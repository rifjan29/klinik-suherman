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
            $('.hasil').on('click',function() {
                var id = $(this).data('id');
                $.ajax({
                    url:`{{ route('hasil.list.detail') }}`,
                    method:'GET',
                    data:{
                        id:id
                    },
                    success:function(data){
                        $('#kode_transaksi').text(data.kode_pemesanan)
                        $('#nama_pasien').text(data.nama_pasien)
                        $('#nama_dokter').text(data.nama_dokter)
                        $('#tarif').text(data.total_nominal)
                        $('#resep_obat').text(data.resep_obat)
                        $('#kesimpulan').text(data.kesimpulan)
                        $('#id_hasil_konsultasi').val(data.id)
                        $('#id_pasien').val(data.id_pasien_konsultasi)
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
                <h2>List E-Konsultasi</h2>
            </div>
            <div class="row content">
                <div class="row justify-content-center my-5">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Pesanan</th>
                                    <th scope="col">Nama Dokter</th>
                                    <th scope="col">Tanggal Konsultasi</th>
                                    <th scope="col">Tarif Konsultasi</th>
                                    <th scope="col" class="text-start">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_pemesanan }}</td>
                                        <td>{{ $item->nama_dokter }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl)->translatedFormat('d F Y ') }}</td>
                                        <td>Rp. {{ number_format($item->total_nominal,2, ",", ".") }}</td>
                                        <td>
                                            @if ($item->status_update == 'konfirmasi')
                                                <a href="#" class="btn btn-sm font-sm rounded btn-primary hasil" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $item->id }}"> Hasil Konsultasi </a>
                                            @else
                                                <div  class="btn btn-sm font-sm rounded btn-brand" > Menunggu Hasil Pemeriksaan </div>
                                            @endif
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Konsultasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-danger " >Cetak PDF</button>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-responsive-sm">
                            <tr>
                                <td width="30%">Kode Transaksi</td>
                                <td width="1%">:</td>
                                <td id="kode_transaksi"></td>
                            </tr>
                            <tr>
                                <td width="30%">Nama Pasien</td>
                                <td width="1%">:</td>
                                <td id="nama_pasien"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-responsive-sm">
                            <tr>
                                <td width="30%">Nama Dokter</td>
                                <td width="1%">:</td>
                                <td id="nama_dokter"></td>
                            </tr>
                            <tr>
                                <td width="30%">Tarif</td>
                                <td width="1%">:</td>
                                <td id="tarif"></td>
                            </tr>

                        </table>
                    </div>
                </div>
                <hr>
                <div class="mb-3">
                    <label for="" class="fw-bold">Resep</label>
                    <textarea name="resep_obat" id="resep_obat" cols="30" rows="10" class="form-control" placeholder="Masukkan resep" readonly></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="fw-bold">Diagnosa</label>
                    <textarea name="kesimpulan" id="kesimpulan" cols="30" rows="10" class="form-control" placeholder="Masukkan diagnosa" readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="{{ route('post.apotek') }}" method="POST">
                @csrf
                <input type="hidden" name="id_hasil_konsultasi" id="id_hasil_konsultasi">
                <input type="hidden" name="id_pasien" id="id_pasien">
                <button type="submit" class="btn btn-primary">Tebus Obat</button>
            </form>
            </div>
        </div>
        </div>
    </div>
@endsection
