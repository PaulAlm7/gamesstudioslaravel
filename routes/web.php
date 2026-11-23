<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\StudioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('studios.all');
})->name('home');

// 1. ROTAS PÚBLICAS
Route::get('/studios', [StudioController::class, 'allStudios'])->name('studios.all');
Route::get('/studios/{id}/games', [GameController::class, 'gamesByStudio'])->name('studios.games');

// 2. ROTAS PROTEGIDAS POR AUTH (Dashboard + Editar)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/edit-studio/{id}', [StudioController::class, 'editStudio'])->name('studios.edit');
    Route::put('/update-studio', [StudioController::class, 'updateStudio'])->name('studios.update');
    Route::get('/edit-game/{id}', [GameController::class, 'editGame'])->name('games.edit');
    Route::put('/update-game', [GameController::class, 'updateGame'])->name('games.update');
});

// 3. ROTAS PROTEGIDAS POR AUTH + ADMIN (Criar e Apagar)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/add-studio', [StudioController::class, 'addStudio'])->name('studios.add');
    Route::post('/store-studio', [StudioController::class, 'storeStudio'])->name('studios.store');
    Route::get('/delete-studio/{id}', [StudioController::class, 'deleteStudio'])->name('studios.delete');

    Route::get('/add-game/{studio_id?}', [GameController::class, 'addGame'])->name('games.add');
    Route::post('/store-game', [GameController::class, 'storeGame'])->name('games.store');
    Route::get('/delete-game/{id}', [GameController::class, 'deleteGame'])->name('games.delete');
});

// 4. ROTA FALLBACK
Route::fallback(function () {
    return view('utils.fallback');
});
