<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Apotek;
use App\Models\Dokter;
use App\Models\ModelPasien;
use App\Models\PemesananKonsultasi;
use App\Models\Petugas;
use App\Models\RiwayatTransaksAmbulance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $dataAkun  = Admin::count() + Petugas::count() + Dokter::count() + Apotek::count();
        $dataPasien = ModelPasien::count();
        $riwayatAmbulance = RiwayatTransaksAmbulance::count();
        $riwayatKonsultasi = PemesananKonsultasi::count();
        $data_grafik_ambulance = RiwayatTransaksAmbulance::select(
            "id" ,
            DB::raw("(sum(total_biaya)) as total_biaya"),
            DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year")
            )
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
            ->get();
        $data_grafik_konsultasi = PemesananKonsultasi::select(
                "id" ,
                DB::raw("(sum(total_nominal)) as total_biaya"),
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year")
                )
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
                ->get();
        // $data_grafik_apotek = ::select(
        //             "id" ,
        //             DB::raw("(sum(total_nominal)) as total_biaya"),
        //             DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year")
        //             )
        //             ->orderBy('created_at')
        //             ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
        //             ->get();
        return view('dashboard',compact('dataAkun',
                    'dataPasien',
                    'riwayatAmbulance',
                    'data_grafik_konsultasi',
                    'data_grafik_ambulance',
                    'riwayatKonsultasi'));
    }
}
