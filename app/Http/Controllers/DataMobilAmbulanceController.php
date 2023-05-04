<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use File;


class DataMobilAmbulanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Ambulance::all();
        return view('backend.mobil.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.mobil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required',
            'plat' => 'required',
            'tahun' => 'required',
        ]);
        try {
            $mobil = new Ambulance;
            $mobil->nama_mobil = $request->get('nama_mobil');
            $mobil->plat = $request->get('plat');
            $mobil->tahun_mobil = $request->get('tahun');
            $mobil->asal_mobil = $request->get('asal_mobil') == null ? 'Milik Pribadi' : $request->get('asal_mobil');
            if ($request->hasFile('foto_mobil')) {
                $photos = $request->file('foto_mobil');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/mobil');
                if ($photos->move($path, $filename)) {
                    $mobil->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $mobil->save();
            return redirect()->route('ambulance.index')->withStatus('Berhasil menambahkan data.');

        } catch (Exception $e) {
            return redirect()->route('ambulance.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('ambulance.index')->withError('Terjadi kesalahan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Ambulance::find($id);
        return view('backend.mobil.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_mobil' => 'required',
            'plat' => 'required',
            'tahun' => 'required',
        ]);
        try {
            $mobil = Ambulance::findOrFail($id);
            $mobil->nama_mobil = $request->get('nama_mobil');
            $mobil->plat = $request->get('plat');
            $mobil->tahun_mobil = $request->get('tahun');
            $mobil->asal_mobil =  $request->get('asal_mobil') == null ? 'Milik Pribadi' : $request->get('asal_mobil');
            if ($request->hasFile('foto_mobil')) {
                $photos = $request->file('foto_mobil');
                $last_path = public_path() . '/img/mobil/' . $mobil->foto;
                unlink($last_path);
                $photos = $request->file('foto_mobil');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/mobil');
                if ($photos->move($path, $filename)) {
                    $mobil->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $mobil->update();
            return redirect()->route('ambulance.index')->withStatus('Berhasil mengganti data.');

        } catch (Exception $e) {
            return redirect()->route('ambulance.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('ambulance.index')->withError('Terjadi kesalahan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mobil = Ambulance::find($id);
            $file_path = public_path().'/img/mobil/'.$mobil->foto;
            if (File::delete($file_path)) {
                $mobil->delete();
            }else{
                $mobil->delete();
            }
            return redirect()->route('ambulance.index')->withStatus('Berhasil Menghapus data.');
        } catch (Exception $e) {
            return redirect()->route('ambulance.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('ambulance.index')->withError('Terjadi kesalahan.');
        }
    }
}
