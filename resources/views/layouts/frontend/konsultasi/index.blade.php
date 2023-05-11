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

        .search {
            width: 65%;
            margin: 35px auto;
        } 
        
        .has-search .form-control {
            padding-left: 3rem;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 50px;
            height: 50px;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #37517e;
            margin-top: 10px;
        }
    </style>
@endpush
@section('hero')
    <section id="hero" class="d-flex align-items-center">
    </section>
@endsection
@section('content')
     <!-- ======= konsultasi Section ======= -->
     <section id="services" class="services">
        <div class="container text-center" data-aos="fade-up">
            <div class="section-title">
                <h2>E-Konsultasi</h2>
            </div>
            <div class="search">
                <div class="form-group has-search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Cari Dokter" />
                </div>
            </div>
            <p style="color: #b4b4b4;"><span style="color: red;">*</span>Konsultasi online hanya dapat dilakukan dengan dokter gigi dan dokter umum</p>
            <div class="mt-4" style="height:500px; width:auto; overflow:auto; padding:1%;">
                <div class="row">
                    <div class="col-md-4 p-2">
                        <div class="card">
                            <div class="card-body p-3 mt-3 mx-2">
                                <div class="d-flex justify-content-start"><span class="badge text-bg-warning">Sibuk</span></div>
                                <img src="{{ asset('') }}frontend/assets/img/dokter1.png" alt="" class="rounded-circle mt-4">
                                <div class="mt-3">
                                    <h4>Dr. Lorem Ipsum</h4>
                                    <span style="color: #b4b4b4;">Dokter Umum</span>
                                </div>
                                <div class="mt-2">
                                    <i class="fa-solid fa-thumbs-up"></i>
                                    <span style="color: #b4b4b4;">9.5</span>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <div class="float-start">
                                            <span style="color: #b4b4b4;">Mulai Dari</span><br>
                                            <p style="font-weight: bold; color:#F4A223;"><span>Rp.</span>25.000</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="float-end mt-1">
                                            <a class="btn btn-lg btn-primary text-center" data-bs-toggle="modal" href="#exampleModalToggle" role="button" style="background-color:#b4b4b4; border:0; border-radius:10px">
                                                <span class="p-4" style="font-size: 16px">Konsultasi</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-2">
                        <div class="card">
                            <div class="card-body p-3 mt-3 mx-2">
                                <div class="d-flex justify-content-start"><span class="badge text-bg-success">Online</span></div>
                                <img src="{{ asset('') }}frontend/assets/img/dokter1.png" alt="" class="rounded-circle mt-4">
                                <div class="mt-3">
                                    <h4>Dr. Lorem Ipsum</h4>
                                    <span style="color: #b4b4b4;">Dokter Umum</span>
                                </div>
                                <div class="mt-2">
                                    <i class="fa-solid fa-thumbs-up"></i>
                                    <span style="color: #b4b4b4;">9.5</span>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <div class="float-start">
                                            <span style="color: #b4b4b4;">Mulai Dari</span><br>
                                            <p style="font-weight: bold; color:#F4A223;"><span>Rp.</span>25.000</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="float-end mt-1">
                                            <a class="btn btn-lg btn-primary text-center" data-bs-toggle="modal" href="#exampleModalToggle" role="button" style="background-color:#37517e; border:0; border-radius:10px">
                                                <span class="p-4" style="font-size: 16px">Konsultasi</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-2">
                        <div class="card">
                            <div class="card-body p-3 mt-3 mx-2">
                                <div class="d-flex justify-content-start"><span class="badge text-bg-danger">Offline</span></div>
                                <img src="{{ asset('') }}frontend/assets/img/dokter1.png" alt="" class="rounded-circle mt-4">
                                <div class="mt-3">
                                    <h4>Dr. Lorem Ipsum</h4>
                                    <span style="color: #b4b4b4;">Dokter Umum</span>
                                </div>
                                <div class="mt-2">
                                    <i class="fa-solid fa-thumbs-up"></i>
                                    <span style="color: #b4b4b4;">9.5</span>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <div class="float-start">
                                            <span style="color: #b4b4b4;">Mulai Dari</span><br>
                                            <p style="font-weight: bold; color:#F4A223;"><span>Rp.</span>25.000</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="float-end mt-1">
                                            <a class="btn btn-lg btn-primary text-center" data-bs-toggle="modal" href="#exampleModalToggle" role="button" style="background-color:#b4b4b4; border:0; border-radius:10px">
                                                <span class="p-4" style="font-size: 16px">Konsultasi</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-2">
                        <div class="card">
                            <div class="card-body p-3 mt-3 mx-2">
                                <div class="d-flex justify-content-start"><span class="badge text-bg-success">Online</span></div>
                                <img src="{{ asset('') }}frontend/assets/img/dokter1.png" alt="" class="rounded-circle mt-4">
                                <div class="mt-3">
                                    <h4>Dr. Lorem Ipsum</h4>
                                    <span style="color: #b4b4b4;">Dokter Umum</span>
                                </div>
                                <div class="mt-2">
                                    <i class="fa-solid fa-thumbs-up"></i>
                                    <span style="color: #b4b4b4;">9.5</span>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <div class="float-start">
                                            <span style="color: #b4b4b4;">Mulai Dari</span><br>
                                            <p style="font-weight: bold; color:#F4A223; font-size:16px;"><span>Rp.</span>25.000</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="float-end mt-1">
                                            <a class="btn btn-lg btn-primary text-center" data-bs-toggle="modal" href="#exampleModalToggle" role="button" style="background-color:#37517e; border:0; border-radius:10px">
                                                <span class="p-4" style="font-size: 16px">Konsultasi</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End konsultasi Section -->


    <!-- Start Modal -->

    <!-- Start Modal Dokter -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #37517e">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel" style="color: white;">Konsultasi Dokter</h1>
            </div>
            <div class="modal-body p-3 mx-2">
                <div class="row">
                    <div class="col-md-4 text-center mt-3">
                        <img src="{{ asset('') }}frontend/assets/img/dokter1.png" alt="" class="rounded-circle" style="width: 100px; height:100px;">
                        <div class="mt-3">
                            <i class="fa-solid fa-thumbs-up fa-lg" style="color: #a8a8a8"></i>
                            <span style="color:#37517e; font-weight:bold;">9.5</span>
                        </div>
                    </div>
                    <div class="col-md-8 p-3 mt-3">
                        <div class="mt-2">
                            <i class="fa-solid fa-user-doctor fa-2xl" style="color: #a8a8a8"></i>
                            <span class="fw-bold mx-3" style="color: #37517e">Dr. Lorem Ipsum</span>
                        </div>
                        <div class="ket mt-4">
                            <span style="color: #808080; font-size:14px;">Spesialis Umum</span><br>
                            <span style="color: #808080; font-size:14px;"><span>STR :</span> 000 000 009 002</span>
                        </div>
                    </div>
                    <p class="mt-4 fw-bold" style="font-size: 14px;">Jadwal Kerja</p>
                    <div class="col-md">
                        <div class="card text-center" style="border-color: #37517e">
                            <div class="card-body" style="heigth: 50%;">
                                <span style="color:#37517e; font-size:14px; ">Selasa</span><br>
                                <span style="color:#37517e; font-size:14px;">11:00 - 12:00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card text-center" style="border-color: #37517e">
                            <div class="card-body" style="heigth: 50%;">
                                <span style="color:#37517e; font-size:14px; ">Selasa</span><br>
                                <span style="color:#37517e; font-size:14px;">11:00 - 12:00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card text-center" style="border-color: #37517e">
                            <div class="card-body" style="heigth: 50%;">
                                <span style="color:#37517e; font-size:14px; ">Rabu</span><br>
                                <span style="color:#37517e; font-size:14px;">18:00 - 20:00</span>
                            </div>
                        </div>
                    </div>
                    <p class="mt-4 fw-bold" style="font-size: 14px;">Detail Layanan</p>
                    <div class="col-md-6">
                        <div class="text-center">
                            <span style="color: #808080; font-size:14px;">Tipe Konsultasi</span><br>
                            <span style="color:#37517e; font-size:14px; font-weight:bold;">Konsultasi Via Chat</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center">
                            <span style="color: #808080; font-size:14px;">Durasi</span><br>
                            <span style="color:#37517e; font-size:14px; font-weight:bold;">24 Jam</span>
                        </div>
                    </div>
                    <p class="mt-4 fw-bold" style="font-size: 14px;">Harga Mulai Dari</p>
                    <p style="font-weight: bold; color:#F4A223; font-size:25px;"><span>Rp.</span> 25.000</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Hubungi via Chat</button>
            </div>
            </div>
        </div>
    </div>
    <!-- End Modal Dokter -->

    <!-- Start Modal Pembayaran-->
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #37517e">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel" style="color: white;">Metode Pembayaran</h1>
                </div>
                <div class="modal-body">
                    <div class="card mt-4" style="background-color:#CEDEF6">
                        <div class="card-body">
                            <img style="width: 30px; height:30px;" src="{{ asset('') }}frontend/assets/img/lamp.png">
                            <span class="fw-light align-middle mx-2" style="font-size: 14px">Yuk selesaikan pembayaran. Pastikan pesananmu sudah sesuai ya!</span>
                        </div>
                    </div>
                    <div class="mt-4 mb-4">
                        <label class="fw-bold fs-6" for="">Pilih Metode Pembayaran</label>
                        <select class="form-select mt-2" aria-label="Default select example">
                            <option selected>BCA</option>
                            <option value="1">BNI</option>
                            <option value="2">BSI</option>
                            <option value="3">BRI</option>
                        </select>
                    </div>
                    <div class="mt-4 mb-5">
                        <h5 class="fw-bold mb-4">Ringkasan Pemesanan</h5>
                        <div class="d-flex mb-3">
                            <div class="fs-6 fw-bold">Total Pesanan</div>
                            <div class="ms-auto fw-6"><span>Rp. </span> 25.000</div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="fs-6 fw-bold">Biaya Layanan</div>
                            <div class="ms-auto fw-6"><span>Rp. </span> 0</div>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4 mb-5">
                        <div class="d-flex mb-3">
                            <div class="fs-6 fw-bold">Total Pembayaran</div>
                            <div class="ms-auto fw-bold fs-3" style="color:#F4A223;">Rp. 25.000</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" style="background-color:#b4b4b4;" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Batal</button>
                    <a class="btn btn-primary" href="{{ route('pembayaran')}}">Bayar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Pembayaran -->

    <!-- End Modal -->

@endsection
