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
        $(document).ready(function() {

            var id_transaksi = $('#id_transaksi').val();
            $('#exampleModal').modal('show');

            test('{{ route('pembayaran.notifikasi.cek') }}',id_transaksi)
            function test(url,id) {
                    var status_kejadian = $('#status_kejadian').val();

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
                                console.log(data);
                                if (data == 'pending') {
                                    $('#exampleModal').modal('show');
                                }else if (data == 'lunas'){
                                    $('#exampleModalToggle1').modal('show');
                                    $('#exampleModal').modal('hide');
                                }else if (data == 'ditolak'){
                                    window.location = `{{ route('pembayaran.detail',['id' => $data->id]) }}`;
                                }

                            }
                        });
                    }, 5000);//time in milliseconds
            }
        });
    </script>
@endpush
@section('hero')
    <section id="hero" class="d-flex align-items-center">
    </section>
@endsection
@section('content')
    <!-- ======= ambulance Section ======= -->
    <!-- Modal -->
    {{-- pending --}}
    <div
        class="modal fade"
        id="exampleModal"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-5">
                <p class="fw-bold text-center"> Tunggu Pembayaran di Verifikasi!!</p>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    {{-- lunas --}}
    <div class="modal fade"
        id="exampleModalToggle1"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="p-4">
                        <div class="text-center">
                            <div class="mb-3">
                                <img style="width: 50px; height:50px;" src="{{ asset('') }}frontend/assets/img/succes.png">
                            </div>
                            <h4 class="fw-bold">Transaksi Berhasil</h4>
                            <div class="p-3 mt-3">
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Kode Transaksi</div>
                                    <div class="ms-auto">{{ $data->kode_pemesanan }}</div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Tanggal</div>
                                    <div class="ms-auto">{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d M Y - H:i:s') }} WIB</div>
                                </div>
                                <hr>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Jenis Transaksi</div>
                                    <div class="ms-auto">Transfer {{ $data->nama_bank }}</div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Bank Tujuan</div>
                                    <div class="ms-auto">Bank {{ $data->nama_bank }}</div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Nomor Tujuan</div>
                                    <div class="ms-auto">{{ $data->no_rekening }}</div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Nama Tujuan</div>
                                    <div class="ms-auto">Klinik Suherman</div>
                                </div>

                                <hr>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Nominal</div>
                                    <div class="ms-auto">Rp. {{ number_format($data->total_nominal,2, ",", ".") }}</div>
                                </div>
                            </div>
                            <a class="btn btn-primary mt-4" href="{{ route('pesan.beranda',$data->id)}}">Chat Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- upload ulang --}}
    <div class="modal fade"
        id="uploadBukti"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="p-4">
                        <div class="text-center">
                            <form action="{{ route('pembayaran.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="id" id="id" readonly value="{{ $data->id }}">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label fw-bold">Upload Bukti</label>
                                    <input class="form-control mt-2" type="file" id="formFile" name="file">
                                </div>
                                <button type="submit" class="btn btn-primary mt-4" >Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="text" name="id_transaksi" id="id_transaksi" value="{{ $data->id }}" readonly hidden>
    @php
        $detail = App\Models\DetailPemesananKonsultasi::where('id_pemesanan_konsultasi',$data->id)->first()->status_pembayaran;
    @endphp
    <input type="text" name="status" id="status" value="{{ $detail }}" readonly hidden>
    <section id="pembayaran" class="pembayaran">
        <div class="container" data-aos="fade-up">
            @include('components.notification')
            <div class="metode card shadow border border-dark col-6 offset-2 rounded-3">
                <div class="card-body p-5">
                    <div class="text-center">
                        <h2 class="fw-bold mb-3">Pembayaran E-Konsultasi</h2>
                        <span class="">Harap menyelesaikan pembayaran terlebih dahulu</span>
                    </div><br>
                    <div class="p-3 mt-5">
                        <div class="d-flex mb-3">
                            <div class="fs-6 fw-bold">Metode Pembayaran</div>
                            <div class="ms-auto fw-6">
                                <img style="width: 70px; height:50px;" src="{{ $data->foto != null ? asset('img/bank/'.$data->foto) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                            </div>
                        </div>
                        <div class="fs-6 fw-bold" style="color: rgb(172, 172, 172)">Nomor Rekening</div>
                        <div class="d-flex mb-3 mt-4">
                            <div class="fs-6 fw-bold" id="teks-element">{{ $data->no_rekening }}</div>
                            <div class="ms-auto fw-6">
                                <button class="border border-1" id="salin-button">salin</button>
                            </div>
                        </div><br>
                        <div class="text-center mt-5 p-3">
                            <div class="fs-4 fw-bold mb-3">Total Pembayaran</div>
                            <div class="ms-auto fw-bold fs-4" style="color:#F4A223;">Rp. {{ number_format($data->total_nominal,2, ",", ".") }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal-backdrop show"></div>
    <!-- End ambulance Section -->
@endsection
