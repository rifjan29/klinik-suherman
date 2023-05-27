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
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vertikal.css') }}">
@endpush
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment-with-locales.min.js"></script>
    <script>
        $(document).ready(function() {
            var id = $('#kode_transaksi').text();
            cek('{{ route('list.apotek.detail') }}',id)
            function cek(url,id) {
                var status_pengambilan = $('#status_pengambilan').val();
                var status = $('#status').val();
                var nominal_bayar = $('#nominal_bayar').text();
                var foto = $('#foto').val();
                if (nominal_bayar == '-') {
                    $('.process ul .pembayaran').removeClass('completed')
                    $('#upload_bukti').addClass('d-none')
                    $('#upload_bukti').removeClass('d-block')
                }else{
                    $('.process ul .pembayaran').addClass('completed')
                    $('#upload_bukti').removeClass('d-none')
                    $('#upload_bukti').addClass('d-block')
                    if (foto == '') {
                        console.log('tidak ada foto');
                    } else {
                        $('#upload_bukti').addClass('d-none')
                        $('#upload_bukti').removeClass('d-block')
                        $('.process ul .verifikasi').addClass('completed')
                    }
                }
                if (status == 'pending') {
                    // $('.process ul .pembayaran').addClass('completed')
                    $('.lunas').removeClass('d-block')
                    $('.lunas').addClass('d-none')

                    // $('#upload_bukti').removeClass('d-none')
                    // $('#upload_bukti').addClass('d-block')
                    console.log('nih pending');
                }else if(status == 'lunas'){
                    $('.process ul .tanggal_ambil').removeClass('d-none')

                    $('.process ul .tanggal_ambil').addClass('completed')
                    $('.lunas').removeClass('d-none')
                    $('.lunas').addClass('d-block')
                }else if(status == 'ditolak'){
                    $('.process ul .tanggal_ambil').addClass('d-none')
                    $('.lunas').removeClass('d-block')
                    $('.lunas').addClass('d-none')
                    $('.process ul .tanggal_ambil').removeClass('completed');
                    var myModal = $("#exampleModalKeluar");

                    // Show the modal
                    myModal.modal("show");

                    // Hide the modal after a delay
                    setTimeout(function() {
                        myModal.modal("hide");
                    }, 3000); // 3000 milliseconds = 3 seconds
                    console.log('nih ditolak');
                }
                setInterval(function()
                {

                    $.ajax({
                        url: url,
                        type:"GET",
                        data: {
                            kode_transaksi: id
                        },
                        success:function(data)
                        {
                            if (data.nominal_bayar == null) {
                                console.log('tidak ada nominal');
                            }else{
                                $('.process ul .pembayaran').addClass('completed')
                                $('#nominal_bayar').text(data.nominal_bayar);
                                $('#upload_bukti').removeClass('d-none')
                                $('#upload_bukti').addClass('d-block')
                                if (data.foto_pembayaran == null) {
                                    console.log('tidak ada foto');
                                } else {
                                    $('#upload_bukti').addClass('d-none')
                                    $('#upload_bukti').removeClass('d-block')
                                    $('.process ul .verifikasi').addClass('completed')
                                }
                            }
                            if (data.status == 'pending') {
                                $('.lunas').removeClass('d-block')
                                $('.lunas').addClass('d-none')
                                console.log('nih pending');
                            }else if(data.status == 'lunas'){
                                moment.locale('id')
                                var formattedDate = moment(data.tgl_ambil_obat).format('D MMMM YYYY');
                                var tanggal = moment(data.tgl_ambil_obat);
                                var next_day = tanggal.add(1,'days');
                                var result_day = next_day.format('D MMMM YYYY')
                                $('#tgl_ambil').html(`
                                    Obat diambil tanggal ${formattedDate} <br> Batas waktu pengambilan : ${result_day}
                                `)
                                $('.process ul .tanggal_ambil').addClass('completed')
                                $('.process ul .tanggal_ambil').removeClass('d-none')
                                $('.lunas').removeClass('d-none')
                                $('.lunas').addClass('d-block')
                            }else if(data.status == 'ditolak'){
                                $('.process ul .tanggal_ambil').addClass('d-none')
                                $('.lunas').removeClass('d-block')
                                $('.lunas').addClass('d-none')
                                $('#upload_bukti').removeClass('d-none')
                                $('#upload_bukti').addClass('d-block')
                                $('.process ul .tanggal_ambil').removeClass('completed')

                            }
                        }
                    });
                }, 5000);
            }
            $('.cetak').on('click',function() {
                var id = $(this).data('id');
                $.ajax({
                    url: `{{ route('list.apotek.invoice') }}`,
                    data:{
                        id:id
                    },
                    success:function(data)
                    {
                        console.log(data);
                        $('#kode').text(data.kode_transaksi)
                        $('#nama_pasien').text(data.nama)

                        $('#tgl_transaksi').text(data.created_at)
                        var transfer = `Transfer Bank ${data.nama_bank}`;
                        $('#transfer').text(transfer);
                        $('#bank_tujuan').text(data.nama_bank);
                        $('#tgl_ambil_obat').text(data.tgl_ambil_obat);
                        $('#total').text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.nominal_bayar));
                        $('#download').on('click',function() {
                            window.location.href = data.url
                        })
                    }
                })
            })
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
        <div class="container text-center" data-aos="fade-up">
            <div class="section-title">
                <h2>List Pemesanan</h2>
            </div>
            @include('components.notification')
            @if (count($data) > 0)
                <div class="row content">
                    <div class="row justify-content-center my-5">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Transaksi</th>
                                        <th scope="col">Nama </th>
                                        <th scope="col">Resep</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item )
                                        <input type="text" id="foto" value="{{ $item->foto_pembayaran }}" hidden>
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td id="kode_transaksi">{{ $item->kode_transaksi }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->resep_obat }}</td>
                                            <td id="nominal_bayar">{{ $item->nominal_bayar != null ? $item->nominal_bayar : '-' }}</td>
                                            <td>
                                                <input type="text" name="status" id="status" value="{{ $item->status }}" hidden>
                                                <input type="text" name="status_pengambilan" id="status_pengambilan" value="{{ $item->status_pengambilan }}" hidden>
                                                <div class="wizard">
                                                    <div class="process">
                                                    <ul>
                                                        <li class="step completed" data-id="0">
                                                        <div class="name">Menunggu informasi kasir</div>
                                                        </li>
                                                        <li class="step pembayaran " data-id='1'>
                                                        <div class="name">Silahkan lakukan pembayaran</div>
                                                        </li>
                                                        <li class="step verifikasi" data-id="2">
                                                        <div class="name">Menunggu verifikasi pembayaran</div>
                                                        </li>
                                                        <li class="step tanggal_ambil d-none" data-id="3">
                                                            <div class="name" id="tgl_ambil">Obat diambil tanggal {{ \Carbon\Carbon::parse($item->tgl_ambil_obat)->translatedFormat('d F Y ') }} <br> Batas waktu pengambilan : {{ \Carbon\Carbon::parse($item->tgl_ambil_obat)->addDay()->translatedFormat('d F Y ') }}</div>
                                                        </li>
                                                        <li class="step tanggal_ambil d-none" data-id="4">
                                                            <div class="name">Pesanan Telah Selesai</div>
                                                        </li>
                                                    </ul>
                                                    </div>
                                                </div>
                                                <div id="upload_bukti" class="d-none">
                                                    <hr>
                                                    <div class="d-flex">
                                                        <div class="mx-3 align-items-center">
                                                            <p class="text-muted">Klik bayar untuk detail lebih lanjut</p>
                                                        </div>
                                                        <div>
                                                            <a class="btn btn-primary" href="{{ route('list.apotek.tebus',$item->kode_transaksi) }}" >Bayar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="lunas" class="d-none">
                                                    <button class="btn btn-primary cetak" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal">Cetak Invoice Resep</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-center">Tidak ada transaksi</p>
            @endif
        </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <div class="ms-auto" id="kode"></div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Nama</div>
                                    <div class="ms-auto" id="nama_pasien"></div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Tanggal</div>
                                    <div class="ms-auto" id="tgl_transaksi"> </div>
                                </div>
                                <hr>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Jenis Transaksi</div>
                                    <div class="ms-auto" id="transfer"></div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Bank Tujuan</div>
                                    <div class="ms-auto" id="bank_tujuan"> </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Tanggal Pengambilan Obat</div>
                                    <div class="ms-auto" id="tgl_ambil_obat"></div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Tempat</div>
                                    <div class="ms-auto">Klinik Suherman</div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Jam Ambil</div>
                                    <div class="ms-auto">08.00 - 21.00 WIB</div>
                                </div>

                                <hr>
                                <div class="d-flex mt-3">
                                    <div class="fw-bold fs-6">Total</div>
                                    <div class="ms-auto" id="total"> </div>
                                </div>
                            </div>
                            <a class="btn btn-primary mt-4" id="download">Download Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="exampleModalKeluar" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <p class="text-danger text-center fw-bold">Upload pembayaran anda ditolak silahkan upload ulang.</p>
            </div>
        </div>
        </div>
    </div>

    <!-- End ambulance Section -->

@endsection
