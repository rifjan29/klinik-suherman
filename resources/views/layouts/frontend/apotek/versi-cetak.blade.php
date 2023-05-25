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
        @page {
                size: A4;
                margin: 0;
        }
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
                color-adjust: exact !important;                 /*Firefox*/     /*Firefox*/
            }
            html, body {
                width: 210mm;
                height: 297mm;
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
        <div class="container mt-5" data-aos="fade-up">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('list.apotek') }}" class="btn btn-primary no-print">Kembali</a>
                    </div>
                    <div class="card shadow border border-dark rounded-3">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between">
                                <h4 class="fw-bold">Nota Pembayaran</h4>
                                {{ $transaksiObat->kode_transaksi }}
                            </div>

                            <p class="mt-4 fw-bold" style="font-size: 16px">Perhatian!</p>
                            <p class="fw-bold fs-normal" style="font-size: 14px; color: #0D5822">Cetak tagihan pembayaran ini kemudian tunjukkan kepada kasir di Klinik Suherman</p>
                            <div class="card mt-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div><h5 class="fw-bold">R/</h5></div>
                                        <div>
                                            {{ \Carbon\Carbon::parse($transaksiObat->created_at)->translatedFormat('d F Y ') }}
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        @php
                                            $obat = \App\Models\DetailTransaksiObat::select('detail_transaksi_pemesanan_obat.*','obat.nama_obat','obat.harga')
                                                                                    ->join('obat','obat.id','detail_transaksi_pemesanan_obat.id_obat')
                                                                                    ->where('detail_transaksi_pemesanan_obat.id_transaksi_obat',$transaksiObat->id)
                                                                                    ->get();
                                        @endphp
                                        <div class="card" name="" class="form-control" id="" cols="30" rows="10">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Obat</th>
                                                        <th>Qty</th>
                                                        <th>Harga Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($obat as $item)
                                                        <tr>
                                                            <td >{{ $item->nama_obat }}</td>
                                                            <td>{{ $item->qty }}</td>
                                                            <td>{{ $item->harga }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-content-between mt-3">
                                                <div>
                                                    <h6>Keterangan Biaya-Biaya :</h6>
                                                </div>
                                                @php
                                                    $lainnya = $transaksiObat->harga_lainnya != null ? $transaksiObat->harga_lainnya : 0;
                                                    $embalase = $transaksiObat->harga_embalase != null ? $transaksiObat->harga_embalase : 0;
                                                    $biaya = $lainnya + $embalase;
                                                @endphp
                                                <div>
                                                    <h6 class="fw-bold">Rp. {{ number_format($biaya,2, ",", ".") }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between px-5 mt-4">
                                        <div>
                                            <div class="d-flex flex-column">
                                                <h6>Total Pembayaran</h6>
                                                <h5 class="text-warning fw-bold">Rp. {{ number_format($transaksiObat->nominal_bayar,2, ",", ".") }}</h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
