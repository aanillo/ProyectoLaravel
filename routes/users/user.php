<?php



use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('users.showRegister');
Route::post('/login', [UserController::class, 'doLogin'])->name('users.doLogin');
Route::post('/register', [UserController::class, 'doRegister'])->name('users.doRegister');