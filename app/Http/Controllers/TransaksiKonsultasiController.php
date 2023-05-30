<?php

namespace App\Http\Controllers;

use App\Models\DetailPemesananKonsultasi;
use App\Models\PemesananKonsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        return view('backend.transaksi-konsultasi.riwayat-transaksi',compact('data'));

    }

    public function CetakRiwayatTransaksi($id)
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
                            ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas')
                            ->where('pemesanan_konsultasi.id',$id)->first();
        return view('backend.transaksi-konsultasi.cetak',compact('data'));
    }

    public function LaporanTransaksi(Request $request)
    {
        $data_grafik = PemesananKonsultasi::select(
            "id" ,
            DB::raw("(sum(total_nominal)) as total_nominal"),
            DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as month_year")
            )
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
            ->get();
        Session::forget('dari');
        Session::forget('sampai');
        $query = PemesananKonsultasi::
                        select('pemesanan_konsultasi.*',
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
                        ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas');
        $cetak = null;
        if ($request->has('dari') || $request->has('sampai')) {
            Session::put('dari',$request->get('dari'));
            Session::put('sampai',$request->get('sampai'));
            $cetak = "ada";
            $data = $query->whereBetween('pemesanan_konsultasi.created_at',[$request->get('dari'),$request->get('sampai')])->get();
        }else{
            $cetak = null;
            $data = $query->get();
        }
        return view('backend.transaksi-konsultasi.laporan-transaksi',compact('data','cetak','data_grafik'));
    }

    public function pdf(Request $request)
    {

        // return Excel::download(new RiwayatTransaksiAmbulanceExport($request->session()->get('dari'),$request->session()->get('sampai')),'laporan.xls');

        $query = PemesananKonsultasi::select('pemesanan_konsultasi.*',
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
                                ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas');

        if (Session::has('dari') || Session::has('sampai')) {
            $data = $query->whereBetween('pemesanan_konsultasi.created_at',[$request->session()->get('dari'),$request->session()->get('sampai')])->get();
        }else{
            $data = $query->get();
        }
        return view('backend.transaksi-konsultasi.pdf',compact('data'));
    }

    public function excel(Request $request)
    {
        $query = PemesananKonsultasi::select('pemesanan_konsultasi.*',
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
                                ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas');

        if (Session::has('dari') || Session::has('sampai')) {
            $data = $query->whereBetween('pemesanan_konsultasi.created_at',[$request->session()->get('dari'),$request->session()->get('sampai')])->get();
        }else{
            $data = $query->get();
        }
        return view('backend.transaksi-konsultasi.excel',compact('data'));
    }


    public function laporanMutu(Request $request)
    {
        $data_grafik = PemesananKonsultasi::select('pemesanan_konsultasi.*',
                                        'detail_pemesanan_konsultasi.id as detail_konsultasi',
                                        'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                        'detail_pemesanan_konsultasi.status_pembayaran',
                                        'detail_pemesanan_konsultasi.id_user',
                                        'detail_pemesanan_konsultasi.keterangan',
                                        'dokter.id as iddokter',
                                        'dokter.nama_dokter',
                                        'dokter.id_poli',
                                        'poli.nama_poli',
                                        'pasien.id as id_pasien',
                                        'pasien.nama as nama_pasien',
                                        'pasien.phone',
                                        'bank.id as idbank',
                                        'bank.nama_bank',
                                        'bank.no_rekening',DB::raw('COUNT(pemesanan_konsultasi.id) as total'))
                                    ->join('detail_pemesanan_konsultasi',
                                        'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                        'pemesanan_konsultasi.id')
                                    ->join('pasien','pasien.id','pemesanan_konsultasi.id_pasien_konsultasi')
                                    ->join('dokter','dokter.id','pemesanan_konsultasi.id_dokter')
                                    ->join('poli','poli.id','dokter.id_poli')
                                    ->join('bank','bank.id','pemesanan_konsultasi.id_bank')
                                    ->groupBy('pemesanan_konsultasi.id_dokter')
                                    ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas')
                                    ->get();
        Session::forget('dari');
        Session::forget('sampai');
        $query = PemesananKonsultasi::select('pemesanan_konsultasi.*',
                            'detail_pemesanan_konsultasi.id as detail_konsultasi',
                            'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                            'detail_pemesanan_konsultasi.status_pembayaran',
                            'detail_pemesanan_konsultasi.id_user',
                            'detail_pemesanan_konsultasi.keterangan',
                            'dokter.id as iddokter',
                            'dokter.nama_dokter',
                            'dokter.id_poli',
                            'poli.nama_poli',
                            'pasien.id as id_pasien',
                            'pasien.nama as nama_pasien',
                            'pasien.phone',
                            'bank.id as idbank',
                            'bank.nama_bank',
                            'bank.no_rekening',DB::raw('COUNT(pemesanan_konsultasi.id) as total'))
                        ->join('detail_pemesanan_konsultasi',
                            'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                            'pemesanan_konsultasi.id')
                        ->join('pasien','pasien.id','pemesanan_konsultasi.id_pasien_konsultasi')
                        ->join('dokter','dokter.id','pemesanan_konsultasi.id_dokter')
                        ->join('poli','poli.id','dokter.id_poli')
                        ->join('bank','bank.id','pemesanan_konsultasi.id_bank')
                        ->groupBy('pemesanan_konsultasi.id_dokter')
                        ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas');
        $cetak = null;
        if ($request->has('dari') || $request->has('sampai')) {
            Session::put('dari',$request->get('dari'));
            Session::put('sampai',$request->get('sampai'));
            $cetak = "ada";
            $data = $query->whereBetween('pemesanan_konsultasi.created_at',[$request->get('dari'),$request->get('sampai')])->get();
        }else{
            $cetak = null;
            $data = $query->get();
        }
        return view('backend.transaksi-konsultasi.laporan-transaksi-mutu',compact('data','cetak','data_grafik'));
    }

    public function pdfMutu(Request $request)
    {
        $query = PemesananKonsultasi::select('pemesanan_konsultasi.*',
                                    'detail_pemesanan_konsultasi.id as detail_konsultasi',
                                    'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                    'detail_pemesanan_konsultasi.status_pembayaran',
                                    'detail_pemesanan_konsultasi.id_user',
                                    'detail_pemesanan_konsultasi.keterangan',
                                    'dokter.id as iddokter',
                                    'dokter.nama_dokter',
                                    'dokter.id_poli',
                                    'poli.nama_poli',
                                    'pasien.id as id_pasien',
                                    'pasien.nama as nama_pasien',
                                    'pasien.phone',
                                    'bank.id as idbank',
                                    'bank.nama_bank',
                                    'bank.no_rekening',DB::raw('COUNT(pemesanan_konsultasi.id) as total'))
                                ->join('detail_pemesanan_konsultasi',
                                    'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                    'pemesanan_konsultasi.id')
                                ->join('pasien','pasien.id','pemesanan_konsultasi.id_pasien_konsultasi')
                                ->join('dokter','dokter.id','pemesanan_konsultasi.id_dokter')
                                ->join('poli','poli.id','dokter.id_poli')
                                ->join('bank','bank.id','pemesanan_konsultasi.id_bank')
                                ->groupBy('pemesanan_konsultasi.id_dokter')
                                ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas');

        if (Session::has('dari') || Session::has('sampai')) {
        $data = $query->whereBetween('pemesanan_konsultasi.created_at',[$request->session()->get('dari'),$request->session()->get('sampai')])->get();
        }else{
        $data = $query->get();
        }
        return view('backend.transaksi-konsultasi.pdf-mutu',compact('data'));
    }

    public function excelMutu(Request $request)
    {
        $query = PemesananKonsultasi::select('pemesanan_konsultasi.*',
                                    'detail_pemesanan_konsultasi.id as detail_konsultasi',
                                    'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                    'detail_pemesanan_konsultasi.status_pembayaran',
                                    'detail_pemesanan_konsultasi.id_user',
                                    'detail_pemesanan_konsultasi.keterangan',
                                    'dokter.id as iddokter',
                                    'dokter.nama_dokter',
                                    'dokter.id_poli',
                                    'poli.nama_poli',
                                    'pasien.id as id_pasien',
                                    'pasien.nama as nama_pasien',
                                    'pasien.phone',
                                    'bank.id as idbank',
                                    'bank.nama_bank',
                                    'bank.no_rekening',DB::raw('COUNT(pemesanan_konsultasi.id) as total'))
                                ->join('detail_pemesanan_konsultasi',
                                    'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                    'pemesanan_konsultasi.id')
                                ->join('pasien','pasien.id','pemesanan_konsultasi.id_pasien_konsultasi')
                                ->join('dokter','dokter.id','pemesanan_konsultasi.id_dokter')
                                ->join('poli','poli.id','dokter.id_poli')
                                ->join('bank','bank.id','pemesanan_konsultasi.id_bank')
                                ->groupBy('pemesanan_konsultasi.id_dokter')
                                ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas');

        if (Session::has('dari') || Session::has('sampai')) {
        $data = $query->whereBetween('pemesanan_konsultasi.created_at',[$request->session()->get('dari'),$request->session()->get('sampai')])->get();
        }else{
        $data = $query->get();
        }
        return view('backend.transaksi-konsultasi.excel-mutu',compact('data'));

    }
}
