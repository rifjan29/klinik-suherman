@extends('layouts.template')

@section('hero')
    <div style="background-color: #37517e; height: 135px;"></div>
@endsection
@section('content')
<section id="about" class="about">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-title">
            <h2>Unit Gawat Darurat</h2>
        </div>
        <div class="row content mt-4">
            <div class="col-lg-12">
                <p class="mb-4">
                    Unit Gawat Darurat adalah salah satu unit dalam rumah sakit yang menyediakan penanganan awal pasien, sesuai dengan tingkat kegawatannya. Pada Klinik Rawat Inap dr Suherman, pelayanan instalasi gawat darurat melayani 24 jam dengan dokter jaga on site dan konsul dokter jaga spesialis on call. 
                    Adapun fasilitas dan layanan yang disediakan diantaranya :
                </p>
                <ol>
                    <li>A</li>
                    <li>B</li>
                    <li>C</li>
                    <li>dst</li>
                </ol>
                {{-- <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                <span style="font-size: 18px; font-weight: bold; color:#37517e">Kelas 1</span>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <p class="mt-2">Poliklinik umum merupakan salah satu layanan yang ada di Klinik dr. Suherman yang memberikan pelayanan kedokteran berupa pemeriksaan kesehatan, pengobatan dan komplikasi penyakit.</p>
                                <div class="row d-flex justify-content-center p-4 mx-5">
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/poli-umum1.jpeg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/poli-umum2.jpeg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/poli-umum3.jpeg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
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
                                <p class="mt-2">Poliklinik KIA merupakan salah satu layanan yang ada di Klinik dr. Suherman yang memberikan pelayanan di bidang kesehatan yang menyangkut pelayanan dan pemeliharaan ibu hamil, ibu menyusui, bayi dan anak balita serta anak prasekolah.</p>
                                <div class="row d-flex justify-content-center p-4 mx-5">
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/kia1.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/kia2.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/kia3.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
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
                                <p class="mt-2">Poliklinik KIA merupakan salah satu layanan yang ada di Klinik dr. Suherman yang memberikan pelayanan di bidang kesehatan yang menyangkut pelayanan dan pemeliharaan ibu hamil, ibu menyusui, bayi dan anak balita serta anak prasekolah.</p>
                                <div class="row d-flex justify-content-center p-4 mx-5">
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/gigi1.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/gigi2.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('') }}frontend/assets/img/gigi3.jpg" alt="" class="img-fluid shadow rounded-3" style="width: 100%; height:100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>
@endsection
