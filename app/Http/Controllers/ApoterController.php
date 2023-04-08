<?php

namespace App\Http\Controllers;

use App\Models\Apotek;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

class ApoterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Apotek::with('user')->latest()->get();
        return view('backend.apotek.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.apotek.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_apotek' => 'required',
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
            $user->role = 'apotek';
            $user->save();

            $apotek = new Apotek;
            $apotek->nama_apotek = $request->get('nama_apotek');
            $apotek->jabatan = $request->get('jabatan');
            $apotek->jenis_kelamin = $request->get('jeni_kelamin');
            $apotek->alamat = $request->get('alamat');
            $apotek->id_user = $user->id;
            if ($request->hasFile('foto_apotek')) {
                $photos = $request->file('foto_apotek');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/apotek');
                if ($photos->move($path, $filename)) {
                    $apotek->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $apotek->save();
            return redirect()->route('apotek.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $e) {
            return redirect()->route('apotek.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('apotek.index')->withError('Terjadi kesalahan.');
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
        $data['data'] = Apotek::find($id);
        $data['user'] = User::find($data['data']->id_user);
        return view('backend.apotek.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_apotek' => 'required',
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

            $apotek = Apotek::findOrFail($id);
            $apotek->nama_apotek = $request->get('nama_apotek');
            $apotek->jabatan = $request->get('jabatan');
            $apotek->jenis_kelamin = $request->get('jeni_kelamin');
            $apotek->alamat = $request->get('alamat');
            if ($request->hasFile('foto_apotek')) {
                $photos = $request->file('foto_apotek');
                $last_path = public_path() . '/img/apotek/' . $apotek->foto;
                unlink($last_path);
                $photos = $request->file('foto_apotek');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/apotek');
                if ($photos->move($path, $filename)) {
                    $apotek->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $apotek->update();
            return redirect()->route('apotek.index')->withStatus('Berhasil mengganti data.');
        } catch (Exception $e) {
            return redirect()->route('apotek.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('apotek.index')->withError('Terjadi kesalahan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $apotek = Apotek::find($id);
            $file_path = public_path().'/img/apotek/'.$apotek->foto;
            if (File::delete($file_path)) {
                $user = User::find($apotek->id_user);
                $user->delete();
                $apotek->delete();
            }else{
                $user = User::find($apotek->id_user);
                $user->delete();
                $apotek->delete();
            }
            return redirect()->route('apotek.index')->withStatus('Berhasil Menghapus data.');
        } catch (Exception $e) {
            return redirect()->route('apotek.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('apotek.index')->withError('Terjadi kesalahan.');
        }
    }
}
