<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {
    Route::get('/insert', [PostController::class, 'create'])->name('posts.insert');
    Route::post('/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/show', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/{id}', [PostController::class, 'delete'])->name('posts.delete');
});


Route::get('/rutaNoProtegida', function() {
    return view('viewNoProtegida');
});
