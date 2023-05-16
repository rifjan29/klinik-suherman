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

        .search {
            width: 65%;
            margin: 35px auto;
        } 
        
        .has-search .form-control {
            padding-left: 3rem;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 50px;
            height: 50px;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #37517e;
            margin-top: 10px;
        }

        .card-header .img-dokter {
            width: 4rem;
            margin-bottom: 10px;
        }

        .massage-pasien {
            background-color: #CDF4D8;
        }

        .massage-dokter {
            background-color: white;
        }
    </style>
@endpush
@section('hero')
    <section id="hero" class="d-flex align-items-center">
    </section>
@endsection
@section('content')
     <!-- ======= konsultasi Section ======= -->
     <section id="services" class="services">
        <div class="container text-center" data-aos="fade-up">
            <div class="section-title">
                <h2>E-Konsultasi</h2>
            </div>
            <div class="card mt-3 shadow">
                <div class="card-header shadow">
                    <div class="row">
                        <div class="py-2 px-4 d-none d-lg-block">
                            <div class="d-flex align-items-center py-1">
                                <div class="position-relative">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="50" height="50">
                                </div>
                                <div class="flex-grow-1 pl-3 text-start mx-3">
                                    <strong>Dr. Lorem Ipsum</strong>
                                    <div class="text-muted small"><i class="fa-solid fa-circle fa-2xs" style="color: #1DEA4A;"></i><em> Online</em></div>
                                </div>
                                <div>
                                    <button class="btn btn-danger btn-sm mr-1 px-3">Keluar Chat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body-content" style="height:500px; width:auto; overflow:auto; padding:3%; background-color: #EFEFEF;">
                    <div class="content-message">
                        <div class="d-flex flex-row-reverse mb-3">
                            <div class="massage-pasien card border-0 shadow">
                                <div class="card-body">
                                    <div class="text-end">
                                        This is some text within a card body.
                                        This is some text within a card body. 
                                        This is some text within a card body. 
                                        This is some text within a card body. 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3">
                            <div class="massage-dokter card border-0 shadow">
                                <div class="card-body">
                                    <div class="text-start">
                                        This is some text within a card body.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse mb-3">
                            <div class="massage-pasien card border-0 shadow">
                                <div class="card-body">
                                    <div class="text-end">
                                        This is some text within a card body.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse mb-3">
                            <div class="massage-pasien card border-0 shadow">
                                <div class="card-body">
                                    <div class="text-end">
                                        This is some text within a card body.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3">
                            <div class="massage-dokter card border-0 shadow">
                                <div class="card-body">
                                    <div class="text-start">
                                        This is some text within a card body.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3">
                            <div class="massage-dokter card border-0 shadow">
                                <div class="card-body">
                                    <div class="text-start">
                                        This is some text within a card body.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse mb-3">
                            <div class="massage-pasien card border-0 shadow">
                                <div class="card-body">
                                    <div class="text-start">
                                        This is some text within a card body.
                                        This is some text within a card body.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3">
                            <div class="massage-dokter card border-0 shadow">
                                <div class="card-body">
                                    <div class="text-start">
                                        This is some text within a card body.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="flex-grow-0 py-3 px-4">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Ketik Pesan.......">
							<button class="btn btn-primary">Kirim</button>
						</div>
					</div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- End konsultasi Section -->
@endsection
