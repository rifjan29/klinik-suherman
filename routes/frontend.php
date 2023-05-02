<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend as Frontend;
use App\Http\Controllers\WilayaIndonesiaDropdownController;

// Beranda
Route::get('/', [Frontend\HomeController::class, 'index'])->name('beranda');

// Login User
Route::get('user-login', [Frontend\AuthController::class, 'index'])->name('login.index');
Route::post('user-login', [Frontend\AuthController::class, 'login']);

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
        Route::get('cek', [Frontend\AmbulanceController::class, 'cek'])->name('e-ambulance.cek');
        Route::get('create', [Frontend\AmbulanceController::class, 'create'])->name('e-ambulance.create');
        Route::post('create/post', [Frontend\AmbulanceController::class, 'store'])->name('e-ambulance.store');
        Route::get('list-pesanan',[Frontend\AmbulanceController::class,'list'])->name('e-ambulance.list');

    });
    Route::get('e-konsultasi', [Frontend\PelayananController::class, 'konsultasi'])->name('e-konsultasi');
});

Route::get('provinces', [WilayaIndonesiaDropdownController::class,'provinces'])->name('provinces');
Route::get('cities',[WilayaIndonesiaDropdownController::class,'cities'])->name('cities');
Route::get('districts', [WilayaIndonesiaDropdownController::class,'districts'])->name('districts');
Route::get('villages', [WilayaIndonesiaDropdownController::class,'villages'])->name('villages');



require __DIR__.'/auth.php';
