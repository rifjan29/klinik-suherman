@extends('layouts.template')
@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

    <style>
        .form-wizard{
            display: none;
        }
        .form-wizard.active{
            display: block;
        }
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
     <style>
            .select2-container--default .select2-selection--single {
                border-radius: 0.35rem !important;
                border: 1px solid #d1d3e2;
                height: calc(1.95rem + 5px);
                background: #fff;
            }

            .select2-container--default .select2-selection--single:hover,
            .select2-container--default .select2-selection--single:focus,
            .select2-container--default .select2-selection--single.active {
                box-shadow: none;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 32px;

            }

            .select2-container--default .select2-selection--multiple {
                border-color: #eaeaea;
                border-radius: 0;
            }

            .select2-dropdown {
                border-radius: 0;
            }

            .select2-container--default .select2-results__option--highlighted[aria-selected] {
                /* background-color: #3838eb; */
            }

            .select2-container--default.select2-container--focus .select2-selection--multiple {
                border-color: #eaeaea;
                background: #fff;

            }
        </style>
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script>


        function onChangeSelect(url, id, name) {
        // send ajax request to get the cities of the selected province and append to the select tag
            $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $('#' + name).empty();
                        $('#' + name).append('<option> -- Pilih Salah Satu -- </option>');
                        $.each(data, function (key, value) {
                            $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
            });
        }
        $(function () {
            $('#provinsi').select2({
                theme: 'bootstrap-5'
            });
            $('#provinsi').on('change', function () {

                onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
            });
            $('#kota').select2({
                theme: 'bootstrap-5'
            });
            $('#kota').on('change', function () {
                onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
            })
            $('#kecamatan').select2({
                theme: 'bootstrap-5'
            });
            $('#kecamatan').on('change', function () {
                onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
            })
        });
    </script>
    <script>
        if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            // console.log(latitude);/
            document.getElementById("latitude").value = latitude;
            document.getElementById("longitude").value = longitude;
        });
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
        function cek(param) {
            $.ajax({
                    url: '{{ route('e-ambulance.cek') }}',
                    type: 'GET',
                    data: {
                        tgl: param
                    },
                    success:function(data){
                        if (data.data == true) {
                            $(".btn-next").show();
                            $('.btn-next').removeAttr('disabled','disabled');
                        } else {
                            console.log(data);
                            $(`<p>${data.message}</p>`).appendTo('#message');
                            $("#message").show();
                            setTimeout(function() { $("#message").hide(); }, 5000);

                            $('.btn-next').attr('disabled','disabled');

                        }

                    }
            });
        }
        $('#tgl').on('change',function() {
            var tgl = $(this).val();
            cek(tgl);
        })
        $(document).ready(function() {
            $(".btn-next").show();

            var jumlahData = $('#jumlahData').val();
            function cekBtn() {
                var indexNow = $(".form-wizard.active").data('index');
                var prev = parseInt(indexNow) - 1
                var next = parseInt(indexNow) + 1

                $(".btn-prev").hide()
                $(".btn-simpan").hide()

                if ($(".form-wizard[data-index='" + prev + "']").length == 1) {
                    $(".btn-prev").show()
                }
                if (parseInt(indexNow) == parseInt(jumlahData)) {
                    // $(".btn-next").click(function(e) {
                    //     if (parseInt(indexNow) != parseInt(jumlahData)) {
                    //         $(".btn-next").show()

                    //     }
                    // $(".btn-simpan").show()
                    // $(".progress").prop('disabled', false);
                    $(".btn-simpan").show()
                    $(".btn-next").hide()
                        // });
                        // $(".btn-next").show()

                } else {
                    $(".btn-next").show()
                    $(".btn-simpan").hide()

                }
            }
            cekBtn()
            $(".btn-next").click(function(e) {
                e.preventDefault();
                // cek();
                var indexNow = $(".form-wizard.active").data('index')

                var next = parseInt(indexNow) + 1
                    // console.log($(".form-wizard[data-index='"+next+"']").length==1);
                    // console.log($(".form-wizard[data-index='"+  +"']"));
                if ($(".form-wizard[data-index='" + next + "']").length == 1) {
                    // console.log(indexNow);
                    $(".form-wizard").removeClass('active')
                    $(".form-wizard[data-index='" + next + "']").addClass('active')
                    $(".form-wizard[data-index='" + indexNow + "']").attr('data-done', 'true')
                }

                cekBtn(true)
            })

            $(".btn-prev").click(function(e) {
                event.preventDefault(e);
                var indexNow = $(".form-wizard.active").data('index')
                var prev = parseInt(indexNow) - 1
                if ($(".form-wizard[data-index='" + prev + "']").length == 1) {
                    $(".form-wizard").removeClass('active')
                    $(".form-wizard[data-index='" + prev + "']").addClass('active')
                }
                cekBtn()
                e.preventDefault();
            })
        });
    </script>
    <script>
        $(function() {
            $('input[name="jam_kerja"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: true,
                startDate:  moment().startOf('hour').add(32, 'hour')    ,
                locale: {
                    format: 'DD-MM-Y hh:mm:ss'
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
         <input type="text" id="jumlahData" name="jumlahData" hidden value="2">
        <div class="container form-wizard active" data-aos="fade-up" data-index='1' data-done='true' data-done='true'">
            <div class="section-title">
                <h2>Pesan Ambulance</h2>
            </div>
            <form action="{{ route('e-ambulance.store') }}" method="POST"  enctype="multipart/form-data">
             @csrf
            <div class="row content">
                <div class="col-md-12">
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Nama Pasien/Pemesan</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control l @error('nama_pasien') is-invalid @enderror" name="nama_pasien" value="{{ old('nama_pasien') }}" placeholder="Masukkan nama pasien" id="inputPassword">
                          <div class="invalid-feedback">
                            @error('nama_pasien')
                                <div class="invalid-feedback">
                                    {{$message}}.
                                </div>
                            @enderror
                          </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Nomor HP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" placeholder="Masukkan no hp" id="inputPassword">
                            @error('no_hp')
                                <div class="invalid-feedback">
                                    {{$message}}.
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Tanggal Pemesanan</label>
                        <div class="col-sm-9">
                            <input type="text" name="jam_kerja" id="tgl" value="{{ old('jam_kerja') }}" class="form-control @error('jam_kerja') is-invalid @enderror"/>
                            @error('jam_kerja')
                                <div class="invalid-feedback">
                                    {{$message}}.
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Foto Kejadian  <small class="text-muted">Wajib</small></label>
                        <div class="col-sm-9">
                          <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" placeholder="Masukkan no hp" id="inputPassword">
                          @error('foto')
                            <div class="invalid-feedback">
                                {{$message}}.
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea name="keteranagan" id="" cols="30" rows="10" class="form-control @error('keterangan') is-invalid @enderror" placeholder="keterangan"></textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{$message}}.
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container form-wizard" data-aos="fade-up" data-index='2' data-done='true' data-done='true'>
            <div class="section-title">
                <h2>Lokasi Penjemputan</h2>
            </div>
            <div class="row content">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="provinsi">Provinsi</label>
                                <div class="">
                                    @php
                                        $provinces = new App\Http\Controllers\WilayaIndonesiaDropdownController;
                                        $provinces= $provinces->provinces();
                                    @endphp
                                    <select class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" id="provinsi" required>
                                        <option>--Pilih Salah Satu--</option>
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi')
                                        <small class="text-small text-danger">
                                            {{$message}}.
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="kota">Kabupaten / Kota</label>
                                <div class="">
                                    <select class="form-control @error('kota') is-invalid @enderror" name="kota" id="kota" required>
                                        <option>--Pilih Salah Satu--</option>
                                    </select>
                                    @error('kota')
                                        <small class="text-small text-danger">
                                            {{$message}}.
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="kecamatan">Kecamatan</label>
                                <div class="">
                                    <select class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" required>
                                        <option>--Pilih Salah Satu--</option>
                                    </select>
                                    @error('kecamatan')
                                        <small class="text-small text-danger">
                                            {{$message}}.
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="desa">Desa</label>
                                <div class="">
                                    <select class="form-control @error('desa') is-invalid @enderror" name="desa" id="desa" required>
                                        <option>--Pilih Salah Satu--</option>
                                    </select>
                                    @error('desa')
                                        <small class="text-small text-danger">
                                            {{$message}}.
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="form-label">Alamat</label>
                            <textarea name="alamat" id="" cols="30" rows="10" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat detail"></textarea>
                            @error('alamat')
                                <small class="text-small text-danger">
                                    {{$message}}.
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3" hidden>
                            <div class="form-group">
                                <label for="longitude" class="ml-1">Longitude :</label>
                                {{-- <p id="labelLongitude">-</p> --}}
                                <input type="text" id="longitude" class="form-control longitude  @error('longitude') is-invalid @enderror" name="longitude" placeholder="longitude..." value="{{old('longitude',)}}" readonly>

                            </div>
                        </div>
                        <div class="col-md-6 mt-3" hidden>
                            <div class="form-group">
                                <label for="latitude" class="ml-1">Latitude :</label>
                                {{-- <p id="labelLatitude">-</p> --}}
                                <input type="text" id="latitude" class="form-control latitude  @error('latitude') is-invalid @enderror" name="latitude" placeholder="Latitude..." value="{{old('latitude',)}}" readonly>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container">
            <div class="d-flex justify-content-center mt-5">
                <div>
                    <button class="btn btn-default btn-prev"><span class="fa fa-chevron-left"></span> Sebelumnya</button>
                    <button class="btn btn-primary btn-next">Next <span class="fa fa-chevron-right"></span></button>
                    <button type="submit" class="btn btn-primary btn-simpan" id="submit">Simpan <span
                            class="fa fa-save"></span></button>
                    </form>

                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <div style=
                    "
                        font-style: normal;
                        font-weight: 700;
                        font-size: 20px;
                        color: rgba(29, 40, 137, 0.92);
                    " id="message">

                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->
@endsection
