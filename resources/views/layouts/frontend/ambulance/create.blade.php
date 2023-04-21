@extends('layouts.template')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
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
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(function() {
            $('input[name="jam_kerja"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: true,
                locale: {
                        format: 'YY-MM-DD hh:mm:ss'
                    }
            });
        });

    </script>
@endpush
@section('hero')
    <section id="hero" class="d-flex align-items-center">
    </section>
@endsection
@section('content')
     <!-- ======= ambulance Section ======= -->
     <section id="services" class="services">
        <div class="container " data-aos="fade-up">
            <div class="section-title">
                <h2>Pesan Ambulance</h2>
            </div>
            <div class="row content">
                <div class="col-md-12">
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Nama Pasien/Pemesan</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="nama_pasien" placeholder="Masukkan nama pasien" id="inputPassword">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Nomor HP</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="no_hp" placeholder="Masukkan no hp" id="inputPassword">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Tanggal Pemesanan</label>
                        <div class="col-sm-9">
                                    <input type="text" name="jam_kerja" value="{{ old('jam_kerja') }}" class="form-control"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->
@endsection
