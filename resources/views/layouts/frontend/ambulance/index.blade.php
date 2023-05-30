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
    </style>
@endpush
@section('hero')
    <section id="hero" class="d-flex align-items-center">
    </section>
@endsection
@section('content')
     <!-- ======= ambulance Section ======= -->
     <section id="services" class="services">
        <div class="container text-center" data-aos="fade-up">
            <div class="section-title">
                <h2>E-Ambulans</h2>
            </div>
            <div class="row content">
                <div class="row justify-content-center">
                    <div class="col-md-8 mx-auto">
                        <img src="{{ asset('frontend/assets/img/fotoambulans 1.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <p>Bagi masyarakat  yang membutuhkan penanganan/evakuasi darurat, klinik dr. Suherman siap memberikan pelayanan ambulance 24 jam.
                            Layanan ambulance  merupakan sarana yang memfasilitasi kegiatan evakuasi medis dengan menggunakan ambulance.
                            <br><b>Pelayanan ini meliputi:</b></p>
                    </div>
                </div>
                <div class="row justify-content-center my-5">
                    <div class="col-md-7">
                        <div class="row justify-content-center ">
                            <div class="col-md-4 mb-3">
                                <div class="d-flex flex-column">
                                    <i class="fa-solid fa-truck-medical fa-lg mb-3"></i>
                                    <strong>Jemput Pasien</strong>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex flex-column">
                                    <i class="fa-solid fa-truck-medical fa-lg mb-3"></i>
                                    <strong>Rujuk Pasien</strong>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex flex-column">
                                    <i class="fa-solid fa-truck-medical fa-lg mb-3"></i>
                                    <strong>Antar Pasien</strong>
                                </div>
                            </div>
                        </div>
                        @if (Session::get('id'))
                        <a class="btn btn-lg btn-primary text-center mt-4" href="{{ route('e-ambulance.create') }}">Pesan Ambulance</a>
                        @else
                        <a class="btn btn-lg btn-primary text-center mt-4" href="{{ route('login.index') }}">Pesan Ambulance</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->
@endsection
