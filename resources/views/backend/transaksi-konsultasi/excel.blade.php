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
            <div class="mb-3 text-center">
                <h5 class="fw-bold">Laporan Transaksi E-Konsultasi</h5>
                <p>Dari Tanggal : {{ \Carbon\Carbon::parse(Session::get('dari'))->translatedFormat('d F Y ') }}, Sampai Tanggal : {{ \Carbon\Carbon::parse(Session::get('sampai'))->translatedFormat('d F Y ') }}</p>
                <hr>
            </div>
            <div class="table-responsive">
                <table class="table table-bondered" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pesanan</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">No. Telp</th>
                            <th>Nama Dokter</th>
                            <th>Total Biaya</th>
                            <th>Nama Bank</th>
                            <th>Status Pembayaran</th>
                            <th scope="col">Tanggal Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucwords($item->kode_pemesanan) }}</td>
                                <td>{{ ucwords($item->nama_pasien) }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->nama_dokter }}</td>
                                <td> Rp. {{ number_format($item->total_nominal,2, ",", ".") }}</td>
                                <td>{{ $item->nama_bank }}
                                    <small class="text-muted">{{ $item->no_rekening }}</small>
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
                                <td>{{ \Carbon\Carbon::parse($item->tgl)->translatedFormat('d F Y ') }} </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Tidak ada data</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @if (isset($_GET['xls']))
    @php
            $name = 'Laporan Transaksi E-Ambulans ' . date('d-m-Y', strtotime($_GET['dari'])).' s/d '.date('d-m-Y', strtotime($_GET['sampai'])).'.xls';
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=$name");
        @endphp
    @else
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
