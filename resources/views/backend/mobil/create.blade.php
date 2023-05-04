
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
                    startDate: moment().startOf('hour'),
                    endDate: moment().startOf('hour').add(32, 'hour'),
                    locale: {
                        format: 'LT'
                    }
                });
            });

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
                        <h4>Profile Data Mobil</h4>
                    </header>
                    <div class="card-body">
                        <form action="{{ route('ambulance.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Nama Mobil</label>
                                    <input type="text" value="{{ old('nama_mobil') }}" placeholder="Masukkan nama mobil" class="form-control @error('nama_mobil') is-invalid @enderror" name="nama_mobil"/>
                                    @error('nama_mobil')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Plat Mobil</label>
                                    <input type="text" value="{{ old('plat') }}" placeholder="Masukkan no plat" class="form-control @error('plat') is-invalid @enderror" name="plat"/>
                                    @error('plat')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Tahun </label>
                                    <input type="text" value="{{ old('tahun') }}" placeholder="Masukkan tahun" class="form-control @error('tahun') is-invalid @enderror" name="tahun"/>
                                    @error('tahun')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Asal Mobil </label>
                                    <input type="text" value="{{ old('asal_mobil') }}" placeholder="Masukkan asal mobil" class="form-control @error('asal_mobil') is-invalid @enderror" name="asal_mobil"/>
                                    <small class="text-muted">Jika milik pribadi silahkan dikosongin</small>
                                    @error('asal_mobil')
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
                        <h4>Foto Data Mobil</h4>
                    </header>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="input-upload">
                                <img src="{{ asset('') }}backend/assets/imgs/theme/upload.svg" alt="" id="photosPreview"/>
                                <input class="form-control" name="foto_mobil" type="file" id="gambar_konten"/>
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
