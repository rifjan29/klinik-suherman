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
                <p>Selamat di aplikasi Klinik Rawat Inap DR. SUHERMAN</p>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-body mb-4">
                    <article class="icontext">
                        <span class="icon icon-sm rounded-circle bg-green-soft-light"><i class="text-green-soft material-icons md-person"></i></span>
                        <div class="text">
                            <h6 class="mb-1 card-title">Data Pasien</h6>
                            <span>$13,456.5</span>
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
                            <span>$13,456.5</span>
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
                            <span>$13,456.5</span>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-4">
                    <article class="card-body">
                        <h5 class="card-title">Total Pendapatan</h5>
                        <canvas id="myChart" height="120px"></canvas>
                    </article>
                </div>
            </div>
        </div>

    </section>
    @endsection
</x-app-layout>
