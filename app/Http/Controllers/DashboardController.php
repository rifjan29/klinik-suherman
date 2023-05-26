<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Apotek;
use App\Models\Dokter;
use App\Models\ModelPasien;
use App\Models\PemesananKonsultasi;
use App\Models\Petugas;
use App\Models\RiwayatTransaksAmbulance;
use App\Models\TransaksiPemesananObat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'dokter') {
            $data['user'] = User::find(Auth::user()->id);
            $data['data'] = Dokter::where('id_user',$data['user']->id)->first();
            $data['dokter'] = PemesananKonsultasi::select('pemesanan_konsultasi.*',
                                        'detail_pemesanan_konsultasi.id as detail_konsultasi',
                                        'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                        'detail_pemesanan_konsultasi.status_pembayaran',
                                        'detail_pemesanan_konsultasi.id_user',
                                        'detail_pemesanan_konsultasi.keterangan',
                                        'dokter.id as iddokter',
                                        'dokter.nama_dokter',
                                        'pasien.id as id_pasien',
                                        'pasien.nama as nama_pasien',
                                        'pasien.phone',
                                        'bank.id as idbank',
                                        'bank.nama_bank',
                                        'bank.no_rekening')
                                        ->join('detail_pemesanan_konsultasi',
                                                'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                                'pemesanan_konsultasi.id')
                                        ->join('pasien','pasien.id','pemesanan_konsultasi.id_pasien_konsultasi')
                                        ->join('dokter','dokter.id','pemesanan_konsultasi.id_dokter')
                                        ->join('bank','bank.id','pemesanan_konsultasi.id_bank')
                                        ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas')
                                        ->where('pemesanan_konsultasi.id_dokter',$data['data']->id)
                                        ->orderBy('pemesanan_konsultasi.id','DESC')
                                        ->first();
            return view('dashboard-dokter',$data);
        }
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
        $data_grafik_apotek = TransaksiPemesananObat::select(
                    "id" ,
                    DB::raw("(sum(nominal_bayar)) as total_biaya"),
                    DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year")
                    )
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
                    ->get();
        return view('dashboard',compact('dataAkun',
                    'dataPasien',
                    'riwayatAmbulance',
                    'data_grafik_konsultasi',
                    'data_grafik_ambulance',
                    'riwayatKonsultasi','data_grafik_apotek'));
    }
}
