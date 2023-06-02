@extends('layouts.template')

@section('hero')
    <div style="background-color: #37517e; height: 135px;"></div>
@endsection
@section('content')
<section id="about" class="about">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-title">
            <h2>Pelayanan Penunjang</h2>
        </div>
        <div class="row content mt-4">
            <div class="col-lg-12">
                <p class="mb-4">
                    Rawat inap di  Klinik dr  Suherman dilengkapi dengan sarana dan fasilitas lengkap guna memberikan pelayanan terbaik demi kepuasan pasien. Di klinik rawat inap dr. Suherman tersedia pelayanan penunjang untuk mendukung kenyamanan pasien yang membutuhkan pelayanan
                    tambahan dalam menunjang diagnosis dokter.Adapun beberapa pelayanan penunjang tersebut mencakup:
                </p>
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                <span style="font-size: 18px; font-weight: bold; color:#37517e">Ruang Laktasi</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <p class="mt-2"><b>Ruang Laktasi : </b> ruangan khusus yang dirancang untuk ibu menyusui atau memompa ASI (Air Susu Ibu) dengan suasana yang nyaman, tertutup, dan aman</p>
                                <div class="row d-flex justify-content-start ">
                                    <div class="col-md-4">
                                        <img src="{{ asset('frontend/assets/img/laktasi room 1.png') }}" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                <span style="font-size: 18px; font-weight: bold; color:#37517e">Ruang Tindakan</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body">
                                <p class="mt-2">
                                    <b>Ruang Tindakan :</b>
                                   ruangan pada fasilitas kesehatan yang digunakan untuk melakukan tindakan medis atau prosedur medis. Ruang ini dirancang dengan peralatan dan fasilitas khusus untuk mendukung berbagai jenis tindakan atau prosedur yang mungkin dilakukan.
                                </p>
                                <div class="row d-flex justify-content-start">
                                    <div class="col-md-4">
                                        <img src="{{ asset('frontend/assets/img/ruang-tindakan.png') }}" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                <span style="font-size: 18px; font-weight: bold; color:#37517e">Laboratorium </span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                <p class="mt-2">
                                    <b>Laboratorium :</b> Laboratorium pada klinik adalah fasilitas di mana dilakukan berbagai jenis uji laboratorium untuk mendiagnosis, memantau, atau mengevaluasi kondisi kesehatan pasien.
                                </p>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-4">
                                        <img src="{{ asset('frontend/assets/img/lab.png') }}" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
