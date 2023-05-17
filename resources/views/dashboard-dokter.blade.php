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
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">List Konsultasi Online</button>
            </div>

        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <header class="card-header">
                        <h4>Konsultasi Terbaru</h4>
                    </header>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-sm">
                            <tr>
                                <td width="20%">Kode Transaksi</td>
                                <td width="1%">:</td>
                                <td >wqtq</td>
                            </tr>
                            <tr>
                                <td width="20%">Nama Pasien</td>
                                <td width="1%">:</td>
                                <td >wqtq</td>
                            </tr>
                            <tr>
                                <td width="20%">Tanggal Pembayaran</td>
                                <td width="1%">:</td>
                                <td >wqtq</td>
                            </tr>
                            <tr>
                                <td width="20%">Status Pembayaran</td>
                                <td width="1%">:</td>
                                <td >  <span class="badge rounded-pill alert-info">Lunas</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary">Chat Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <header class="card-header">
                        <h4>Profil Dokter</h4>
                    </header>
                    <div class="card-body">
                        <figure class="text-lg-center">
                            <img class="img-lg mb-3 img-avatar" src="{{ $data->foto != null ? asset('img/dokter/'.$data->foto) : asset('backend/assets/imgs/people/avatar-2.png') }}" alt="User Photo">
                        </figure>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Nama</label>
                                    <input type="text" value="{{ old('nama_petugas',$data->nama_dokter) }}" readonly placeholder="Masukkan nama petugas" class="form-control" name="nama_petugas"/>
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Spesialis</label>
                                    <input type="text" value="{{ $data->spesialis }}" placeholder="Masukkan jabatan" class="form-control " readonly name="jabatan"/>
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
