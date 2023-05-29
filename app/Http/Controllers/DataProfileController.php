<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Apotek;
use App\Models\Dokter;
use App\Models\Kasir;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;

class DataProfileController extends Controller
{
    public function index($id)
    {
        $data['user'] = User::find($id);

        if (auth()->user()->role == 'apotek') {
            $data['data'] = Apotek::where('id_user',$data['user']->id)->first();
        }else if (auth()->user()->role == 'dokter') {
            $data['data'] = Dokter::where('id_user',$data['user']->id)->first();
        }else if (auth()->user()->role == 'petugas') {
            $data['data'] = Petugas::where('id_user',$data['user']->id)->first();
        }else if (auth()->user()->role == 'kasir') {
            $data['data'] = Kasir::where('id_user',$data['user']->id)->first();
        } else {
            $data['data'] = Admin::where('id_user',$data['user']->id)->first();
        }
        return view('backend.profile.index',$data);
    }
}
