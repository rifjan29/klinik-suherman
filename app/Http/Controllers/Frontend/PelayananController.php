<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    public function jalan()
    {
        return view('layouts.frontend.jalan');
    }

    public function inap()
    {
        return view('layouts.frontend.inap');
    }

    public function penunjang()
    {
        return view('layouts.frontend.penunjang');
    }

    public function ugd()
    {
        return view('layouts.frontend.ugd');
    }

    public function ambulance()
    {
        return view('layouts.frontend.ambulance');
    }

    public function konsultasi()
    {
        return view('layouts.frontend.konsultasi');
    }
}
