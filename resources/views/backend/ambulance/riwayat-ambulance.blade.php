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
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pesanan</th>
                                <th scope="col">Nama Wali</th>
                                <th scope="col">No. Telp</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Tanggal Pesanan</th>
                                <th scope="col">Alasan</th>
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
                                    <td>{{ $item->pasien_ambulance->lokasi_tujuan }}</td>
                                    <td>{{ $item->pasien_ambulance->tanggal }}</td>
                                    <td><a href="{{ $item->pasien_ambulance->id }}" class="badge rounded-pill alert-info">Alasan Pesanan</a></td>
                                    <td>
                                        @if ($item->status_kejadian == '0')
                                            <span class="badge rounded-pill alert-warning">Tidak Darurat</span>
                                        @elseif ($item->status_kejadian == '1')
                                            <span class="badge rounded-pill alert-warning">Darurat</span>
                                        @else
                                            <a href="{{ $item->pasien_ambulance->id }}" data-bs-toggle="modal" data-bs-target="#cekstatus{{ $item->pasien_ambulance->id }}" class="badge rounded-pill alert-info">Cek Status Kejadian</a></td>
                                            <div class="modal fade" id="cekstatus{{ $item->pasien_ambulance->id }}" tabindex="-1" aria-labelledby="cekstatus{{ $item->pasien_ambulance->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Modal Keluar</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">Logout</a>
                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                @csrf
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
