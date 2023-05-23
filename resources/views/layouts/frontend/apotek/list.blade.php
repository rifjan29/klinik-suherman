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
    <script>
        $(document).ready(function() {
            var id = $('#kode_transaksi').text();
            cek('{{ route('list.apotek.detail') }}',id)
            function cek(url,id) {
                var status = $('#status').val();
                var nominal_bayar = $('#nominal_bayar').text();
                console.log(nominal_bayar);
                if (nominal_bayar == '-') {
                    $('.process ul .pembayaran').removeClass('completed')
                    $('#upload_bukti').addClass('d-none')
                    $('#upload_bukti').removeClass('d-block')
                }else{
                    $('.process ul .pembayaran').addClass('completed')
                    $('#upload_bukti').removeClass('d-none')
                    $('#upload_bukti').addClass('d-block')
                }
                if (status == 'pending') {
                    console.log('nih pending');
                }else if(status == 'lunas'){
                    console.log('nih lunas');
                }else if(status == 'ditolak'){
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
                                console.log('ada nominal');
                            }
                            if (data.status == 'pending') {
                                console.log('nih pending');
                            }else if(data.status == 'lunas'){
                                console.log('nih lunas');
                            }else if(data.status == 'ditolak'){
                                console.log('nih ditolak');
                            }
                        }
                    });
                }, 5000);
            }
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
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td id="kode_transaksi">{{ $item->kode_transaksi }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->resep_obat }}</td>
                                        <td id="nominal_bayar">{{ $item->nominal_bayar != null ? $item->nominal_bayar : '-' }}</td>
                                        <td>
                                            <input type="text" name="status" id="status" value="{{ $item->status }}">
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
        </div>
    </section>
    <!-- End ambulance Section -->

@endsection
