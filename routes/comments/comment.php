<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {
    Route::post('/store', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/{id}', [CommentController::class, 'show'])->name('comments.show');
});


Route::get('/rutaNoProtegida', function() {
    return view('viewNoProtegida');
});