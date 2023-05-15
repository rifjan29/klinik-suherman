<?php

namespace App\Http\Controllers;

use App\Models\DetailPemesananKonsultasi;
use App\Models\PemesananKonsultasi;
use Illuminate\Http\Request;

class TransaksiKonsultasiController extends Controller
{
    public function ListTransaksi()
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
                                ->where('detail_pemesanan_konsultasi.status_pembayaran','pending')->get();
        return view('backend.transaksi-konsultasi.list-transaksi',compact('data'));
    }

    public function GetTransaksi(Request $request)
    {
        $data = PemesananKonsultasi::select('pemesanan_konsultasi.*',
                                    'pasien.id as id_pasien',
                                    'pasien.nama as nama_pasien',
                                    'pasien.phone')
                                ->join('pasien','pasien.id','pemesanan_konsultasi.id_pasien_konsultasi')
                                ->where('pemesanan_konsultasi.id',$request->get('id'))->first();
        return response()->json([
            'data' => $data
        ]);
    }

    public function UpdateTransaksi(Request $request)
    {
        $pemesanan = DetailPemesananKonsultasi::where('id_pemesanan_konsultasi',$request->get('id'))->first();
        $pemesanan->status_pembayaran = $request->get('status');
        $pemesanan->id_user = auth()->user()->id;
        $pemesanan->keterangan = $request->get('ket');
        $pemesanan->update();
        return redirect()->route('konsultasi.list')->withStatus('Berhasil update status pembayaran');
    }
    public function RiwayatTransaksi()
    {

    }

    public function Laporan()
    {

    }
}
