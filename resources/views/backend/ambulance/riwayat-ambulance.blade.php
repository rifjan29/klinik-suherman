<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <style>
            .page-item.active .page-link{
                background-color: #219ebc !important;
                border-color: #8ecae6;
            }
            .btn-danger{
                background-color: #e63946;
                border: none
            }
        </style>
    @endpush
    @push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
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
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto Bukti</th>
                                <th>No Pesanan</th>
                                <th>Nama Pasien</th>
                                <th scope="col">Tanggal Pesanan</th>
                                <th scope="col">Tanggal Jemput</th>
                                <th>Status Pembayaran</th>
                                <th>Status Pesanan</th>
                                <th>Total Biaya</th>
                                <th scope="col" class="text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="input-upload">
                                            <img src="{{ $item->pasien_ambulance->foto_kejadian != null ? asset('img/foto-kejadian/'.$item->pasien_ambulance->foto_kejadian) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                                        </div>
                                    </td>
                                    <td>{{ $item->kode_pesanan }}</td>
                                    <td>{{ $item->pasien_ambulance->nama_wali }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_jemput)->translatedFormat('d F Y ') }} <br> <small class="text-muted" style="font-size: 11px">Jam {{ \Carbon\Carbon::parse($item->tanggal_jemput)->translatedFormat('h:i:s A') }}</small></td>
                                    <td>{{ \Carbon\Carbon::parse($item->pasien_ambulance->tanggal)->translatedFormat('d F Y ') }} <br> <small class="text-muted" style="font-size: 11px">Jam {{ \Carbon\Carbon::parse($item->pasien_ambulance->tanggal)->translatedFormat('h:i:s A') }}</small></td>
                                    <td>
                                        <span class="badge rounded-pill alert-success">Lunas</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill alert-success">Selesai</span>
                                    </td>
                                    <td>
                                        <b>Rp. {{ number_format($item->total_biaya,2, ",", ".") }}</b>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-danger" href="{{ route('riwayat-ambulance.detail',$item->id) }}">Cetak Bukti Pembayaran</a>
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
