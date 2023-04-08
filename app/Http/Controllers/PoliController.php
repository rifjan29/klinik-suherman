<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Poli::latest()->get();
        return view('backend.poli.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.poli.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:poli,nama_poli',
        ]);
        try {
            $poli = new Poli;
            $poli->nama_poli = $request->get('name');
            $poli->save();
            return redirect()->route('poli.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $e) {
            return redirect()->route('poli.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('poli.index')->withError('Terjadi kesalahan.');
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
        $data = Poli::find($id);
        return view('backend.poli.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Poli::find($id);
        $isUniquekategori = $kategori->nama_poli == $request->nama_poli ? '' : '|unique:poli,nama_poli';
        $request->validate([
            'name' => 'required'.$isUniquekategori,
        ]);
        try {
            $poli = Poli::findOrFail($id);
            $poli->nama_poli = $request->get('name');
            $poli->save();
            return redirect()->route('poli.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $e) {
            return redirect()->route('poli.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('poli.index')->withError('Terjadi kesalahan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Poli::findOrFail($id)->delete();
            return redirect()->route('poli.index')->withStatus('Berhasil Menghapus data');
        } catch (Exception $e) {
            return redirect()->route('poli.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('poli.index')->withError('Terjadi kesalahan.');
        }
    }
}
