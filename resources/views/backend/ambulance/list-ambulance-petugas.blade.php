<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
        <style>
            #map { height: 600px; }
        </style>
        <style>
            .page-item.active .page-link{
                background-color: #219ebc !important;
                border-color: #8ecae6;
            }
        </style>
    @endpush
    @push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script>
        $('.cekStatusData').on('click',function() {
            var long = parseFloat($('#long').val());
            var lang = parseFloat($('#lang').val());
            test(lang,long)
        })
        function test(lang,long) {
            var map = L.map('map').setView([-7.93699,113.812946], 13);
            var marker = L.marker([long,lang]).addTo(map);
            var circle = new L.circleMarker();

            L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                minZoom: 10,
                subdomains:['mt0','mt1','mt2','mt3']
            }).addTo(map);
        }

    </script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        })
    </script>
    <script>
        $(document).ready(function() {
            cetak_pembayaran()
            function cetak_pembayaran() {
                $("#pesan").hide();
                function hapus_uang(params) {
                    const angka = params;
                    const valueWithoutCurrency = angka.replace(/\./g, "").toString();
                    return parseInt(valueWithoutCurrency);
                }
                function count_biaya(biaya, nominal_bayar) {
                    var result = nominal_bayar - biaya;
                    $('#total').val(result)
                    if (result < 0) {
                        $("#pesan").show();
                        setTimeout(function() { $("#pesan").hide(); }, 5000);
                    }else{
                        var total = document.getElementById("total");
                        total.value = formatRupiah(total.value);
                        $("#pesan").hide();
                    }
                }

                var nominal_bayar = document.getElementById("nominal_bayar");
                nominal_bayar.value = formatRupiah(nominal_bayar.value);
                nominal_bayar.addEventListener("keyup", function(e) {
                    nominal_bayar.value = formatRupiah(this.value);
                    count_biaya(hapus_uang($('#total_biaya').val()),hapus_uang(this.value))
                });


                var total_biaya = document.getElementById("total_biaya");
                total_biaya.value = formatRupiah(total_biaya.value);

                total_biaya.addEventListener("keyup", function(e) {
                    total_biaya.value = formatRupiah(this.value);
                });

            }

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, "").toString(),
                    split = number_string.split(","),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }

                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                return prefix == undefined ? rupiah : rupiah ? rupiah : "";
            }
        })
    </script>
    @endpush
    @section('content')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(3))) }}</h2>
            @if (auth()->user()->role != 'petugas')
                <div>
                    <a href="{{ route('riwayat-ambulance') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Riwayat Pesanan</a>
                </div>
            @endif
        </div>
        @include('components.notification')
        <div class="card mb-4">
            <div class="card-body">
                {{-- @if (auth()->user()->role == 'petugas')
                    ini petugas
                @else
                    ini bukan petugas
                @endif --}}
                <div class="">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pesanan</th>
                                <th scope="col">Nama Wali</th>
                                <th scope="col">No. Telp</th>
                                <th scope="col">Tanggal Pesanan</th>
                                <th>Status Kejadian</th>
                                <th>Status Pesanan</th>
                                <th>Status Pembayaran</th>
                                <th>Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_pesanan }}</td>
                                    <td>{{ $item->pasien_ambulance->nama_wali }}</td>
                                    <td>{{ $item->pasien_ambulance->no_hp }}</td>

                                    <td>{{ \Carbon\Carbon::parse($item->pasien_ambulance->tanggal)->translatedFormat('d F Y ') }} <br> <small class="text-muted" style="font-size: 11px">Jam {{ \Carbon\Carbon::parse($item->pasien_ambulance->tanggal)->translatedFormat('h:i:s A') }}</small></td>

                                    <td>
                                        <a href="{{ $item->pasien_ambulance->id }}" data-bs-toggle="modal" data-bs-target="#cekstatus{{ $item->pasien_ambulance->id }}" class="badge rounded-pill alert-info cekStatusData">Cek Status Kejadian</a></td>
                                        <div class="modal fade" id="cekstatus{{ $item->pasien_ambulance->id }}" tabindex="-1" aria-labelledby="cekstatus{{ $item->pasien_ambulance->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Cek Status</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-2">Lokasi :</div>
                                                        <div class="col-md-10">
                                                            <input type="number" hidden name="" id="long" value="{{ $item->lokasi->long }}">
                                                            <input type="number" hidden name="" id="lang" value="{{ $item->lokasi->lang }}">
                                                            <div id="map"></div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            Alamat :
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="card">
                                                                @php

                                                                        $provinsi = \Indonesia::findProvince($item->lokasi->id_provinsi);
                                                                        $kota = \Indonesia::findCity($item->lokasi->id_kota);
                                                                        $kecamatan = \Indonesia::findDistrict($item->lokasi->id_kecamatan);
                                                                        $desa = \Indonesia::findVillage($item->lokasi->id_desa);
                                                                @endphp
                                                                <div class="card-body">
                                                                    <p>{{ $provinsi->name }}, {{ $kota->name }}, {{ $kecamatan->name }}, {{ $desa->name }}, {{ $item->lokasi->alamat }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            Keaadaan :
                                                        </div>
                                                        <div class="col-md-10">
                                                            <textarea name="" id="" cols="5" rows="5" class="form-control" readonly>{{ $item->pasien_ambulance->keadaan }}</textarea>
                                                            <div class="input-upload">
                                                                <img src="{{ $item->pasien_ambulance->foto_kejadian != null ? asset('img/admin/'.$item->pasien_ambulance->foto_kejadian) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </div>

                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        @if ($item->status_kejadian == "0")
                                            <span class="badge rounded-pill alert-warning">Tidak Darurat</span>
                                        @elseif ($item->status_kejadian == "1")
                                            <span class="badge rounded-pill alert-danger">Darurat</span>
                                        @else
                                        @endif
                                    </td>
                                    <td>
                                        {{-- 0 = pesanan diterima 1 = ambulance menuju lokasi 2 = ambulance tiba di lokasi 3 = pesanan dibayarkan 4 = selesai --}}
                                        @if ($item->status_perjalanan == '0')
                                            <span class="badge rounded-pill alert-warning">Pesanan diterima</span><br>
                                            <small class="text-muted" style="font-size: 10px">Silahkan update pesanan </small>
                                        @elseif ($item->status_perjalanan == '1')
                                            <small class="text-muted" style="font-size: 10px">Klik jika ambulance tiba di lokasi </small>
                                        @elseif ($item->status_perjalanan == '2')
                                            <small class="text-muted" style="font-size: 10px">Klik jika ambulance melakukan pembayaran</small>
                                        @elseif ($item->status_perjalanan == '3')
                                            <a class="badge rounded-pill alert-info">Pesanan dibayarkan</a> <br>
                                        @else
                                            <span class="badge rounded-pill alert-success">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status_pembayaran == 'pending')
                                            <span class="badge rounded-pill alert-warning">Pending</span>
                                        @elseif ($item->status_pembayaran == 'lunas')
                                            <span class="badge rounded-pill alert-info">Lunas</span>
                                        @else
                                            <span class="badge rounded-pill alert-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->total_biaya != null)
                                            @if ($item->status_perjalanan == '3')
                                                Rp. {{ number_format($item->total_biaya,2, ",", ".") }}
                                            @else
                                                Rp. {{ number_format($item->total_biaya,2, ",", ".") }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            </div>
        </div>
        <!-- card end// -->
    </section>
    @endsection
</x-app-layout>
