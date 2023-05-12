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
                <div class="card-body p-5">
                    <div class="text-center">
                        <h2 class="fw-bold mb-3">Pembayaran E-Konsultasi</h2>
                        <span class="">Harap menyelesaikan pembayaran terlebih dahulu</span>
                    </div><br>
                    <div class="p-3 mt-5">
                        <div class="d-flex mb-3">
                            <div class="fs-6 fw-bold">Metode Pembayaran</div>
                            <div class="ms-auto fw-6">
                                <img style="width: 70px; height:50px;" src="{{ asset('') }}frontend/assets/img/bsi.png">
                            </div>
                        </div>
                        <div class="fs-6 fw-bold" style="color: rgb(172, 172, 172)">Nomor Rekening</div>
                        <div class="d-flex mb-3 mt-4">
                            <div class="fs-6 fw-bold">600 0822 4442 7986</div>
                            <div class="ms-auto fw-6">
                                <button class="border border-1">salin</button>
                            </div>
                        </div><br>
                        <div class="text-center mt-5 p-3">
                            <div class="fs-4 fw-bold mb-3">Total Pembayaran</div>
                            <div class="ms-auto fw-bold fs-4" style="color:#F4A223;">Rp. 25.000</div>
                        </div>
                    </div>
                    {{-- <a class="btn btn-primary btn-next mt-3 float-end" href="" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Upload Bukti</a> --}}
                    <a class="btn btn-primary mt-3 float-end" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Upload Bukti</a>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->

    <!-- Start Modal Upload BUkti -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="p-4">
                        <div class="text-center">
                            <div class="mb-3">
                                <label for="formFile" class="form-label fw-bold">Upload Bukti</label>
                                <input class="form-control mt-2" type="file" id="formFile">
                            </div>
                            <a class="btn btn-primary mt-4" href="{{ route('pembayaran')}}">Upload</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Upload BUkti -->


    <!-- Start Modal Status Berhasil -->
    <div class="modal fade" id="exampleModalToggle1" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="p-4">
                        <div class="text-center">
                            <div class="mb-3">
                                <img style="width: 50px; height:50px;" src="{{ asset('') }}frontend/assets/img/succes.png">
                            </div>
                            <h4 class="fw-bold">Transaksi Berhasil</h4>
                            <div class="p-3 mt-3">
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">ID Transaksi</div>
                                    <div class="ms-auto">1208763401289</div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Tanggal</div>
                                    <div class="ms-auto">2023-03-12 10:39:56 WIB</div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Sumber Dana</div>
                                    <div class="ms-auto">Lorem Ipsum</div>
                                </div>
                                <hr>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Jenis Transaksi</div>
                                    <div class="ms-auto">Transfer Bank BSI</div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Bank Tujuan</div>
                                    <div class="ms-auto">Bank BSI</div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Nomor Tujuan</div>
                                    <div class="ms-auto">600 0822 4442 7986</div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Nama Tujuan</div>
                                    <div class="ms-auto">Klinik Suherman</div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Durasi</div>
                                    <div class="ms-auto">08:00 - 08:00 WIB</div>
                                </div>
                                <hr>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Nominal</div>
                                    <div class="ms-auto">Rp. 25.000</div>
                                </div>
                            </div>
                            <a class="btn btn-primary mt-4" href="{{ route('pembayaran')}}">Chat Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle1" role="button">modal setelah berhasil upload bukti</a>
    <!-- End Modal Status Berhasil -->

@endsection
