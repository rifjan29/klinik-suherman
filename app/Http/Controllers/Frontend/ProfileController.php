<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ModelPasien;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function ProfilSaya()
    {
        $data = ModelPasien::where('id', session('id'))->first();
        return view('layouts.frontend.akun.profil-saya', compact('data'));
    }

    public function updateProfil(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255|string|min:5',
            'address' => 'required|string',
            'phone' => 'required|numeric|min:10|starts_with:08|digits_between:10,12',
            'born' => 'required|string',
            'gender' => 'required|in:L,P',
            'status' => 'required|in:1,0',
            'job' => 'required|string',
            'religion' => 'required|string',
        ]);
        // dd($validatedData['nama']);
        $data = ModelPasien::find(session('id'));
        $data->nama = $validatedData['nama'];
        $data->address = $validatedData['address'];
        $data->phone = $validatedData['phone'];
        $data->born = $validatedData['born'];
        $data->gender = $validatedData['gender'];
        $data->status = $validatedData['status'];
        $data->job = $validatedData['job'];
        $data->religion = $validatedData['religion'];
        $data->update();
        return redirect()->back()->with('alert-success','Kamu berhasil Update Data.');
    }
}
