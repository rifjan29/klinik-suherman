<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelPasien;
use App\Models\RiwayatTransaksAmbulance;
use App\Models\TransaksiPemesananObat;
use App\Models\PemesananKonsultasi;

class RiwayatController extends Controller
{
    public function riwayat()
    {
        $data = ModelPasien::where('id', session('id'))->first();
        $ambulance = RiwayatTransaksAmbulance::with('pasien_ambulance')->where('transaksi_ambulance.id_pasien',session('id'))->get();
        $obat = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*','pasien.nama')
                                        ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                        ->where('transaksi_pemesanan_obat.status_pengambilan','diterima', session('id'))
                                        ->get();
        $konsultasi = PemesananKonsultasi::select('pemesanan_konsultasi.*',
                                    'detail_pemesanan_konsultasi.id as detail_konsultasi',
                                    'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                    'detail_pemesanan_konsultasi.id_user',
                                    'dokter.id as id_dokter',
                                    'dokter.nama_dokter as nama_dokter',
                                    'dokter.spesialis as spesialis',
                                    'dokter.jenis_kelamin as jenis_kelamin',
                                    'penilaian.suka as suka',
                                    'penilaian.tidak_suka as tidak_suka',
                                    'pasien.id as id_pasien',
                                    'pasien.nama as nama_pasien',
                                    'hasil_konsultasi.kode_transaksi_konsultasi',
                                    'hasil_konsultasi.kesimpulan',
                                    'hasil_konsultasi.resep_obat')
                                    ->join('dokter','dokter.id','pemesanan_konsultasi.id_dokter')
                                    ->join('pasien','pasien.id','pemesanan_konsultasi.id_pasien_konsultasi')
                                    ->join('detail_pemesanan_konsultasi',
                                        'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                        'pemesanan_konsultasi.id')
                                    ->join('penilaian','dokter.id','penilaian.id_dokter')
                                    ->join('hasil_konsultasi','hasil_konsultasi.kode_transaksi_konsultasi','pemesanan_konsultasi.kode_pemesanan')
                                    ->where('pemesanan_konsultasi.id_pasien_konsultasi',session('id'))->get();
        // dd($konsultasi);
        return view('layouts.frontend.riwayat.riwayat', compact('data','ambulance', 'obat', 'konsultasi'));
    }
}
