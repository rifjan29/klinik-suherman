<x-app-layout>
    @push('css')
        <style>
            .page-item.active .page-link{
                background-color: #219ebc !important;
                border-color: #8ecae6;
            }
        </style>
    @endpush
    @push('js')
    <script>
        $(document).ready(function() {


        })
    </script>
    @endpush
    @section('content')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(3))) }}</h2>
            {{-- <div>
                <a href="{{ route('dokter.create') }}" class="btn btn-danger"><i class="text-muted material-icons md-post_add"></i>Tambah Data</a>
            </div> --}}
        </div>
        @include('components.notification')
        <div class="card mb-4">
            <div class="card-body">
                <div class="">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pesanan</th>
                                <th scope="col">Nama Wali</th>
                                <th scope="col">No. Telp</th>
                                <th scope="col">Tanggal Pesanan</th>
                                <th>Status Kejadian</th>
                                <th>Status Pesanan</th>
                                <th>Status Pembayaran</th>
                                <th scope="col" class="text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_pesanan }}</td>
                                    <td>{{ $item->pasien_ambulance->nama_wali }}</td>
                                    <td>{{ $item->pasien_ambulance->no_hp }}</td>

                                    <td>{{ $item->pasien_ambulance->tanggal }}</td>
                                    <td>
                                        @if ($item->status_kejadian == '0')
                                            <span class="badge rounded-pill alert-warning">Tidak Darurat</span>
                                        @elseif ($item->status_kejadian == '1')
                                            <span class="badge rounded-pill alert-warning">Darurat</span>
                                        @else
                                            <a href="{{ $item->pasien_ambulance->id }}" data-bs-toggle="modal" data-bs-target="#cekstatus{{ $item->pasien_ambulance->id }}" class="badge rounded-pill alert-info">Cek Status Kejadian</a></td>
                                            <div class="modal fade" id="cekstatus{{ $item->pasien_ambulance->id }}" tabindex="-1" aria-labelledby="cekstatus{{ $item->pasien_ambulance->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Cek Status</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                Alamat :
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="card">
                                                                    @php

                                                                            $provinsi = \Indonesia::findProvince($item->lokasi->id_provinsi)->first();
                                                                            $kota = \Indonesia::findCity($item->lokasi->id_kota)->first();
                                                                            $kecamatan = \Indonesia::findDistrict($item->lokasi->id_kecamatan)->first();
                                                                            $desa = \Indonesia::findVillage($item->lokasi->id_desa)->first();
                                                                    @endphp
                                                                    <div class="card-body">
                                                                        <p>{{ $provinsi->name }}, {{ $kota->name }}, {{ $kecamatan->name }}, {{ $desa->name }}, {{ $item->lokasi->alamat }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                Keaadaan :
                                                            </div>
                                                            <div class="col-md-10">
                                                                <textarea name="" id="" cols="5" rows="5" class="form-control" readonly>{{ $item->pasien_ambulance->keadaan }}</textarea>
                                                                <div class="input-upload">
                                                                    <img src="{{ $item->pasien_ambulance->foto_kejadian != null ? asset('img/admin/'.$item->pasien_ambulance->foto_kejadian) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <form action="{{ route('update-status.riwayat-ambulance') }}" method="POST" >
                                                                @csrf
                                                                <input type="text" name="id_transaksi" value="{{ $item->kode_pesanan }}">

                                                            <div class="col-md-2">
                                                                <label for="product_name" class="form-label">Status Kejadian</label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                                                    <input class="form-check-input" id="jenis_kelamin" name="status_kejadian" value="0" {{ old('status_kejadian') == '0' ? "checked" : '' }} type="radio">
                                                                    <span class="form-check-label"> Darurat </span>
                                                                </label>
                                                                <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                                                    <input class="form-check-input" id="jeni_kelamin" name="status_kejadian" value="1" {{ old('status_kejadian') == '1' ? "checked" : '' }} type="radio">
                                                                    <span class="form-check-label"> Tidak Darurat </span>
                                                                </label>
                                                                @error('status_kejadian')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}.
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Status</button>

                                                        </form>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status_kendaraan == '1')
                                            <span class="badge rounded-pill alert-warning">Dalam Perjalanan</span>
                                        @elseif ($item->status_kendaraan == '2')
                                            <span class="badge rounded-pill alert-info">Tiba di klinik</span>
                                        @else
                                            <span class="badge rounded-pill alert-warning">Proses Pengecekan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status_kendaraan == 'pending')
                                            <span class="badge rounded-pill alert-warning">Pending</span>
                                        @elseif ($item->status_kendaraan == 'lunas')
                                            <span class="badge rounded-pill alert-info">Lunas</span>
                                        @else
                                            <span class="badge rounded-pill alert-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i> Detail Pesanan </a>
                                        <div class="dropdown">
                                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Cek Pembayaran</a>
                                                <a class="dropdown-item" href="#">Ganti Status Pesanan</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            </div>
        </div>
        <!-- card end// -->
    </section>
    @endsection
</x-app-layout>
