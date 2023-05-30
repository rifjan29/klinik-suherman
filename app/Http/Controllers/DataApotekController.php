<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiObat;
use App\Models\Obat;
use App\Models\TransaksiPemesananObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DataApotekController extends Controller
{
    public function list()
    {
        $data = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*','pasien.nama')
                                    ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                    ->where('transaksi_pemesanan_obat.status_pengambilan','pending')
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
            if ($obat->stok <= 0) {
                return redirect()->route('e-apotek.list')->withError('Stok kurang dari permintaaan');
            }
            if ($obat->stok < $request->get('qty')[$key] ) {
                return redirect()->route('e-apotek.list')->withError('Stok kurang dari permintaaan');
            }

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

            $obat->stok -= $request->qty[$key];
            $obat->update();

        }
        $total += $subtotal;
        TransaksiPemesananObat::where('kode_transaksi',$request->get('kode_transaksi'))->update([
            'nominal_bayar' => $total,
            'harga_lainnya' => $lainnya,
            'harga_embalase' => $embalase,
        ]);
        return redirect()->route('e-apotek.list')->withStatus('Transaksi obat berhasil ditambahkan. Total: '.$total);
    }

    public function updatePembayaranTransaksi(Request $request)
    {
        if ($request->get('status') == 'lunas') {
            TransaksiPemesananObat::where('kode_transaksi',$request->get('kode_transaksi'))->update([
                'tgl_ambil_obat' => $request->get('jam_kerja'),
                'status' => 'lunas',
            ]);
        }else{
            $request->validate([
                'ket' => 'required'
            ]);
            TransaksiPemesananObat::where('kode_transaksi',$request->get('kode_transaksi'))->update([
                'alasan' => $request->get('ket'),
                'status' => 'ditolak',
            ]);

        }
        return redirect()->route('e-apotek.list')->withStatus('Transaksi obat berhasil diperbaharui. Kode Transaksi: '.$request->get('kode_transaksi'));

    }
    public function updatePembayaranTransaksiBiaya(Request $request)
    {
        TransaksiPemesananObat::where('kode_transaksi',$request->get('kode_transaksi'))->update([
            'status_pengambilan' => 'diterima',
        ]);
        return redirect()->route('e-apotek.list')->withStatus('Transaksi obat berhasil diperbaharui. Kode Transaksi: '.$request->get('kode_transaksi'));

    }
    public function getDetail(Request $request)
    {
        $data = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*','pasien.nama')
                ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                ->where('transaksi_pemesanan_obat.id',$request->get('id'))
                ->first();
        return response()->json(['data' => $data]);
    }

    public function riwayat()
    {
        $data = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*','pasien.nama')
                                        ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                        ->where('transaksi_pemesanan_obat.status_pengambilan','diterima')
                                        ->get();
        return view('backend.data-e-apotek.riwayat',compact('data'));
    }
    public function riwayatCetak($id)
    {
        $transaksiObat = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*',
                                                'pasien.nama',
                                                'hasil_konsultasi.resep_obat','hasil_konsultasi.kode_transaksi_konsultasi')
                                            ->join('hasil_konsultasi','hasil_konsultasi.id','transaksi_pemesanan_obat.id_hasil_konsultasi')
                                            ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                            ->where('transaksi_pemesanan_obat.id',$id)
                                            ->first();
        return view('backend.data-e-apotek.cetak',compact('transaksiObat'));
    }

    public function laporan(Request $request)
    {
        $data_grafik = TransaksiPemesananObat::select(
            "id" ,
            DB::raw("(sum(nominal_bayar)) as total_biaya"),
            DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year")
            )
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
            ->get();
        Session::forget('dari');
        Session::forget('sampai');
        $query = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*','pasien.nama')
                                        ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                        ->where('transaksi_pemesanan_obat.status_pengambilan','diterima');
        $cetak = null;
        if ($request->has('dari') || $request->has('sampai')) {
            Session::put('dari',$request->get('dari'));
            Session::put('sampai',$request->get('sampai'));
            $cetak = "ada";
            $data = $query->whereBetween('transaksi_pemesanan_obat.created_at',[$request->get('dari'),$request->get('sampai')])->get();
        }else{
            $cetak = null;
            $data = $query->get();
        }
        return view('backend.data-e-apotek.laporan',compact('data','cetak','data_grafik'));
    }
    public function pdf(Request $request)
    {

        // return Excel::download(new RiwayatTransaksiAmbulanceExport($request->session()->get('dari'),$request->session()->get('sampai')),'laporan.xls');

        $query = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*','pasien.nama')
                            ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                            ->where('transaksi_pemesanan_obat.status_pengambilan','diterima');

        if (Session::has('dari') || Session::has('sampai')) {
            $data = $query->whereBetween('transaksi_pemesanan_obat.created_at',[$request->session()->get('dari'),$request->session()->get('sampai')])->get();
        }else{
            $data = $query->get();
        }
        return view('backend.data-e-apotek.pdf',compact('data'));
    }

    public function excel(Request $request)
    {
        $query = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*','pasien.nama')
                        ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                        ->where('transaksi_pemesanan_obat.status_pengambilan','diterima');

        if (Session::has('dari') || Session::has('sampai')) {
            $data = $query->whereBetween('transaksi_pemesanan_obat.created_at',[$request->session()->get('dari'),$request->session()->get('sampai')])->get();
        }else{
            $data = $query->get();
        }
        return view('backend.data-e-apotek.excel',compact('data'));
    }

    public function laporanMutu(Request $request)
    {
        $data_grafik = DetailTransaksiObat::select('detail_transaksi_pemesanan_obat.*','obat.nama_obat',DB::raw('SUM(qty) as total'))
                                        ->join('obat','obat.id','detail_transaksi_pemesanan_obat.id_obat')
                                        ->groupBy('detail_transaksi_pemesanan_obat.id_obat')
                                        ->orderByDesc('total')
                                        ->take(10)
                                        ->get();
        Session::forget('dari');
        Session::forget('sampai');
        $query = DetailTransaksiObat::select('detail_transaksi_pemesanan_obat.*','obat.nama_obat',DB::raw('SUM(qty) as total'))
                                        ->join('obat','obat.id','detail_transaksi_pemesanan_obat.id_obat')
                                        ->groupBy('detail_transaksi_pemesanan_obat.id_obat')
                                        ->orderByDesc('total');
        $cetak = null;
        if ($request->has('dari') || $request->has('sampai')) {
            Session::put('dari',$request->get('dari'));
            Session::put('sampai',$request->get('sampai'));
            $cetak = "ada";
            $data = $query->whereBetween('detail_transaksi_pemesanan_obat.created_at',[$request->get('dari'),$request->get('sampai')])->get();
        }else{
            $cetak = null;
            $data = $query->get();
        }
        return view('backend.data-e-apotek.laporan-mutu',compact('data','cetak','data_grafik'));
    }

    public function pdfMutu(Request $request)
    {
        $query = DetailTransaksiObat::select('detail_transaksi_pemesanan_obat.*','obat.nama_obat',DB::raw('SUM(qty) as total'))
                                    ->join('obat','obat.id','detail_transaksi_pemesanan_obat.id_obat')
                                    ->groupBy('detail_transaksi_pemesanan_obat.id_obat')
                                    ->orderByDesc('total');

        if (Session::has('dari') || Session::has('sampai')) {
        $data = $query->whereBetween('detail_transaksi_pemesanan_obat.created_at',[$request->session()->get('dari'),$request->session()->get('sampai')])->get();
        }else{
        $data = $query->get();
        }
        return view('backend.data-e-apotek.pdf-mutu',compact('data'));
    }

    public function excelMutu(Request $request)
    {
        $query = DetailTransaksiObat::select('detail_transaksi_pemesanan_obat.*','obat.nama_obat',DB::raw('SUM(qty) as total'))
                                    ->join('obat','obat.id','detail_transaksi_pemesanan_obat.id_obat')
                                    ->groupBy('detail_transaksi_pemesanan_obat.id_obat')
                                    ->orderByDesc('total');

        if (Session::has('dari') || Session::has('sampai')) {
        $data = $query->whereBetween('detail_transaksi_pemesanan_obat.created_at',[$request->session()->get('dari'),$request->session()->get('sampai')])->get();
        }else{
        $data = $query->get();
        }
        return view('backend.data-e-apotek.excel-mutu',compact('data'));

    }
}
