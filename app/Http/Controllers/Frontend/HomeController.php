<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KritikSaran;

class HomeController extends Controller
{
    public function index()
    {
        $layanan = ['ambulan', 'konsultasi', 'apotek'];
        // dd($layanan);
        return view ('welcome', compact('layanan'));
    }


    public function kritikSaran(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'responden' => 'required',
            'kepuasan' => 'required',
            'profesional' => 'required',
            'fasilitas' => 'required',
            'waktu' => 'required',
            'biaya' => 'required',
            'layanan' => 'required|in:ambulan,konsultasi,apotek',
            'nama' => 'required|max:255|string|min:5',
            'no_hp' => 'required|numeric|min:10|starts_with:08|digits_between:10,12',
            'feedback' => 'required|string|min:10',
        ],[
            'required' => ':attribute harus terisi',
            'min' => ':attribute harus memiliki panjang minimal :min karakter',
            'starts_with' => ':attribute harus diawali dengan 08',
            'numeric' => ':attribute harus berupa angka',
            'digits_between' => ':attribute harus berupa angka dan memiliki panjang minimal :min dan maksimal :max karakter',
            'min' => ':attribute harus memiliki panjang minimal :min karakter',
        ]);
        // dd('kritik saran berhasil');
        $data = new KritikSaran();
        $data->nama = $validatedData['nama'];
        $data->responden = $validatedData['responden'];
        $data->no_hp = $validatedData['no_hp'];
        $data->kepuasan = $validatedData['kepuasan'];
        $data->profesional = $validatedData['profesional'];
        $data->fasilitas = $validatedData['fasilitas'];
        $data->waktu = $validatedData['waktu'];
        $data->biaya = $validatedData['biaya'];
        $data->layanan = $validatedData['layanan'];
        $data->kritik_saran = $validatedData['feedback'];
        $data->save();

        return redirect()->back()->with('success', 'Terima Kasih Atas Kritik dan Saran Anda');
    }
}
