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
                var harga_satuan = document.getElementById("nominal");
                harga_satuan.value = formatRupiah(harga_satuan.value);

                harga_satuan.addEventListener("keyup", function(e) {
                    harga_satuan.value = formatRupiah(this.value);
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
            $("#datepicker").daterangepicker( {
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                        format: 'YYYY-MM-DD'
                    }
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
                        <h4>Profile Data Dokter</h4>
                    </header>
                    <div class="card-body">
                        <form action="{{ route('dokter.update',$dokter->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Nama Dokter</label>
                                    <input type="text" value="{{ old('nama_dokter',$dokter->nama_dokter) }}" placeholder="Masukkan nama dokter" class="form-control @error('nama_dokter') is-invalid @enderror" name="nama_dokter"/>
                                    @error('nama_dokter')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Email</label>
                                    <input type="text" value="{{ old('email',$user->email) }}" placeholder="Masukkan email dokter" class="form-control @error('email') is-invalid @enderror" name="email"/>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">NO SIP</label>
                                    <input type="text" value="{{ old('no_sip') }}" placeholder="Masukkan No SIP dokter" class="form-control @error('no_sip') is-invalid @enderror" name="no_sip"/>
                                    @error('no_sip')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">NO STR</label>
                                    <input type="text" value="{{ old('no_str') }}" placeholder="Masukkan No STR dokter" class="form-control @error('no_str') is-invalid @enderror" name="no_str"/>
                                    @error('no_str')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Poli</label>
                                    <select name="poli" id="" class="form-control @error('poli') is-invalid @enderror">
                                        <option value="">Pilih Poli</option>
                                        @foreach ($poli as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $dokter->id_poli ? "selected" : "" }}>{{ $item->nama_poli }}</option>
                                        @endforeach
                                    </select>
                                    @error('poli')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Spesialis</label>
                                    <input type="text" value="{{ old('spesialis',$dokter->spesialis) }}" placeholder="Masukkan spesialis dokter" class="form-control @error('spesialis') is-invalid @enderror" name="spesialis"/>
                                    @error('spesialis')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Jam Kerja</label>
                                    <input type="text" name="jam_kerja" value="{{ $dokter->mulai_dari }} - {{ $dokter->akhir_dari }}" class="form-control"/>
                                    @error('jam_kerja')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="product_name" class="form-label">Jenis Kelamin</label>
                                        <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                            <input class="form-check-input" id="jenis_kelamin" name="jeni_kelamin" value="1" {{ old('jenis_kelamin',$dokter->jenis_kelamin) == '1' ? "checked" : '' }} type="radio">
                                            <span class="form-check-label"> Laki-Laki </span>
                                        </label>
                                        <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                            <input class="form-check-input" id="jeni_kelamin" name="jeni_kelamin" value="2" {{ old('jenis_kelamin',$dokter->jenis_kelamin) == '2' ? "checked" : '' }} type="radio">
                                            <span class="form-check-label"> Perempuan </span>
                                        </label>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">
                                                {{$message}}.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Tanggal Lahir</label>
                                    <input type="text" value="{{ old('tgl_lahir',$dokter->tanggal_lahir) }}" placeholder="Masukkan tgl lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" id="datepicker" name="tgl_lahir"/>
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">No. Telp</label>
                                    <input type="text" value="{{ old('telp',$dokter->no_telp) }}" placeholder="Masukkan nama no telp" class="form-control @error('telp') is-invalid @enderror" name="telp"/>
                                    @error('telp')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Nominal</label>
                                    <input type="text" id="nominal" value="{{ old('nominal',$dokter->nominal) }}" placeholder="Masukkan Nominal" class="form-control @error('nominal') is-invalid @enderror" name="nominal"/>
                                    @error('nominal')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Alamat</label>
                                    <textarea name="alamat" id="" cols="30" rows="10" class="form-control" placeholder="Masukkan alamat">{{ old('alamat', $dokter->alamat) }}</textarea>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>

                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <header class="card-header">
                        <h4>Ganti Akun Data Dokter</h4>
                    </header>
                    <div class="card-body">
                        <div class="mb-3">
                            <input type="text" value="{{ old('username',$user->id) }}" name="id" hidden/>

                            <label for="product_name" class="form-label">Username</label>
                            <input type="text" value="{{ old('username',$user->name) }}" placeholder="Masukkan username" class="form-control @error('username') is-invalid @enderror" name="username"/>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{$message}}.
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Password Baru</label>
                            <input type="password" value="{{ old('password') }}" placeholder="Masukkan password" class="form-control @error('password') is-invalid @enderror" name="password"/>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}.
                                </div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="product_name" class="form-label">Ulangi Password</label>
                            <input type="password" value="{{ old('password_confirmation') }}" placeholder="Masukkan password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"/>
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{$message}}.
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card">
                    <header class="card-header">
                        <h4>Foto Data Dokter</h4>
                    </header>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="input-upload">
                                <img src="{{ $dokter->foto != null ? asset('img/dokter/'.$dokter->foto) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                                <input class="form-control" name="foto_dokter" type="file" id="gambar_konten"/>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="d-flex justify-content-end mb-4">
            <button type="reset" class="btn btn-outline-danger">Batal</button>
            <button type="submit" class="btn btn-primary mx-2">Simpan</button>

        </div>
    </form>

        <!-- card end// -->
    </section>
    @endsection
</x-app-layout>
