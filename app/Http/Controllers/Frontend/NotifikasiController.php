<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelPasien;
use App\Models\PemesananKonsultasi;
use App\Models\RiwayatTransaksAmbulance;
use Illuminate\Support\Facades\Session;

class NotifikasiController extends Controller
{
    public function index()
    {
        $data = ModelPasien::where('id', session('id'))->first();
        $konsultasi = PemesananKonsultasi::select('pemesanan_konsultasi.*',
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
                                ->where('pemesanan_konsultasi.id_pasien_konsultasi',Session::get('id'))->orderBy('pemesanan_konsultasi.id','DESC')->take(1)->get();
        $apotek = PemesananKonsultasi::select('pemesanan_konsultasi.*',
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
                                'bank.no_rekening',
                                'hasil_konsultasi.kode_transaksi_konsultasi',
                                'hasil_konsultasi.status as status_update')
                                ->join('detail_pemesanan_konsultasi',
                                        'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                        'pemesanan_konsultasi.id')
                                ->join('pasien','pasien.id','pemesanan_konsultasi.id_pasien_konsultasi')
                                ->join('dokter','dokter.id','pemesanan_konsultasi.id_dokter')
                                ->join('bank','bank.id','pemesanan_konsultasi.id_bank')
                                ->join('hasil_konsultasi','hasil_konsultasi.kode_transaksi_konsultasi','pemesanan_konsultasi.kode_pemesanan')
                                ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas')
                                ->where('pemesanan_konsultasi.id_pasien_konsultasi',Session::get('id'))
                                ->get();
        $ambulance = RiwayatTransaksAmbulance::with('pasien_ambulance')->where('transaksi_ambulance.id_pasien_login',Session::get('id'))->get();
        return view('layouts.frontend.notifikasi.index', compact('data','konsultasi','apotek','ambulance'));
    }
}
