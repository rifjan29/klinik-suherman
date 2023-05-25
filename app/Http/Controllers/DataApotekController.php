<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiObat;
use App\Models\Obat;
use App\Models\TransaksiPemesananObat;
use Illuminate\Http\Request;

class DataApotekController extends Controller
{
    public function list()
    {
        $data = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*','pasien.nama')
                                    ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                    ->where('transaksi_pemesanan_obat.status','pending')->where('transaksi_pemesanan_obat.status_pengambilan','pending')
                                    ->get();
        return view('backend.data-e-apotek.list',compact('data'));
    }

    public function updatePembayaran($id)
    {
        $data = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*',
                            'hasil_konsultasi.resep_obat','hasil_konsultasi.kode_transaksi_konsultasi')
                            ->join('hasil_konsultasi','hasil_konsultasi.id','transaksi_pemesanan_obat.id_hasil_konsultasi')
                            ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                            ->where('transaksi_pemesanan_obat.status','pending')->where('transaksi_pemesanan_obat.status_pengambilan','pending')
                            ->where('transaksi_pemesanan_obat.id',$id)
                            ->first();
        $obat = Obat::all();
        return view('backend.data-e-apotek.update-pembayaran',compact('data','obat'));
    }

    public function dataObat()
    {
        $data = Obat::all();
        return response()->json($data);
    }

    public function post(Request $request)
    {
        $request->validate([
            'obat.*' => 'required',
            'qty.*' => 'required|numeric|min:1',
        ]);

        $total = 0;
        $embalase = $request->embalase != null ? $request->embalase : 0;
        $lainnya = $request->lainnya != null ? $request->lainnya : 0;
        foreach ($request->obat as $key => $value) {
            $obat = Obat::find($value);
            $harga = $obat->harga;
            $jumlah = $request->qty[$key];
            $subtotal = ($harga * $jumlah) + $embalase + $lainnya;
            // input detail
            $id = TransaksiPemesananObat::where('kode_transaksi',$request->get('kode_transaksi'))->first()->id;
            $detail = new DetailTransaksiObat;
            $detail->id_transaksi_obat = $id;
            $detail->id_obat = $value;
            $detail->qty = $request->qty[$key];
            $detail->save();
        }
        $total += $subtotal;
        TransaksiPemesananObat::where('kode_transaksi',$request->get('kode_transaksi'))->update([
            'nominal_bayar' => $total,
            'harga_lainnya' => $lainnya,
            'harga_embalase' => $embalase,
        ]);
        return redirect()->route('e-apotek.list')->withStatus('Transaksi obat berhasil ditambahkan. Total: '.$total);
    }
}
