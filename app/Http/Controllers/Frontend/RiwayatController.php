<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function riwayat()
    {
        return view('layouts.frontend.riwayat.riwayat');
    }
}
