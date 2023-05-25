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

        .search {
            width: 65%;
            margin: 35px auto;
        }

        .has-search .form-control {
            padding-left: 3rem;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 50px;
            height: 50px;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #37517e;
            margin-top: 10px;
        }

        .card-header .img-dokter {
            width: 4rem;
            margin-bottom: 10px;
        }

        .massage-pasien {
            background-color: #CDF4D8;
        }

        .massage-dokter {
            background-color: white;
        }
    </style>
@endpush
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
    <script>
        var suka=null;
        $('.like').on('click',function() {
            suka = $(this).data('id');
            alert(suka);
        })
        $('#proses-konsultasi').on('click',function() {
            var ulasan = $('.ulasan').val();
            var kode_transaksi = $('#kode').val();
            var id_pasien = $('#sender_id').val();
            var id_dokter = $('#receiver_id').val();
            console.log(`${ulasan}=${suka}=${kode_transaksi}`);
            $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $.ajax({
                url:`{{ route('hasil.post') }}`,
                method:'POST',
                data:{
                    suka:suka,
                    kode:kode_transaksi,
                    ulasan:ulasan,
                    id_pasien:id_pasien,
                    id_dokter:id_dokter,
                },
                success:function(data){
                    window.location.href = data;
                }
            })
        })
        $('#keluar').on('click',function() {
            $('#exampleModal').modal('show');
        })
        hitungMundur();

        function hitungMundur() {
            var countdownElem = document.getElementById("countdown");

            var waktuSisa = 30 * 60; // Konversi menit ke detik
            // var waktuSisa = 3; // Konversi menit ke detik

            var timer = setInterval(function() {
                var menit = Math.floor(waktuSisa / 60);
                var detik = waktuSisa % 60;

                menit = menit < 10 ? "0" + menit : menit;
                detik = detik < 10 ? "0" + detik : detik;

                countdownElem.textContent = menit + ":" + detik;

                if (waktuSisa <= 0) {
                clearInterval(timer);
                    // countdownElem.textContent = "Hitung mundur selesai!";
                    $('#exampleModal').modal('show');

                } else {
                    waktuSisa--;
                }
            }, 1000);

        }

    </script>
    <script>
        $(document).ready(function() {
            var id = $('#kode_transaksi').val();
            loadMessages(id);
            // Mengirim pesan
            $('#chat-form').on('click', function(e) {
            // $('#chat-form').submit(function(e) {
                e.preventDefault();
                var sender_id = $('#sender_id').val();
                var receiver_id = $('#receiver_id').val();
                var message = $('#message').val();
                var kode = $('#kode').val();
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: `{{ route('pesan.post') }}`,
                    method: 'POST',
                    data: {
                        sender_id: sender_id,
                        receiver_id: receiver_id,
                        message: message,
                        kode: kode,
                    },
                    success: function(response) {
                        // $("#chat-messages").scrollBottom($("#chat-messages")[0].scrollHeight);
                        $('#message').val('');
                        var id = $('#kode_transaksi').val();
                        loadMessages(id); // Memuat pesan-pesan terbaru setelah mengirim pesan

                    }
                });


            });
            // Memuat pesan-pesan secara berkala
            setInterval(function() {
                var id = $('#kode_transaksi').val();

                loadMessages(id);
            }, 5000); // Memuat pesan setiap 5 detik
        });
        function loadMessages(id) {
            $.ajax({
                url: `{{ route('pesan.get') }}`,
                data:{
                    id:id
                },
                method: 'GET',
                success: function(response) {
                    var messages = response;

                    var chatMessages = $('#chat-messages');
                    chatMessages.empty();

                    $.each(messages, function(key, message) {
                        if (message.pesan_pasien != null) {
                            var pasien = $(' <div id="pasien">');
                            pasien.append(`
                                <div class="d-flex flex-row-reverse mb-3">
                                    <div class="massage-pasien card border-0 shadow">
                                        <div class="card-body">
                                            <div class="text-end">
                                                ${ message.pesan_pasien }
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        }
                        chatMessages.append(pasien);
                        if (message.pesan_dokter != null) {
                            var dokter = $(`
                                <div class="d-flex flex-row mb-3">
                                    <div class="massage-dokter card border-0 shadow">
                                        <div class="card-body">
                                            <div class="text-start">
                                               ${ message.pesan_dokter }
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `)

                            chatMessages.append(dokter);
                        }

                    });
                }
            });
        };
    </script>
@endpush
@section('hero')
    <section id="hero" class="d-flex align-items-center">
    </section>
@endsection
@section('content')
     <!-- ======= konsultasi Section ======= -->
     <section id="services" class="services">
        <div class="container text-center" data-aos="fade-up">
            <div class="section-title">
                <h2>E-Konsultasi</h2>
                <input type="text" name="kode_transaksi" id="kode_transaksi" value="{{ $data->kode_pemesanan }}">
            </div>
            <div class="card mt-3 shadow">
                <div class="card-header shadow">
                    <div class="row">
                        <div class="py-2 px-4 d-none d-lg-block">
                            <div class="d-flex align-items-center py-1">
                                <div class="position-relative">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="50" height="50">
                                </div>
                                <div class="flex-grow-1 pl-3 text-start mx-3">
                                    <strong>{{ ucwords($data->nama_pasien) }}</strong>
                                    {{-- <div class="text-muted small"><i class="fa-solid fa-circle fa-2xs" style="color: #1DEA4A;"></i><em> Online</em></div> --}}
                                </div>
                                <div>
                                    <h1 id="countdown">30:00</h1>
                                    <button class="btn btn-danger btn-sm mr-1 px-3" id="keluar">Keluar Chat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body-content" style="height:500px; width:auto; overflow:auto; padding:3%; background-color: #EFEFEF;">
                    <div class="content-message" id="chat-messages">
                        <div id="pasien">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="flex-grow-0 py-3 px-4">
                        {{-- <form id="chat-form"> --}}
                            <input type="hidden" id="sender_id" value="{{ $data->id_pasien_konsultasi }}">
                            <input type="hidden" id="receiver_id" value="{{ $data->id_dokter }}">
                            <input type="hidden" id="kode" value="{{ $data->kode_pemesanan }}">
                            <div class="input-group">
                                <input type="text" id="message" class="form-control" placeholder="Ketik Pesan.......">
                                <button class="btn btn-primary" id="chat-form">Kirim</button>
                            </div>
                        {{-- </form> --}}
					</div>
                </div>
            </div>

        </div>
    </section>
    <div
        class="modal fade"
        id="exampleModal"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <p class="fw-bold text-center"> Bagaimana Pengalaman Konsultasi Kamu?</p>
                    <div class="d-flex justify-content-center">
                        <div class="p-3">
                            <img src="{{ asset('frontend/assets/img/plus.png') }}" value="5" alt="" class="img-fluid like" data-id="5" width="40" height="40">
                            <p> Suka</p>
                        </div>
                        <div class="p-3">
                            <img src="{{ asset('frontend/assets/img/minus.png') }}" value="1" alt="" class="img-fluid like" data-id="1" width="40" height="40">
                            <p>Tidak Suka</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Ulasan Anda</label>
                        <textarea name="ulasan" id="ulasan cols="4" rows="4" class="form-control ulasan" placeholder="Masukkan ulasan" "></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="proses-konsultasi">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End konsultasi Section -->
@endsection
