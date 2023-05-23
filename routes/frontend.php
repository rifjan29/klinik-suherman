<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend as Frontend;
use App\Http\Controllers\WilayaIndonesiaDropdownController;

// Beranda
Route::get('/', [Frontend\HomeController::class, 'index'])->name('beranda');
Route::post('kritik-saran', [Frontend\HomeController::class, 'kritikSaran'])->name('kritikSaran');

// Login User
Route::get('user-login', [Frontend\PasienController::class, 'login'])->name('login.index');
Route::post('user-login/post', [Frontend\PasienController::class, 'loginPost'])->name('loginPost');
// Register User
Route::get('user-register', [Frontend\PasienController::class, 'register'])->name('login.register');
Route::post('user-register/post', [Frontend\PasienController::class, 'registerPost'])->name('registerPost');
// Lupa Password
Route::get('lupa-password', [Frontend\PasienController::class, 'forgotPassword'])->name('lupaPassword');
Route::post('lupa-password/post', [Frontend\PasienController::class, 'forgotPasswordPost'])->name('lupaPasswordPost');
// Reset Password
Route::get('reset-password', [Frontend\PasienController::class, 'resetPassword'])->name('resetPassword');
Route::post('reset-password/post', [Frontend\PasienController::class, 'resetPasswordPost'])->name('resetPasswordPost');

// Logout
Route::get('logout', [Frontend\PasienController::class, 'logout'])->name('logout');

// Profile
Route::prefix('akun')->group(function() {
    Route::get('profil-saya', [Frontend\ProfileController::class, 'ProfilSaya'])->name('profil');
    Route::put('update-profil', [Frontend\ProfileController::class, 'updateProfil'])->name('updateProfil');
    Route::get('riwayat', [Frontend\RiwayatController::class, 'riwayat'])->name('riwayat');
    Route::get('notifikasi', [Frontend\NotifikasiController::class, 'index'])->name('notifikasi');
    Route::get('pengaturan', [Frontend\PengaturanController::class, 'index'])->name('pengaturan');
    Route::post('update-password', [Frontend\PengaturanController::class, 'updatePassword'])->name('updatePassword');
});



// Pelayanan
Route::get('cek-status',[Frontend\AmbulanceController::class,'status'])->name('e-ambulance.status');
Route::get('cek-estimasi',[Frontend\AmbulanceController::class,'statusEstimasi'])->name('e-ambulance.status-estimasi');

Route::prefix('pelayanan')->group(function() {
    Route::get('rawat-jalan', [Frontend\PelayananController::class, 'jalan'])->name('rawat-jalan');
    Route::get('rawat-inap', [Frontend\PelayananController::class, 'inap'])->name('rawat-inap');
    Route::get('penunjang', [Frontend\PelayananController::class, 'penunjang'])->name('penunjang');
    Route::get('ugd', [Frontend\PelayananController::class, 'ugd'])->name('ugd');

    // ambulance
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
        Route::get('hasil-konsultasi/list/detail-konsultasi', [Frontend\KonsultasiController::class, 'listKonsultasiDetail'])->name('hasil.list.detail');
        Route::get('hasil-konsultasi/list/{id}', [Frontend\KonsultasiController::class, 'listKonsultasi'])->name('hasil.list');
        Route::post('hasil-konsultasi/post', [Frontend\KonsultasiController::class, 'hasilKonsultasi'])->name('hasil.post');
        Route::post('getpesan/post', [Frontend\KonsultasiController::class, 'sendMessage'])->name('pesan.post');
        Route::get('getpesan', [Frontend\KonsultasiController::class, 'getMessage'])->name('pesan.get');
        Route::get('pesan/{id}', [Frontend\KonsultasiController::class, 'pesan'])->name('pesan.beranda');
        // pembayaran upload
        Route::get('pembayaran/cek-transaksi-konsultasi', [Frontend\KonsultasiController::class, 'CekNotifikasiPembayaran'])->name('pembayaran.notifikasi.cek');
        Route::get('pembayaran/detail/upload/notifikasi/{id}', [Frontend\KonsultasiController::class, 'NotifikasiPembayaran'])->name('pembayaran.notifikasi');
        Route::post('pembayaran/detail/upload', [Frontend\KonsultasiController::class, 'UploadPembayaran'])->name('pembayaran.upload');
        // pembayaran detail
        Route::get('pembayaran/detail/{id}', [Frontend\KonsultasiController::class, 'DetailPembayaran'])->name('pembayaran.detail');
        Route::post('pembayaran', [Frontend\KonsultasiController::class, 'postPembayaran'])->name('pembayaran.post');
        // beranda pesan konsultasi
        Route::get('beranda/detail', [Frontend\KonsultasiController::class, 'detail'])->name('e-konsultasi.detail');
        Route::get('beranda', [Frontend\KonsultasiController::class, 'index'])->name('e-konsultasi');
    });

    Route::get('e-apotek', [Frontend\PelayananController::class, 'apotek'])->name('e-apotek');
    Route::prefix('e-apotek')->group(function() {
        // apotek
        Route::get('list-data/tebus-resep/{id}',[Frontend\ApotekController::class,'tebusResep'])->name('list.apotek.tebus');
        Route::get('list-data/',[Frontend\ApotekController::class,'listData'])->name('list.apotek.detail');
        Route::get('list',[Frontend\ApotekController::class,'index'])->name('list.apotek');
        // tebus obat
        Route::post('list/post',[Frontend\ApotekController::class,'post'])->name('post.apotek');
    });

});

Route::get('provinces', [WilayaIndonesiaDropdownController::class,'provinces'])->name('provinces');
Route::get('cities',[WilayaIndonesiaDropdownController::class,'cities'])->name('cities');
Route::get('districts', [WilayaIndonesiaDropdownController::class,'districts'])->name('districts');
Route::get('villages', [WilayaIndonesiaDropdownController::class,'villages'])->name('villages');



require __DIR__.'/auth.php';
