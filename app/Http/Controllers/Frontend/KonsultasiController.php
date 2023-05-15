<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function index()
    {
        return view('layouts.frontend.konsultasi.index');
    }

    public function pembayaran()
    {
        return view('layouts.frontend.konsultasi.pembayaran');
    }

    public function pesan()
    {
        return view('layouts.frontend.konsultasi.pesan');
    }
}
