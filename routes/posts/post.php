<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {
    // Listar todos los posts

    // Insertar un nuevo post
    Route::get('/posts/insert', [PostController::class, 'create'])->name('posts.insert');

    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');

    // Mostrar un post individual
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

    // Eliminar un post (solo el propietario puede hacerlo)
    Route::delete('/posts/{id}', [PostController::class, 'delete'])->name('posts.delete');
});

// Ruta no protegida
Route::get('/rutaNoProtegida', function() {
    return view('viewNoProtegida');
});
