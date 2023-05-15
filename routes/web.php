<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\ApoterController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardDokterController;
use App\Http\Controllers\DataMobilAmbulanceController;
use App\Http\Controllers\DataProfileController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiKonsultasiController;
use App\Models\Ambulance;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('profile-user/{id}',[DataProfileController::class,'index'])->name('profile-user');
    Route::prefix('dashboard')->group(function () {
        Route::prefix('master-data')->group(function () {
            Route::resource('poli', PoliController::class);
            Route::resource('dokter', DokterController::class);
            Route::resource('admin', AdminController::class);
            Route::resource('petugas',PetugasController::class);
            Route::resource('apotek',ApoterController::class);
            Route::resource('ambulance', DataMobilAmbulanceController::class);
            Route::resource('kasir', KasirController::class);
            Route::resource('bank', BankController::class);
        });
        Route::prefix('ambulance')->group(function () {
            Route::get('data-ambulance',[AmbulanceController::class,'index'])->name('data-ambulance');
            // list ambulance
            Route::post('list-ambulance/post/{id}',[AmbulanceController::class,'postAmbulance'])->name('list-ambulance.post');
            Route::get('list-ambulance/update-perjalanan/{id}',[AmbulanceController::class,'updatePerjalanan'])->name('list-ambulance.update-perjalanan');
            Route::get('list-ambulance/update-perjalanan-dua/{id}',[AmbulanceController::class,'updatePerjalananDua'])->name('list-ambulance.update-perjalanan-dua');
            Route::post('list-ambulance/update-status',[AmbulanceController::class,'updateStatus'])->name('update-status.riwayat-ambulance');
            Route::post('list-ambulance/detail/update/{id}',[AmbulanceController::class,'updatePesanan'])->name('list-ambulance.detail-update');
            Route::get('list-ambulance/detail/{id}',[AmbulanceController::class,'detail'])->name('list-ambulance.detail');
            Route::get('list-ambulance',[AmbulanceController::class,'list'])->name('list-ambulance');
            // riwayat
            Route::get('riwayat-ambulance/detail/{id}',[AmbulanceController::class,'riwayatDetail'])->name('riwayat-ambulance.detail');
            Route::get('riwayat-ambulance',[AmbulanceController::class,'riwayat'])->name('riwayat-ambulance');
            // Laporan e-ambulance
            Route::get('laporan-ambulance/pdf',[AmbulanceController::class,'pdf'])->name('laporan-ambulance.pdf');
            Route::get('laporan-ambulance/excel',[AmbulanceController::class,'excel'])->name('laporan-ambulance.excel');
            Route::get('laporan-ambulance',[AmbulanceController::class,'laporan'])->name('laporan-ambulance');

        });
        Route::prefix('e-konsultasi')->group(function () {
            Route::get('list-transaksi',[TransaksiKonsultasiController::class,'ListTransaksi'])->name('konsultasi.list');
            Route::get('riwayat-transaksi',[TransaksiKonsultasiController::class,'RiwayatTransaksi'])->name('konsultasi.riwayat');
            Route::get('laporan-transaksi',[TransaksiKonsultasiController::class,'LaporanTransaksi'])->name('konsultasi.laporan');
        });

        Route::prefix('konsultasi')->group(function () {
            Route::get('dashboard-dokter',[DashboardDokterController::class,'index'])->name('dokter.dashboard');
        });



    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require_once __DIR__.'/frontend.php';
