<?php

namespace App\Http\Controllers;

use App\Models\RiwayatTransaksAmbulance;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    public function index()
    {
        return view('backend.ambulance.index');
    }

    public function riwayat()
    {
        $data = RiwayatTransaksAmbulance::with('pasien_ambulance','ambulance')->get();
        return view('backend.ambulance.riwayat-ambulance',compact('data'));

    }

    public function saldo()
    {
        return view('backend.ambulance.data-saldo');
    }

    public function pemasukan()
    {
        return view('backend.ambulance.data-pemasukan');
    }

    public function transaksi()
    {
        return view('backend.ambulance.riwayat-transaksi');
    }

    public function list()
    {
        $data = RiwayatTransaksAmbulance::with('pasien_ambulance','ambulance','lokasi')->where('status_pembayaran','pending')->where('status_kejadian',Null)->get();
        return view('backend.ambulance.riwayat-ambulance',compact('data'));

    }

    public function updateStatus(Request $request)
    {
        RiwayatTransaksAmbulance::where('kode_pesanan',$request->get('id_transaksi'))->update([
            'status_kejadian' => $request->get('status_kejadian')
        ]);
        return redirect()->route('riwayat-ambulance')->withStatus('Berhasil mengganti status kejadian');
    }
}
