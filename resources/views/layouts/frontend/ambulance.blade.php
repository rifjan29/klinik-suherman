@extends('layouts.template')

@section('hero')
    <div style="background-color: #37517e; height: 135px;"></div>
@endsection
@section('content')
<section id="about" class="about">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-title">
            <h2>E-Ambulance</h2>
        </div>
        <div class="row content mt-4">
            <div class="col-lg-12">
                <div class="text-center p-3">
                    <img src="{{ asset('') }}frontend/assets/img/fotoambulans.png" alt="">
                </div>
                <p class="mb-4 mt-4 p-4 text-center">
                    Bagi masyarakat  yang membutuhkan penanganan/evakuasi darurat, klinik dr. Suherman siap memberikan pelayanan ambulance 24 jam.
                    Layanan ambulance  merupakan sarana yang memfasilitasi kegiatan evakuasi medis dengan menggunakan ambulance.
                </p>
                <p class="text-center fw-bold fs-6" style="color: #37517e;">Pelayanan ini meliputi :</p>
                <div class="row p-5">
                    <div class="col-4 text-center">
                        <i class="fa-solid fa-truck-medical fa-2xl"></i>
                        <p class="mt-3 fw-bold">Jemput Pasien</p>
                    </div>
                    <div class="col-4 text-center">
                        <i class="fa-solid fa-truck-medical fa-2xl"></i>
                        <p class="mt-3 fw-bold">Rujuk Pasien</p>
                    </div>
                    <div class="col-4 text-center">
                        <i class="fa-solid fa-truck-medical fa-2xl"></i>
                        <p class="mt-3 fw-bold">Antar Jenazah</p>
                    </div>
                    <div class="d-flex justify-content-center p-2 mt-5">
                        <button type="submit" class="btn btn-lg btn-primary text-center" style="background-color: #37517E; border:0; border-radius:20px"><span class="p-4" style="font-size: 16px">Pesan Ambulance</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
