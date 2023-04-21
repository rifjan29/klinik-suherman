@extends('layouts.template')
@section('hero')
    <section id="hero" class="d-flex align-items-center">
        <div class="hero-img">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                        <h1>Selamat Datang di
                            Klinik Rawat Inap
                            dr. Suherman</h1>
                        <h4 class="fw-light mt-3" style="color:rgb(197, 197, 197)">Melayani dengan Sepenuh Hati</h4>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 d-flex justify-content-center" data-aos="zoom-in" data-aos-delay="200">
                        <img src="{{ asset('') }}frontend/assets/img/logo-1.png" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
  <!-- End Hero -->
@section('content')
    <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients section-bg" style="background-color: #37517e;">
            <div class="container">

            <div class="row" data-aos="zoom-in">

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="assets/img/clients/client-1.png" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                <img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
                </div>

            </div>

            </div>
        </section>
        <!-- End Cliens Section -->

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container text-center" data-aos="fade-up">
                <div class="section-title">
                    <h2>Tentang Kami</h2>
                </div>
                <div class="row content">
                    <div class="row justify-content-between">
                        <div class="col-4 p-5">
                            <img src="{{ asset('') }}frontend/assets/img/status-alert.png" alt="">
                            <p class="mt-3 fw-bold">Meraih “Status Paripurna”</p>
                        </div>
                        <div class="col-4 p-5">
                            <img src="{{ asset('') }}frontend/assets/img/hospital-fill.png" alt=""><br>
                            <p class="mt-3 fw-bold">Fasilitas Kesehatan Tingkat Pertama</p>
                        </div>
                        <div class="col-4 p-5">
                            <img src="{{ asset('') }}frontend/assets/img/Group 2.png" alt=""><br>
                            <p class="mt-3 fw-bold">14 Februari 2009</p>
                        </div>
                        <div class="col-4 p-5">
                            <img src="{{ asset('') }}frontend/assets/img/status-alert.png" alt=""><br>
                            <p class="mt-3 fw-bold">Meraih “Status Paripurna”</p>
                        </div>
                        <div class="col-4 p-5">
                            <img src="{{ asset('') }}frontend/assets/img/hospital-fill.png" alt=""><br>
                            <p class="mt-3 fw-bold">Fasilitas Kesehatan Tingkat Pertama</p>
                        </div>
                        <div class="col-4 p-5">
                            <img src="{{ asset('') }}frontend/assets/img/Group 2.png" alt=""><br>
                            <p class="mt-3 fw-bold">14 Februari 2009</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Us Section -->

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="team section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Profil</h2>
                </div>
                <div class="row">
                    <div class="col-lg-5 text-center" data-aos="zoom-in" data-aos-delay="300">
                        <div class="card border-0 p-3 shadow rounded-3">
                            {{-- style="background:#D9D9D9" --}}
                            <div class="card-body align-middle mb-4">
                                <h4>Motto</h4>
                                <p class="mt-5">Melayani dengan sepenuh hati</p>
                            </div>
                        </div>
                        <div class="card border-0 p-3 mt-4 shadow rounded-3">
                            <div class="card-body align-middle mb-4">
                                <h4>Visi</h4>
                                <p class="mt-4">Menjadi Klinik Utama yang mengedepankan pelayanan prima dan nilai-nilai keislaman dengan ragam layanan unggulan pada Tahun 2027</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 d-flex align-items-stretch section__misi" data-aos="zoom-in" data-aos-delay="300">
                        <div class="card p-3 border-0 shadow rounded-3">
                            <div class="card-body">
                                <h4 class="text-center">Misi</h4>
                                <ol class="mt-4">
                                    <li>Meningkatkan status Klinik Pratama menjadi Klinik Utama </li>
                                    <li class="mt-2">Memberikan pelayanan preventif, kuratif dan rehabilitative yang komprehensif dan berkesinambungan sesuai dengan kompetensi</li>
                                    <li class="mt-2">Memberikan pelayanan kesehatan bermutu dan mengutamakan keselamatan dan kepuasan pasien</li>
                                    <li class="mt-2">Menyediakan sarana, prasarana dan peralatan yang bermutu baik & terpercaya</li>
                                    <li class="mt-2">Menyediakan SDM yang professional, santun dan berakhlak mulia berdasarkan nilai-nilai keislaman</li>
                                    <li class="mt-2">Memberikan pleayanan unggulan</li>
                                    <li class="mt-2">Melakukan kerjasama dengan pihak lain yang saling memberikan manfaat</li><br>
                                </ol>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-5 mt-4 text-center" data-aos="zoom-in" data-aos-delay="300">
                        <div class="member align-middle">
                            <h4>Visi</h4>
                            <p class="mt-4">Menjadi Klinik Utama yang mengedepankan pelayanan prima dan nilai-nilai keislaman dengan ragam layanan unggulan pada Tahun 2027</p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        <!-- End Why Us Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services" style="background-color: #37517e">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2 style="color: white">Pelayanan</h2>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center pelayanan">
                        <a href="{{ route('rawat-jalan') }}">
                            <div class="bg-image1">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">Rawat Jalan</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 text-center pelayanan">
                        <a href="{{ route('rawat-inap') }}">
                            <div class="bg-image2">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">Rawat Inap</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 text-center pelayanan">
                        <a href="{{ route('penunjang') }}">
                            <div class="bg-image3">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">Penunjang</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mt-4 text-center pelayanan">
                        <a href="{{ route('ugd') }}">
                            <div class="bg-image4">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">UGD</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mt-4 text-center pelayanan">
                        <a href="{{ route('e-ambulance') }}">
                            <div class="bg-image5">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">E-Ambulance</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mt-4 text-center pelayanan">
                        <a href="{{ route('e-konsultasi') }}">
                            <div class="bg-image6">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">E-Konsultasi</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Services Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Dokter</h2>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 text-center pelayanan" data-aos="zoom-in" data-aos-delamd-400">
                        <a href="">
                            <div class="bg-image7">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">Poli Umum</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 text-center pelayanan" data-aos="zoom-in" data-aos-delamd-400">
                        <a href="">
                            <div class="bg-image8">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">Poli KIA</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 text-center pelayanan" data-aos="zoom-in" data-aos-delamd-400">
                        <a href="">
                            <div class="bg-image9">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">Poli Gigi</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Portfolio Section -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Kritik dan Saran</h2>
                </div>
                <div class="row">
                    <div>
                        <p>Berikan pelayanan pada kami</p>
                        <p>Seberapa puaskah anda terhadap pelayanan kami?</p>
                    </div>
                    <div>
                        <p class="fw-bolder fs-6">Responden</p>
                        <div class="d-flex justify-content-start">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">Pasien</label>
                            </div>
                            <div class="form-check mx-4">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">Pengunjung</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p>Kepuasan Rumah Sakit</p>
                        <div class="d-flex justify-content-center" style="width: auto">
                            <div class="row text-center">
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji1.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Sangat tidak puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji2.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Tidak puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji3.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji4.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Sangat puas</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p>Profesionalisme dan Keterampilan Petugas</p>
                        <div class="d-flex justify-content-center" style="width: auto">
                            <div class="row text-center">
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji1.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Sangat tidak puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji2.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Tidak puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji3.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji4.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Sangat puas</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p>Fasilitas (Sarana dan Prasarana)</p>
                        <div class="d-flex justify-content-center" style="width: auto">
                            <div class="row text-center">
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji1.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Sangat tidak puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji2.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Tidak puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji3.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji4.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Sangat puas</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p>Ketepatan Waktu Layanan</p>
                        <div class="d-flex justify-content-center" style="width: auto">
                            <div class="row text-center">
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji1.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Sangat tidak puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji2.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Tidak puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji3.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji4.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Sangat puas</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p>Kesesuaian Biaya Layanan dengan Manfaat yang Dirasakan</p>
                        <div class="d-flex justify-content-center" style="width: auto">
                            <div class="row text-center">
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji1.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Sangat tidak puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji2.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Tidak puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji3.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Puas</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-3 p-5">
                                    <a href="">
                                        <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                            <img src="{{ asset('') }}frontend/assets/img/emoji4.png"
                                            class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                            <p class="mt-3" style="color:black; font-size:12px">Sangat puas</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Jenis Pelayanan</label>
                            <select class="form-select shadow" aria-label="Default select example">
                                <option selected>Pilih Pelayanan</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama pasien</label>
                            <input type="email" class="form-control shadow" id="exampleFormControlInput1" placeholder="Isikan nama anda">
                        </div>
                        <div class="mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Nomor HP</label>
                            <input type="email" class="form-control shadow" id="exampleFormControlInput1" placeholder="Isikan nomor HP anda">
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
                        <div class="">
                            <label for="exampleFormControlTextarea1" class="form-label">Kritik dan Saran</label>
                            <textarea class="form-control shadow" id="exampleFormControlTextarea1" rows="9" cols="100" placeholder="Isikan Kotak dan Saran Anda"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end p-1 mt-5">
                        <button type="button" class="btn btn-lg btn-primary text-center" style="background-color: #37517E; border:0; border-radius:20px"><span class="p-4" style="font-size: 16px">Submit</span></button>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Team Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact" style="background-color: #37517e">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2 style="color:white;">Kontak</h2>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="300">
                        <ul class="p-0" style="color:white">
                            <li class="mb-3"><i class="fa-solid fa-location-dot fa-1x" aria-hidden="true"></i><span class="mx-3">Jl. Karimata No.49, Gumuk Kerang, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121</span></li>
                            <li class="mb-3"><i class="fa fa-phone fa-1x" aria-hidden="true"></i><span class="mx-3">085 233 001 981</span></li>
                            <li class="mb-3"><i class="fa fa-envelope fa-1x" aria-hidden="true"></i><a href="" style="color: white"><span class="mx-3">kliniksuherman@unmuhjember.ac.id</span></a></li>
                            <li class="mb-3"><i class="fa-brands fa-square-instagram fa-1x"></i><a href="" style="color: white"><span class="mx-3">@kliniksuherman</span></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-7 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
                        <iframe class="rounded-4" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4458.5783732372465!2d113.71520663005651!3d-8.176142185914616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695d3658161bf%3A0xc6a3da57e5f2dc7a!2sKlinik%20Rawat%20Inap%20dr.%20M.%20Suherman!5e0!3m2!1sid!2sid!4v1681063878845!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                    </div>
                </div>
                {{-- <div class="row">

                    <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Location:</h4>
                        <p>A108 Adam Street, New York, NY 535022</p>
                        </div>

                        <div class="email">
                        <i class="bi bi-envelope"></i>
                        <h4>Email:</h4>
                        <p>info@example.com</p>
                        </div>

                        <div class="phone">
                        <i class="bi bi-phone"></i>
                        <h4>Call:</h4>
                        <p>+1 5589 55488 55s</p>
                        </div>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                    </div>

                    </div>

                    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Your Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Your Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        </div>
                        <div class="form-group">
                        <label for="name">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                        <div class="form-group">
                        <label for="name">Message</label>
                        <textarea class="form-control" name="message" rows="10" required></textarea>
                        </div>
                        <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                    </div>

                </div> --}}

            </div>
        </section>
        <!-- End Contact Section -->
@endsection
