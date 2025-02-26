<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {
    // Listar todos los posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    // Insertar un nuevo post
    Route::post('/posts', [PostController::class, 'insert'])->name('posts.insert');

    // Mostrar un post individual
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

    // Eliminar un post (solo el propietario puede hacerlo)
    Route::delete('/posts/{id}', [PostController::class, 'delete'])->name('posts.delete');
});

// Ruta no protegida
Route::get('/rutaNoProtegida', function() {
    return view('viewNoProtegida');
});
