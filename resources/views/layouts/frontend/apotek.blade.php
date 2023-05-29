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
                <h2>E-Apotek</h2>
            </div>
            <div class="row content">
                <div class="row justify-content-center">
                    <div class="col-md-8 mx-auto">
                        <img src="{{ asset('frontend/assets/img/apotek.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-12">
                        <p>E-Apotek merupakan fitur dari E-MAN yang berfungsi untuk melakukan transaksi pembelian obat yang ada di Klinik Rawat Inap di Klinik Suherman. Dalam mengakses E-Apotek dan melakukan transaksi obat harus mengakses E-Konsultasi terlebih dahulu untuk mendapatkan pelayanan konsultasi dan resep dokter. Klik <b>Next</b> untuk mendapatkan konsultasi dari dokter yang tersedia
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center ">
                    <div class="col-md-7">

                        @if (Session::get('id'))
                        <a class="btn btn-lg btn-primary text-center mt-4" href="{{ route('e-konsultasi') }}">Next</a>
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
