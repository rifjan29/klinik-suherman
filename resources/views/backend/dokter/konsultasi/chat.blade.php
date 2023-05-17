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
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        })
    </script>
    <script>
        function hitungMundur() {
        var countdownElem = document.getElementById("countdown");

        var waktuSisa = 30 * 60; // Konversi menit ke detik

        var timer = setInterval(function() {
            var menit = Math.floor(waktuSisa / 60);
            var detik = waktuSisa % 60;

            menit = menit < 10 ? "0" + menit : menit;
            detik = detik < 10 ? "0" + detik : detik;

            countdownElem.textContent = menit + ":" + detik;

            if (waktuSisa <= 0) {
            clearInterval(timer);
            countdownElem.textContent = "Hitung mundur selesai!";
            } else {
            waktuSisa--;
            }
        }, 1000);
        }

        hitungMundur();
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
                                        <div class="modal-dialog-scrollable">
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
                                                                    <h3>Mehedi Hasan</h3>
                                                                    <p>front end developer</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <ul class="moreoption">
                                                                <li class="navbar nav-item dropdown">
                                                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                                        <li>
                                                                            <hr class="dropdown-divider">
                                                                        </li>
                                                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="modal-body">
                                                    <div class="msg-body">
                                                        <ul>
                                                            <li class="sender">
                                                                <p> Hey, Are you there? </p>
                                                                <span class="time">10:06 am</span>
                                                            </li>
                                                            <li class="sender">
                                                                <p> Hey, Are you there? </p>
                                                                <span class="time">10:16 am</span>
                                                            </li>
                                                            <li class="repaly">
                                                                <p>yes!</p>
                                                                <span class="time">10:20 am</span>
                                                            </li>
                                                            <li class="sender">
                                                                <p> Hey, Are you there? </p>
                                                                <span class="time">10:26 am</span>
                                                            </li>
                                                            <li class="sender">
                                                                <p> Hey, Are you there? </p>
                                                                <span class="time">10:32 am</span>
                                                            </li>
                                                            <li class="repaly">
                                                                <p>How are you?</p>
                                                                <span class="time">10:35 am</span>
                                                            </li>
                                                            <li>
                                                                <div class="divider">
                                                                    <h6>Today</h6>
                                                                </div>
                                                            </li>

                                                            <li class="repaly">
                                                                <p> yes, tell me</p>
                                                                <span class="time">10:36 am</span>
                                                            </li>
                                                            <li class="repaly">
                                                                <p>yes... on it</p>
                                                                <span class="time">junt now</span>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>


                                                <div class="send-box">
                                                    <form action="">
                                                        <input type="text" class="form-control" aria-label="message…" placeholder="Write message…">
                                                        {{-- <button type="button"><i class="material-icons md-send" aria-hidden="true"></i> Send</button> --}}
                                                        <button href="{{ route('konsultasi.riwayat') }}" class="btn btn-primary"><i class="text-muted material-icons md-send"></i>Kirim</button>

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
    @endsection
</x-app-layout>
