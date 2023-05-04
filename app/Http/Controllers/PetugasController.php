<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Petugas;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Petugas::with('user')->latest()->get();
        return view('backend.petugas.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required',
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
            $user->role = 'petugas';
            $user->save();

            $petugas = new Petugas;
            $petugas->nama_petugas = $request->get('nama_petugas');
            $petugas->jabatan = $request->get('jabatan');
            $petugas->jenis_kelamin = $request->get('jeni_kelamin');
            $petugas->alamat = $request->get('alamat');
            $petugas->id_user = $user->id;
            if ($request->hasFile('foto_petugas')) {
                $photos = $request->file('foto_petugas');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/petugas');
                if ($photos->move($path, $filename)) {
                    $petugas->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $petugas->save();
            return redirect()->route('petugas.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $e) {
            return redirect()->route('petugas.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('petugas.index')->withError('Terjadi kesalahan.');
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
        $data['data'] = Petugas::find($id);
        $data['user'] = User::find($data['data']->id_user);
        return view('backend.petugas.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_petugas' => 'required',
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

            $petugas = Petugas::findOrFail($id);
            $petugas->nama_petugas = $request->get('nama_petugas');
            $petugas->jabatan = $request->get('jabatan');
            $petugas->jenis_kelamin = $request->get('jeni_kelamin');
            $petugas->alamat = $request->get('alamat');
            if ($request->hasFile('foto_petugas')) {
                $photos = $request->file('foto_petugas');
                $last_path = public_path() . '/img/petugas/' . $petugas->foto;
                unlink($last_path);
                $photos = $request->file('foto_petugas');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/petugas');
                if ($photos->move($path, $filename)) {
                    $petugas->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $petugas->update();
            return redirect()->route('petugas.index')->withStatus('Berhasil mengganti data.');
        } catch (Exception $e) {
            return redirect()->route('petugas.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('petugas.index')->withError('Terjadi kesalahan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $petugas = Petugas::find($id);
            $file_path = public_path().'/img/petugas/'.$petugas->foto;
            if (File::delete($file_path)) {
                $user = User::find($petugas->id_user);
                $user->delete();
                $petugas->delete();
            }else{
                $user = User::find($petugas->id_user);
                $user->delete();
                $petugas->delete();
            }
            return redirect()->route('petugas.index')->withStatus('Berhasil Menghapus data.');
        } catch (Exception $e) {
            return redirect()->route('petugas.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('petugas.index')->withError('Terjadi kesalahan.');
        }
    }
}
