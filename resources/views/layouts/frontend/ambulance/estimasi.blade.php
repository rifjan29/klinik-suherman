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
        .card.active{
            background-color:#37517e;
        }
        .card{
            background-color:#c9cacc;
        }
    </style>
@endpush
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script>
        var id_transaksi = $('#id').val();
        test('{{ route('e-ambulance.status-estimasi') }}',id_transaksi)
        function test(url,id) {
                var status_kejadian = $('#status_kejadian').val();
                if (status_kejadian == '0') {
                    $(".diterima").addClass('active')
                }else if(status_kejadian == '1'){
                    $(".diterima").addClass('active')
                    $(".menuju").addClass('active')
                }else if(status_kejadian == '2'){
                    $(".diterima").addClass('active')
                    $(".menuju").addClass('active')
                    $(".tiba").addClass('active')
                }else if(status_kejadian == '3'){
                    $(".diterima").addClass('active')
                    $(".menuju").addClass('active')
                    $(".tiba").addClass('active')
                    $(".dibayar").addClass('active')
                }else if(status_kejadian == '4'){
                    $(".diterima").addClass('active')
                    $(".menuju").addClass('active')
                    $(".tiba").addClass('active')
                    $(".dibayar").addClass('active')
                    $(".selesai").addClass('active')
                }
                setInterval(function()
                {
                    $.ajax({
                        url: url,
                        type:"GET",
                        data: {
                            id: id
                        },
                        success:function(data)
                        {
                            if (data == '0') {
                                $(".diterima").addClass('active')
                            }else if(data == '1'){
                                $(".menuju").addClass('active')
                            }else if(data == '2'){
                                $(".tiba").addClass('active')
                            }else if(data == '3'){
                                $(".dibayar").addClass('active')
                            }else if(data == '4'){
                                $(".selesai").addClass('active')
                            }
                        }
                    });
                }, 5000);//time in milliseconds
        }
    </script>
@endpush
@section('hero')
    <section id="hero" class="d-flex align-items-center">
    </section>
@endsection
@section('content')
     <!-- ======= ambulance Section ======= -->
     <section id="services" class="services">
        <div class="container text-center" data-aos="fade-up" style="height: 100%; width:100%">
            <div class="section-title">
                <h2>Estimasi Perjalanan Ambulance</h2>
            </div>
            <input type="text" name="" id="id" value="{{ $data->id }}" hidden>
            <input type="text" name="" id="status_kejadian" value="{{ $data->status_perjalanan }}" hidden>
            <div class="d-flex justify-content-between my-5 mb-5 p-3 align-middle" style="margin-button:40%;">
                <div>
                    <div class="card border border-0 rounded-4 shadow p-3 mx-5 diterima active" style="width:130px; height:110px;">
                        <img src="{{ asset('') }}frontend/assets/img/estimasi1.png"
                        class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 60px; height:60px">
                    </div>
                    <p class="mt-5 fw-bold" style="color:black; font-size:15px;">Pesanan Diterima</p>
                </div>
                <div>
                    <div class="card border border-0 rounded-4 shadow p-3 mx-5 text-center menuju" style="width:130px; height:110px;">
                        <img src="{{ asset('') }}frontend/assets/img/estimasi2.png"
                        class="rounded mx-auto d-block mt-3" alt="GFG" style="width: 70px; height:50px">
                    </div>
                    <p class="mt-5 fw-bold" style="color:black; font-size:15px;">Ambulance Menuju Lokasi</p>
                </div>
                <div>
                    <div class="card border border-0 rounded-4 shadow p-3 mx-5 tiba" style="width:130px; height:110px;">
                        <img src="{{ asset('') }}frontend/assets/img/estimasi3.png"
                        class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 71px; height:73px">
                    </div>
                    <p class="mt-5 fw-bold" style="color:black; font-size:15px;">Ambulance Tiba di Lokasi</p>
                </div>
                <div>
                    <div class="card border border-0 rounded-4 shadow p-3 mx-5 dibayar" style="width:130px; height:110px;">
                        <img src="{{ asset('') }}frontend/assets/img/estimasi4.png"
                        class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 60px; height:60px">
                    </div>
                    <p class="mt-5 fw-bold" style="color:black; font-size:15px;">Pesanan Dibayarkan</p>
                </div>
                <div>
                    <div class="card border border-0 rounded-4 shadow p-3 mx-5 selesai" style="width:130px; height:110px;">
                        <img src="{{ asset('') }}frontend/assets/img/estimasi5.png"
                        class="rounded mx-auto d-block mt-2" alt="GFG" style="width: 60px; height:60px">
                    </div>
                    <p class="mt-5 fw-bold" style="color:black; font-size:15px;">Selesai</p>
                </div>
            </div>
            <a class="btn btn-primary btn-next mt-2 btn-lg" href="{{ route('e-ambulance.estimasi-selesai',$data->id) }}">Selesai</a>
        </div>
    </section>
    <!-- End ambulance Section -->
@endsection
