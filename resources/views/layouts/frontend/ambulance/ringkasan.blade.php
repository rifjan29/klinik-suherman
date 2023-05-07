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
    </style>
@endpush
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script>
        var id_transaksi = $('#id').val();
        test('{{ route('e-ambulance.status') }}',id_transaksi)
        function test(url,id) {
                var status_kejadian = $('#status_kejadian').val();
                if (status_kejadian == '0') {
                    $('#pending').show();
                    $('#diterima').hide();
                    $('#ditolak').hide();
                }else if(status_kejadian == '1'){
                    $('#pending').hide();
                    $('#diterima').show();
                    $('#ditolak').hide();
                }else{
                    $('#pending').hide();
                    $('#diterima').hide();
                    $('#ditolak').show();
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
                            console.log(typeof(data));
                            if (data == '0') {
                                $('#pending').show();
                                $('#diterima').hide();
                                $('#ditolak').hide();
                            }else if(data == '1'){
                                $('#pending').hide();
                                $('#diterima').show();
                                $('#ditolak').hide();
                            }else{
                                $('#pending').hide();
                                $('#diterima').hide();
                                $('#ditolak').show();
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
        <div class="container" data-aos="fade-up">
            <div class="section-title text-center">
                <h2>Ringkasan Pemesanan</h2>
            </div>
            <div class="p-4">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" name="" id="id" value="{{ $data->id }}" hidden>
                        <input type="text" name="" id="status_kejadian" value="{{ $data->status_kendaraan }}" hidden>
                        <h6>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('l,d F Y') }}</h6>
                        <p class="mb-2 fw-bold">Nama : {{ ucwords($data->nama_wali) }}</p>
                        <p class="fw-bold">No. HP : {{ $data->no_hp }}</p>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end align-self-center">
                        <div id="pending">
                            <h5>Status : <span class="badge bg-warning">Sedang Proses</span></h5>
                            <small class="text-muted" style="font-size: 11px;">Silakan cek secara berkala untuk melihat pembaruan status pemesanan Anda</small>
                        </div>
                        <div id="diterima">
                            <h5>Status : <span class="badge bg-success">Diterima dengan tanggal jemput : </span></h5>
                            <a class="btn btn-primary w-100" href="{{ route('e-ambulance.pembayaran',$data->id) }}"> Cetak Pembayaran</a>
                        </div>
                        <div id="ditolak">
                            <h5>Status : <span class="badge bg-danger">Ditolak</span></h5>
                        </div>

                    </div>
                </div>
                <div class="mt-4">
                    <table class="table table-bordered" style="border-color: black">
                        <thead>
                            <tr class="text-center">
                              <th class="p-5">Tanggal Pemesanan</th>
                              <th class="p-5">Lokasi Penjemputan</th>
                              <th class="p-5">Foto Kejadian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                {{-- <td class="p-5">20 Maret 2023 jam 12.00</td> --}}
                                <td class="p-5">{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y ') }} Jam {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('h:i:s A') }}</td>
                                @php

                                        $provinsi = \Indonesia::findProvince($data->id_provinsi)->first();
                                        $kota = \Indonesia::findCity($data->id_kota)->first();
                                        $kecamatan = \Indonesia::findDistrict($data->id_kecamatan)->first();
                                        $desa = \Indonesia::findVillage($data->id_desa)->first();
                                @endphp
                                <td class="p-5">{{ $data->alamat }}, {{ $provinsi->name }}, {{ $kota->name }}, {{ $kecamatan->name }}, {{ $desa->name }}</td>
                                <td class="p-5">
                                    <div class="input-upload">
                                        <img class="img-fluid" src="{{ $data->foto_kejadian != null ? asset('img/foto-kejadian/'.$data->foto_kejadian) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                              <td class="p-5" colspan="3">
                                <p class="fw-bold">Keterangan :</p>
                                <p>{{ $data->keadaan }}</p>
                              </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-5 fw-bold">
                    <h5 style="color: #37517e">Silakan cek secara berkala untuk melihat pembaruan status pemesanan Anda</h5>
                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->
@endsection
