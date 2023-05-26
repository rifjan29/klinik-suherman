@extends('layouts.template')
@push('css')
    <style>
        #hero {
            width: 100%;
            height: 10vh !important;
            background: #37517e;
        }
        .btn-primary {
            background-color: #37517e;
            border: none;
            font-size: 14px;
        }

        .nav-pills .nav-link {
            color:#37517e;
        }
    </style>
@endpush
@section('hero')
    <section id="hero" class="d-flex align-items-center">
    </section>
@endsection
@section('content')
     <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <div class="d-flex flex-column align-items-center mb-4" style="margin-top: 20px;">
                        <div class="card-body">
                            <img src="{{ $data->gender == 'L' ? asset('backend/assets/imgs/people/avatar-4.png') : asset('backend/assets/imgs/people/avatar-1.png') }}" alt="user-img" class="img-fluid rounded-circle" style="width: 75px; height: 75px;">
                        </div>
                        <div class="ml-3 d-none d-sm-block">
                            <span style="color:black; font-size:16px; font-weight:bold;">{{ $data->nama }}</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center mt-3 d-sm-none">
                        <span style="color:black; font-size:16px; font-weight:bold;">{{ $data->nama }}</span>
                    </div>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item mb-2">
                            <a href="{{ route('profil') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-person"></i> <span class="mx-3 d-none d-sm-inline">Profil Saya</span>
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('riwayat') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-clock-history"></i> <span class="mx-3 d-none d-sm-inline">Riwayat</span>
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('notifikasi') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-bell"></i> <span class="mx-3 d-none d-sm-inline">Notifikasi</span> 
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-gear"></i> <span class="mx-3 d-none d-sm-inline">Pengaturan</span> 
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col p-5">
                <div class="section-title">
                    <h2>Pengaturan</h2>
                </div>
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="p-3">
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <h5 class="fw-bold text-center">Ubah Password</h5>
                            </div>
                            <div class="tab-content my-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                            @if (\Session::has('alert-success'))
                                                <div class="alert alert-success">
                                                    <div>{{Session::get('alert-success')}}</div>
                                                </div>
                                            @endif
                                            @if (\Session::has('alert-danger'))
                                                <div class="alert alert-danger">
                                                    <div>{{ Session::get('alert-danger') }}</div>
                                                </div>
                                            @endif
                                        <form action="{{ route('updatePassword') }}" method="POST">
                                            @csrf
                                            <div class="col-md-12">
                                                <div class="p-5">
                                                    <div class="vstack gap-2 col-md-5 mx-auto">
                                                        <div class="mb-3 row">
                                                            <label for="current_password" class="col-sm-3 col-form-label">Password Lama</label>
                                                            <div class="col-sm-9">
                                                                <input type="password" class="form-control shadow @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                                                                @error('current_password')
                                                                <div class="invalid-feedback" role="alert">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="new_password" class="col-sm-3 col-form-label">Password Baru</label>
                                                            <div class="col-sm-9">
                                                                <input type="password" class="form-control shadow @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                                                                @error('password')
                                                                    <div class="invalid-feedback" role="alert">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="new_password_confirmation" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                                                            <div class="col-sm-9">
                                                                <input type="password" class="form-control mt-2 shadow" id="new_password_confirmation" name="new_password_confirmation" required>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-center p-1 mt-3">
                                                        <button type="submit" class="btn btn-lg btn-primary text-center" style="background-color: #37517E; border:0; border-radius:10px"><span class="p-4" style="font-size: 16px">Simpan</span></button>
                                                    </div>
                                                    <div class="d-flex justify-content-center p-1 mt-3">
                                                        <a href="{{ route('lupaPassword') }}" class="fw-bold" style="color: #37517E;">Lupa Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
