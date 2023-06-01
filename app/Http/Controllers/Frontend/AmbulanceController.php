<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\LokasiKejadian;
use App\Models\PasienAmbulance;
use App\Models\Petugas;
use App\Models\RiwayatTransaksAmbulance;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

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
            'longitude' => 'required',
            'latitude' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'alamat' => 'required',
        ]);
        try {
            $pasien = new PasienAmbulance;
            $pasien->nama_wali = $request->get('nama_pasien');
            $pasien->tanggal = Carbon::parse($request->get('jam_kerja'))->format('Y-m-d H:i:s');
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
            $lokasi->long = $request->get('longitude');
            $lokasi->lang = $request->get('latitude');
            $lokasi->id_provinsi = $request->get('provinsi');
            $lokasi->id_kota = $request->get('kota');
            $lokasi->id_kecamatan = $request->get('kecamatan');
            $lokasi->id_desa = $request->get('desa');
            $lokasi->alamat = $request->get('alamat');
            $lokasi->id_pasien_ambu = $pasien->id;
            $lokasi->save();

            $ambulance = Ambulance::where('status_mobil','tersedia')->first()->id;
            if ($ambulance == null) {
                PasienAmbulance::find($pasien->id)->delete();
                LokasiKejadian::find($lokasi->id)->delete();
                return redirect()->route('e-ambulance.create')->withStatus('Ambulans Kosong');
            }
            $petugas = Petugas::first()->id;
            $transaksi = new RiwayatTransaksAmbulance;
            $transaksi->kode_pesanan = $this->generateTransaksi();
            $transaksi->id_ambulance = $ambulance;
            $transaksi->id_pasien = $pasien->id;
            $transaksi->id_petugas = $petugas;
            $transaksi->status_pembayaran = 'pending';
            $transaksi->tanggal = date('Y-m-d ', strtotime($request->get('tgl')));
            $transaksi->id_pasien_login = Session::get('id');
            $transaksi->save();
            return redirect()->route('e-ambulance.ringkasan',['id'=> $transaksi->id]);
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
        if (Session::get('id')) {
            $data = RiwayatTransaksAmbulance::with('pasien_ambulance')->get();
            return view('layouts.frontend.ambulance.list',compact('data'));
        }else{
            return redirect()->route('login.index');
        }

    }

    public function generateTransaksi()
    {
        $date = date('Ymd');

        $noTransaksi = null;
        $ambulance = RiwayatTransaksAmbulance::orderBy('created_at', 'DESC')->get();

        if($ambulance->count() > 0) {
            $noTransaksi = $ambulance[0]->kode_pesanan;

            $lastIncrement = substr($noTransaksi, 10);
            $noTransaksi = str_pad($lastIncrement + 1, 5, 0, STR_PAD_LEFT);
            return "KT".$date.$noTransaksi;
        }
        else {
            return $noTransaksi = "KT".$date."0001";
        }
    }
    public function cek(Request $request)
    {
        $request = new DateTime($request->get('tgl'));
        $sekarang = new DateTime("now");

        if ($request > $sekarang) {
            $data = RiwayatTransaksAmbulance::with('pasien_ambulance')->whereDate('tanggal_jemput', '>',$sekarang);
            if (count($data->get()) > 0 ) {
                return response()->json([
                    'data' => true,
                    'message' => 'Dapat Memesan'
                ],Response::HTTP_OK);
            } else {
                $data = RiwayatTransaksAmbulance::with('pasien_ambulance')->whereDate('tanggal_jemput', '=',$request);

                if (count($data->get()) > 0 ) {
                    $day = $data->whereDay('tanggal_jemput', '>=',$request->format('d'));
                    $time = $data->whereTime('tanggal_jemput', '>=',$request->format('H:i:s'));
                    if (count($time->get()) < 0 || count($day->get()) <= 0) {
                        return response()->json([
                            'data' => true,
                            'message' => 'Dapat Memesan'
                        ],Response::HTTP_OK);
                    }else{
                        return response()->json([
                                    'data' => false,
                                    'message' => 'Mohon maaf, ambulance tidak tersedia. Silakan untuk menghubungi fasilitas kesehatan lainnya.'
                                ]);
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
    public function status(Request $request)
    {
        $data = RiwayatTransaksAmbulance::find($request->id);
        $tanggal_jemput = new DateTime($data->tanggal_jemput);
        $format = 'Diterima dengan tanggal jemput : '.$tanggal_jemput->format('d F Y').' Jam '.$tanggal_jemput->format('h:i:s A');
        return response()->json([
            'data' => $data->status_kendaraan,
            'tanggal_jemput' => $format,
        ]);
    }

    public function statusEstimasi(Request $request)
    {
        $data = RiwayatTransaksAmbulance::find($request->id)->status_perjalanan;
        return $data;
    }

    public function ringkasan($id)
    {
        $data = RiwayatTransaksAmbulance::
                select(
                        'transaksi_ambulance.*',
                        'pasien_ambulance.id as pasien_id',
                        'pasien_ambulance.nama_wali','pasien_ambulance.tanggal',
                        'pasien_ambulance.foto_kejadian',
                        'pasien_ambulance.keadaan','pasien_ambulance.no_hp',
                        'lokasi_kejadian.id as lokasi_kejadian_id',
                        'lokasi_kejadian.long',
                        'lokasi_kejadian.lang',
                        'lokasi_kejadian.id_provinsi',
                        'lokasi_kejadian.id_kota',
                        'lokasi_kejadian.id_kecamatan',
                        'lokasi_kejadian.id_desa',
                        'lokasi_kejadian.alamat',
                        'lokasi_kejadian.id_pasien_ambu')
                    ->join('pasien_ambulance','pasien_ambulance.id', 'transaksi_ambulance.id_pasien')
                    ->join('lokasi_kejadian','lokasi_kejadian.id_pasien_ambu','pasien_ambulance.id')
                    ->find($id);
        return view('layouts.frontend.ambulance.ringkasan',compact('data'));
    }

    public function pembayaran($id)
    {
        $data = RiwayatTransaksAmbulance::
        select(
                'transaksi_ambulance.*',
                'pasien_ambulance.id as pasien_id',
                'pasien_ambulance.nama_wali','pasien_ambulance.tanggal',
                'pasien_ambulance.foto_kejadian',
                'pasien_ambulance.keadaan','pasien_ambulance.no_hp',
                'lokasi_kejadian.id as lokasi_kejadian_id',
                'lokasi_kejadian.long',
                'lokasi_kejadian.lang',
                'lokasi_kejadian.id_provinsi',
                'lokasi_kejadian.id_kota',
                'lokasi_kejadian.id_kecamatan',
                'lokasi_kejadian.id_desa',
                'lokasi_kejadian.alamat',
                'lokasi_kejadian.id_pasien_ambu')
            ->join('pasien_ambulance','pasien_ambulance.id', 'transaksi_ambulance.id_pasien')
            ->join('lokasi_kejadian','lokasi_kejadian.id_pasien_ambu','pasien_ambulance.id')
            ->find($id);
        return view('layouts.frontend.ambulance.pembayaran',compact('data'));
    }
    public function versi($id)
    {
        $data = RiwayatTransaksAmbulance::
        select(
                'transaksi_ambulance.*',
                'pasien_ambulance.id as pasien_id',
                'pasien_ambulance.nama_wali','pasien_ambulance.tanggal',
                'pasien_ambulance.foto_kejadian',
                'pasien_ambulance.keadaan','pasien_ambulance.no_hp',
                'lokasi_kejadian.id as lokasi_kejadian_id',
                'lokasi_kejadian.long',
                'lokasi_kejadian.lang',
                'lokasi_kejadian.id_provinsi',
                'lokasi_kejadian.id_kota',
                'lokasi_kejadian.id_kecamatan',
                'lokasi_kejadian.id_desa',
                'lokasi_kejadian.alamat',
                'lokasi_kejadian.id_pasien_ambu')
            ->join('pasien_ambulance','pasien_ambulance.id', 'transaksi_ambulance.id_pasien')
            ->join('lokasi_kejadian','lokasi_kejadian.id_pasien_ambu','pasien_ambulance.id')
            ->find($id);
        return view('layouts.frontend.ambulance.versi-cetak',compact('data'));
    }

    public function estimasi($id)
    {
        $data = RiwayatTransaksAmbulance::
        select(
                'transaksi_ambulance.id',
                'transaksi_ambulance.status_perjalanan',
            )
            ->find($id);

        return view('layouts.frontend.ambulance.estimasi',compact('data'));
    }

    public function estimasiSelesai($id)
    {
        $kode = RiwayatTransaksAmbulance::find($id)->kode_pesanan;
        $data = "Berhasil melakukan pesan ambulance dengan kode pesanan : $kode";
        return redirect()->route('e-ambulance.fitur')->withStatus($data);
    }
}
