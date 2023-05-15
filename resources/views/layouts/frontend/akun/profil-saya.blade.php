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
                    <div class="d-flex flex-row mb-3 p-3">
                        <div class="card-body">
                            <img src="{{ asset('frontend/assets/img/profile.jpg') }}" alt="" class="img-fluid rounded-circle" style="width: 75px; height: 75px;">
                        </div>
                        <div class="mx-4 mt-4">
                            <span style="color:black; font-size:16px; font-weight:bold;">{{ $data->nama }}</span>
                        </div>
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
                            <a href="{{ route('pengaturan') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-gear"></i> <span class="mx-3 d-none d-sm-inline">Pengaturan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col p-5">
                <div class="section-title">
                    <h2>Profil Saya</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="p-3">
                            <div class="fw-bold" style="font-size:20px;">
                                <p>Ubah Informasi Pengguna</p>
                            </div>
                            <form action="{{ route('updateProfil') }}" method="POST">
                                @csrf
                                @method('PUT')
                                @if (\Session::has('alert-success'))
                                    <div class="alert alert-success">
                                        <div>{{Session::get('alert-success')}}</div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label for="nama" class="col-form-label fw-bold">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control rounded-3 mt-1  @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama Lengkap" style="height: 50px;" required value="{{ old('nama', $data->nama)}}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="religion" class="col-form-label fw-bold">Agama</label>
                                        <input type="text" name="religion" class="form-control rounded-3 mt-1  @error('religion') is-invalid @enderror" id="religion" placeholder="(Islam, Kristen, Katolik, Budha, Hindu, Khonghucu)" style="height: 50px;" required value="{{ old('religion', $data->religion) }}">
                                        @error('religion')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="born" class="col-form-label fw-bold">Tempat/Tanggal Lahir</label>
                                        <input type="text" name="born" class="form-control rounded-3 mt-1  @error('born') is-invalid @enderror" id="born" placeholder="Masukkan Tempat, Tanggal Lahir" style="height: 50px;" required value="{{ old('born',$data->born)}}">
                                        @error('born')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="gender" class="col-form-label fw-bold">Jenis Kelamin</label>
                                            <div class="d-flex justify-content-start mt-3">
                                                <div class="form-check">
                                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="male" value="L" {{ old('gender',$data->gender) == 'L' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="male">Laki-Laki</label>
                                                </div>
                                                <div class="form-check mx-4">
                                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="female" value="P" {{ old('gender',$data->gender) == 'P' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="female">Perempuan</label>
                                                </div>
                                                @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="status" class="col-form-label fw-bold">Status Perkawinan</label>
                                        <div class="d-flex justify-content-start mt-3">
                                            <div class="form-check">
                                                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="married" value="1" {{ old('status', $data->status) == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="married">Kawin</label>
                                            </div>
                                            <div class="form-check mx-4">
                                                <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="single" value="0" {{ old('status', $data->status) == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="single">Belum Kawin</label>
                                            </div>
                                        </div>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="job" class="col-form-label fw-bold">Pekerjaan</label>
                                        <input type="text" name="job" class="form-control rounded-3 mt-1  @error('job') is-invalid @enderror" id="job" placeholder="Masukkan Pekerjaan" style="height: 50px;" required value="{{ old('job',$data->job) }}">
                                        @error('job')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="address" class="col-form-label fw-bold">Alamat</label>
                                        <input type="text" name="address" class="form-control rounded-3 mt-1  @error('address') is-invalid @enderror" id="address" placeholder="Masukkan Alamat" style="height: 50px;" required value="{{ old('address',$data->address) }}">
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="phone" class="col-form-label fw-bold">Nomor Telepon</label>
                                        <input type="number" name="phone" class="form-control rounded-3 mt-1  @error('phone') is-invalid @enderror" id="phone" placeholder="Masukkan Nomor Anda (08xxxxxxxxxx)" style="height: 50px;" required value="{{ old('phone',$data->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-center p-1 mt-5">
                                        <button type="submit" class="btn btn-lg btn-primary text-center" style="background-color: #37517E; border:0; border-radius:10px"><span class="p-4" style="font-size: 16px">Simpan</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
