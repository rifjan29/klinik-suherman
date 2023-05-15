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
            $('#status_non_aktif').click(function() {
                if($('#status_non_aktif').is(':checked')) {
                    $('#keterangan').removeClass('active-ket')
                 }
            });
            $('#status_aktif').click(function() {
                if($('#status_aktif').is(':checked')) {
                    $('#keterangan').addClass('active-ket')
                 }
            });
            var id;
            $('.gantiStatus').on('click',function() {
                id = $(this).data('id');
                $('#id').val(id);
                $.ajax({
                    url:`{{ route('konsultasi.get') }}`,
                    type: 'GET',
                    data:{
                        id:id
                    },
                    success: function(data) {
                        console.log(data);
                        $.each(data, function (key, value) {
                            console.log(value);
                            $('#kode_transaksi').val(value.kode_pemesanan);
                            $('#nama').val(value.nama_pasien);
                        //     $('#nama').val(value.nama)
                        //     if (value.status == 'aktif') {
                        //         $('#status_aktif').prop('checked',true);
                        //         $('#status_aktif').attr('checked', 'checked')
                        //     } else if(value.status == 'non-aktif'){
                        //         $('#status_non_aktif').prop('checked',true);
                        //         $('#status_non_aktif').attr('checked', 'checked')
                        //     }
                        })
                    }
                })

            })
        })
    </script>
    @endpush
    @section('content')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(3))) }}</h2>
            <div>
                <a href="{{ route('konsultasi.riwayat') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Riwayat Pesanan</a>
            </div>
        </div>
        @include('components.notification')
        <div class="card mb-4">
            <div class="card-body">
                {{-- @if (auth()->user()->role == 'petugas')
                    ini petugas
                @else
                    ini bukan petugas
                @endif --}}
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
                                        <button class="btn btn-sm font-sm rounded btn-brand gantiStatus" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#gantiStatus"> <i class="material-icons md-edit"></i> Update Pembayaran </button>
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
        <div class="modal fade" id="gantiStatus" tabindex="-1" aria-labelledby="gantiStatusLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" >Update Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="id" id="id" hidden>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Kode Transaksi</label>
                                    <input placeholder="Kode Transaksi" value="" readonly type="text" value="{{ old('kode_transaksi') }}" class="form-control @error('kode_transaksi') is-invalid @enderror" name="kode_transaksi" id="kode_transaksi" />
                                    @error('kode_transaksi')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Nama Pasien</label>
                                    <input placeholder="Masukkan Nama Pasien" readonly type="text" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" />
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="product_name" class="form-label">Status</label>
                                <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                    <input class="form-check-input" id="status_aktif" name="status" value="lunas" {{ old('status') == 'aktif' ? "checked" : '' }} type="radio">
                                    <span class="form-check-label"> Lunas </span>
                                </label>
                                <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                    <input class="form-check-input" id="status_non_aktif" name="status" value="ditolak" {{ old('status') == 'non-aktif' ? "checked" : '' }} type="radio">
                                    <span class="form-check-label"> Ditolak </span>
                                </label>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{$message}}.
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 active-ket" id="keterangan">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Keterangan</label>
                                    <textarea name="ket" id="ket" cols="30" rows="10" class="form-control" placeholder="Masukkan alasan otorisasi"></textarea>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </section>
    @endsection
</x-app-layout>
