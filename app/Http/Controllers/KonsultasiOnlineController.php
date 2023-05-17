<?php

namespace App\Http\Controllers;

use App\Models\PemesananKonsultasi;
use Illuminate\Http\Request;

class KonsultasiOnlineController extends Controller
{
    public function index()
    {
        $data = PemesananKonsultasi::select('pemesanan_konsultasi.*',
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
                                    ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas')->get();
        return view('backend.dokter.konsultasi.list',compact('data'));
    }

    public function chat()
    {
        return view('backend.dokter.konsultasi.chat');
    }

    public function RiwayatKonsultasi()
    {
        $data = PemesananKonsultasi::select('pemesanan_konsultasi.*',
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
                                    ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas')->get();
        return view('backend.dokter.konsultasi.riwayat',compact('data'));

    }

    public function penilaian()
    {
        return view('backend.dokter.konsultasi.penilaian');
    }
}

