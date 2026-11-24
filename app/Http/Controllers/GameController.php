<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function gamesByStudio($id)
    {
        $studio = Studio::findOrFail($id);
        $games = Game::where('studio_id', $studio->id)
            ->orderBy('release_date', 'desc')
            ->get();

        return view('games.studio_games', compact('studio', 'games'));
    }

    public function addGame($studio_id = null)
    {
        $studios = Studio::orderBy('name')->get();

        return view('games.add_game', compact('studios', 'studio_id'));
    }

    public function storeGame(Request $request)
    {
        $request->validate([
            'studio_id' => 'required|exists:studios,id',
            'name' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'release_date' => 'nullable|date',
        ]);

        $coverPath = null;

        if ($request->hasFile('cover')) {
            $coverPath = Storage::disk('public')->putFile('games', $request->file('cover'));
        }

        Game::create([
            'studio_id' => $request->studio_id,
            'name' => $request->name,
            'cover' => $coverPath,
            'release_date' => $request->release_date,
        ]);

        return redirect()->route('studios.games', $request->studio_id)
            ->with('message', 'Jogo adicionado com sucesso!');
    }

    public function editGame($id)
    {
        $game = Game::findOrFail($id);
        $studios = Studio::orderBy('name')->get();

        return view('games.edit_game', compact('game', 'studios'));
    }

    public function updateGame(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:games,id',
            'studio_id' => 'required|exists:studios,id',
            'name' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'release_date' => 'nullable|date',
        ]);

        $game = Game::findOrFail($request->id);
        $coverPath = $game->cover;

        if ($request->hasFile('cover')) {
            if ($game->cover && Storage::disk('public')->exists($game->cover)) {
                Storage::disk('public')->delete($game->cover);
            }

            $coverPath = Storage::disk('public')->putFile('games', $request->file('cover'));
        }

        $game->update([
            'studio_id' => $request->studio_id,
            'name' => $request->name,
            'cover' => $coverPath,
            'release_date' => $request->release_date,
        ]);

        return redirect()->route('studios.games', $game->studio_id)
            ->with('message', 'Jogo atualizado com sucesso!');
    }

    public function deleteGame($id)
    {
        $game = Game::findOrFail($id);
        $studioId = $game->studio_id;

        if ($game->cover && Storage::disk('public')->exists($game->cover)) {
            Storage::disk('public')->delete($game->cover);
        }

        $game->delete();

        return redirect()->route('studios.games', $studioId)
            ->with('message', 'Jogo eliminado com sucesso!');
    }
}
