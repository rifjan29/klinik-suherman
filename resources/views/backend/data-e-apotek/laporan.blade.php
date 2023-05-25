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
            .btn-danger{
                background-color: #e63946;
                border: none
            }
            .btn-success{
                background-color: #2a9d8f !important;
                border: none;
                color: #fff;
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
         (function ($) {
                "use strict";

                /*Sale statistics Chart*/
                if ($('#myChart').length) {
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: [
                                @foreach ($data_grafik as $item)
                                    '{{ $item->month_year }}',
                                @endforeach
                                // 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                            ],
                            datasets: [{
                                    label: 'Total Pendapatan',
                                    tension: 0.3,
                                    fill: true,
                                    backgroundColor: 'rgba(44, 120, 220, 0.2)',
                                    borderColor: 'rgba(44, 120, 220)',
                                    data: [
                                        @foreach ($data_grafik as $item)
                                        //  {{ number_format($item->total_biaya,2, ",", ".") }}
                                            {{ $item->total_biaya }},
                                        @endforeach
                                    ]
                                },


                            ]
                        },
                        options: {
                            plugins: {
                            legend: {
                                labels: {
                                usePointStyle: true,
                                },
                            }
                            }
                        }
                    });
                } //End if


            })(jQuery);
    </script>
    <script>
        $(function() {
            $('input[name="sampai"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                locale: {
                    format: 'YY-MM-DD'
                }
            });
            $('input[name="dari"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                locale: {
                    format: 'YY-MM-DD'
                }
            });
        });

    </script>
    @endpush
    @section('content')
    {{-- // @foreach ($total_seluruh as $item)
    //     {{ $item }},
    // @endforeach --}}
    {{-- // @foreach ($data_biaya_tetap_seluruh as $item)
    //     '{{ \Carbon\Carbon::parse($item->period)->translatedFormat('F-Y') }}',
    // @endforeach --}}
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
                <canvas id="myChart" height="70px"></canvas>
            </div>
        </div>
        <div class="card mb-4">
            <header class="card-header">
                <form action="{{ route('e-apotek.laporan') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Sampai Tanggal </label>
                            <input type="text" data-provide="dari" name="dari" value="{{ request('dari') }}" class="form-control dari @error('dari') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan tanggal dari">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Dari Tanggal</label>
                            <input type="text"  name="sampai" value="{{ request('sampai') }}" class="form-control sampai @error('bulan') is-invalid @enderror" id="exampleInputUsername1" placeholder="Masukkan tanggal sampai">

                        </div>
                    </div>
                    <div class="col-md-6 p-0 ">
                        <label for=""></label>
                        <div class="d-flex flex-row">
                            <div>
                                <button type="submit" class="btn btn-primary btn-icon-text ">
                                    <i class="ti-filter btn-icon-prepend"></i>
                                    Filter
                                </button>
                            </div>
                            <div class="mx-2">
                                @if ($cetak != null)
                                    <a href="{{ route('e-apotek.pdf') }}" type="button" class="btn btn-danger btn-icon-text">
                                        <i class="ti-printer btn-icon-prepend"></i>
                                        Cetak PDF
                                    </a>
                                    <a href="{{ route('e-apotek.excel')."?dari=$_GET[dari]&sampai=$_GET[sampai]&xls=true" }}" type="button" class="btn btn-success btn-icon-text">
                                        <i class="ti-printer btn-icon-prepend"></i>
                                        Cetak Excel
                                    </a>
                                    <a href="{{ route('e-apotek') }}" class="btn btn-outline-danger btn-icon-text">
                                        <i class="ti-shift-left btn-icon-prepend"></i>
                                        Reset
                                    </a>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
                </form>
            </header>

        </div>
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
                                <th>Status Pembayaran</th>
                                <th>Status Pesanan</th>
                                <th>Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="input-upload">
                                            <img src="{{ $item->foto_pembayaran != null ? asset('img/foto-bukti-pembayaran-apotek/'.$item->foto_pembayaran) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                                        </div>
                                    </td>
                                    <td>{{ $item->kode_transaksi }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y ') }} <br> </td>
                                    <td>
                                        <span class="badge rounded-pill alert-success">Lunas</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill alert-success">Diterima</span>
                                    </td>
                                    <td>
                                        <b>Rp. {{ number_format($item->nominal_bayar,2, ",", ".") }}</b>
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
