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
                <h2>Selamat Datang di Layanan Online Suherman</h2>
                @if (session('status'))
                    <div class="alert alert-primary" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="row mb-5">
                <div class="col-md-4 mt-4 text-center pelayanan">
                    <a href="{{ route('e-ambulance') }}">
                        <div class="bg-image5">
                            <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                <p class="card-text1">E-Ambulans</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mt-4 text-center pelayanan">
                    <a href="{{ route('e-konsultasi.index') }}">
                        <div class="bg-image6">
                            <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                <p class="card-text1">E-Konsultasi</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mt-4 text-center pelayanan">
                    <a href="{{ route('e-apotek') }}">
                        <div class="bg-image7">
                            <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                <p class="card-text1">E-Apotek</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->
@endsection
