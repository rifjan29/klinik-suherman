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
        .card-footer{
            border-top: 1px solid #000;
            background-color: #fff;

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
                                        @if ($transaksiObat->status == 'pending')
                                            <span class="badge bg-primary">Pending</span>
                                        @elseif ($transaksiObat->status == 'lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    @php
                                            $data_dokter =  App\Models\PemesananKonsultasi::select('pemesanan_konsultasi.id as id_konsultasi','pemesanan_konsultasi.id_dokter','pemesanan_konsultasi.kode_pemesanan',
                                                                'dokter.id as iddokter',
                                                                'dokter.nama_dokter','dokter.no_sip')
                                                            ->join('dokter','dokter.id','pemesanan_konsultasi.id_dokter')
                                                            ->where('pemesanan_konsultasi.kode_pemesanan',$transaksiObat->kode_transaksi_konsultasi)
                                                            ->first();
                                    @endphp
                                    <div>
                                        <div class="d-flex flex-column">
                                            <div><p>Nama Dokter</p></div>
                                            <div><p>SIP</p></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div><p>{{ ucwords($data_dokter->nama_dokter) }}</p></div>
                                        <div><p>{{ $data_dokter->no_sip }}</p></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div><h5 class="fw-bold">R/</h5></div>
                                    <div>
                                        {{ \Carbon\Carbon::parse($transaksiObat->created_at)->translatedFormat('d F Y ') }}
                                    </div>
                                </div>
                                <div class="p-5">
                                    @php
                                        $obat = \App\Models\DetailTransaksiObat::select('detail_transaksi_pemesanan_obat.*','obat.nama_obat','obat.harga')
                                                                                ->join('obat','obat.id','detail_transaksi_pemesanan_obat.id_obat')
                                                                                ->where('detail_transaksi_pemesanan_obat.id_transaksi_obat',$transaksiObat->id)
                                                                                ->get();
                                    @endphp
                                    <div class="card" name="" class="form-control" id="" cols="30" rows="10">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nama Obat</th>
                                                    <th>Qty</th>
                                                    <th>Harga Satuan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($obat as $item)
                                                    <tr>
                                                        <td >{{ $item->nama_obat }}</td>
                                                        <td>{{ $item->qty }}</td>
                                                        <td>{{ $item->harga }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-between mt-3">
                                            <div>
                                                <h6>Keterangan Biaya-Biaya :</h6>
                                            </div>
                                            @php
                                                $lainnya = $transaksiObat->harga_lainnya != null ? $transaksiObat->harga_lainnya : 0;
                                                $embalase = $transaksiObat->harga_embalase != null ? $transaksiObat->harga_embalase : 0;
                                                $biaya = $lainnya + $embalase;
                                            @endphp
                                            <div>
                                                <h6 class="fw-bold">Rp. {{ number_format($biaya,2, ",", ".") }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between px-5 mt-4">
                                    <div>
                                        <div class="d-flex flex-column">
                                            <h6>Total Pembayaran</h6>
                                            <h5 class="text-warning fw-bold">Rp. {{ number_format($transaksiObat->nominal_bayar,2, ",", ".") }}</h5>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between px-5 mb-4">
                                    <div class="mt-4 w-50" >
                                        <form action="{{ route('list.apotek.tebus.post',$transaksiObat->kode_transaksi) }}" method="POST">
                                            @csrf
                                        <h5 class="fw-bold">Metode Pembayaran</h5>
                                        <select class="form-control mt-2" aria-label="Default select example" id="selectpicker" name="bank">
                                            @forelse ($bank as $item)
                                                <option value="{{ $item->id }}" data-thumbnail="{{ $item->foto != null ? asset('img/bank/'.$item->foto) : asset('backend/assets/imgs/theme/upload.svg') }}">{{ $item->nama_bank }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div >
                                        <button class="btn btn-primary" type="submit">Bayar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p class="text-center fw-bold p-0 m-0" style="font-size: 12px">*Lakukan pembayaran secara online terlebih dahulu kemudian upload bukti pembayaran </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->

@endsection
