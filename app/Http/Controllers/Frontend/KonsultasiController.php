<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\DetailPemesananKonsultasi;
use App\Models\Dokter;
use App\Models\HasilKonsultasi;
use App\Models\PemesananKonsultasi;
use App\Models\Penilaian;
use App\Models\RiwayatChat;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KonsultasiController extends Controller
{
    public function index(Request $request)
    {
        // $dokter = Dokter::
        $data = Dokter::orderBy('id','ASC')->get();
        $bank = Bank::all();
        if($request->ajax())
        {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            if (!empty($query)) {
                $data = DB::table('dokter')
                            ->where('nama_dokter','like', '%'.$query.'%')
                            ->get();
                return view('layouts.frontend.konsultasi.daftar-dokter', compact('data','bank'))->render();
            }else{
                $data = Dokter::orderBy('id','ASC')->get();
                return view('layouts.frontend.konsultasi.daftar-dokter', compact('data','bank'))->render();

            }
        }
        return view('layouts.frontend.konsultasi.index',compact('data','bank'));
    }
    public function detail(Request $request)
    {
        $dokter = Dokter::find($request->get('id'));
        $suka = Penilaian::where('id_dokter',$dokter->id)->sum('suka');
        return response()->json([
            'data' => $dokter,
            'suka' => $suka,
        ]);

    }

    public function postPembayaran(Request $request)
    {
        $request->validate([
            'bank' => 'required',
        ]);
        try {
            $pemesanan = new PemesananKonsultasi;
            $pemesanan->id_pasien_konsultasi = $request->get('id_pasien_konsultasi');
            $pemesanan->kode_pemesanan = $this->generateTransaksi();
            $pemesanan->id_dokter = $request->get('id_dokter');
            $pemesanan->id_bank = $request->get('bank');
            $pemesanan->total_nominal = (int)$request->get('total_nominal');
            $pemesanan->save();

            $detailPemesanan = new DetailPemesananKonsultasi;
            $detailPemesanan->id_pemesanan_konsultasi = $pemesanan->id;
            $detailPemesanan->status_pembayaran = 'pending';
            $detailPemesanan->save();

            return redirect()->route('pembayaran.detail',['id' => $pemesanan->id])->withStatus('Berhasil menyimpan data transaksi.');
        } catch (Exception $e) {
            return redirect()->route('e-konsultasi')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('e-konsultasi')->withError('Terjadi kesalahan.');
        }
    }

    public function DetailPembayaran($id)
    {
        $data = PemesananKonsultasi::select('pemesanan_konsultasi.*',
                                'bank.nama_bank',
                                'bank.no_rekening',
                                'bank.foto')
                                ->join('bank','bank.id','pemesanan_konsultasi.id_bank')
                                ->find($id);
        return view('layouts.frontend.konsultasi.pembayaran',compact('data'));
    }

    public function UploadPembayaran(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:png,jpg,jpeg'
        ]);
        try {

            $pemesanan = PemesananKonsultasi::find($request->get('id'));
            $pemesanan->tgl = date(now());
            if ($request->hasFile('file')) {
                $photos = $request->file('file');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/foto_bukti_pembayaran_konsultasi');
                if ($photos->move($path, $filename)) {
                    $pemesanan->bukti_pembayaran = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $pemesanan->update();

            $detailPemesanan = DetailPemesananKonsultasi::where('id_pemesanan_konsultasi',$request->get('id'))->first();
            $detailPemesanan->status_pembayaran = 'pending';
            $detailPemesanan->update();
            return redirect()->route('pembayaran.notifikasi',['id' => $request->get('id')])->withStatus('Berhasil upload pembayaran.');
        } catch (Exception $e) {
            return redirect()->route('e-konsultasi')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('e-konsultasi')->withError('Terjadi kesalahan.');
        }
    }
    public function NotifikasiPembayaran($id)
    {
        $data = PemesananKonsultasi::select('pemesanan_konsultasi.*',
                                'bank.nama_bank',
                                'bank.no_rekening',
                                'bank.foto')
                                ->join('bank','bank.id','pemesanan_konsultasi.id_bank')
                                ->find($id);
        return view('layouts.frontend.konsultasi.notifikasi',compact('data'));
    }

    public function CekNotifikasiPembayaran(Request $request)
    {
        $data = DetailPemesananKonsultasi::where('id_pemesanan_konsultasi',$request->id)->first()->status_pembayaran;
        return $data;
    }
    public function generateTransaksi()
    {
        $date = date('Ymd');

        $noTransaksi = null;
        $ambulance = PemesananKonsultasi::orderBy('created_at', 'DESC')->get();

        if($ambulance->count() > 0) {
            $noTransaksi = $ambulance[0]->kode_pemesanan;

            $lastIncrement = substr($noTransaksi, 10);

            $noTransaksi = str_pad($lastIncrement + 1, 4, 0, STR_PAD_LEFT);
            return $noTransaksi = "KS".$date.$noTransaksi;
        }
        else {
            return $noTransaksi = "KS".$date."0001";
        }
    }

    public function pesan($id)
    {
        $data = PemesananKonsultasi::select('pemesanan_konsultasi.*',
                'bank.nama_bank',
                'bank.no_rekening',
                'bank.foto',
                'pasien.nama as nama_pasien')
                ->join('pasien','pasien.id','pemesanan_konsultasi.id_pasien_konsultasi')
                ->join('bank','bank.id','pemesanan_konsultasi.id_bank')
                ->find($id);
        return view('layouts.frontend.konsultasi.pesan',compact('data'));
    }

    public function getMessage(Request $request)
    {
        $messages = RiwayatChat::orderBy('created_at', 'asc')->where('kode_transaksi_konsultasi',$request->get('id'))->get();
        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        try {
            $pesan = new RiwayatChat;
            $pesan->kode_transaksi_konsultasi = $request->get('kode');
            $pesan->pesan_dokter = null;
            $pesan->pesan_pasien = $request->get('message');
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
    public function hasilKonsultasi(Request $request)
    {
        try {
            $penilaian = new Penilaian;
            $penilaian->id_dokter = $request->get('id_dokter');
            if ($request->get('suka') == 5) {
                $penilaian->suka = $request->get('suka');
            }else{
                $penilaian->tidak_suka = $request->get('suka');
            }
            $penilaian->ulasan =$request->get('ulasan');
            $penilaian->save();
            $konsultasi = PemesananKonsultasi::where('kode_pemesanan',$request->get('kode'))->first()->id;

            $data = DetailPemesananKonsultasi::where('id_pemesanan_konsultasi',$konsultasi)->update([
                'status_chat' => 'selesai'
            ]);

            $hasil = new HasilKonsultasi;
            $hasil->kode_transaksi_konsultasi = $request->get('kode');
            $hasil->id_pasien = $request->get('id_pasien');
            $hasil->save();
            return response()->json(route('hasil.list',['id' => $request->get('kode')]));

        } catch (Exception $e) {
            return $e;
        } catch (QueryException $e) {
            //throw $th;
            return $e;
        }

    }



    public function listKonsultasi($id)
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
                    ->where('pemesanan_konsultasi.id_pasien_konsultasi',Session::get('id'))
                    ->get();
        // bikin tampilan list konsultasi
        return view('layouts.frontend.konsultasi.list-konsultasi',compact('data'));
    }

    public function listKonsultasiDetail(Request $request)
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
                                'hasil_konsultasi.status as status_update',
                                'hasil_konsultasi.kesimpulan',
                                'hasil_konsultasi.resep_obat',)
                                ->join('detail_pemesanan_konsultasi',
                                        'detail_pemesanan_konsultasi.id_pemesanan_konsultasi',
                                        'pemesanan_konsultasi.id')
                                ->join('pasien','pasien.id','pemesanan_konsultasi.id_pasien_konsultasi')
                                ->join('dokter','dokter.id','pemesanan_konsultasi.id_dokter')
                                ->join('bank','bank.id','pemesanan_konsultasi.id_bank')
                                ->join('hasil_konsultasi','hasil_konsultasi.kode_transaksi_konsultasi','pemesanan_konsultasi.kode_pemesanan')
                                ->where('detail_pemesanan_konsultasi.status_pembayaran','lunas')
                                ->where('pemesanan_konsultasi.id_pasien_konsultasi',Session::get('id'))
                                ->where('pemesanan_konsultasi.id',$request->get('id'))
                                ->first();

        return response()->json($data);
    }
}
