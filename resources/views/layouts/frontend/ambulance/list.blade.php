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
@section('hero')
    <section id="hero" class="d-flex align-items-center">
    </section>
@endsection
@section('content')
     <!-- ======= ambulance Section ======= -->
     <section id="services" class="services">
        <div class="container text-center" data-aos="fade-up">
            <div class="section-title">
                <h2>List E-Ambulance</h2>
            </div>
            <div class="row content">
                <div class="row justify-content-center my-5">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Transaksi</th>
                                    <th>Nama Wali</th>
                                    <th>Alamat</th>
                                    <th>Status Pembayaran</th>
                                    <th>Status Perjalanan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_pesanan }}</td>
                                        <td>{{ $item->pasien_ambulance->nama_wali }}</td>
                                        @php
                                                $lokasi = \App\Models\LokasiKejadian::where('id_pasien_ambu', $item->id_pasien)->first()->alamat;
                                        @endphp
                                        <td>{{ $lokasi }}</td>
                                        <td>
                                            @if ($item->status_pembayaran == 'pending')
                                                <span class="badge bg-warning">{{ $item->status_pembayaran }}</span>
                                            @else
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_perjalanan == '0')
                                                <span class="badge bg-warning">Pesanan Diterima</span>
                                            @else

                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-primary">Cetak</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <a class="btn btn-lg btn-primary text-center mt-4" href="{{ route('e-ambulance.create') }}">Pesan Ambulance</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->
@endsection
