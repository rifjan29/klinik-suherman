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
        <div class="container text-center" data-aos="fade-up" style="height: 100%; width:100%">
            <div class="section-title">
                <h2>Estimasi Perjalanan Ambulance</h2>
            </div>
            <div class="d-flex justify-content-between my-5 mb-5 p-3 align-middle" style="margin-button:40%;">
                <div>
                    <div class="card border border-0 rounded-4 shadow p-3 mx-5" style="width:130px; height:110px; background-color:#37517e;">
                        <img src="{{ asset('') }}frontend/assets/img/estimasi1.png"
                        class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 60px; height:60px">
                    </div>
                    <p class="mt-5 fw-bold" style="color:black; font-size:15px;">Pesanan Diterima</p>
                </div>
                <div>
                    <div class="card border border-0 rounded-4 shadow p-3 mx-5 text-center" style="width:130px; height:110px; background-color:#37517e;">
                        <img src="{{ asset('') }}frontend/assets/img/estimasi2.png"
                        class="rounded mx-auto d-block mt-3" alt="GFG" style="width: 70px; height:50px">
                    </div>
                    <p class="mt-5 fw-bold" style="color:black; font-size:15px;">Ambulance Menuju Lokasi</p>
                </div>
                <div>
                    <div class="card border border-0 rounded-4 shadow p-3 mx-5" style="width:130px; height:110px; background-color:#c9cacc;">
                        <img src="{{ asset('') }}frontend/assets/img/estimasi3.png"
                        class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 71px; height:73px">
                    </div>
                    <p class="mt-5 fw-bold" style="color:black; font-size:15px;">Ambulance Tiba di Lokasi</p>
                </div>
                <div>
                    <div class="card border border-0 rounded-4 shadow p-3 mx-5" style="width:130px; height:110px; background-color:#c9cacc;">
                        <img src="{{ asset('') }}frontend/assets/img/estimasi4.png"
                        class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 60px; height:60px">
                    </div>
                    <p class="mt-5 fw-bold" style="color:black; font-size:15px;">Pesanan Dibayarkan</p>
                </div>
                <div>
                    <div class="card border border-0 rounded-4 shadow p-3 mx-5" style="width:130px; height:110px; background-color:#c9cacc;">
                        <img src="{{ asset('') }}frontend/assets/img/estimasi5.png"
                        class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 60px; height:60px">
                    </div>
                    <p class="mt-5 fw-bold" style="color:black; font-size:15px;">Selesai</p>
                </div>
            </div>
            <button class="btn btn-primary btn-next mt-2 btn-lg">Selesai</button>
        </div>
    </section>
    <!-- End ambulance Section -->
@endsection
