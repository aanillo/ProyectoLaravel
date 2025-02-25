<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function() {
    Route::put('/{id}', [PostController::class, 'updateStatus'])->name('chore.updateStatus');
    Route::delete('/{id}', [PostController::class, 'delete'])->name('chore.delete');
    Route::get('/rutaProtegida', function() {
        return view('viewProtegida');
    });
    Route::get('/insert', [PostController::class, 'viewChore'])->name('chore.viewInsert');
    Route::post('/insert', [PostController::class, 'insert'])->name('chore.insert');
});


Route::get('/rutaNoProtegida', function() {
    return view('viewNoProtegida');
});