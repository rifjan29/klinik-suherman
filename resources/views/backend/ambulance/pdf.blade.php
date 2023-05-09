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
                <h5 class="fw-bold">Laporan Transaksi E-Ambulance</h5>
                <p>Dari Tanggal : {{ \Carbon\Carbon::parse(Session::get('dari'))->translatedFormat('d F Y ') }}, Sampai Tanggal : {{ \Carbon\Carbon::parse(Session::get('sampai'))->translatedFormat('d F Y ') }}</p>
                <hr>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pesanan</th>
                            <th>Nama Pasien</th>
                            <th scope="col">Tanggal Pesanan</th>
                            <th scope="col">Tanggal Jemput</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th>Total Biaya</th>
                            <th scope="col" class="text-start">Tanggal Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
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
                                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y ') }} <br> <small class="text-muted" style="font-size: 11px">Jam {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('h:i:s A') }}</small>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        print()
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
