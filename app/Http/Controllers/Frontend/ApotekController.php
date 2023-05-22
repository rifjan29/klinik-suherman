<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApotekController extends Controller
{
    public function index()
    {
        return view('layouts.frontend.apotek.list');
    }
    public function post(Request $request)
    {
        return $request;
    }
}
