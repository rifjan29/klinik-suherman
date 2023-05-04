<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use File;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Bank::all();
        return view('backend.bank.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required',
            'no_rek' => 'required',
        ]);
        try {
            $bank = new Bank;
            $bank->nama_bank = $request->get('nama_bank');
            $bank->no_rekening = $request->get('no_rek');
            $bank->id_user = auth()->user()->id;
            if ($request->hasFile('foto_bank')) {
                $photos = $request->file('foto_bank');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/bank');
                if ($photos->move($path, $filename)) {
                    $bank->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $bank->save();
            return redirect()->route('bank.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $e) {
            return redirect()->route('bank.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('bank.index')->withError('Terjadi kesalahan.');
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
        $data['data'] = Bank::find($id);
        return view('backend.bank.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_bank' => 'required',
            'no_rek' => 'required',
        ]);
        try {
            $bank = Bank::findOrFail($id);
            $bank->nama_bank = $request->get('nama_bank');
            $bank->no_rekening = $request->get('no_rek');
            if ($request->hasFile('foto_bank')) {
                $photos = $request->file('foto_bank');
                $last_path = public_path() . '/img/bank/' . $bank->foto;
                unlink($last_path);
                $photos = $request->file('foto_bank');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/bank');
                if ($photos->move($path, $filename)) {
                    $bank->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $bank->update();
            return redirect()->route('bank.index')->withStatus('Berhasil mengganti data.');
        } catch (Exception $e) {
            return redirect()->route('bank.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('bank.index')->withError('Terjadi kesalahan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $bank = Bank::find($id);
            $file_path = public_path().'/img/bank/'.$bank->foto;
            if (File::delete($file_path)) {
                $bank->delete();
            }else{
                $bank->delete();
            }
            return redirect()->route('bank.index')->withStatus('Berhasil Menghapus data.');
        } catch (Exception $e) {
            return redirect()->route('bank.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('bank.index')->withError('Terjadi kesalahan.');
        }
    }
}
