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


    </script>
    @endpush
    @section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('konsultasi-dokter.hasil.post') }}" method="POST">
                            @csrf
                            <input type="text" name="kode_transaksi" id="kode_transaksi" value="{{ $data->kode_pemesanan }}">
                            <div class="mb-3">
                                <label for="">Resep</label>
                                <textarea name="resep_obat" id="" cols="30" rows="10" class="form-control" placeholder="Masukkan resep"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Diagnosa</label>
                                <textarea name="kesimpulan" id="" cols="30" rows="10" class="form-control" placeholder="Masukkan diagnosa"></textarea>
                            </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-2">
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
            </div>
        </div>
    </section>
    @endsection
</x-app-layout>
