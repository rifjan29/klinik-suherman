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
    </style>
@endpush
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var id;
            $('.upload-bukti').on('click',function() {
                id = $(this).data('id');
                console.log(id);
                $('#id').val(id);
            })
        })
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
     <section id="pembayaran" class="pembayaran">
        <div class="container" data-aos="fade-up">
            @include('components.notification')
            <div class="metode card shadow border border-dark col-6 offset-2 rounded-3">
                <div class="card-body p-5">
                    <div class="text-center">
                        <h2 class="fw-bold mb-3">Pembayaran E-Konsultasi</h2>
                        <span class="">Harap menyelesaikan pembayaran terlebih dahulu</span>
                    </div><br>
                    <div class="p-3 mt-5">
                        <div class="d-flex mb-3">
                            <div class="fs-6 fw-bold">Metode Pembayaran</div>
                            <div class="ms-auto fw-6">
                                <img style="width: 70px; height:50px;" src="{{ $data->foto != null ? asset('img/bank/'.$data->foto) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                            </div>
                        </div>
                        <div class="fs-6 fw-bold" style="color: rgb(172, 172, 172)">Nomor Rekening</div>
                        <div class="d-flex mb-3 mt-4">
                            <div class="fs-6 fw-bold" id="teks-element">{{ $data->no_rekening }}</div>
                            <div class="ms-auto fw-6">
                                <button class="border border-1" id="salin-button">salin</button>
                            </div>
                        </div><br>
                        <div class="text-center mt-5 p-3">
                            <div class="fs-4 fw-bold mb-3">Total Pembayaran</div>
                            <div class="ms-auto fw-bold fs-4" style="color:#F4A223;">Rp. {{ number_format($data->total_nominal,2, ",", ".") }}</div>
                        </div>
                    </div>
                    {{-- <a class="btn btn-primary btn-next mt-3 float-end" href="" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Upload Bukti</a> --}}
                    <a class="btn btn-primary mt-3 float-end upload-bukti" data-id="{{ $data->id }}" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Upload Bukti</a>

                </div>
            </div>
        </div>
    </section>
    <!-- End ambulance Section -->

    <!-- Start Modal Upload BUkti -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="p-4">
                        <div class="text-center">
                            <form action="{{ route('pembayaran.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="id" id="id" readonly hidden>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label fw-bold">Upload Bukti</label>
                                    <input class="form-control mt-2" type="file" id="formFile" name="file">
                                </div>
                                <button type="submit" class="btn btn-primary mt-4" >Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Upload BUkti -->
@endsection
