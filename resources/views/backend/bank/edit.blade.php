
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
                        <h4>Data Bank</h4>
                    </header>
                    <div class="card-body">
                        <form action="{{ route('bank.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">Nama Bank</label>
                                    <input type="text" value="{{ old('nama_bank',$data->nama_bank) }}" placeholder="Masukkan nama bank" class="form-control @error('nama_bank') is-invalid @enderror" name="nama_bank"/>
                                    @error('nama_bank')
                                        <div class="invalid-feedback">
                                            {{$message}}.
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="product_name" class="form-label">No Rekening</label>
                                    <input type="text" value="{{ old('no_rek', $data->no_rekening) }}" placeholder="Masukkan no rekening" class="form-control @error('no_rek') is-invalid @enderror" name="no_rek"/>
                                    @error('no_rek')
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
                        <h4>Foto Bank</h4>
                    </header>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="input-upload">
                                <img src="{{ $data->foto != null ? asset('img/bank/'.$data->foto) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                                <input class="form-control" name="foto_bank" type="file" id="gambar_konten"/>
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
