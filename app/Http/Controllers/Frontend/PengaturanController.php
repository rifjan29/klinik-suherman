<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ModelPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PengaturanController extends Controller
{
    public function index()
    {
        $data = ModelPasien::where('id', session('id'))->first();
        return view('layouts.frontend.pengaturan.index', compact('data'));
    }

    public function updatePassword(Request $request)
    {
        $data = ModelPasien::where('id', session('id'))->first();
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:5|confirmed',
        ], [
            'current_password.required' => 'Masukkan password lama',
            'new_password.required' => 'Masukkan password baru',
            'new_password.min' => 'Password baru minimal terdiri dari 5 karakter',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok',
        ]);
        if (!Hash::check($request->current_password, $data->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama salah']);
        }
        // dd('ubah password berhasil. silahkan login kembali');

        $data->password = Hash::make($request->new_password);
        // dd($data->password);
        $data->save();

        // logout
        session()->flush();
        return redirect('/user-login')->with('alert-success', 'Password berhasil diubah, silahkan login kembali');
    }
}
