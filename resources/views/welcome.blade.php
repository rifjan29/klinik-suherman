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
    @if(session('success'))
    <div class="modal" tabindex="-1" role="dialog" id="successModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #D4EDDA; color: #198754;">
                    <h5 class="modal-title">Success</h5>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('successModal').style.display = 'block';
        setTimeout(function(){
            document.getElementById('successModal').style.display = 'none';
        }, 5000);
    </script>
    @endif
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
                <div class="row d-flex flex-wrap align-content-center">
                    <div class="col-md-3 mb-3 text-center pelayanan">
                        <a href="{{ route('rawat-jalan') }}">
                            <div class="bg-image1">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">Rawat Jalan</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3 text-center pelayanan">
                        <a href="{{ route('rawat-inap') }}">
                            <div class="bg-image2">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">Rawat Inap</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3 text-center pelayanan">
                        <a href="{{ route('penunjang') }}">
                            <div class="bg-image3">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">Penunjang</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3 text-center pelayanan">
                        <a href="{{ route('ugd') }}">
                            <div class="bg-image4">
                                <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                    <p class="card-text">UGD</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-center row">
                        <div class="col-md-3 mt-4 mx-3 text-center pelayanan">
                            <a href="{{ route('e-ambulance') }}">
                                <div class="bg-image5">
                                    <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                        <p class="card-text">E-Ambulance</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 mt-4 mx-3 text-center pelayanan">
                            <a href="{{ route('e-konsultasi') }}">
                                <div class="bg-image6">
                                    <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                        <p class="card-text">E-Konsultasi</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 mt-4 mx-3 text-center pelayanan">
                            <a href="{{ route('e-apotek') }}">
                                <div class="bg-image7">
                                    <div class="text-start mx-4 fw-bold fs-5" style="color: rgb(247, 247, 247)">
                                        <p class="card-text">E-Apotek</p>
                                    </div>
                                </div>
                            </a>
                        </div>
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
                    <form action="{{ route('kritikSaran') }}" method="post">
                        @csrf
                        <div class="mt-3">
                            <label class="fw-bolder fs-6" for="responden">Responden</label>
                            <div class="d-flex justify-content-start">
                                <div class="form-check">
                                    <input class="form-check-input @error('responden') is-invalid @enderror" type="radio" name="responden" id="pasien" value="pasien" {{ old('responden') == 'pasien' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="pasien">Pasien</label>
                                </div>
                                <div class="form-check mx-4">
                                    <input class="form-check-input @error('responden') is-invalid @enderror" type="radio" name="responden" id="pengunjung" value="pengunjung" {{ old('responden') == 'pengunjung' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="pengunjung">Pengunjung</label>
                                </div>
                                @error('responden')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="fw-bolder fs-6" for="kepuasan">Kepuasan Rumah Sakit</label>
                            <div class="d-flex justify-content-center" style="width: auto">
                                <div class="row text-center">
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji1.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Sangat tidak puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('kepuasan') is-invalid @enderror" type="radio" name="kepuasan" id="sobad" value="0" {{ old('kepuasan') == '0' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji2.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Tidak puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('kepuasan') is-invalid @enderror" type="radio" name="kepuasan" id="bad" value="1" {{ old('kepuasan') == '1' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji3.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('kepuasan') is-invalid @enderror" type="radio" name="kepuasan" id="good" value="2" {{ old('kepuasan') == '2' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji4.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Sangat puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('kepuasan') is-invalid @enderror" type="radio" name="kepuasan" id="great" value="3" {{ old('kepuasan') == '3' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                </div>
                                @error('kepuasan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="fw-bolder fs-6" for="profesional">Profesionalisme dan Keterampilan Petugas</label>
                            <div class="d-flex justify-content-center" style="width: auto">
                                <div class="row text-center">
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji1.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Sangat tidak puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('profesional') is-invalid @enderror" type="radio" name="profesional" id="sobad" value="0" {{ old('profesional') == '0' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji2.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Tidak puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('profesional') is-invalid @enderror" type="radio" name="profesional" id="bad" value="1" {{ old('profesional') == '1' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji3.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('profesional') is-invalid @enderror" type="radio" name="profesional" id="good" value="2" {{ old('profesional') == '2' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji4.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Sangat puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('profesional') is-invalid @enderror" type="radio" name="profesional" id="great" value="3" {{ old('profesional') == '3' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                </div>
                                @error('profesional')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="fw-bolder fs-6" for="fasilitas"> Fasilitas (Sarana dan Prasarana)</label>
                            <div class="d-flex justify-content-center" style="width: auto">
                                <div class="row text-center">
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji1.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Sangat tidak puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">`
                                                <input class="form-check-input @error('fasilitas') is-invalid @enderror" type="radio" name="fasilitas" id="sobad" value="0" {{ old('fasilitas') == '0' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji2.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Tidak puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('fasilitas') is-invalid @enderror" type="radio" name="fasilitas" id="bad" value="1" {{ old('fasilitas') == '1' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji3.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('fasilitas') is-invalid @enderror" type="radio" name="fasilitas" id="good" value="2" {{ old('fasilitas') == '2' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji4.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Sangat puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('fasilitas') is-invalid @enderror" type="radio" name="fasilitas" id="great" value="3" {{ old('fasilitas') == '3' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                </div>
                                @error('fasilitas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="fw-bolder fs-6" for="waktu">Ketepatan Waktu Layanan</label>
                            <div class="d-flex justify-content-center" style="width: auto">
                                <div class="row text-center">
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji1.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Sangat tidak puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('waktu') is-invalid @enderror" type="radio" name="waktu" id="sobad" value="0" {{ old('waktu') == '0' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji2.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Tidak puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('waktu') is-invalid @enderror" type="radio" name="waktu" id="bad" value="1" {{ old('waktu') == '1' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji3.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('waktu') is-invalid @enderror" type="radio" name="waktu" id="good" value="2" {{ old('waktu') == '2' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji4.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Sangat puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('waktu') is-invalid @enderror" type="radio" name="waktu" id="great" value="3" {{ old('waktu') == '3' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                </div>
                                @error('waktu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="fw-bolder fs-6" for="biaya">Kesesuaian Biaya Layanan dengan Manfaat yang Dirasakan</label>
                            <div class="d-flex justify-content-center" style="width: auto">
                                <div class="row text-center">
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji1.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Sangat tidak puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('biaya') is-invalid @enderror" type="radio" name="biaya" id="sobad" value="0" {{ old('biaya') == '0' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji2.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Tidak puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('biaya') is-invalid @enderror" type="radio" name="biaya" id="bad" value="1" {{ old('biaya') == '1' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji3.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('biaya') is-invalid @enderror" type="radio" name="biaya" id="good" value="2" {{ old('biaya') == '2' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                    <div class="col-3 p-5">
                                            <div class="card border border-0 rounded-4 shadow p-3" style="width:125px; height:135px">
                                                <img src="{{ asset('') }}frontend/assets/img/emoji4.png"
                                                class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 50px; height:50px">
                                                <p class="mt-3" style="color:black; font-size:12px">Sangat puas</p>
                                            </div>
                                            <div style="display: flex; justify-content: center;" class="mt-4">
                                                <input class="form-check-input @error('biaya') is-invalid @enderror" type="radio" name="biaya" id="great" value="3" {{ old('biaya') == '3' ? 'checked' : '' }} required>
                                            </div>
                                    </div>
                                </div>
                                @error('biaya')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="300">
                                <div class="mb-3">
                                    <label for="layanan" class="form-label">Jenis Pelayanan</label>
                                    <select class="form-select shadow @error('layanan') is-invalid @enderror" required name="layanan">
                                        <option selected>Pilih Pelayanan</option>
                                        @foreach ($layanan as $item)
                                            <option value="{{ $item}}" {{ old('layanan') == $item ? 'selected' : '' }}>E-{{ ucfirst($item) }}</option>
                                        @endforeach
                                        {{-- <option value="ambulan" {{ old('layanan') == 'ambulan' ? 'selected' : '' }}>E-Ambulance</option>
                                        <option value="konsultasi" {{ old('layanan') == 'konsultasi' ? 'selected' : '' }}>E-Konsultasi</option>
                                        <option value="apotek" {{ old('layanan') == 'apotek' ? 'selected' : '' }}>E-Apotek</option> --}}
                                    </select>
                                    @error('layanan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="nama" class="form-label">Nama pasien</label>
                                    <input type="text" name="nama" value="{{ Session::get('nama')?? old('nama') }}" class="form-control shadow @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama Anda"  {{ Session::get('nama') ? 'readonly' : 'required' }}>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="no_hp" class="form-label">Nomor HP</label>
                                    <input type="number" name="no_hp" value="{{ Session::get('phone') ?? old('no_hp')}}" class="form-control shadow @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="Masukkan Nomor Anda (08xxxxxxxxxx)" {{ Session::get('phone') ? 'readonly' : 'required' }}>
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
                                <div>
                                    <label for="feedback" class="form-label">Kritik dan Saran</label>
                                    <textarea class="form-control shadow @error('feedback') is-invalid @enderror" id="feedback" name="feedback" rows="9" cols="100" placeholder="Isikan Kritik dan Saran Anda" required>{{ old('feedback') }}</textarea>
                                </div>
                                @error('feedback')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end p-1 mt-5">
                                <button type="submit" class="btn btn-lg btn-primary text-center" style="background-color: #37517E; border:0; border-radius:20px"><span class="p-4" style="font-size: 16px">Submit</span></button>
                            </div>
                        </div>
                    </form>
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
            </div>
        </section>
        <!-- End Contact Section -->
@endsection
