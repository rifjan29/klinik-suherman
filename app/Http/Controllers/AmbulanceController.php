<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    public function index()
    {
        return view('backend.ambulance.index');
    }

    public function riwayat()
    {
        return view('backend.ambulance.riwayat-ambulance');

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
}
