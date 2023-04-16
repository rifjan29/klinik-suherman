<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kasir::all();
        return view('backend.kasir.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.kasir.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kasir' => 'required',
            'email' => 'required',
            'jabatan' => 'required',
            'jeni_kelamin' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        try {
            $user = new User;
            $user->name = $request->get('username');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->role = 'kasir';
            $user->save();

            $kasir = new Kasir;
            $kasir->nama_kasir = $request->get('nama_kasir');
            $kasir->jabatan = $request->get('jabatan');
            $kasir->jenis_kelamin = $request->get('jeni_kelamin');
            $kasir->alamat = $request->get('alamat');
            $kasir->id_user = $user->id;
            if ($request->hasFile('foto_kasir')) {
                $photos = $request->file('foto_kasir');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/kasir');
                if ($photos->move($path, $filename)) {
                    $kasir->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $kasir->save();
            return redirect()->route('kasir.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $e) {
            return redirect()->route('kasir.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('kasir.index')->withError('Terjadi kesalahan.');
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
        $data['data'] = Kasir::find($id);
        $data['user'] = User::find($data['data']->id_user);
        return view('backend.kasir.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kasir' => 'required',
            'email' => 'required',
            'jabatan' => 'required',
            'jeni_kelamin' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'confirmed',
        ]);
        try {
            User::where('id',$request->get('id'))->update([
                'name' => $request->get('username'),
                'email' => $request->get('email'),
            ]);
            if ($request->has('password') && $request->get('password') != null)  {
                User::where('id',$request->get('id'))->update([
                    'name' => $request->get('username'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                ]);
            }

            $kasir = Kasir::findOrFail($id);
            $kasir->nama_kasir = $request->get('nama_kasir');
            $kasir->jabatan = $request->get('jabatan');
            $kasir->jenis_kelamin = $request->get('jeni_kelamin');
            $kasir->alamat = $request->get('alamat');
            if ($request->hasFile('foto_kasir')) {
                $photos = $request->file('foto_kasir');
                $last_path = public_path() . '/img/kasir/' . $kasir->foto;
                unlink($last_path);
                $photos = $request->file('foto_kasir');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/kasir');
                if ($photos->move($path, $filename)) {
                    $kasir->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $kasir->update();
            return redirect()->route('kasir.index')->withStatus('Berhasil mengganti data.');
        } catch (Exception $e) {
            return redirect()->route('kasir.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('kasir.index')->withError('Terjadi kesalahan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kasir = Kasir::find($id);
            $file_path = public_path().'/img/kasir/'.$kasir->foto;
            if (File::delete($file_path)) {
                $user = User::find($kasir->id_user);
                $user->delete();
                $kasir->delete();
            }else{
                $user = User::find($kasir->id_user);
                $user->delete();
                $kasir->delete();
            }
            return redirect()->route('kasir.index')->withStatus('Berhasil Menghapus data.');
        } catch (Exception $e) {
            return redirect()->route('kasir.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('kasir.index')->withError('Terjadi kesalahan.');
        }
    }
}
