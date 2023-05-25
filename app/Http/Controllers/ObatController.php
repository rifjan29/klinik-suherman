<?php

namespace App\Http\Controllers;

use App\Models\KategoriObat;
use App\Models\Obat;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Obat::select('obat.*','category_obat.name')
                    ->join('category_obat','category_obat.id','obat.id_kategori')
                    ->get();
        return view('backend.obat.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriObat::all();
        return view('backend.obat.create',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|not_in:0',
            'name' => 'required',
            'stok' => 'required',
            'harga' => 'required',
        ]);
        try {
            $obat = new Obat;
            $obat->nama_obat = $request->get('name');
            $obat->stok = $request->get('stok');
            $obat->harga = $request->get('harga');
            $obat->id_kategori = $request->get('id_kategori');
            $obat->save();
            return redirect()->route('obat.index')->withStatus('Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('obat.index')->withError('Terjadi kesalahan');
        } catch (QueryException $e){
            return redirect()->route('obat.index')->withError('Terjadi kesalahan');

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
        $kategori = KategoriObat::all();
        $data = Obat::find($id);
        return view('backend.obat.edit',compact('data','kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_kategori' => 'required|not_in:0',
            'name' => 'required',
            'stok' => 'required',
            'harga' => 'required',
        ]);
        try {
            $obat = Obat::find($id);
            $obat->nama_obat = $request->get('name');
            $obat->stok = $request->get('stok');
            $obat->harga = $request->get('harga');
            $obat->id_kategori = $request->get('id_kategori');
            $obat->update();
            return redirect()->route('obat.index')->withStatus('Berhasil mengganti data');
        } catch (Exception $e) {
            return redirect()->route('obat.index')->withError('Terjadi kesalahan');
        } catch (QueryException $e){
            return redirect()->route('obat.index')->withError('Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $obat = Obat::find($id);
            $obat->delete();
            return redirect()->route('obat.index')->withStatus('Berhasil menghapus data');
        } catch (Exception $e) {
            return redirect()->route('obat.index')->withError('Terjadi kesalahan');
        } catch (QueryException $e){
            return redirect()->route('obat.index')->withError('Terjadi kesalahan');
        }
    }
}
