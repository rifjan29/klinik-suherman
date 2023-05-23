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
        .card-dokter .card{
            border: 1px solid #000;
        }
        .card-dokter .card-header {
            border-bottom: 1px solid #000;
            background-color: #fff;
        }
        .card-header h4{
            color: #001D4F;
        }
        .bg-primary{
            background-color: #001D4F !important;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vertikal.css') }}">
@endpush
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

        })

    </script>
@endpush
@section('hero')
    <section id="hero" class="d-flex align-items-center">
    </section>
@endsection
@section('content')
     <!-- ======= ambulance Section ======= -->
     <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
            </div>
            <div class="row content">
                <div class="row justify-content-center my-5">
                    <div class="col-md-8 card-dokter">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="fw-bold text-center">Resep Dokter</h4>
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <p>Status Resep</p>
                                    </div>
                                    <div class="mx-2">
                                        <span class="badge bg-primary">Pending</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex flex-column">
                                            <div><p>Nama Dokter</p></div>
                                            <div><p>SIP</p></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div><p>dr. Erinne</p></div>
                                        <div><p>222/05.05/DPMTP/II/2018</p></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->

@endsection
