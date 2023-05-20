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
        $(document).ready(function() {
            var id = $('#kode_transaksi').val();
            console.log(id);
            loadMessages(id);
            // Mengirim pesan
            $('#chat-form').on('click', function(e) {
            // $('#chat-form').submit(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: `{{ route('konsultasi-dokter.chat.post') }}`,
                    method: 'POST',
                    data: {
                        sender_id: $('#sender_id').val(),
                        receiver_id: $('#receiver_id').val(),
                        message: $('#message').val(),
                        kode: $('#kode').val(),
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
                url: `{{ route('konsultasi-dokter.chat.get') }}`,
                data:{
                    id:id
                },
                method: 'GET',
                success: function(response) {
                    var messages = response;

                    var chatMessages = $('#chat-messages');
                    chatMessages.empty();

                    $.each(messages, function(key, message) {
                        var createdAt = moment(message.created_at).format('h:mm A')
                        if (message.pesan_pasien != null) {
                            var pasien = $('<li class="sender">');
                            pasien.append(`
                                <p> ${message.pesan_pasien} </p>
                                <span class="time">${createdAt}</span>
                            `);
                        }
                        chatMessages.append(pasien);
                        if (message.pesan_dokter != null) {
                            var dokter = $(`
                                <li class="repaly">
                                    <p>${message.pesan_dokter}</p>
                                    <span class="time">${createdAt}</span>
                                </li> --}}
                            `)

                            chatMessages.append(dokter);
                        }

                    });
                }
            });
        };
    </script>
    <script>
        hitungMundur();

        $('#proses-konsultasi').on('click',function() {
            var id = $('#kode_transaksi').val();
            $.ajax({
                success:function(data) {
                    window.location.href = `{{ route('konsultasi-dokter.hasil.get',$data->kode_pemesanan) }}`;
                }
            })
        })
        function hitungMundur() {
            var countdownElem = document.getElementById("countdown");

            var waktuSisa = 3; // Konversi menit ke detik

            var timer = setInterval(function() {
                var menit = Math.floor(waktuSisa / 60);
                var detik = waktuSisa % 60;

                menit = menit < 10 ? "0" + menit : menit;
                detik = detik < 10 ? "0" + detik : detik;

                countdownElem.textContent = menit + ":" + detik;

                if (waktuSisa <= 0) {
                clearInterval(timer);
                    $('#exampleModalChat').modal('show');
                } else {
                    waktuSisa--;
                }
            }, 1000);

        }

    </script>
    @endpush
    @section('content')
    <section class="content-main">
        <div class="card mb-2">
            <header class="card-header">
                <div class="d-flex justify-content-end">
                    <h1 id="countdown">30:00</h1>
                </div>
            </header>
            <div class="card-body">
                <section class="message-area">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="chat-area">
                                    <!-- chatlist -->

                                    <!-- chatbox -->
                                    <div class="chatbox">
                                        <div class="modal-dialog-scrollable" id="modal-dialog">
                                            <div class="modal-content">
                                                <div class="msg-head">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <div class="d-flex align-items-center">
                                                                <span class="chat-icon"><img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg" alt="image title"></span>
                                                                <div class="flex-shrink-0">
                                                                    <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/user.png" alt="user img">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h3>{{ ucwords($data->nama_pasien) }}</h3>
                                                                    <input type="text" id="kode_transaksi" value="{{ $data->kode_pemesanan }}">
                                                                    <p>{{ $data->gender == 'L' ? 'Laki-Laki ' : 'Perempuan' }}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="msg-body">
                                                        <ul id="chat-messages">

                                                            {{-- <li class="repaly">
                                                                <p>yes!</p>
                                                                <span class="time">10:20 am</span>
                                                            </li> --}}


                                                        </ul>
                                                    </div>
                                                </div>


                                                <div class="send-box">
                                                    <form action="">
                                                        <input type="text" class="form-control" aria-label="message…" placeholder="Write message…" id="message">
                                                        <input type="hidden" id="sender_id" value="{{ $data->id_pasien_konsultasi }}">
                                                        <input type="hidden" id="receiver_id" value="{{ $data->id_dokter }}">
                                                        <input type="hidden" id="kode" value="{{ $data->kode_pemesanan }}">
                                                        <button id="chat-form" class="btn btn-primary"><i class="text-muted material-icons md-send"></i>Kirim</button>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- chatbox -->


                            </div>
                        </div>
                    </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <div
        class="modal fade"
        id="exampleModalChat"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <p class="fw-bold text-center"> Konsultasi telah selesai !  </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="proses-konsultasi">Selesai</button>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
