<x-app-layout>
    @section('content')
    @push('js')
    <script src="{{ asset('') }}backend/assets/js/custom-chart.js" type="text/javascript"></script>
    @endpush
    @push('css')
        <style>
            .bg-info-light{
                background-color: #b9d3f556 !important;
            }
            .bg-green-soft-light{
                background-color: #b2f0e958;
            }
            .text-green-soft-light{
                color: #2a9d8f !important;
            }
            .form-switch .form-check-input{
                margin-left: 0;
                width: 6rem;
                height: 40px;
            }
            .form-check-input.sibuk:checked{
                background-color: red;
            }
        </style>
    @endpush
    <section class="content-main">
        <div class="content-header">
            <!-- Button trigger modal -->
            <div>
                <h2 class="content-title card-title">Dashboard Dokter</h2>
                <p>Selamat Datang  {{ auth()->user()->name }}, di aplikasi Klinik Rawat Inap DR. SUHERMAN</p>

            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row p-3">
                            <div class="col-md-4">
                                <div class="d-flex">
                                    <div class="align-self-center">
                                        <h3>Sibuk</h3>
                                    </div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input sibuk" type="checkbox" id="flexSwitchCheckChecked" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex">
                                    <div class="align-self-center">
                                        <h3>Online</h3>
                                    </div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex">
                                    <div class="align-self-center">
                                        <h3>Offline</h3>
                                    </div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
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
    @endsection
</x-app-layout>
