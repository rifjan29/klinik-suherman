<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend as Frontend;
use App\Http\Controllers\WilayaIndonesiaDropdownController;

// Beranda
Route::get('/', [Frontend\HomeController::class, 'index'])->name('beranda');

// Login User
Route::get('user-login', [Frontend\PasienController::class, 'login'])->name('login.index');
Route::post('user-login/post', [Frontend\PasienController::class, 'loginPost'])->name('loginPost');
// Register User
Route::get('user-register', [Frontend\PasienController::class, 'register'])->name('login.register');
Route::post('user-register/post', [Frontend\PasienController::class, 'registerPost'])->name('registerPost');

// Logout
Route::get('logout', [Frontend\PasienController::class, 'logout'])->name('logout');

// Profile
Route::prefix('akun')->group(function() {
    Route::get('profil-saya', [Frontend\ProfileController::class, 'ProfilSaya'])->name('profil');
    Route::get('riwayat', [Frontend\RiwayatController::class, 'riwayat'])->name('riwayat');
    Route::get('notifikasi', [Frontend\NotifikasiController::class, 'index'])->name('notifikasi');
    Route::get('pengaturan', [Frontend\PengaturanController::class, 'index'])->name('pengaturan');
});



// Pelayanan
Route::get('cek-status',[Frontend\AmbulanceController::class,'status'])->name('e-ambulance.status');
Route::get('cek-estimasi',[Frontend\AmbulanceController::class,'statusEstimasi'])->name('e-ambulance.status-estimasi');

Route::prefix('pelayanan')->group(function() {
    Route::get('rawat-jalan', [Frontend\PelayananController::class, 'jalan'])->name('rawat-jalan');
    Route::get('rawat-inap', [Frontend\PelayananController::class, 'inap'])->name('rawat-inap');
    Route::get('penunjang', [Frontend\PelayananController::class, 'penunjang'])->name('penunjang');
    Route::get('ugd', [Frontend\PelayananController::class, 'ugd'])->name('ugd');
    Route::prefix('e-ambulance')->group(function () {
        Route::get('beranda', [Frontend\AmbulanceController::class, 'index'])->name('e-ambulance');
        // Pilihan Layanan Fitur Online
        Route::get('fitur', [Frontend\AmbulanceController::class, 'fitur'])->name('e-ambulance.fitur');
        Route::get('cek', [Frontend\AmbulanceController::class, 'cek'])->name('e-ambulance.cek');
        Route::get('create', [Frontend\AmbulanceController::class, 'create'])->name('e-ambulance.create');
        Route::post('create/post', [Frontend\AmbulanceController::class, 'store'])->name('e-ambulance.store');
        Route::get('list-pesanan',[Frontend\AmbulanceController::class,'list'])->name('e-ambulance.list');
        Route::get('ringkasan-pesanan/{id}',[Frontend\AmbulanceController::class,'ringkasan'])->name('e-ambulance.ringkasan');
        Route::get('metode-pembayaran/{id}',[Frontend\AmbulanceController::class,'pembayaran'])->name('e-ambulance.pembayaran');
        Route::get('metode-pembayaran/versi-cetak/{id}',[Frontend\AmbulanceController::class,'versi'])->name('e-ambulance.versi');
        Route::get('metode-pembayaran/estimasi-ambulance/{id}',[Frontend\AmbulanceController::class,'estimasi'])->name('e-ambulance.estimasi');
        Route::get('metode-pembayaran/estimasi-ambulance/selesai/{id}',[Frontend\AmbulanceController::class,'estimasiSelesai'])->name('e-ambulance.estimasi-selesai');

    });

    // Layanan E-Konsultasi
    Route::prefix('e-konsultasi')->group(function() {
        Route::get('beranda', [Frontend\KonsultasiController::class, 'index'])->name('e-konsultasi');
        Route::get('pembayaran', [Frontend\KonsultasiController::class, 'pembayaran'])->name('pembayaran');
        Route::get('pesan', [Frontend\KonsultasiController::class, 'pesan'])->name('pesan');
    });

    
    Route::get('e-apotek', [Frontend\PelayananController::class, 'apotek'])->name('e-apotek');
});

Route::get('provinces', [WilayaIndonesiaDropdownController::class,'provinces'])->name('provinces');
Route::get('cities',[WilayaIndonesiaDropdownController::class,'cities'])->name('cities');
Route::get('districts', [WilayaIndonesiaDropdownController::class,'districts'])->name('districts');
Route::get('villages', [WilayaIndonesiaDropdownController::class,'villages'])->name('villages');



require __DIR__.'/auth.php';
