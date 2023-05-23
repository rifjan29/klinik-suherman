<?php

namespace App\Http\Controllers;

use App\Models\KategoriObat;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class KategoriObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = KategoriObat::all();
        return view('backend.kategori-obat.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.kategori-obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        try {
            $kategori = new KategoriObat;
            $kategori->name = $request->get('name');
            $kategori->save();
            return redirect()->route('kategori-obat.index')->withStatus('Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('kategori-obat.index')->withError('Terjadi Kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('kategori-obat.index')->withError('Terjadi Kesalahan.');
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
        $data = KategoriObat::find($id);
        return view('backend.kategori-obat.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        try {
            $kategori = KategoriObat::find($id);
            $kategori->name = $request->get('name');
            $kategori->update();
            return redirect()->route('kategori-obat.index')->withStatus('Berhasil mengganti data');
        } catch (Exception $e) {
            return redirect()->route('kategori-obat.index')->withError('Terjadi Kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('kategori-obat.index')->withError('Terjadi Kesalahan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $kategori = KategoriObat::find($id);
            $kategori->delete();
            return redirect()->route('kategori-obat.index')->withStatus('Berhasil menghapus data');
        } catch (Exception $e) {
            return redirect()->route('kategori-obat.index')->withError('Terjadi Kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('kategori-obat.index')->withError('Terjadi Kesalahan.');
        }
    }
}
