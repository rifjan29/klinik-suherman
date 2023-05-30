<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Versi Cetak</title>
    <style>

        @media print {
            @page {
                size: A3 landscape;
                padding: 10px
                    /* margin-bottom: 2cm; */
            }

            table {
                width: 100%;
            }
            * {
                -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
                color-adjust: exact !important;                 /*Firefox*/     /*Firefox*/
            }
            html,
            body {
                width: 100%;
                height: max-content;
            }

            .card{
                padding: 0;
            }
            .card-body{
                padding: 0 10px 0 10px;
            }
            .no-print, .no-print *
            {
                display: none !important;
            }
        /* ... the rest of the rules ... */
        }
    </style>
  </head>
  <body>
    <section id="pembayaran" class="pembayaran">
        <div class="container-fluid mt-5" data-aos="fade-up">
            <div class="d-flex justify-content-end mb-3">
                <button onclick="history.back()" class="btn btn-primary no-print">Kembali</button>
            </div>
            <div class="mb-3 text-center">
                <h5 class="fw-bold">Laporan Mutu E-Apotek</h5>
                <hr>
            </div>
            <div class="" style="
                display: flex;
                justify-content: center;
                align-items: center;
                ">
                <div class="card w-50" style="border: 1px solid #000; ">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Total Penjualan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_obat }}</td>
                                            <td>{{ $item->total }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <canvas id="myChart" height="100px"></canvas>
                </div>
            </div>
            <div class="card d-flex justify-content-end w-25 mt-4" style="background-color: #D9D9D9">
                <div class="card-body p-3">
                    <p class="m-0">Dari Tanggal : {{ \Carbon\Carbon::parse(Session::get('dari'))->translatedFormat('d F Y ') }} <br> Sampai Tanggal : {{ \Carbon\Carbon::parse(Session::get('sampai'))->translatedFormat('d F Y ') }}</p>
                </div>
            </div>

        </div>
    </section>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('') }}backend/assets/js/vendors/chart.js"></script>
    @if (isset($_GET['xls']))
    @php
            $name = 'Laporan Transaksi E-Apotek ' . date('d-m-Y', strtotime($_GET['dari'])).' s/d '.date('d-m-Y', strtotime($_GET['sampai'])).'.xls';
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=$name");
        @endphp
    @else
        <script>
            var obatLabels = {!! json_encode($data->pluck('nama_obat')) !!};
            var jumlahData = {!! json_encode($data->pluck('total')) !!};

            (function ($) {
                    "use strict";

                    /*Sale statistics Chart*/
                    if ($('#myChart').length) {
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var chart = new Chart(ctx, {
                            // The type of chart we want to create
                            type: 'bar',

                            // The data for our dataset
                            data: {
                            labels: obatLabels,
                            datasets: [{
                                label: 'Jumlah',
                                data: jumlahData,
                                backgroundColor: 'rgba(55, 81, 126, 1)',
                                borderColor: 'rgba(55, 81, 126, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            plugins:{
                                legend:{
                                    display: true,
                                    position: 'top',
                                    align: 'start',
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    precision: 0
                                }
                            }
                        }
                        });
                    } //End if


                })(jQuery)
                ;
        </script>
        <script>
            window.print()
        </script>
    @endif
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
