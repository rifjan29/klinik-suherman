<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    public function index()
    {
        return view('layouts.frontend.ambulance.index');
    }

    public function create()
    {
        return view('layouts.frontend.ambulance.create');

    }
}
