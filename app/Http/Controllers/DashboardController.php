<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Apotek;
use App\Models\Dokter;
use App\Models\ModelPasien;
use App\Models\Petugas;
use App\Models\RiwayatTransaksAmbulance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dataAkun  = Admin::count() + Petugas::count() + Dokter::count() + Apotek::count();
        $dataPasien = ModelPasien::count();
        $riwayatAmbulance = RiwayatTransaksAmbulance::count();
        return view('dashboard',compact('dataAkun','dataPasien','riwayatAmbulance'));
    }
}
