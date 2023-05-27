<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\TransaksiPemesananObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApotekController extends Controller
{
    public function index()
    {
        if (Session::get('id')) {
            $data = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*',
                                            'pasien.nama',
                                            'hasil_konsultasi.resep_obat')
                                        ->join('hasil_konsultasi','hasil_konsultasi.id','transaksi_pemesanan_obat.id_hasil_konsultasi')
                                        ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                        ->where('transaksi_pemesanan_obat.id_pasien',Session::get('id'))
                                        ->where('transaksi_pemesanan_obat.status','!=','pending')
                                        ->OrWhere('transaksi_pemesanan_obat.status_pengambilan','pending')->get();
            return view('layouts.frontend.apotek.list',compact('data'));
        }else{
            return redirect()->route('login.index');
        }
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
                                    'hasil_konsultasi.resep_obat','hasil_konsultasi.kode_transaksi_konsultasi')
                                ->join('hasil_konsultasi','hasil_konsultasi.id','transaksi_pemesanan_obat.id_hasil_konsultasi')
                                ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                // ->where('transaksi_pemesanan_obat.status_pengambilan','diterima')
                                ->where('transaksi_pemesanan_obat.kode_transaksi',$id)
                                ->first();
        $bank = Bank::all();
        return view('layouts.frontend.apotek.tebus-resep',compact('transaksiObat','bank'));

    }

    public function tebusResepPost(Request $request,$id)
    {
        $request->validate([
            'bank' => 'required'
        ]);
        TransaksiPemesananObat::where('kode_transaksi',$id)->update([
            'id_bank' => $request->get('bank')
        ]);
        return redirect()->route('list.apotek.tebus.upload',['id' => $id])->withStatus('Berhasil update transaksi');
    }

    public function tebusResepUpload($id)
    {
        $transaksiObat = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*',
                                    'pasien.nama',
                                    'hasil_konsultasi.resep_obat',
                                    'hasil_konsultasi.kode_transaksi_konsultasi',
                                    'bank.nama_bank','bank.no_rekening','bank.foto')
                                ->join('hasil_konsultasi','hasil_konsultasi.id','transaksi_pemesanan_obat.id_hasil_konsultasi')
                                ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                ->join('bank','bank.id','transaksi_pemesanan_obat.id_bank')
                                ->where('transaksi_pemesanan_obat.kode_transaksi',$id)
                                ->first();
        return view('layouts.frontend.apotek.tebus-resep-upload',compact('transaksiObat'));
    }

    public function tebusResepUploadBukti(Request $request, $id)
    {
        $request->validate([
            'file' => 'required'
        ]);
        if ($request->hasFile('file')) {
            $photos = $request->file('file');
            $filename = date('His') . '.' . $photos->getClientOriginalExtension();
            $path = public_path('img/foto-bukti-pembayaran-apotek');
            if ($photos->move($path, $filename)) {
                TransaksiPemesananObat::find($id)->update([
                    'foto_pembayaran' => $filename,
                    'status' => 'pending'
                ]);
            } else {
                return redirect()->back()->withError('Terjadi kesalahan.');
            }
        }

        return redirect()->route('list.apotek')->withStatus('Berhasil Upload pembayaran silahkan tunggu verifikasi');
    }

    public function detailInvoice(Request $request)
    {
        $data = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*','pasien.nama','bank.nama_bank')
                                    ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                    ->join('bank','bank.id','transaksi_pemesanan_obat.id_bank')
                                    ->where('transaksi_pemesanan_obat.id',$request->get('id'))
                                    ->first();
        $data->url = route('list.apotek.invoice-pdf',[$data->id]);
        return response()->json($data);
    }
    public function detailInvoicePDF($id)
    {
        $transaksiObat = TransaksiPemesananObat::select('transaksi_pemesanan_obat.*',
                                                'pasien.nama',
                                                'hasil_konsultasi.resep_obat','hasil_konsultasi.kode_transaksi_konsultasi')
                                            ->join('hasil_konsultasi','hasil_konsultasi.id','transaksi_pemesanan_obat.id_hasil_konsultasi')
                                            ->join('pasien','pasien.id','transaksi_pemesanan_obat.id_pasien')
                                            ->where('transaksi_pemesanan_obat.id',$id)
                                            ->first();
        return view('layouts.frontend.apotek.versi-cetak',compact('transaksiObat'));

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
