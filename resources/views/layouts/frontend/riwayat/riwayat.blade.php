@extends('layouts.template')
@push('css')
    <style>
        #hero {
            width: 100%;
            height: 10vh !important;
            background: #37517e;
        }
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
            background-color: #37517e !important;
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
                            <a href="" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-clock-history"></i> <span class="mx-3 d-none d-sm-inline">Riwayat</span>
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{ route('notifikasi') }}" class="nav-link px-0 align-middle">
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
                    <h2>Riwayat</h2>
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
                                        <h5 class="fw-bold">E-Ambulans</h5>
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content my-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="" style="height:500px; width:auto; overflow:auto; padding:1%;">
                                        <div class="row">
                                            @forelse ($konsultasi as $data)
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ $data->jenis_kelamin == '1' ? asset('backend/assets/imgs/people/avatar-4.png') : asset('backend/assets/imgs/people/avatar-1.png') }}" alt="" class="img-fluid rounded-circle" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="m-2">
                                                                    <span class="fw-bold fs-5">{{ ucwords($data->nama_dokter) }}</span>
                                                                </div>
                                                                <div class="m-2">Dokter {{ ucwords($data->spesialis) }}</div>
                                                                <div class="d-flex flex-row m-2">
                                                                    <div class="d-flex justify-content-start mt-2">
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                        <i class="fa-solid fa-star" style="color: #e1ff00;"></i>
                                                                    </div>
                                                                    <div class="p-1 mx-1">
                                                                        @php
                                                                            $suka = \App\Models\Penilaian::where('id_dokter',$data->id_dokter)->sum('suka')
                                                                        @endphp
                                                                        <span>{{ $suka }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 position-relative">
                                                                <div class="position-absolute bottom-0 end-0 mx-4">
                                                                    <button type="button" class="btn btn-lg btn-primary text-center hasil" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $data->id }}" style="background-color: #37517E; border:0; border-radius:10px"><span class="p-4" style="font-size: 14px">Catatan Dokter</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <h5 class="fw-bold">Belum ada riwayat konsultasi</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="" style="height:500px; width:auto; overflow:auto; padding:1%;">
                                        <div class="row">
                                            @forelse ($obat as $data)
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/obat.png') }}" alt="" class="img-fluid rounded-circle" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="m-2">
                                                                    <span class="fw-bold fs-5">{{ $data->kode_transaksi }}</span>
                                                                </div>
                                                                <div class="float-start hstack gap-3 m-2">
                                                                    <div class="ms-auto">{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y ') }}</div>
                                                                    <div class="vr"></div>
                                                                    <div class="">{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('h:i:s') }} WIB</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 position-relative">
                                                                <div class="position-absolute top-50 start-50 translate-middle">
                                                                    <span>Rp. {{ number_format($data->nominal_bayar,2, ",", ".") }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <h5 class="fw-bold">Belum ada riwayat pembelian obat</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="" style="height:500px; width:auto; overflow:auto; padding:1%;">
                                        <div class="row">
                                            @forelse ($ambulance as $data)
                                            <div class="col-md-12 p-2">
                                                <div class="card shadow">
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-2 text-center">
                                                                <img src="{{ asset('frontend/assets/img/ambulance.png') }}" alt="" class="img-fluid" style="width: 130px; height: 130px;">
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="d-flex justify-content-between mx-4">
                                                                    <h5 class="fw-bold" style="color: #37517E">
                                                                    @if ($data->status_perjalanan == '0')
                                                                        Pesanan Diterima
                                                                    @elseif($data->status_perjalanan == '1')
                                                                        Ambulance Menuju Lokasi
                                                                    @elseif($data->status_perjalanan == '2')
                                                                        Ambulance Tiba di Lokasi
                                                                    @elseif($data->status_perjalanan == '3')
                                                                        Pesanan Dibayarkan
                                                                    @elseif($data->status_perjalanan == '4')
                                                                        Pembayaran E-Ambulans sudah selesai!
                                                                    @else
                                                                    @endif
                                                                    </h6>
                                                                </div>
                                                                <div class="mx-4 mt-2">
                                                                    <div class="float-end fw-bold" style="color: #37517e">Rp. {{ number_format($data->total_biaya,2, ",", ".") }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="col-md-12 p-2">
                                            <div class="card shadow">
                                                <div class="card-body p-4">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <h5 class="fw-bold">Belum ada riwayat ambulance</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Konsultasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
            </div>
        </div>
        </div>
    </div>
@endsection
