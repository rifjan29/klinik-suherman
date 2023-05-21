<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="{{ asset('backend/assets/css/chat.css') }}">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        })
    </script>
    <script>
    </script>
    <script>


    </script>
    @endpush
    @section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <header class="card-header">
                        <h4>Detail Hasil Konsultasi</h4>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered table-responsive-sm">
                                    <tr>
                                        <td width="20%">Kode Transaksi</td>
                                        <td width="1%">:</td>
                                        <td >{{ $data->kode_pemesanan }}</td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Nama Pasien</td>
                                        <td width="1%">:</td>
                                        <td >{{ $data->nama_pasien }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered table-responsive-sm">
                                    <tr>
                                        <td width="20%">Nama Dokter</td>
                                        <td width="1%">:</td>
                                        <td >{{ $data->nama_dokter }}</td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Tarif</td>
                                        <td width="1%">:</td>
                                        <td >Rp. {{ number_format($data->total_nominal,2, ",", ".") }}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="">Resep</label>
                            <textarea name="resep_obat" id="" cols="30" rows="10" class="form-control" placeholder="Masukkan resep" readonly>{{ $data->resep_obat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Diagnosa</label>
                            <textarea name="kesimpulan" id="" cols="30" rows="10" class="form-control" placeholder="Masukkan diagnosa" readonly>{{ $data->kesimpulan }} </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
</x-app-layout>
