<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ModelPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!session::get('login')){
            return redirect('login')->with('alert','Kamu harus login dulu');
        }
        else{
            // return view('pasien');
        }
    }

    public function login(){
        return view('layouts.frontend.login');
    }

    public function loginPost(Request $request){
        // return $request;
        $username = $request->username;
        $password = $request->password;

        $data = ModelPasien::where('username',$username)->first();

        if($data){
            //apakah username tersebut ada atau tidak
            if(Hash::check($password, $data->password)) {
                Session::put('id', $data->id);
                Session::put('nama', $data->nama);
                Session::put('username', $data->username);
                Session::put('email', $data->email);
                Session::put('login', TRUE);
                // dd($data);
                // return $data->email;
                return redirect('/');
            }
            else{
                return back()->with('alert','Password atau Email, Salah!');
            }
        }
        else{
            return back()->with('alert','Password atau Email, Salah!');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/user-login')->with('alert-success','Kamu sudah logout');
    }

    public function register(Request $request){
        return view('layouts.frontend.register');
    }

    public function registerPost(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $data = new ModelPasien();
        $data->nama = $request->nama;
        $data->username = $request->username;
        $data->password = Hash::make($request->get('password'));
        $data->email = $request->email;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->save();
        return redirect('login.index')->with('alert-success', 'Kamu berhasil Register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
