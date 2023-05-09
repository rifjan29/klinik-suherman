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
                // return redirect('/fitur');
                return view('layouts.frontend.ambulance.fitur');

            }
            else{
                return back()->with('alert','Password atau Username, Salah!');
            }
        }
        else{
            return back()->with('alert','Password atau Username, Salah!');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/user-login')->with('alert-success','Kamu sudah logout');
    }

    public function register(){
        return view('layouts.frontend.register');
    }

    public function registerPost(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'nama' => 'required|max:255|string|min:5',
            'username' => 'required|unique:pasien|min:5|max:20|string|alpha_dash',
            'email' => 'required|unique:pasien|email:dns',
            'password' => 'required|min:8|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'address' => 'required|string',
            'phone' => 'required|numeric|min:10|starts_with:08|digits_between:10,12',
            'born' => 'required|string',
            'gender' => 'required|in:L,P',
            'status' => 'required|in:1,0',
            'job' => 'required|string',
            'religion' => 'required|string',
        ]);

        // dd('registrasi berhasil');
        $data = new ModelPasien();
        $data->nama = $validatedData['nama'];
        $data->username = $validatedData['username'];
        $data->email = $validatedData['email'];
        $data->password = Hash::make($validatedData['password']);
        $data->address = $validatedData['address'];
        $data->phone = $validatedData['phone'];
        $data->born = $validatedData['born'];
        $data->gender = $validatedData['gender'];
        $data->status = $validatedData['status'];
        $data->job = $validatedData['job'];
        $data->religion = $validatedData['religion'];
        $data->save();
        return redirect('/user-login')->with('alert-success','Kamu berhasil Register. Silahkan Login');
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
