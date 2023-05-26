<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelPasien;

class RiwayatController extends Controller
{
    public function riwayat()
    {
        $data = ModelPasien::where('id', session('id'))->first();
        return view('layouts.frontend.riwayat.riwayat', compact('data'));
    }
}
