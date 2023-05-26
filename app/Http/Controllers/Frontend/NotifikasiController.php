<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelPasien;

class NotifikasiController extends Controller
{
    public function index()
    {
        $data = ModelPasien::where('id', session('id'))->first();
        return view('layouts.frontend.notifikasi.index', compact('data'));
    }
}
