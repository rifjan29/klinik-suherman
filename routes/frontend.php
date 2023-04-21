<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend as Frontend;

// Beranda
Route::get('/', [Frontend\HomeController::class, 'index'])->name('beranda');

// Login User
Route::get('user-login', [Frontend\AuthController::class, 'index'])->name('login.index');
<<<<<<< HEAD

=======
Route::post('user-login', [Frontend\AuthController::class, 'login']);
 
>>>>>>> da951733c4865ac43fd8fe687d11144c8a1d12c8
// Register User
Route::get('user-register', [Frontend\AuthController::class, 'register'])->name('login.register');

// Pelayanan
Route::prefix('pelayanan')->group(function() {
    Route::get('rawat-jalan', [Frontend\PelayananController::class, 'jalan'])->name('rawat-jalan');
    Route::get('rawat-inap', [Frontend\PelayananController::class, 'inap'])->name('rawat-inap');
    Route::get('penunjang', [Frontend\PelayananController::class, 'penunjang'])->name('penunjang');
    Route::get('ugd', [Frontend\PelayananController::class, 'ugd'])->name('ugd');
    Route::prefix('e-ambulance')->group(function () {
        Route::get('beranda', [Frontend\AmbulanceController::class, 'index'])->name('e-ambulance');
        Route::get('create', [Frontend\AmbulanceController::class, 'create'])->name('e-ambulance.create');
    });
    Route::get('e-konsultasi', [Frontend\PelayananController::class, 'konsultasi'])->name('e-konsultasi');
});





require __DIR__.'/auth.php';
