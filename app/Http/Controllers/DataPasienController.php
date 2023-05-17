<?php

namespace App\Http\Controllers;

use App\Models\ModelPasien;
use Illuminate\Http\Request;

class DataPasienController extends Controller
{
    public function index()
    {
        $data = ModelPasien::all();
        return view('backend.pasien.index',compact('data'));
    }
}
