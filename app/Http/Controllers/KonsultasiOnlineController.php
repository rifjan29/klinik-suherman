<?php

namespace App\Http\Controllers;

use App\Models\DetailPemesananKonsultasi;
use App\Models\HasilKonsultasi;
use App\Models\PemesananKonsultasi;
use App\Models\RiwayatChat;
use Exception;
use Illuminate\Database\QueryException;
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
                                    ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas')->get();
        return view('backend.dokter.konsultasi.list',compact('data'));
    }

    public function chat($id)
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
                                'pasien.gender',
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
                                ->where('pemesanan_konsultasi.id',$id)
                                ->first();
        return view('backend.dokter.konsultasi.chat',compact('data'));
    }
    public function getChat(Request $request)
    {
        $messages = RiwayatChat::orderBy('created_at', 'asc')->where('kode_transaksi_konsultasi',$request->get('id'))->get();
        return response()->json($messages);
    }
    public function postChat(Request $request)
    {
        try {
            $pesan = new RiwayatChat;
            $pesan->kode_transaksi_konsultasi = $request->get('kode');
            $pesan->pesan_dokter = $request->get('message');
            $pesan->pesan_pasien = null;
            $pesan->tgl_dokter = null;
            $pesan->tgl_pasien = date(now());
            $pesan->sender_id = $request->get('sender_id');
            $pesan->receiver_id = $request->get('receiver_id');
            $pesan->save();

        } catch (Exception $th) {
            return response()->json(['e' => $th]);
        } catch (QueryException $e){
            return response()->json(['e' => $e]);

        }
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
                                    ->get();
        return view('backend.dokter.konsultasi.riwayat',compact('data'));
    }
    public function HasilRiwayatKonsultasi($id)
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
                                'bank.no_rekening',
                                'hasil_konsultasi.kode_transaksi_konsultasi',
                                'hasil_konsultasi.kesimpulan',
                                'hasil_konsultasi.resep_obat',
                                'hasil_konsultasi.status as status_update')
                                ->join('detail_pemesanan_konsultasi',
                                        'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                        'pemesanan_konsultasi.id')
                                ->join('pasien','pasien.id','pemesanan_konsultasi.id_pasien_konsultasi')
                                ->join('dokter','dokter.id','pemesanan_konsultasi.id_dokter')
                                ->join('bank','bank.id','pemesanan_konsultasi.id_bank')
                                ->join('hasil_konsultasi','hasil_konsultasi.kode_transaksi_konsultasi','pemesanan_konsultasi.kode_pemesanan')
                                ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas')
                                ->where('pemesanan_konsultasi.kode_pemesanan',$id)
                                ->first();
            return view('backend.dokter.konsultasi.hasil-konsultasi',compact('data'));
    }

    public function hasil($id)
    {
        $pemesan = PemesananKonsultasi::where('kode_pemesanan',$id)->first();
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
                                'pasien.gender',
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
                                ->where('pemesanan_konsultasi.id',$pemesan->id)
                                ->first();

        return view('backend.dokter.konsultasi.post-hasil-konsultasi',compact('data'));
    }

    public function hasilPost(Request $request)
    {
        $hasil = HasilKonsultasi::where('kode_transaksi_konsultasi',$request->get('kode_transaksi'))->update([
            'kesimpulan' => $request->get('kesimpulan'),
            'resep_obat' => $request->get('resep_obat'),
            'status' => 'konfirmasi'
        ]);
        // bikin tampilan buat riwayat
        return redirect()->route('konsultasi-dokter.riwayat');
    }

    public function statusKonsultasi(Request $request)
    {
        $konsultasi = PemesananKonsultasi::where('kode_pemesanan',$request->get('id'))->first()->id;

        $data = DetailPemesananKonsultasi::where('id_pemesanan_konsultasi',$konsultasi)->first()->status_chat;
        return response()->json($data);
    }

    public function penilaian()
    {
        return view('backend.dokter.konsultasi.penilaian');
    }
}

