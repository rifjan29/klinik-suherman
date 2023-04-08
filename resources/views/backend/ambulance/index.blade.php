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
            <h2 class="content-title">Data {{ ucwords(str_replace('-',' ',Request::segment(2))) }}</h2>
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
                                <th scope="col">Nama Pemesan</th>
                                <th scope="col">No. Telp</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Tanggal Pesanan</th>
                                <th scope="col">Alasan</th>
                                <th>Status Pesanan</th>
                                <th>Status Pembayaran</th>
                                <th scope="col" class="text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>AM-001</td>
                                <td>Sofyan</td>
                                <td>081215</td>
                                <td>Perumnas Citarum No. 25</td>
                                <td>12-May-2020 12:0:20</td>
                                <td><a href="" class="badge rounded-pill alert-info">Alasan Pesanan</a></td>
                                <td>
                                    <span class="badge rounded-pill alert-success">Telah Sampai di lokasi</span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill alert-success">Diterima</span>
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
                            <tr>
                                <td>2</td>
                                <td>AM-002</td>
                                <td>Sofyan Muhammad</td>
                                <td>081215</td>
                                <td>Perumnas Badean No. 20</td>
                                <td>13-May-2020 12:0:20</td>
                                <td><a href="" class="badge rounded-pill alert-info">Alasan Pesanan</a></td>
                                <td>
                                    <span class="badge rounded-pill alert-warning">Dalam Antrian</span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill alert-warning">Pending</span>
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
                            <tr>
                                <td>3</td>
                                <td>AM-003</td>
                                <td>Sofyan Saori</td>
                                <td>081215</td>
                                <td>Perumnas Mastrip No. 20 </td>
                                <td>12-May-2020 12:0:20</td>
                                <td><a href="" class="badge rounded-pill alert-info">Alasan Pesanan</a></td>
                                <td>
                                    <span class="badge rounded-pill alert-warning">Pending</span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill alert-danger">Ditolak</span>
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
