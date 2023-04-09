<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Apotek;
use App\Models\Dokter;
use App\Models\Petugas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dataAkun  = Admin::count() + Petugas::count() + Dokter::count() + Apotek::count();
        return view('dashboard',compact('dataAkun'));
    }
}
