<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function ProfilSaya()
    {
        return view('layouts.frontend.akun.profil-saya');
    }
}
