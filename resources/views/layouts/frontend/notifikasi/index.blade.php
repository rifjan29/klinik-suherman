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

        .nav-pills .nav-link {
            color:#37517e;
        }
    </style>
@endpush
@section('hero')
    <section id="hero" class="d-flex align-items-center">
    </section>
@endsection
@section('content')
     <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <div class="d-flex flex-column align-items-center mb-4" style="margin-top: 20px;">
                        <div class="card-body">
                            <img src="{{ $data->gender == 'L' ? asset('backend/assets/imgs/people/avatar-4.png') : asset('backend/assets/imgs/people/avatar-1.png') }}" alt="user-img" class="img-fluid rounded-circle" style="width: 75px; height: 75px;">
                        </div>
                        <div class="ml-3 d-none d-sm-block">
                            <span style="color:black; font-size:16px; font-weight:bold;">{{ $data->nama }}</span>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-center mt-3 d-sm-none">
                        <span style="color:black; font-size:16px; font-weight:bold;">{{ $data->nama }}</span>
                    </div>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item mb-2">
                            <a href="{{ route('profil') }}" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-person"></i> <span class="mx-3 d-none d-sm-inline">Profil Saya</span>
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('riwayat') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-clock-history"></i> <span class="mx-3 d-none d-sm-inline">Riwayat</span>
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-bell"></i> <span class="mx-3 d-none d-sm-inline">Notifikasi</span>
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('pengaturan') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-gear"></i> <span class="mx-3 d-none d-sm-inline">Pengaturan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col p-5">
                <div class="section-title">
                    <h2>Notifikasi</h2>
                </div>
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="p-3">
                            <ul class="nav-tabs nav nav-pills nav-fill" id="myTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                        <h5 class="fw-bold">E-Konsultasi</h5>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                        <h5 class="fw-bold">E-Apotek</h5>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                        <h5 class="fw-bold">E-Ambulance</h5>
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content my-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="" style="height:500px; width:auto; overflow:auto; padding:1%;">
                                        <div class="row">
                                            @forelse ($konsultasi as $item)
                                                <div class="col-md-12">
                                                    <div class="d-flex flex-column">
                                                        <div class="">
                                                            <div class="card shadow border-0 mt-2" >
                                                                <div class="card-body">
                                                                    <div class="d-flex flex-row">
                                                                        <div class="p-2">
                                                                            <div class="mt-2">
                                                                                <img src="{{ asset('frontend/assets/img/pesan.png') }}" alt="" class="img-fluid" style="width: 70px; height: 70px;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="p-3">
                                                                            <div class="p-1">
                                                                                @if ($item->status_pembayaran == 'pending')
                                                                                    <h5 class="fw-bold">Menunggu Verifikasi Pembayarann</h5>
                                                                                @elseif ($item->status_pembayaran == 'lunas')
                                                                                    @php
                                                                                        $riwayat = \App\Models\DetailPemesananKonsultasi::where('id_pemesanan_konsultasi',$item->id)->first();
                                                                                    @endphp
                                                                                    @if ($riwayat->status_chat == 'pending')
                                                                                        <h5 class="fw-bold">Sedang Melakukan Chat</h5>
                                                                                    @else
                                                                                        <h5 class="fw-bold">Chat telah berakhir</h5>
                                                                                    @endif
                                                                                @else
                                                                                    <h5 class="fw-bold">Pembayaran ditolak</h5>
                                                                                @endif
                                                                            </div>
                                                                            <div class="p-1">
                                                                                <span>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y ') }} Jam {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('h:i:s A') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>Tidak ada data</p>
                                            @endforelse

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="" style="height:500px; width:auto; overflow:auto; padding:1%;">
                                        <div class="row">
                                            @forelse ($apotek as $item)
                                                <div class="col-md-12">
                                                    <div class="d-flex flex-column">
                                                        <div class="">
                                                            <div class="card shadow border-0 mt-2">
                                                                <div class="card-body">
                                                                    <div class="d-flex flex-row">
                                                                        <div class="p-2">
                                                                            <div class="mt-2">
                                                                                <img src="{{ asset('frontend/assets/img/farmasi.png') }}" alt="" class="img-fluid" style="width: 70px; height: 70px;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="p-3">
                                                                            <div class="p-1">
                                                                                @if ($item->status_update == 'konfirmasi')
                                                                                    <h5 class="fw-bold"><a href="{{ route('hasil.list',$item->kode_pemesanan) }}">Silahkan Tebus obat</a></h5>
                                                                                @else

                                                                                    <h5 class="fw-bold">Menunggu Hasil Pemeriksaan</h5>
                                                                                @endif
                                                                            </div>
                                                                            <div class="p-1">
                                                                                <span>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y ') }} Jam {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('h:i:s A') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>Tidak ada data</p>

                                            @endforelse

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="" style="height:500px; width:auto; overflow:auto; padding:1%;">
                                        <div class="row">
                                            @forelse ($ambulance as $item)
                                                <div class="col-md-12">
                                                    <div class="d-flex flex-column">
                                                        <div class="">
                                                            <div class="card shadow border-0 mt-2">
                                                                <div class="card-body">
                                                                    <div class="d-flex flex-row">
                                                                        <div class="p-2">
                                                                            <div class="mt-2">
                                                                                <img src="{{ asset('frontend/assets/img/ambulance1.png') }}" alt="" class="img-fluid" style="width: 70px; height: 70px;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="p-3">
                                                                            <div class="p-1">
                                                                                <h5 class="fw-bold">
                                                                                    @if ($item->status_perjalanan == '0')
                                                                                        Pesanan Diterima
                                                                                    @elseif($item->status_perjalanan == '1')
                                                                                        Ambulance Menuju Lokasi
                                                                                    @elseif($item->status_perjalanan == '2')
                                                                                        Ambulance Tiba di Lokasi
                                                                                    @elseif($item->status_perjalanan == '3')
                                                                                        Pesanan Dibayarkan
                                                                                    @elseif($item->status_perjalanan == '4')
                                                                                        Pembayaran E-Ambulance sudah selesai!
                                                                                    @else
                                                                                    @endif
                                                                                </h5>
                                                                            </div>
                                                                            <div class="p-1">
                                                                                <span>Apr 07, 2023 at 10.45 am</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>Tidak ada data</p>

                                            @endforelse

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
