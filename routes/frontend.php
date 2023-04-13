<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend as Frontend;

// Beranda
Route::get('/', [Frontend\HomeController::class, 'index'])->name('beranda');

// Login User
Route::get('user-login', [Frontend\AuthController::class, 'index'])->name('login.index');
 
// Register User
Route::get('user-register', [Frontend\AuthController::class, 'register'])->name('login.register');

// Pelayanan
Route::prefix('pelayanan')->group(function() {
    Route::get('rawat-jalan', [Frontend\PelayananController::class, 'jalan'])->name('rawat-jalan');
    Route::get('rawat-inap', [Frontend\PelayananController::class, 'inap'])->name('rawat-inap');
    Route::get('penunjang', [Frontend\PelayananController::class, 'penunjang'])->name('penunjang');
    Route::get('ugd', [Frontend\PelayananController::class, 'ugd'])->name('ugd');
    Route::get('e-ambulance', [Frontend\PelayananController::class, 'ambulance'])->name('e-ambulance');
    Route::get('e-konsultasi', [Frontend\PelayananController::class, 'konsultasi'])->name('e-konsultasi');
});





require __DIR__.'/auth.php';
