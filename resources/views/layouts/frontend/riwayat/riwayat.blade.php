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
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/profile.jpg') }}" alt="" class="img-fluid rounded-circle" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="m-2">
                                                                    <span class="fw-bold fs-5">Dr. Lorem Ipsum</span>
                                                                </div>
                                                                <div class="m-2">Dr. Umum - 2 tahun</div>
                                                                <div class="d-flex flex-row m-2">
                                                                    <div class="d-flex justify-content-start mt-2">
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                    </div>
                                                                    <div class="p-1 mx-1">
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 position-relative">
                                                                <div class="position-absolute bottom-0 end-0 mx-4">
                                                                    <button type="submit" class="btn btn-lg btn-primary text-center" style="background-color: #37517E; border:0; border-radius:10px"><span class="p-4" style="font-size: 14px">Catatan Dokter</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/profile.jpg') }}" alt="" class="img-fluid rounded-circle" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="m-2">
                                                                    <span class="fw-bold fs-5">Dr. Lorem Ipsum</span>
                                                                </div>
                                                                <div class="m-2">Dr. Umum - 2 tahun</div>
                                                                <div class="d-flex flex-row m-2">
                                                                    <div class="d-flex justify-content-start mt-2">
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                    </div>
                                                                    <div class="p-1 mx-1">
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 position-relative">
                                                                <div class="position-absolute bottom-0 end-0 mx-4">
                                                                    <button type="submit" class="btn btn-lg btn-primary text-center" style="background-color: #37517E; border:0; border-radius:10px"><span class="p-4" style="font-size: 14px">Catatan Dokter</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/profile.jpg') }}" alt="" class="img-fluid rounded-circle" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="m-2">
                                                                    <span class="fw-bold fs-5">Dr. Lorem Ipsum</span>
                                                                </div>
                                                                <div class="m-2">Dr. Umum - 2 tahun</div>
                                                                <div class="d-flex flex-row m-2">
                                                                    <div class="d-flex justify-content-start mt-2">
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                    </div>
                                                                    <div class="p-1 mx-1">
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 position-relative">
                                                                <div class="position-absolute bottom-0 end-0 mx-4">
                                                                    <button type="submit" class="btn btn-lg btn-primary text-center" style="background-color: #37517E; border:0; border-radius:10px"><span class="p-4" style="font-size: 14px">Catatan Dokter</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/profile.jpg') }}" alt="" class="img-fluid rounded-circle" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="m-2">
                                                                    <span class="fw-bold fs-5">Dr. Lorem Ipsum</span>
                                                                </div>
                                                                <div class="m-2">Dr. Umum - 2 tahun</div>
                                                                <div class="d-flex flex-row m-2">
                                                                    <div class="d-flex justify-content-start mt-2">
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                    </div>
                                                                    <div class="p-1 mx-1">
                                                                        <span>5</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 position-relative">
                                                                <div class="position-absolute bottom-0 end-0 mx-4">
                                                                    <button type="submit" class="btn btn-lg btn-primary text-center" style="background-color: #37517E; border:0; border-radius:10px"><span class="p-4" style="font-size: 14px">Catatan Dokter</span></button>
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
                                    <div class="" style="height:500px; width:auto; overflow:auto; padding:1%;">
                                        <div class="row">
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/obat.png') }}" alt="" class="img-fluid rounded-circle" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="m-2">
                                                                    <span class="fw-bold fs-5">A0000001</span>
                                                                </div>
                                                                <div class="float-start hstack gap-3 m-2">
                                                                    <div class="ms-auto">13/03/2023</div>
                                                                    <div class="vr"></div>
                                                                    <div class="">10:44:38 WIB</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 position-relative">
                                                                <div class="position-absolute top-50 start-50 translate-middle">
                                                                    <span>Rp. 75.000,-</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/obat.png') }}" alt="" class="img-fluid rounded-circle" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="m-2">
                                                                    <span class="fw-bold fs-5">A0000001</span>
                                                                </div>
                                                                <div class="float-start hstack gap-3 m-2">
                                                                    <div class="ms-auto">13/03/2023</div>
                                                                    <div class="vr"></div>
                                                                    <div class="">10:44:38 WIB</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 position-relative">
                                                                <div class="position-absolute top-50 start-50 translate-middle">
                                                                    <span>Rp. 75.000,-</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/obat.png') }}" alt="" class="img-fluid rounded-circle" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="m-2">
                                                                    <span class="fw-bold fs-5">A0000001</span>
                                                                </div>
                                                                <div class="float-start hstack gap-3 m-2">
                                                                    <div class="ms-auto">13/03/2023</div>
                                                                    <div class="vr"></div>
                                                                    <div class="">10:44:38 WIB</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 position-relative">
                                                                <div class="position-absolute top-50 start-50 translate-middle">
                                                                    <span>Rp. 75.000,-</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/obat.png') }}" alt="" class="img-fluid rounded-circle" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="m-2">
                                                                    <span class="fw-bold fs-5">A0000001</span>
                                                                </div>
                                                                <div class="float-start hstack gap-3 m-2">
                                                                    <div class="ms-auto">13/03/2023</div>
                                                                    <div class="vr"></div>
                                                                    <div class="">10:44:38 WIB</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 position-relative">
                                                                <div class="position-absolute top-50 start-50 translate-middle">
                                                                    <span>Rp. 75.000,-</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="" style="height:500px; width:auto; overflow:auto; padding:1%;">
                                        <div class="row">
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/ambulance.png') }}" alt="" class="img-fluid" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="d-flex justify-content-between mx-4">
                                                                    <h5 class="fw-bold" style="color: #37517E">Ambulance Emergency</h6>
                                                                    <span>15 Menit yang lalu</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between mx-4 mt-2">
                                                                    <span>Klinik Rawat Inap dr Suherman - Residence  Baratan</span>
                                                                    <span>7 km x Rp 7000/km</span>
                                                                </div>
                                                                <div class="progress mx-4 m-2">
                                                                    <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <div class="mx-4 mt-2">
                                                                    <div class="float-end fw-bold" style="color: #37517e">Rp. 421.000,-</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/ambulance.png') }}" alt="" class="img-fluid" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="d-flex justify-content-between mx-4">
                                                                    <h5 class="fw-bold" style="color: #37517E">Ambulance Emergency</h6>
                                                                    <span>15 Menit yang lalu</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between mx-4 mt-2">
                                                                    <span>Klinik Rawat Inap dr Suherman - Residence  Baratan</span>
                                                                    <span>7 km x Rp 7000/km</span>
                                                                </div>
                                                                <div class="progress mx-4 m-2">
                                                                    <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <div class="mx-4 mt-2">
                                                                    <div class="float-end fw-bold" style="color: #37517e">Rp. 421.000,-</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/ambulance.png') }}" alt="" class="img-fluid" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="d-flex justify-content-between mx-4">
                                                                    <h5 class="fw-bold" style="color: #37517E">Ambulance Emergency</h6>
                                                                    <span>15 Menit yang lalu</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between mx-4 mt-2">
                                                                    <span>Klinik Rawat Inap dr Suherman - Residence  Baratan</span>
                                                                    <span>7 km x Rp 7000/km</span>
                                                                </div>
                                                                <div class="progress mx-4 m-2">
                                                                    <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <div class="mx-4 mt-2">
                                                                    <div class="float-end fw-bold" style="color: #37517e">Rp. 421.000,-</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/ambulance.png') }}" alt="" class="img-fluid" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="d-flex justify-content-between mx-4">
                                                                    <h5 class="fw-bold" style="color: #37517E">Ambulance Emergency</h6>
                                                                    <span>15 Menit yang lalu</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between mx-4 mt-2">
                                                                    <span>Klinik Rawat Inap dr Suherman - Residence  Baratan</span>
                                                                    <span>7 km x Rp 7000/km</span>
                                                                </div>
                                                                <div class="progress mx-4 m-2">
                                                                    <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <div class="mx-4 mt-2">
                                                                    <div class="float-end fw-bold" style="color: #37517e">Rp. 421.000,-</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
