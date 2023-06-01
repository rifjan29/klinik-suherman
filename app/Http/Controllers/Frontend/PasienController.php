<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ModelPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class   PasienController extends Controller
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
                Session::put('phone', $data->phone);
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
        $validatedData = $request->validate([
            'nama' => 'required|max:255|string|min:5',
            'username' => 'required|unique:pasien|min:5|max:20|string|alpha_dash',
            'email' => 'required|unique:pasien|email:dns',
            'password' => 'required|min:5',
            'address' => 'required|string',
            'phone' => 'required|numeric|min:10|starts_with:08|digits_between:10,12',
            'birthplace' => 'required|string',
            'birthdate' => 'required|date',
            'gender' => 'required|in:L,P',
            'status' => 'required|in:1,0',
            'job' => 'required|string',
            'religion' => 'required|string',
            'password' => 'confirmed',

        ],[
            'required' => ':attribute harus terisi',
            'regex' => ':attribute terdiri dari minimal 8 karakter dan terdapat huruf besar dan simbol',
            'min' => ':attribute harus lebih dari 5 karakter',
            'phone.starts_with' => 'Nomor Telepon harus diawali dengan 08',
            'confirmed' => ':attribute data tidak sesuai',
            'email.dns' => 'Email tidak valid'
        ]);

        // dd('registrasi berhasil');
        $data = new ModelPasien();
        $data->nama = $validatedData['nama'];
        $data->username = $validatedData['username'];
        $data->email = $validatedData['email'];
        $data->password = Hash::make($validatedData['password']);
        $data->address = $validatedData['address'];
        $data->phone = $validatedData['phone'];
        $born = $validatedData['birthplace'] . ', ' . $validatedData['birthdate'];
        $data->born = $born;
        $data->gender = $validatedData['gender'];
        $data->status = $validatedData['status'];
        $data->job = $validatedData['job'];
        $data->religion = $validatedData['religion'];
        $data->save();
        return redirect('/user-login')->with('alert-success','Kamu berhasil Register. Silahkan Login');
    }

    public function forgotPassword(){
        return view('layouts.frontend.lupaPassword');
    }

    public function forgotPasswordPost(Request $request){
        $request->validate([
            'email' => 'email:dns|required_without:phone',
            'phone' => 'numeric|min:10|starts_with:08|digits_between:10,12|required_without:email',
        ],[
            'email.dns' => 'Email tidak valid',
            'email.required_without' => 'Silahkan isi dengan Email Terdaftar',
            'phone.required_without' => 'Silahkan isi dengan Nomor Telepon Terdaftar',
            'phone.starts_with' => 'Nomor Telepon harus diawali dengan 08',
            'phone.digits_between' => 'Nomor Telepon harus diantara 10 sampai 12 digit',
            'phone.numeric' => 'Nomor Telepon harus berupa angka',
            'phone.min' => 'Nomor Telepon harus lebih dari 10 digit',
            'phone.max' => 'Nomor Telepon harus kurang dari 12 digit',
        ]);
        // dd('Success');
        if ($request->has('email')) {
        $data = ModelPasien::where('email', $request->email)->first();
        } elseif ($request->has('phone')) {
            $data = ModelPasien::where('phone', $request->phone)->first();
        } else {
            throw ValidationException::withMessages([
                'email' => 'Email or phone is required.',
                'phone' => 'Email or phone is required.',
            ]);
        }
        if ($data){
            session(['id' => $data->id]);
            return redirect()->route('resetPassword')->with('alert-success',"Email atau Nomor Telepon Terdaftar.\nSilahkan isi Password Baru.");
        } else {
            return back()->with('alert-danger','Email atau Nomor Telepon tidak terdaftar');
        }
    }

    public function resetPassword(){
        return view('layouts.frontend.resetPassword');
    }

    public function resetPasswordPost(Request $request){
        $validatedData = $request->validate([
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password',
        ],[
            'password.required' => 'Silahkan isi Password',
            'password.min' => 'Password harus lebih dari 5 karakter',
            'password_confirmation.required' => 'Silahkan isi Konfirmasi Password',
            'password_confirmation.same' => 'Konfirmasi Password tidak sama dengan Password',
        ]);
        $data = ModelPasien::find(session('id'));

        if ($data) {
            $data->password = Hash::make($request->password);
            $data->save();
            session()->forget('id');
            return redirect('/user-login')->with('alert-success', 'Password berhasil diubah. Silahkan Login');
        } else {
            return back()->with('alert-danger', 'Password gagal diubah. Username tidak dapat ditemukan');
        }
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
