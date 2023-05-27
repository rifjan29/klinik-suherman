@extends('layouts.template')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <style>
        .disabled{
            background-color:#b4b4b4;
            border:0;
            border-radius:10px;
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
        .bg-primary{
            background-color: #CEDEF6 !important;
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
        .bootstrap-select.form-control{
            border:  1px solid #b4b4b428;
        }
    </style>
@endpush
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#selectpicker').selectpicker();
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, "").toString(),
                    split = number_string.split(","),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }

                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                return prefix == undefined ? rupiah : rupiah ? rupiah : "";
            }
            var id;
            $('.detailDokter').on('click',function() {
                id = $(this).data('id');
                detail(id);
            })

            // $('#hubungi').on('click')
            $('#pembayaran-close').on('click',function() {
                $('.modal').modal('hide') // closes all active pop ups.
                $('.modal-backdrop').remove() // removes the grey overlay.
            })
            // $('.modal').modal('hide');
            $(document).on('keyup', '#query', function(){
                var query = $('#query').val();
                fetch_data(query);

            });
        })
        function detail(id) {
            $.ajax({
                url:`{{ route('e-konsultasi.detail') }}`,
                data:{
                    id:id
                },
                success: function(data) {
                    $('#rating').text(data.suka);
                    var nominal = Intl.NumberFormat('id-ID',
                        { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }
                    ).format(data.data.nominal)
                    var img = `{{ asset('') }}img/dokter/${data.data.foto}`
                    $('#dokter').attr("src", `${img}`);
                    $('#total_bayar').text(nominal);
                    $('#total_pesanan').text(nominal);
                    $('#id_dokter').val(data.data.id);
                    $('#total_nominal').val(data.data.nominal);
                    $.map(data,function(i) {
                        $('#nama').text(i.nama_dokter)
                        $('#spesialis').text(i.spesialis)
                        $('#mulai_dari').text(i.mulai_dari)
                        $('#akhir_dari').text(i.akhir_dari)
                    })
                }
            })
        }
        function fetch_data(query)
        {
            if(query === undefined){
                query = "";
            }
            $.ajax({
                url:"/pelayanan/e-konsultasi/beranda?query="+query,
                success:function(data)
                {
                    $('.row').html('');
                    $('.row').html(data);
                }
            })
        }
    </script>
    <script>



    </script>
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
            <div class="search">

                <div class="input-group mb-3 form-group has-search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Masukkan kata kunci" name="query" id="query" aria-label="Recipient's username" aria-describedby="button-addon2">
                </div>
            </div>
            <p style="color: #b4b4b4;"><span style="color: red;">*</span>Konsultasi online hanya dapat dilakukan dengan dokter gigi dan dokter umum</p>
            <div class="mt-4 bg-primary rounded" style="height:500px; width:auto; overflow:auto; padding:1%;">
                <div class="row">
                    @include('layouts.frontend.konsultasi.daftar-dokter')
                </div>
            </div>
        </div>
    </section>
    <!-- End konsultasi Section -->


    <!-- Start Modal -->

    <!-- Start Modal Dokter -->
    <div class="modal fade" id="exampleModalToggle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #37517e">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel" style="color: white;">Konsultasi Dokter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 mx-2">
                <div class="row">
                    <div class="col-md-4 text-center mt-3">
                        <img src="{{ asset('') }}frontend/assets/img/dokter1.png" id="dokter" alt="" class="rounded-circle" style="width: 100px; height:100px;">
                        <div class="mt-3">
                            <i class="fa-solid fa-thumbs-up fa-lg" style="color: #a8a8a8"></i>
                            <span style="color:#37517e; font-weight:bold;" id="rating">0</span>
                        </div>
                    </div>
                    <div class="col-md-8 p-3 mt-3">
                        <div class="mt-2">
                            <i class="fa-solid fa-user-doctor fa-2xl" style="color: #a8a8a8"></i>
                            <span class="fw-bold mx-3" style="color: #37517e" id="nama"></span>
                        </div>
                        <div class="ket mt-4">
                            <span style="color: #808080; font-size:14px;" id="spesialis">Spesialis Umum</span><br>
                        </div>
                    </div>
                    <p class="mt-4 fw-bold" style="font-size: 14px;">Jadwal Kerja</p>
                    <div class="col-md-12">
                        <div class="card text-center" style="border-color: #37517e">
                            <div class="card-body" style="heigth: 50%;">
                                <span style="color:#37517e; font-size:14px;">Senin-Sabtu</span><br>
                                <span style="color:#37517e; font-size:14px;" ><span id="mulai_dari">00:00</span> - <span id="akhir_dari">00:00</span> </span>
                            </div>
                        </div>
                    </div>

                    <p class="mt-4 fw-bold" style="font-size: 14px;">Detail Layanan</p>
                    <div class="col-md-6">
                        <div class="text-center">
                            <span style="color: #808080; font-size:14px;">Tipe Konsultasi</span><br>
                            <span style="color:#37517e; font-size:14px; font-weight:bold;">Konsultasi Via Chat</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center">
                            <span style="color: #808080; font-size:14px;">Durasi</span><br>
                            <span style="color:#37517e; font-size:14px; font-weight:bold;">24 Jam</span>
                        </div>
                    </div>
                    <p class="mt-4 fw-bold" style="font-size: 14px;">Harga Mulai Dari</p>
                    <p style="font-weight: bold; color:#F4A223; font-size:25px;" id="nominal"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="hubungi" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Hubungi via Chat</button>
            </div>
            </div>
        </div>
    </div>
    <!-- End Modal Dokter -->

    <!-- Start Modal Pembayaran-->
    <div class="modal fade" id="exampleModalToggle2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #37517e">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel" style="color: white;">Metode Pembayaran</h1>
                    <button type="button" class="btn-close " id="pembayaran-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card mt-4" style="background-color:#CEDEF6">
                        <div class="card-body">
                            <img style="width: 30px; height:30px;" src="{{ asset('') }}frontend/assets/img/lamp.png">
                            <span class="fw-light align-middle mx-2" style="font-size: 14px">Yuk selesaikan pembayaran. Pastikan pesananmu sudah sesuai ya!</span>
                        </div>
                    </div>
                    <form action="{{ route('pembayaran.post') }}" method="POST">
                    @csrf
                    <input type="text" name="id_dokter" id="id_dokter" readonly hidden>
                    <input type="text" name="id_pasien_konsultasi" id="id_pasien_konsultasi" readonly value="{{ Session::get('id') }}" hidden>
                    <input type="text" name="total_nominal" id="total_nominal" readonly hidden>
                    <div class="mt-4 mb-4">
                        <label class="fw-bold fs-6" for="">Pilih Metode Pembayaran</label>
                        <select class="form-control mt-2" aria-label="Default select example" id="selectpicker" name="bank">
                            @forelse ($bank as $item)
                                <option value="{{ $item->id }}" data-thumbnail="{{ $item->foto != null ? asset('img/bank/'.$item->foto) : asset('backend/assets/imgs/theme/upload.svg') }}">{{ $item->nama_bank }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="mt-4 mb-5">
                        <h5 class="fw-bold mb-4">Ringkasan Pemesanan</h5>
                        <div class="d-flex mb-3">
                            <div class="fs-6 fw-bold">Total Pesanan</div>
                            <div class="ms-auto fw-6"><span id="total_pesanan">Rp.0</span></div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="fs-6 fw-bold">Biaya Layanan</div>
                            <div class="ms-auto fw-6"><span>Rp. </span> 0</div>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4 mb-5">
                        <div class="d-flex mb-3">
                            <div class="fs-6 fw-bold">Total Pembayaran</div>
                            <div class="ms-auto fw-bold fs-3" style="color:#F4A223;" id="total_bayar">Rp. 0</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Bayar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Pembayaran -->

    <!-- End Modal -->

@endsection
