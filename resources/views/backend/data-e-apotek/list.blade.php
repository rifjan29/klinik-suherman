<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        })
    </script>
    <script>
        $(function() {
            $('input[name="jam_kerja"]').daterangepicker({
                timePicker: true,

                locale: {
                    format: 'LT'
                }
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $('#status_non_aktif').click(function() {
                if($('#status_non_aktif').is(':checked')) {
                    $('#keterangan').removeClass('active-ket')
                    $('#tanggal').addClass('active-ket')

                 }
            });
            $('#status_aktif').click(function() {
                if($('#status_aktif').is(':checked')) {
                    $('#keterangan').addClass('active-ket')
                    $('#tanggal').removeClass('active-ket')
                 }
            });
            var id;
            $('.gantiStatus').on('click',function() {
                id = $(this).data('id');
                $('#id').val(id);
                $.ajax({
                    url:`{{ route('e-apotek.list.detail') }}`,
                    type: 'GET',
                    data:{
                        id:id
                    },
                    success: function(data) {
                        $.each(data, function (key, value) {
                            var img = `{{ asset('') }}img/foto-bukti-pembayaran-apotek/${value.foto_pembayaran}`
                            $('#foto_bukti').attr("src", `${img}`);
                            $('#kode_transaksi').val(value.kode_transaksi);
                            $('#nama').val(value.nama);
                        })
                    }
                })

            })

            $('.gantiPengambilan').on('click',function() {
                var id_pengambilan = $(this).data('id');
                $('#id').val(id_pengambilan);
                console.log(id_pengambilan);
                $.ajax({
                    url:`{{ route('e-apotek.list.detail') }}`,
                    type: 'GET',
                    data:{
                        id:id_pengambilan
                    },
                    success: function(data) {
                        console.log(data);
                        $.each(data, function (key, value) {
                            $('#kode_transaksi_pengambilan').val(value.kode_transaksi);
                            $('#nama_pengambilan').val(value.nama);
                        })
                    }
                })

            })
        })
    </script>
    <script>
        $(function() {
            $('input[name="jam_kerja"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: true,
                startDate:  moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'YY-MM-DD hh:mm:ss'
                }
            });
        });

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
                                                @if ($item->foto_pembayaran != null)
                                                    <a href="#" class="btn btn-primary gantiStatus" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#gantiStatus">Verifikasi Pembayaran</a> <br>
                                                    <b class="text-muted"> Total : Rp. {{ number_format($item->nominal_bayar,2, ",", ".") }}</b>
                                                @else
                                                    <small class="text-muted">Menunggu pasien upload pembayaran</small>
                                                @endif
                                            @endif
                                            {{-- <span class="badge rounded-pill alert-warning">Pending</span> --}}
                                        @elseif ($item->status == 'lunas')
                                            <span class="badge rounded-pill alert-info">Lunas</span>
                                        @else
                                            <a href="#" class="btn btn-danger gantiStatus" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#gantiStatus">Verifikasi Pembayaran</a> <br>
                                            <b class="text-muted"> Total : Rp. {{ number_format($item->nominal_bayar,2, ",", ".") }}</b>
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
                                        @if ($item->status == 'lunas')
                                            <a class="gantiPengambilan" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#gantiPengambilan">Update Pengambilan Obat  </a><br>
                                            <small class="text-muted" style="font-size: 10px">Pending</small>
                                        @else
                                             <b> Rp. {{ number_format($item->nominal_bayar,2, ",", ".") }}</b>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Tidak ada data</td>
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
    {{-- update status --}}
    <div class="modal fade" id="gantiStatus" tabindex="-1" aria-labelledby="gantiStatusLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" >Update Pembayaran</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('transaksi-obat.data-obat.update') }}" method="POST">
                    @csrf
                    {{-- $(this).attr("src", "images/card-front.jpg"); --}}
                    <p>Foto bukti pembayaran</p>
                    <img src="{{ asset('backend/assets/imgs/brands/brand-1.jpg') }}" alt="Poker Card" class="img-fluid w-25" id="foto_bukti">
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                                <input class="form-check-input" id="status_aktif" name="status" value="lunas" {{ old('status') == 'aktif' ? "checked" : '' }} type="radio" checked>
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
                        <div class="col-md-12 mb-4 tanggal_jemput" id="tanggal">
                            <label for="product_name" class="form-label">Tanggal Pengambilan</label>
                            <input type="text" name="jam_kerja" id="tgl" value="{{ old('jam_kerja') }}" class="form-control @error('jam_kerja') is-invalid @enderror"/>
                            @error('jam_kerja')
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
    {{-- update biaya --}}
    <div class="modal fade" id="gantiPengambilan" tabindex="-1" aria-labelledby="gantiStatusLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" >Update Pengambilan Obat</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('transaksi-obat.data-obat.update-ambil') }}" method="POST">
                    @csrf
                    {{-- $(this).attr("src", "images/card-front.jpg"); --}}
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="id" id="id" hidden>
                            <div class="mb-4">
                                <label for="product_name" class="form-label">Kode Transaksi</label>
                                <input placeholder="Kode Transaksi" value="" readonly type="text" value="{{ old('kode_transaksi') }}" class="form-control @error('kode_transaksi') is-invalid @enderror" name="kode_transaksi" id="kode_transaksi_pengambilan" />
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
                                <input placeholder="Masukkan Nama Pasien" readonly type="text" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama_pengambilan" />
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
                                <input class="form-check-input" id="status_aktif" name="status" value="lunas" {{ old('status') == 'aktif' ? "checked" : '' }} type="radio" checked>
                                <span class="form-check-label"> Diterima </span>
                            </label>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{$message}}.
                                </div>
                            @enderror
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
    @endsection

</x-app-layout>
