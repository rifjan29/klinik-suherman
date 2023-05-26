<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelPasien;
use App\Models\RiwayatTransaksAmbulance;
use App\Models\TransaksiPemesananObat;
use App\Models\PemesananKonsultasi;
use App\Models\RiwayatChat;

class RiwayatController extends Controller
{
    public function riwayat()
    {
        $data = ModelPasien::where('id', session('id'))->first();
        // $ambulance = RiwayatTransaksAmbulance::with('pasien_ambulance')->where('transaksi_ambulance.id_pasien',session('id'))->get();
        // $konsultasi = 
        $ambulance = RiwayatTransaksAmbulance::with('pasien_ambulance')->where('id_pasien',session('id'))->get();
        $apotek = TransaksiPemesananObat::with('pasien_apotek')->where('id_pasien',session('id'))->get();
        
        return view('layouts.frontend.riwayat.riwayat', compact('data'));
    }
}
