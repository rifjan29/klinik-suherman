<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\ApoterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataMobilAmbulanceController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    Route::prefix('dashboard')->group(function () {
        Route::prefix('master-data')->group(function () {
            Route::resource('poli', PoliController::class);
            Route::resource('dokter', DokterController::class);
            Route::resource('admin', AdminController::class);
            Route::resource('petugas',PetugasController::class);
            Route::resource('apotek',ApoterController::class);
            Route::resource('ambulance', DataMobilAmbulanceController::class);
            Route::resource('kasir', KasirController::class);
        });
        Route::prefix('ambulance')->group(function () {
            Route::get('data-ambulance',[AmbulanceController::class,'index'])->name('data-ambulance');
            Route::get('riwayat-ambulance',[AmbulanceController::class,'riwayat'])->name('riwayat-ambulance');
            // Route::get('data-saldo',[AmbulanceController::class,'saldo'])->name('data-saldo');
            // Route::get('data-pemasukan',[AmbulanceController::class,'pemasukan'])->name('data-pemasukan');
            // Route::get('riwayat-transaksi',[AmbulanceController::class,'transaksi'])->name('riwayat-transaksi');

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
