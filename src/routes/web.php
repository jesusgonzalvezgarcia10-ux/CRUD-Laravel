<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Página principal redirige a artículos
Route::get('/', function () {
    return redirect()->route('articles.index');
});

// Ruta de prueba para Eloquent (Actividad 4)
Route::get('/articles/test', [ArticleController::class, 'test'])->name('articles.test');

// Rutas públicas de artículos
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show')->where('id', '[0-9]+');

// Rutas protegidas de artículos (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/articles/mine', [ArticleController::class, 'mine'])->name('articles.mine');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

// Dashboard redirige a artículos (después de login)
Route::get('/dashboard', function () {
    return redirect()->route('articles.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
