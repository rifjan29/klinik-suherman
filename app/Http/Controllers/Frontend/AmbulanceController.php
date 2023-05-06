<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\LokasiKejadian;
use App\Models\PasienAmbulance;
use App\Models\Petugas;
use App\Models\RiwayatTransaksAmbulance;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AmbulanceController extends Controller
{
    public function index()
    {
        return view('layouts.frontend.ambulance.index');
    }

    public function create()
    {
        return view('layouts.frontend.ambulance.create');

    }

    public function fitur()
    {
        return view('layouts.frontend.ambulance.fitur');

    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'no_hp' => 'required',
            'jam_kerja' => 'required',
            'keteranagan' => 'required',
            'lang' => 'required',
            'long' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'alamat' => 'required',
        ]);
        try {
            $pasien = new PasienAmbulance;
            $pasien->nama_wali = $request->get('nama_pasien');
            $pasien->tanggal = $request->get('jam_kerja');
            if ($request->hasFile('foto')) {
                $photos = $request->file('foto');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/foto-kejadian');
                if ($photos->move($path, $filename)) {
                    $pasien->foto_kejadian = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $pasien->keadaan = $request->get('keteranagan');
            $pasien->no_hp = $request->get('no_hp');
            $pasien->save();

            $lokasi = new LokasiKejadian;
            $lokasi->long = $request->get('long');
            $lokasi->lang = $request->get('lang');
            $lokasi->id_provinsi = $request->get('provinsi');
            $lokasi->id_kota = $request->get('kota');
            $lokasi->id_kecamatan = $request->get('kecamatan');
            $lokasi->id_desa = $request->get('desa');
            $lokasi->alamat = $request->get('alamat');
            $lokasi->id_pasien_ambu = $pasien->id;
            $lokasi->save();

            $ambulance = Ambulance::where('status_mobil','tersedia')->first()->id;
            $petugas = Petugas::first()->id;
            $transaksi = new RiwayatTransaksAmbulance;
            $transaksi->kode_pesanan = $this->generateTransaksi();
            $transaksi->id_ambulance = $ambulance;
            $transaksi->id_pasien = $pasien->id;
            $transaksi->id_petugas = $petugas;
            $transaksi->status_pembayaran = 'pending';
            $transaksi->tanggal = date('Y-m-d ', strtotime($request->get('tgl')));
            $transaksi->save();
            return $transaksi;
        } catch (Exception $e) {
            return $e;
            return redirect()->route('dokter.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return $e;
            return redirect()->route('dokter.index')->withError('Terjadi kesalahan.');
        }
    }

    public function list()
    {
        $data = RiwayatTransaksAmbulance::with('pasien_ambulance')->get();
        return view('layouts.frontend.ambulance.list',compact('data'));
    }

    public function generateTransaksi()
    {
        $date = date('Ymd');

        $noTransaksi = null;
        $ambulance = RiwayatTransaksAmbulance::orderBy('created_at', 'DESC')->get();

        if($ambulance->count() > 0) {
            $noTransaksi = $ambulance[0]->kode_pesanan;

            $lastIncrement = substr($noTransaksi, 10);

            $noTransaksi = str_pad($lastIncrement + 1, 4, 0, STR_PAD_LEFT);
            return $noTransaksi = "KT".$date.$noTransaksi;
        }
        else {
            return $noTransaksi = "KT".$date."0001";
        }
    }
    public function cek(Request $request)
    {
        if (date('Y-m-d H:i:s', strtotime($request->get('tgl'))) > date("Y-m-d H:i:s")) {
            $data = RiwayatTransaksAmbulance::with('pasien_ambulance')->whereDate('tanggal_jemput', '>',date('Y-m-d', strtotime($request->get('tgl'))));
            if (count($data->get()) > 0 ) {
                if (count($data->OrWhere('status_kejadian','==','1')->get()) > 0) {
                    if (count($data->where('status_perjalanan','!=','1')->where('status_perjalanan','!=','2')->get()) > 0) {
                        return response()->json([
                            'data' => true,
                            'message' => 'Dapat Memesan'
                        ],Response::HTTP_OK);
                    }else{
                        return response()->json([
                            'data' => false,
                            'message' => 'Mohon maaf, ambulance tidak tersedia. Silakan untuk menghubungi fasilitas kesehatan lainnya.'
                        ],Response::HTTP_OK);
                    }
                }else{
                    return response()->json([
                        'data' => true,
                        'message' => 'Dapat Memesan'
                    ],Response::HTTP_OK);
                }
            } else {
                $data = RiwayatTransaksAmbulance::with('pasien_ambulance')->whereDate('tanggal_jemput', '=',date('Y-m-d', strtotime($request->get('tgl'))));

                if (count($data->get()) > 0 ) {
                    $day = $data->whereDay('tanggal_jemput', '>',date('d',strtotime($request->get('tgl'))));
                    $time = $data->whereTime('tanggal_jemput', '>',date('h:i:s',strtotime($request->get('tgl'))));
                    if ($day->get()) {
                        return response()->json([
                            'data' => true,
                            'message' => 'Dapat Memesan'
                        ],Response::HTTP_OK);
                    }
                    if ($time->get()) {
                        return response()->json([
                            'data' => true,
                            'message' => 'Dapat Memesan'
                        ],Response::HTTP_OK);
                    }
                    if (count($data->where('status_perjalanan','!=','1')->where('status_perjalanan','!=','2')->get()) > 0) {
                        return response()->json([
                            'data' => true,
                            'message' => 'Dapat Memesan'
                        ],Response::HTTP_OK);
                    }else{
                        return response()->json([
                            'data' => false,
                            'message' => 'Mohon maaf, ambulance tidak tersedia. Silakan untuk menghubungi fasilitas kesehatan lainnya.'
                        ],Response::HTTP_OK);
                    }
                }else{
                    return response()->json([
                        'data' => true,
                        'message' => 'Dapat Memesan'
                    ],Response::HTTP_OK);
                }
            }
        }else{
            return response()->json([
                'data' => false,
                'message' => 'Tolong masukkan tanggal dengan benar.'
            ],Response::HTTP_OK);
        }

    }

    public function ringkasan()
    {
        return view('layouts.frontend.ambulance.ringkasan');
    }

    public function pembayaran()
    {
        return view('layouts.frontend.ambulance.pembayaran');
    }

    public function estimasi()
    {
        return view('layouts.frontend.ambulance.estimasi');
    }
}
