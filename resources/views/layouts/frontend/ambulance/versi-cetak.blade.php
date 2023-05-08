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
                        <button onclick="history.back()" class="btn btn-primary no-print">Kembali</button>
                    </div>
                    <div class="card shadow border border-dark rounded-3">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between">
                                <h4 class="fw-bold">Metode Pembayaran</h4>
                                {{ $data->kode_pesanan }}
                            </div>
                            <div class="card mt-4" style="background-color:#CEDEF6">
                                <div class="card-body">
                                    <img style="width: 30px; height:30px;" src="{{ asset('') }}frontend/assets/img/lamp.png">
                                    <span class="fw-light align-middle mx-2" style="font-size: 14px">Pesanan kami terima. Silakan unduh struk pembayaran kemudian klik “Next” untuk melihat estimasi perjalanan ambulance.</span>
                                </div>
                            </div>
                            <p class="mt-4 fw-bold" style="font-size: 16px">Perhatian!</p>
                            <p class="fw-bold fs-normal" style="font-size: 14px; color: #0D5822">Cetak tagihan pembayaran ini kemudian tunjukkan kepada kasir di Klinik Suherman</p>
                            <div class="card mt-4">
                                <div class="card-body p-4">
                                    <p class="mt-1 fw-bold" style="font-size: 16px">Ringkasan Pemesanan</p>
                                    <div class="d-flex justify-content-between mt-4">
                                        <p class="mt-1 fw-bold" style="font-size: 14px">Nama Pasien</p>
                                        <p class="mt-1 fw-normal" style="font-size: 14px">{{ ucwords($data->nama_wali) }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between mt-4">
                                        <p class="mt-1 fw-bold" style="font-size: 14px">Total Pesanan</p>
                                        <p class="mt-1 fw-normal" style="font-size: 14px">Rp. {{ number_format($data->nominal,2, ",", ".") }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="fw-bold" style="font-size: 14px">Biaya Layanan</p>
                                        <p class="fw-normal" style="font-size: 14px">{{ $data->biaya_lain != null ? number_format($data->biaya_lain,2, ",", ".") : 'Rp. 0' }}</p>
                                    </div>
                                    <p class="mt-5 fw-bold" style="font-size: 18px">Total Pembayaran</p>
                                    <p class="fw-bold" style="font-size: 18px; color:#FF4D00">Rp. {{ number_format($data->total_biaya,2, ",", ".") }}</p>
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
