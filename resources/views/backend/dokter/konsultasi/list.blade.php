<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <style>
            .page-item.active .page-link{
                background-color: #219ebc !important;
                border-color: #8ecae6;
            }
            .active-ket{
                display: none;
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
    <script>
        $(document).ready(function() {

        })
    </script>
    @endpush
    @section('content')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(3))) }}</h2>

        </div>
        @include('components.notification')
        <div class="card mb-4">
            <div class="card-body">
                <div class="">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pesanan</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col">No. Telp</th>
                                <th scope="col">Tanggal Pesanan</th>
                                <th>Nama Dokter</th>
                                <th>Total Biaya</th>
                                <th>Nama Bank</th>
                                <th>Status Pembayaran</th>
                                <th scope="col" class="text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><b>{{ ucwords($item->kode_pemesanan) }}</b></td>
                                    <td><b>{{ ucwords($item->nama_pasien) }}</b></td>
                                    <td><b>{{ $item->phone }}</b></td>
                                    <td><b>{{ \Carbon\Carbon::parse($item->tgl)->translatedFormat('d F Y ') }} </b></td>
                                    <td><b>{{ $item->nama_dokter }}</b></td>
                                    <td><b> Rp. {{ number_format($item->total_nominal,2, ",", ".") }}</b></td>
                                    <td><b>{{ $item->nama_bank }}</b>
                                        <br><small class="text-muted">{{ $item->no_rekening }}</small>
                                    </td>
                                    <td>
                                        @if ($item->status_pembayaran == 'pending')
                                            <span class="badge rounded-pill alert-warning">Pending</span>
                                        @elseif ($item->status_pembayaran == 'lunas')
                                            <span class="badge rounded-pill alert-info">Lunas</span>
                                        @else
                                            <span class="badge rounded-pill alert-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('konsultasi-dokter.chat') }}" class="btn btn-sm font-sm rounded btn-primary gantiStatus" > Chat Sekarang </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Tidak ada data</td>
                                </tr>
                            @endforelse

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
