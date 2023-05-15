<?php

namespace App\Http\Controllers;

use App\Models\KritikSaran;
use Illuminate\Http\Request;

class DataSaranKritikController extends Controller
{
    public function index()
    {
        $data = KritikSaran::all();
        return view('backend.saran-kritik.index',compact('data'));
    }
}
