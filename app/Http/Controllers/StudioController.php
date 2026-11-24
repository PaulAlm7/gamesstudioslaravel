<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudioController extends Controller
{
    public function allStudios()
    {
        $studios = Studio::withCount('games')->orderBy('name')->get();

        return view('studios.all_studios', compact('studios'));
    }

    public function addStudio()
    {
        return view('studios.add_studio');
    }

    public function storeStudio(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = Storage::disk('public')->putFile('studios', $request->file('photo'));
        }

        Studio::create([
            'name' => $request->name,
            'photo' => $photoPath,
        ]);

        return redirect()->route('studios.all')
            ->with('message', 'Estúdio adicionado com sucesso!');
    }

    public function editStudio($id)
    {
        $studio = Studio::findOrFail($id);

        return view('studios.edit_studio', compact('studio'));
    }

    // public function updateStudio(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:studios,id',
    //         'name' => 'required|string|max:255',
    //         'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    //     ]);

    //     $studio = Studio::findOrFail($request->id);
    //     $photoPath = $studio->photo;

    //     if ($request->hasFile('photo')) {
    //         if ($studio->photo && Storage::disk('public')->exists($studio->photo)) {
    //             Storage::disk('public')->delete($studio->photo);
    //         }

    //         $photoPath = Storage::disk('public')->putFile('studios', $request->file('photo'));
    //     }

    //     $studio->update([
    //         'name' => $request->name,
    //         'photo' => $photoPath,
    //     ]);

    //     return redirect()->route('studios.all')
    //         ->with('message', 'Estúdio atualizado com sucesso!');
    // }

    public function updateStudio(Request $request)
    {
    $request->validate([
        'id' => 'required|exists:studios,id',
        'name' => 'required|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $studio = Studio::findOrFail($request->id);
    $photoPath = $this->replaceUploadedImage($request, 'photo', 'studios', $studio->photo);

    $studio->update([
        'name' => $request->name,
        'photo' => $photoPath,
    ]);

    return redirect()->route('studios.all')
        ->with('message', 'Estúdio atualizado com sucesso!');
    }

    public function deleteStudio($id)
    {
        $studio = Studio::findOrFail($id);

        if ($studio->photo && Storage::disk('public')->exists($studio->photo)) {
            Storage::disk('public')->delete($studio->photo);
        }

        $games = Game::where('studio_id', $studio->id)->get();
        foreach ($games as $game) {
            if ($game->cover && Storage::disk('public')->exists($game->cover)) {
                Storage::disk('public')->delete($game->cover);
            }
        }

        $studio->delete();

        return redirect()->route('studios.all')
            ->with('message', 'Estúdio e respetivos jogos eliminados com sucesso!');
    }


    private function replaceUploadedImage(Request $request, string $field, string $folder, ?string $currentPath = null): ?string
    {
    if (! $request->hasFile($field)) {
        return $currentPath;
    }

    if ($currentPath && Storage::disk('public')->exists($currentPath)) {
        Storage::disk('public')->delete($currentPath);
    }

    return $request->file($field)->store($folder, 'public');
    }

}
