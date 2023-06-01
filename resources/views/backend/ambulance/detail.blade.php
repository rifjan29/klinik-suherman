<x-app-layout>
    @push('css')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    @endpush
    @push('js')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>
            $(function() {
                $('input[name="jam_kerja"]').daterangepicker({
                    timePicker: true,

                    locale: {
                        format: 'LT'
                    }
                });
            });

        </script>
        <script>
            $(document).ready(function() {
                function hapus_uang(params) {
                    const angka = params;
                    const valueWithoutCurrency = angka.replace(/\./g, "").toString();
                    return parseInt(valueWithoutCurrency);
                }
                function count_biaya(biaya, biaya_lain) {
                    var result = biaya + biaya_lain;
                    $('#total_biaya').val(result)
                    var total_biaya = document.getElementById("total_biaya");
                    total_biaya.value = formatRupiah(total_biaya.value);
                }
                var biaya = document.getElementById("biaya");
                biaya.value = formatRupiah(biaya.value);
                biaya.addEventListener("keyup", function(e) {
                    biaya.value = formatRupiah(this.value);
                    count_biaya(hapus_uang(this.value), hapus_uang($('#biaya_lain').val()))
                });


                var biaya_lain = document.getElementById("biaya_lain");
                biaya_lain.value = formatRupiah(biaya_lain.value);
                biaya_lain.addEventListener("keyup", function(e) {
                    biaya_lain.value = formatRupiah(this.value);
                    count_biaya(hapus_uang($('#biaya').val()),hapus_uang(this.value))
                });


                var total_biaya = document.getElementById("total_biaya");
                total_biaya.value = formatRupiah(total_biaya.value);

                total_biaya.addEventListener("keyup", function(e) {
                    total_biaya.value = formatRupiah(this.value);
                });


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
        <script>
             $(document).ready(function() {
                $('#gambar_konten').change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            $('#photosPreview')
                            .attr("src",event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                })
            })
        </script>
        <script>
            $(function() {
                $('input[name="jam_kerja"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    timePicker: true,
                    startDate:  moment().startOf('hour').add(32, 'hour')    ,
                    locale: {
                        format: 'DD-MM-Y hh:mm:ss'
                    }
                });
            });

        </script>

    @endpush
    @section('content')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">Data {{ ucwords(str_replace('-',' ',Request::segment(3))) }}</h2>
            <div>
                <button onclick="history.back()" class="btn btn-light"><i class="text-muted material-icons md-arrow_back"></i>Kembali</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <header class="card-header">
                        <h4>Detail Pesanan Ambulance</h4>
                    </header>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-responsive-sm">
                                <tbody>
                                    <tr>
                                        <td width="20%">Nama Pasien</td>
                                        <td width="1%">:</td>
                                        <td >{{ ucwords($data->nama_wali) }}</td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Tanggal </td>
                                        <td width="1%">:</td>
                                        <td >
                                            {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y ') }} <br> <small class="text-muted" style="font-size: 11px">Jam {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('h:i:s A') }}</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Alamat </td>
                                        <td width="1%">:</td>
                                        <td >
                                            @php
                                                    $provinsi = \Indonesia::findProvince($data->id_provinsi);
                                                    $kota = \Indonesia::findCity($data->id_kota);
                                                    $kecamatan = \Indonesia::findDistrict($data->id_kecamatan);
                                                    $desa = \Indonesia::findVillage($data->id_desa);
                                            @endphp
                                            <p>{{ $provinsi->name }}, {{ $kota->name }}, {{ $kecamatan->name }}, {{ $desa->name }}, {{ $data->alamat }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Foto Kejadian </td>
                                        <td width="1%">:</td>
                                        <td >
                                            <div class="d-flex">
                                                <div class="input-upload">
                                                    <img class="img-fluid" src="{{ $data->foto_kejadian != null ? asset('img/foto-kejadian/'.$data->foto_kejadian) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Keadaaan </td>
                                        <td width="1%">:</td>
                                        <td >{{ $data->keadaan }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <header class="card-header">
                        <h4>Update Pesanan</h4>
                    </header>
                    <div class="card-body">
                        <form action="{{ route('list-ambulance.detail-update',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="product_name" class="form-label">Nominal Biaya</label>
                                <input type="text" id="biaya" value="{{ old('biaya',$data->nominal) }}" placeholder="Masukkan biaya" class="form-control @error('biaya') is-invalid @enderror" name="biaya"/>
                                @error('biaya')
                                    <div class="invalid-feedback">
                                        {{$message}}.
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="product_name" class="form-label">Biaya Lainnya</label>
                                <input type="text" id="biaya_lain" value="{{ old('biaya_lain',$data->biaya_lain != null ? $data->biaya_lain : 0) }}" placeholder="Masukkan biaya lain" class="form-control @error('biaya_lain') is-invalid @enderror" name="biaya_lain"/>
                                @error('biaya_lain')
                                    <div class="invalid-feedback">
                                        {{$message}}.
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="product_name" class="form-label">Total Biaya</label>
                                <input type="text" id="total_biaya" value="{{ old('total_biaya',$data->total_biaya) }}" readonly placeholder="Masukkan Total Biaya" class="form-control @error('total_biaya') is-invalid @enderror" name="total_biaya"/>
                                @error('total_biaya')
                                    <div class="invalid-feedback">
                                        {{$message}}.
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="product_name" class="form-label">Tanggal Jemput</label>
                                <input type="text" name="jam_kerja" id="tgl" value="{{ old('jam_kerja') }}" class="form-control @error('jam_kerja') is-invalid @enderror"/>
                                @error('jam_kerja')
                                    <div class="invalid-feedback">
                                        {{$message}}.
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="product_name" class="form-label">Status Perjalanan</label>
                                <select name="status_perjalanan" id="" class="form-control">
                                    <option value="0">Pilih Status Perjalanan</option>
                                    <option value="1">Ambulance menuju lokasi </option>
                                    <option value="2">Ambulance tiba di lokasi </option>
                                    <option value="3">Pesanan Dibayarkan </option>
                                </select>
                                @error('status_perjalanan')
                                    <div class="invalid-feedback">
                                        {{$message}}.
                                    </div>
                                @enderror
                            </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end mb-4">
                            <button type="reset" class="btn btn-outline-danger">Batal</button>
                            <button type="submit" class="btn btn-primary mx-2">Simpan</button>

                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- card end// -->
    </section>
    @endsection
</x-app-layout>
