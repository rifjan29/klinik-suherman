<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Dokter::with('user')->latest()->get();
        return view('backend.dokter.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $poli = Poli::all();
        return view('backend.dokter.create',compact('poli'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'email' => 'required',
            'poli' => 'required',
            'spesialis' => 'required',
            'jam_kerja' => 'required',
            'jeni_kelamin' => 'required',
            'tgl_lahir' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
            'nominal' => 'required',
            'foto_dokter' => 'required',
        ]);
        try {
            $user = new User;
            $user->name = $request->get('username');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->role = 'dokter';
            $user->save();

            $dokter = new Dokter;
            $dokter->nama_dokter = $request->get('nama_dokter');
            $dokter->id_poli = $request->get('poli');
            $dokter->spesialis = $request->get('spesialis');
            $dokter->mulai_dari = date("H:i", strtotime($this->pecahjamkerja($request->get('jam_kerja'))[0]));
            $dokter->akhir_dari = date("H:i", strtotime($this->pecahjamkerja($request->get('jam_kerja'))[1]));
            $dokter->jenis_kelamin = $request->get('jeni_kelamin');
            $dokter->umur = $request->get('tgl_lahir');
            $dokter->alamat = $request->get('alamat');
            $dokter->nominal = $this->formatNumber($request->get('nominal'));
            $dokter->no_telp = $request->get('telp');
            $dokter->id_user = $user->id;
            if ($request->hasFile('foto_dokter')) {
                $photos = $request->file('foto_dokter');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/dokter');
                if ($photos->move($path, $filename)) {
                    $dokter->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $dokter->save();
            return redirect()->route('dokter.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $e) {
            return redirect()->route('dokter.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('dokter.index')->withError('Terjadi kesalahan.');
        }
    }
    public function formatNumber($param)
    {
        return (int)str_replace('.', '', $param);
    }
    public function pecahjamkerja($param)
    {
        $data = explode('-', $param);
        return $data;
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
        $data['dokter'] = Dokter::find($id);
        $data['user'] = User::find($data['dokter']->id_user);
        $data['poli'] = Poli::all();
        return view('backend.dokter.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'email' => 'required',
            'poli' => 'required',
            'spesialis' => 'required',
            'jam_kerja' => 'required',
            'jeni_kelamin' => 'required',
            'tgl_lahir' => 'required',
            'telp' => 'required',
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

            $dokter = Dokter::findOrFail($id);
            $dokter->nama_dokter = $request->get('nama_dokter');
            $dokter->id_poli = $request->get('poli');
            $dokter->spesialis = $request->get('spesialis');
            $dokter->mulai_dari = date("H:i", strtotime($this->pecahjamkerja($request->get('jam_kerja'))[0]));
            $dokter->akhir_dari = date("H:i", strtotime($this->pecahjamkerja($request->get('jam_kerja'))[1]));
            $dokter->jenis_kelamin = $request->get('jeni_kelamin');
            $dokter->umur = $request->get('tgl_lahir');
            $dokter->alamat = $request->get('alamat');
            $dokter->nominal = $this->formatNumber($request->get('nominal'));
            $dokter->no_telp = $request->get('telp');
            if ($request->hasFile('foto_dokter')) {
                $photos = $request->file('foto_dokter');
                $last_path = public_path() . '/img/dokter/' . $dokter->foto;
                unlink($last_path);
                $photos = $request->file('foto_dokter');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/dokter');
                if ($photos->move($path, $filename)) {
                    $dokter->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $dokter->update();
            return redirect()->route('dokter.index')->withStatus('Berhasil mengganti data.');
        } catch (Exception $e) {
            return redirect()->route('dokter.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('dokter.index')->withError('Terjadi kesalahan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $dokter = Dokter::find($id);
            $file_path = public_path().'/img/dokter/'.$dokter->foto;
            if (File::delete($file_path)) {
                $user = User::find($dokter->id_user);
                $user->delete();
                $dokter->delete();
            }else{
                $user = User::find($dokter->id_user);
                $user->delete();
                $dokter->delete();
            }
            return redirect()->route('dokter.index')->withStatus('Berhasil Menghapus data.');
        } catch (Exception $e) {
            return redirect()->route('dokter.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('dokter.index')->withError('Terjadi kesalahan.');
        }
    }
}
