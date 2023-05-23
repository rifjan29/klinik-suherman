<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPemesananObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApotekController extends Controller
{
    public function index()
    {
        $data = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*',
                                        'pasien.nama',
                                        'hasil_konsultasi.resep_obat')
                                    ->join('hasil_konsultasi','hasil_konsultasi.id','transaksi_pemesanan_obat.id_hasil_konsultasi')
                                    ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                    ->where('transaksi_pemesanan_obat.id_pasien',Session::get('id'))->get();
        return view('layouts.frontend.apotek.list',compact('data'));
    }
    public function post(Request $request)
    {
        $cek = TransaksiPemesananObat::where('id_hasil_konsultasi',$request->get('id_hasil_konsultasi'))->first();
        if ($cek == null) {
            $transaksiObat = new TransaksiPemesananObat;
            $transaksiObat->id_pasien = $request->get('id_pasien');
            $transaksiObat->id_hasil_konsultasi = $request->get('id_hasil_konsultasi');
            $transaksiObat->kode_transaksi = $this->generateTransaksi();
            $transaksiObat->save();
            return redirect()->route('list.apotek');
        }else{
            return redirect()->route('list.apotek');
        }

    }

    public function listData(Request $request)
    {
        $transaksiObat = TransaksiPemesananObat::where('kode_transaksi',$request->get('kode_transaksi'))->first();
        return response()->json($transaksiObat);
    }

    public function tebusResep($id)
    {
        $transaksiObat = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*',
                                    'pasien.nama',
                                    'hasil_konsultasi.resep_obat')
                                ->join('hasil_konsultasi','hasil_konsultasi.id','transaksi_pemesanan_obat.id_hasil_konsultasi')
                                ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                ->where('transaksi_pemesanan_obat.kode_transaksi',$id)->first();
        return view('layouts.frontend.apotek.tebus-resep',compact('transaksiObat'));

    }

    public function generateTransaksi()
    {
        $date = date('Ymd');

        $noTransaksi = null;
        $ambulance = TransaksiPemesananObat::orderBy('created_at', 'DESC')->get();

        if($ambulance->count() > 0) {
            $noTransaksi = $ambulance[0]->kode_transaksi;

            $lastIncrement = substr($noTransaksi, 10);

            $noTransaksi = str_pad($lastIncrement + 1, 4, 0, STR_PAD_LEFT);
            return $noTransaksi = "KO".$date.$noTransaksi;
        }
        else {
            return $noTransaksi = "K0".$date."0001";
        }
    }
}
