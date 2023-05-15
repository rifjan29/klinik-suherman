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
        </style>
    @endpush
    <section class="content-main">
        <div class="content-header">
            <!-- Button trigger modal -->
            <div>
                <h2 class="content-title card-title">Dashboard</h2>
                <p>Selamat Datang  {{ auth()->user()->name }}, di aplikasi Klinik Rawat Inap DR. SUHERMAN</p>

            </div>

        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-green-soft-light"><i class="text-green-soft material-icons md-person"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Data Pasien</h6>
                            <span>{{ $dataPasien }}</span>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-airport_shuttle"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Data Ambulance</h6>
                            <span>{{ $riwayatAmbulance }}</span>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-add_alert"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Data Konsultasi</h6>
                            <span>$13,456.5</span>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-airplay"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Data Akun</h6>
                            <span>{{ $dataAkun }}</span>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Total Pendapatan E-Ambulance</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Total Pendapatan E-Konsultasi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Total Pendapatan E-Apotek</button>
                    </li>
                </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card mb-4">
                            <article class="card-body">
                                <h5 class="card-title">Total Pendapatan E-Ambulance</h5>
                                <canvas id="myChart" height="120px"></canvas>
                            </article>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card mb-4">
                            <article class="card-body">
                                <h5 class="card-title">Total Pendapatan E-Konsultasi</h5>
                                <canvas id="myChart" height="120px"></canvas>
                            </article>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="card mb-4">
                            <article class="card-body">
                                <h5 class="card-title">Total Pendapatan E-Konsultasi</h5>
                                <canvas id="myChart" height="120px"></canvas>
                            </article>
                        </div>
                    </div>
                  </div>

            </div>
        </div>

    </section>
    @endsection
</x-app-layout>
