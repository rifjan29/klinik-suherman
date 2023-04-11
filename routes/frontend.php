<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend as Frontend;

// Beranda
Route::get('/', [Frontend\HomeController::class, 'index'])->name('beranda');

// Login User
Route::get('user-login', [Frontend\AuthController::class, 'index'])->name('login.index');
 
// Register User
Route::get('user-register', [Frontend\AuthController::class, 'register'])->name('login.register');





require __DIR__.'/auth.php';
