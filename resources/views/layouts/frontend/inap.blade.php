@extends('layouts.template')

@section('hero')
    <div style="background-color: #37517e; height: 135px;"></div>
@endsection
@section('content')
<section id="about" class="about">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-title">
            <h2>Instalasi Rawat Inap</h2>
        </div>
        <div class="row content mt-4">
            <div class="col-lg-12">
                <p class="mb-4">
                    Rawat inap di  Klinik dr  Suherman dilengkapi dengan sarana dan fasilitas lengkap guna memberikan pelayanan terbaik demi kepuasan pasien. Dalam klinik ini tersedia ruang rawat inap di Klinik dr Suherman untuk mendukung kenyamanan pasien yang membutuhkan fasilitas perawatan di Klinik. Fasilitas tersebut mencakup ruang rawat inap biasa dan ruang rawat inap bersalin. 
                    Pada instalasi rawat inap terdapat beberapa kelas perawatan :
                </p>
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                <span style="font-size: 18px; font-weight: bold; color:#37517e">Kelas 1</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <p class="mt-2"><span class="fw-bolder">Kelas 1 : </span> Peserta mendapat fasilitas ruang rawat inap dengan jumlah paling sedikit, yaitu 2-4 orang.</p>
                                <div class="row d-flex justify-content-start p-4 mx-5">
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/kelas1.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/poli-umum2.jpeg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/poli-umum3.jpeg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                <span style="font-size: 18px; font-weight: bold; color:#37517e">Kelas 2</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body">
                                <p class="mt-2"><span class="fw-bolder">Kelas 2 : </span> Peserta mendapat fasilitas ruang rawat inap dengan jumlah paling sedikit, yaitu 3-5 orang.</p>
                                <div class="row d-flex justify-content-start p-4 mx-5">
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/kelas2.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/kia2.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/kia3.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                <span style="font-size: 18px; font-weight: bold; color:#37517e">Kelas 3</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                <p class="mt-2"><span class="fw-bolder">Kelas 3 : </span> Peserta akan mendapat fasilitas ruang rawat inap dengan jumlah paling sedikit, yaitu 4-6 orang.</p>
                                <div class="row d-flex justify-content-start p-4 mx-5">
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/kelas3.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/gigi2.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/gigi3.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div> --}}
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
