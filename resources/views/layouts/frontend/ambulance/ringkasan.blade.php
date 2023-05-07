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
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center">
                <h2>Ringkasan Pemesanan</h2>
            </div>
            <div class="p-4">
                <h6>Kamis, 4 Mei 2023</h6>
                <p class="mb-2 fw-bold">Nama : Ananda Milantika</p>
                <div class="position-relative">
                    <div class="position-absolute top-0 start-0">
                        <p class="fw-bold">No. HP : 089670543672</p>
                    </div>
                    <div class="position-absolute top-0 end-0">
                        <h6>Status : <span style="background-color: yellow">Sedang Proses</span></h6>
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <table class="table table-bordered" style="border-color: black">
                        <thead>
                            <tr class="text-center">
                              <th class="p-5">Tanggal Pemesanan</th>
                              <th class="p-5">Lokasi Penjemputan</th>
                              <th class="p-5">Foto Kejadian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="p-5">20 Maret 2023 jam 12.00</td>
                                <td class="p-5">Jl. Mastrip no. 76, Sumbersari, Jember, Jawa Timur</td>
                                <td class="p-5">-</td>
                            </tr>
                            <tr class="">
                              <td class="p-5" colspan="3">
                                <p class="fw-bold">Keterangan :</p>
                                <p>Kecelakaan motor yang terjadi di jalan mastrip nomor 76 dengan keadaan korban tidak sadarkan diri</p>
                              </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-5 fw-bold">
                    <h5 style="color: #37517e">Silakan cek secara berkala untuk melihat pembaruan status pemesanan Anda</h5>
                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->
@endsection
