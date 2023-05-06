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
     <section id="pembayaran" class="pembayaran">
        <div class="container" data-aos="fade-up">
            <div class="metode card shadow border border-dark col-6 offset-2 rounded-3">
                <div class="card-body p-4">
                    <h4 class="fw-bold">Metode Pembayaran</h4>
                    <div class="card mt-4" style="background-color:#CEDEF6">
                        <div class="card-body">
                            <img style="width: 30px; height:30px;" src="{{ asset('') }}frontend/assets/img/lamp.png">
                            <span class="fw-light align-middle mx-2" style="font-size: 14px">Pesanan kami terima. Silakan unduh struk pembayaran kemudian klik “Next” untuk melihat estimasi perjalanan ambulance.</span>
                        </div>
                    </div>
                    <p class="mt-4 fw-bold" style="font-size: 16px">Perhatian!</p>
                    <p class="fw-bold fs-normal" style="font-size: 14px; color: #0D5822">Cetak tagihan pembayaran ini kemudian tunjukkan kepada kasir di Klinik Suherman</p>
                    <button class="btn btn-outline-secondary btn-sm" style="background-color:#cedef6b2;">Versi Cetak</button>
                    <div class="card mt-4">
                        <div class="card-body p-4">
                            <p class="mt-1 fw-bold" style="font-size: 16px">Ringkasan Pemesanan</p>
                            <div class="d-flex justify-content-between mt-4">
                                <p class="mt-1 fw-bold" style="font-size: 14px">Total Pesanan</p>
                                <p class="mt-1 fw-normal" style="font-size: 14px">Rp. 25.000</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="fw-bold" style="font-size: 14px">Biaya Layanan</p>
                                <p class="fw-normal" style="font-size: 14px">Rp. 0</p>
                            </div>
                            <p class="mt-5 fw-bold" style="font-size: 18px">Total Pembayaran</p>
                            <p class="fw-bold" style="font-size: 18px; color:#FF4D00">Rp. 25.000</p>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-next mt-3 float-end">Next</button>
                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->
@endsection
