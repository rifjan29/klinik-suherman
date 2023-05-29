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
                <h2>E-Konsultasi</h2>
            </div>
            <div class="row content">
                <div class="row justify-content-center">
                    <div class="col-md-8 mx-auto">
                        <img src="{{ asset('frontend/assets/img/konsultasi.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <p>Konsultasi lewat chat dengan dokter umum dan dokter gigi seputar kesehatan lebih mudah dan cepat.
                            Mulai dari chat dan resep obat.
                            <br><b>Pelayanan ini meliputi:</b></p>
                    </div>
                </div>
                <div class="row justify-content-center my-5">
                    <div class="col-md-7">
                        <div class="row justify-content-center ">
                            <div class="col-md-4 mb-3">
                                <div class="d-flex flex-column">
                                    <img src="{{ asset('frontend/assets/img/chat.png') }}" class="img-fluid mx-auto" width="30"  alt="">
                                    <strong>Konsultasi Online</strong>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="d-flex flex-column">
                                    <img src="{{ asset('frontend/assets/img/medicine.png') }}" class="img-fluid mx-auto" width="30"  alt="">

                                    <strong>Resep Obat</strong>
                                </div>
                            </div>

                        </div>
                        @if (Session::get('id'))
                        <a class="btn btn-lg btn-primary text-center mt-4" href="{{ route('e-konsultasi') }}">Konsultasi Sekarang</a>
                        @else
                        <a class="btn btn-lg btn-primary text-center mt-4" href="{{ route('login.index') }}">Login</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->
@endsection
