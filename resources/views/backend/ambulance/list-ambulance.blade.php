<x-app-layout>
    @push('css')
        <style>
            .page-item.active .page-link{
                background-color: #219ebc !important;
                border-color: #8ecae6;
            }
        </style>
    @endpush
    @push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
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
            <div>
                <a href="{{ route('riwayat-ambulance') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Riwayat Pesanan</a>
            </div>
        </div>
        @include('components.notification')
        <div class="card mb-4">
            <div class="card-body">
                <div class="">
                    <table class="table table-hover">
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
                                <th scope="col" class="text-start">Action</th>
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
                                        @if ($item->status_kejadian == "0")
                                            <span class="badge rounded-pill alert-warning">Tidak Darurat</span>
                                        @elseif ($item->status_kejadian == "1")
                                            <span class="badge rounded-pill alert-danger">Darurat</span>
                                        @else
                                            <a href="{{ $item->pasien_ambulance->id }}" data-bs-toggle="modal" data-bs-target="#cekstatus{{ $item->pasien_ambulance->id }}" class="badge rounded-pill alert-info">Cek Status Kejadian</a></td>
                                            <div class="modal fade" id="cekstatus{{ $item->pasien_ambulance->id }}" tabindex="-1" aria-labelledby="cekstatus{{ $item->pasien_ambulance->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Cek Status</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                Alamat :
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="card">
                                                                    @php

                                                                            $provinsi = \Indonesia::findProvince($item->lokasi->id_provinsi)->first();
                                                                            $kota = \Indonesia::findCity($item->lokasi->id_kota)->first();
                                                                            $kecamatan = \Indonesia::findDistrict($item->lokasi->id_kecamatan)->first();
                                                                            $desa = \Indonesia::findVillage($item->lokasi->id_desa)->first();
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
                                                            <form action="{{ route('update-status.riwayat-ambulance') }}" method="POST" >
                                                                @csrf
                                                                <input type="text" name="id_transaksi" value="{{ $item->kode_pesanan }}" hidden>

                                                            <div class="col-md-2">
                                                                <label for="product_name" class="form-label">Status Kejadian</label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                                                    <input class="form-check-input" id="jenis_kelamin" name="status_kejadian" value="0" {{ old('status_kejadian') == '0' ? "checked" : '' }} type="radio">
                                                                    <span class="form-check-label"> Darurat </span>
                                                                </label>
                                                                <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                                                    <input class="form-check-input" id="jeni_kelamin" name="status_kejadian" value="1" {{ old('status_kejadian') == '1' ? "checked" : '' }} type="radio">
                                                                    <span class="form-check-label"> Tidak Darurat </span>
                                                                </label>
                                                                @error('status_kejadian')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}.
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="product_name" class="form-label">Status Pesanan</label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                                                    <input class="form-check-input" id="jenis_kelamin" name="status" value="1" {{ old('status') == '1' ? "checked" : '' }} type="radio">
                                                                    <span class="form-check-label"> Setuju </span>
                                                                </label>
                                                                <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                                                    <input class="form-check-input" id="jeni_kelamin" name="status" value="2" {{ old('status') == '2' ? "checked" : '' }} type="radio">
                                                                    <span class="form-check-label"> Ditolak </span>
                                                                </label>
                                                                @error('status')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}.
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Status</button>

                                                        </form>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- 0 = pesanan diterima 1 = ambulance menuju lokasi 2 = ambulance tiba di lokasi 3 = pesanan dibayarkan 4 = selesai --}}
                                        @if ($item->status_perjalanan == '0')
                                            <span class="badge rounded-pill alert-warning">Pesanan diterima</span><br>
                                            <small class="text-muted" style="font-size: 10px">Silahkan update pesanan </small>
                                        @elseif ($item->status_perjalanan == '1')
                                            <a class="badge rounded-pill alert-info" href="{{ route('list-ambulance.update-perjalanan',$item->id) }}">Ambulance menuju lokasi</a> <br>
                                            <small class="text-muted" style="font-size: 10px">Klik jika ambulance tiba di lokasi </small>
                                        @elseif ($item->status_perjalanan == '2')
                                            <a class="badge rounded-pill alert-info" href="{{ route('list-ambulance.update-perjalanan-dua',$item->id) }}">Ambulance tiba di klinik</a> <br>
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
                                                <button class="btn btn-sm font-sm rounded btn-brand"  data-bs-toggle="modal" data-bs-target="#exampleModalBayar-{{ $item->id }}">Bayar Tagihan Rp. {{ number_format($item->total_biaya,2, ",", ".") }}</button> <br>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalBayar-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalBayar-{{ $item->id }}Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('list-ambulance.post',$item->id) }}" method="POST">
                                                            @csrf
                                                            <div class="">
                                                                <label for="product_name" class="form-label">Jumlah Nominal Bayar</label>
                                                                <input type="text" id="nominal_bayar" value="{{ old('nominal_bayar',0) }}"  placeholder="Masukkan Total Biaya" class="form-control @error('nominal_bayar') is-invalid @enderror" name="nominal_bayar"/>
                                                                @error('nominal_bayar')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}.
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="product_name" class="form-label">Total Biaya</label>
                                                                <input type="text" id="total_biaya" value="{{ old('total_biaya',$item->total_biaya) }}" readonly placeholder="Masukkan Total Biaya" class="form-control @error('total_biaya') is-invalid @enderror" name="total_biaya"/>
                                                                @error('total_biaya')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}.
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="product_name" class="form-label">Jumlah Kembalian</label>
                                                                <input type="text" id="total" value="{{ old('total',) }}"  placeholder="Masukkan Total Biaya" class="form-control @error('total') is-invalid @enderror" name="total"/>
                                                                <div id="pesan">
                                                                    <small class="text-danger">Maaf uang anda tidak mencukupi</small>
                                                                </div>
                                                                @error('total')
                                                                    <div class="invalid-feedback">
                                                                        {{$message}}.
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>

                                                            </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            @else
                                                Rp. {{ number_format($item->total_biaya,2, ",", ".") }}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status_kendaraan == '1')
                                            <a href="{{ route('list-ambulance.detail',$item->id) }}" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i> Update Pesanan Ambulance </a>
                                            <div class="dropdown">
                                                <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Edit Data</a>
                                                </div>
                                            </div>
                                        @elseif ($item->status_kendaraan == "2")
                                            <span class="badge rounded-pill alert-danger">Pesanan ditolak </span> <br>
                                            <small style="font-size: 12px" class=""> No HP Pasien : {{ $item->pasien_ambulance->no_hp }}</small>
                                        @else
                                            <span class="badge rounded-pill alert-warning">Silahkan cek pesanan</span>
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
