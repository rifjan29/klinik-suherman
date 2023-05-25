@extends('layouts.template')
@push('css')
    <style>
        #hero {
            width: 100%;
            height: 10vh !important;
            background: #37517e;
        }
        .btn-primary {
            background-color: #37517e;
            border: none;
            font-size: 14px;
        }
        .card-dokter .card{
            border: 1px solid #000;
        }
        .card-footer{
            border-top: 1px solid #000;
            background-color: #fff;

        }
        .card-dokter .card-header {
            border-bottom: 1px solid #000;
            background-color: #fff;
        }
        .card-header h4{
            color: #001D4F;
        }
        .bg-primary{
            background-color: #001D4F !important;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/vertikal.css') }}">
@endpush
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

        })

    </script>
    <script>
        // Mendapatkan referensi ke elemen tombol salin
        var salinButton = document.getElementById("salin-button");

        // Mendapatkan referensi ke elemen teks yang ingin disalin
        var teksElement = document.getElementById("teks-element");

        // Menambahkan event listener pada tombol salin
        salinButton.addEventListener("click", function() {
            // Mendapatkan teks dari elemen teks
            var teks = teksElement.innerText;

            // Periksa apakah browser mendukung metode navigator.clipboard.writeText()
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(teks)
                .then(function() {
                    alert("Teks berhasil disalin ke clipboard.")
                    console.log("Teks berhasil disalin ke clipboard.");
                })
                .catch(function(error) {
                    alert("Gagal menyalin teks ke clipboard: ", error)
                    console.error("Gagal menyalin teks ke clipboard: ", error);
                });
            } else {
                // Fallback untuk browser yang tidak mendukung metode navigator.clipboard.writeText()
                var textarea = document.createElement("textarea");
                textarea.value = teks;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand("copy");
                document.body.removeChild(textarea);
                console.log("Teks berhasil disalin ke clipboard.");
            }
        });

    </script>
@endpush
@section('hero')
    <section id="hero" class="d-flex align-items-center">
    </section>
@endsection
@section('content')
     <!-- ======= ambulance Section ======= -->
     <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                @include('components.notification')
            </div>
            <div class="row content">
                <div class="row justify-content-center my-5">
                    <div class="col-md-8 card-dokter">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="fw-bold text-center">Pembayaran E-Apotek</h4>
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <p>Status Resep</p>
                                    </div>
                                    <div class="mx-2">
                                        @if ($transaksiObat->status == 'pending')
                                            <span class="badge bg-primary">Pending</span>
                                        @elseif ($transaksiObat->status == 'lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    @php
                                            $data_dokter =  App\Models\PemesananKonsultasi::select('pemesanan_konsultasi.id as id_konsultasi','pemesanan_konsultasi.id_dokter','pemesanan_konsultasi.kode_pemesanan',
                                                                'dokter.id as iddokter',
                                                                'dokter.nama_dokter','dokter.no_sip')
                                                            ->join('dokter','dokter.id','pemesanan_konsultasi.id_dokter')
                                                            ->where('pemesanan_konsultasi.kode_pemesanan',$transaksiObat->kode_transaksi_konsultasi)
                                                            ->first();
                                    @endphp
                                    <div>
                                        <div class="d-flex flex-column">
                                            <div><p>Nama Dokter</p></div>
                                            <div><p>SIP</p></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div><p>{{ ucwords($data_dokter->nama_dokter) }}</p></div>
                                        <div><p>{{ $data_dokter->no_sip }}</p></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="p-5">
                                    <div class="d-flex mb-3">
                                        <div class="fs-6 fw-bold">Metode Pembayaran</div>
                                        <div class="ms-auto fw-6">
                                            <img style="width: 70px; height:50px;" src="{{ $transaksiObat->foto != null ? asset('img/bank/'.$transaksiObat->foto) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                                        </div>
                                    </div>
                                    <div class="fs-6 fw-bold" style="color: rgb(172, 172, 172)">Nomor Rekening</div>
                                    <div class="d-flex mb-3 mt-4">
                                        <div class="fs-6 fw-bold" id="teks-element">{{ $transaksiObat->no_rekening }}</div>
                                        <div class="ms-auto fw-6">
                                            <button class="border border-1" id="salin-button">salin</button>
                                        </div>
                                    </div><br>
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

                                    <div >
                                        <button class="btn btn-primary" type="submit">Bayar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p class="text-center fw-bold p-0 m-0" style="font-size: 12px">*Lakukan pembayaran secara online terlebih dahulu kemudian upload bukti pembayaran </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->

@endsection
