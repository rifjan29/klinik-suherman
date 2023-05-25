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
                                <th>Kode Transaksi</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Pasien </th>
                                <th scope="col">Status Pesanan</th>
                                <th>Status Pengambilan</th>
                                <th scope="col" class="text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><b>{{ ucwords($item->kode_transaksi) }}</b></td>
                                    <td><b>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y ') }} </b></td>
                                    <td><b>{{ ucwords($item->nama) }}</b></td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            @if ($item->nominal_bayar == null)
                                                <a href="{{ route('e-apotek.update',$item->id) }}">Update Pembayaran</a><br>
                                                <small class="text-muted" style="font-size: 10px">Pending</small>
                                            @else
                                                <a href="" class="btn btn-primary">Verifikasi Pembayaran</a> <br>
                                            <b class="text-muted"> Total : Rp. {{ number_format($item->nominal_bayar,2, ",", ".") }}</b>
                                            @endif
                                            {{-- <span class="badge rounded-pill alert-warning">Pending</span> --}}
                                        @elseif ($item->status == 'lunas')
                                            <span class="badge rounded-pill alert-info">Lunas</span>
                                        @else
                                            <span class="badge rounded-pill alert-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status_pengambilan == 'pending')
                                            <span class="badge rounded-pill alert-warning">Pending</span>
                                        @else
                                            <span class="badge rounded-pill alert-info">Diterima</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->nominal_bayar == null)
                                            <a href="{{ route('e-apotek.update',$item->id) }}">Update Pembayaran</a><br>
                                            <small class="text-muted" style="font-size: 10px">Pending</small>
                                        @else
                                        <b> Rp. {{ number_format($item->nominal_bayar,2, ",", ".") }}</b>
                                        @endif
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
