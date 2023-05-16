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
                            <span style="color:black; font-size:16px; font-weight:bold;">Yolanda</span>
                        </div>
                    </div>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item mb-2">
                            <a href="{{ route('profil') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-person"></i> <span class="mx-3 d-none d-sm-inline">Profil Saya</span>
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="" class="nav-link px-0 align-middle">
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
                    <h2>Riwayat</h2>
                </div>
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="p-3">
                            <ul class="nav-tabs nav nav-pills nav-fill" id="myTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                        <h5 class="fw-bold">E-Konsultasi</h5>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        <h5 class="fw-bold">E-Apotek</h5>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                        <h5 class="fw-bold">E-Ambulance</h5>
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content my-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="" style="height:500px; width:auto; overflow:auto; padding:1%;">
                                        <div class="row">
                                            <div class="col-md-12 p-2">
                                                <div class="card">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/profile.jpg') }}" alt="" class="img-fluid rounded-circle" style="width: 100px; height: 100px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="mt-2">
                                                                    <span class="fw-bold fs-5">Dr. Lorem Ipsum</span>
                                                                </div>
                                                                <div class="mt-2">Dr. Umum - 2 tahun</div>
                                                                <div class="d-flex justify-content-start mt-2">
                                                                    <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                    <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                    <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                    <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                    <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                    <span class="align-middle">5</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 position-relative">
                                                                <div class="position-absolute bottom-0 end-0 mx-4">
                                                                    <button>tes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <h1>Profile</h1>
                                    <p>This is the profile tab content.</p>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <h1>Contact</h1>
                                    <p>This is the contact tab content.</p>
                                </div>
                            </div>
                            {{-- <ul class="nav nav-pills nav-fill">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Active</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Much longer nav link</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled">Disabled</a>
                                </li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
