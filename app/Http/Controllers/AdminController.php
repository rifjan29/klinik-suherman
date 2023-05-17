<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Admin::with('user')->latest()->get();
        return view('backend.admin.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required',
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
            $user->role = 'admin';
            $user->save();

            $admin = new Admin;
            $admin->nama_admin = $request->get('nama_admin');
            $admin->jabatan = $request->get('jabatan');
            $admin->jenis_kelamin = $request->get('jeni_kelamin');
            $admin->alamat = $request->get('alamat');
            $admin->id_user = $user->id;
            if ($request->hasFile('foto_admin')) {
                $photos = $request->file('foto_admin');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/admin');
                if ($photos->move($path, $filename)) {
                    $admin->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $admin->save();
            return redirect()->route('admin.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $e) {
            return redirect()->route('admin.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('admin.index')->withError('Terjadi kesalahan.');
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
        $data['data'] = Admin::find($id);
        $data['user'] = User::find($data['data']->id_user);
        return view('backend.admin.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_admin' => 'required',
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

            $admin = Admin::findOrFail($id);
            $admin->nama_admin = $request->get('nama_admin');
            $admin->jabatan = $request->get('jabatan');
            $admin->jenis_kelamin = $request->get('jeni_kelamin');
            $admin->alamat = $request->get('alamat');
            if ($request->hasFile('foto_admin')) {
                $photos = $request->file('foto_admin');
                if ($admin->foto != null) {
                    $last_path = public_path() . '/img/admin/' . $admin->foto;
                    unlink($last_path);
                }
                $photos = $request->file('foto_admin');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/admin');
                if ($photos->move($path, $filename)) {
                    $admin->foto = $filename;
                } else {
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $admin->update();
            return redirect()->route('admin.index')->withStatus('Berhasil mengganti data.');
        } catch (Exception $e) {
            return redirect()->route('admin.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('admin.index')->withError('Terjadi kesalahan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $admin = Admin::find($id);
            $file_path = public_path().'/img/admin/'.$admin->foto;
            if (File::delete($file_path)) {
                $user = User::find($admin->id_user);
                $user->delete();
                $admin->delete();
            }else{
                $user = User::find($admin->id_user);
                $user->delete();
                $admin->delete();
            }
            return redirect()->route('admin.index')->withStatus('Berhasil Menghapus data.');
        } catch (Exception $e) {
            return redirect()->route('admin.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('admin.index')->withError('Terjadi kesalahan.');
        }
    }
}
