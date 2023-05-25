<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <style>
            .page-item.active .page-link{
                background-color: #219ebc !important;
                border-color: #8ecae6;
            }
            .active-ket{
                display: none;
            }
        </style>
    @endpush
    @push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        })
    </script>
    <script>
         $(document).ready(function() {
            // Menambahkan form dinamis ketika tombol "Add Form" ditekan
            $('#addBtn').click(function() {
                var formRow = `
                    <div class="row form-row my-3">
                        <div class="form-group col-md-4">
                            <label for="obat">Nama Obat</label>
                            <select class="form-control obat-select" name="obat[]" required>
                                <option value="">Pilih Obat</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="qty">Qty</label>
                            <input type="number" class="form-control qty-input" name="qty[]" required min="1">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control harga-input" disabled>
                        </div>
                        <div class="form-group col-md-2">
                            <button type="button" class="btn btn-danger remove-btn">Hapus</button>
                        </div>
                    </div>
                `;

                $('#formContainer').append(formRow);

                // Mendapatkan data obat dan mengisi dropdown di form baru
                $.ajax({
                    url: "{{ route('transaksi-obat.data-obat') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        var obatSelect = $('.obat-select:last');
                        obatSelect.empty();
                        obatSelect.append('<option value="">Pilih Obat</option>');

                        $.each(response, function(key, value) {
                            obatSelect.append('<option value="' + value.id + '">' + value.nama_obat + '</option>');
                        });
                    }
                });
            });

            // Menghapus form ketika tombol "Remove" ditekan
            $(document).on('click', '.remove-btn', function() {
                $(this).closest('.form-row').remove();
                calculateTotal();
            });

            // Menghitung total saat nilai qty berubah
            $(document).on('keyup', '.qty-input', function() {
                calculateTotal();
            });

            // Mengisi harga saat obat dipilih
            $(document).on('change', '.obat-select', function() {
                var obatId = $(this).val();
                var hargaInput = $(this).closest('.form-row').find('.harga-input');

                $.ajax({
                    url: "{{ route('transaksi-obat.data-obat') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        var obat = response.find(item => item.id == obatId);

                        if (obat) {
                            hargaInput.val(obat.harga);
                            calculateTotal();
                        }
                    }
                });
            });
            $(document).on('keyup','.lainnya',function() {
                calculateTotal();
            })
            $(document).on('keyup','.embalase',function() {
                calculateTotal();
            })

            // Fungsi untuk menghitung total
            function calculateTotal() {
                var total = 0;
                $('.form-row').each(function() {
                    var qty = $(this).find('.qty-input').val();
                    var harga = $(this).find('.harga-input').val();

                    if (qty && harga) {
                        total += qty * harga;
                    }
                });
                $('.test').each(function() {
                    var lainnya = parseInt($(this).find('#lainnya').val());
                    var embalase = parseInt($(this).find('#embalase').val());
                    lainnya = isNaN(lainnya) ? 0 : lainnya;
                    embalase = isNaN(embalase) ? 0 : embalase;
                    total += embalase + lainnya
                })

                $('#total').val(total);
            }
        });
    </script>
    @endpush
    @section('content')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(3))) }}</h2>

        </div>
        @include('components.notification')
        <div class="card mb-4">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="w-75">
                                <h4>Resep Obat</h4>
                            </div>
                            <div class="w-50">
                                @php
                                   $data_dokter =  App\Models\PemesananKonsultasi::select('pemesanan_konsultasi.id as id_konsultasi','pemesanan_konsultasi.id_dokter','pemesanan_konsultasi.kode_pemesanan',
                                                                    'dokter.id as iddokter',
                                                                    'dokter.nama_dokter','dokter.no_sip')
                                                                ->join('dokter','dokter.id','pemesanan_konsultasi.id_dokter')
                                                                ->where('pemesanan_konsultasi.kode_pemesanan',$data->kode_transaksi_konsultasi)
                                                                ->first();
                                @endphp
                                <div class="d-flex justify-content-end">
                                    <table class="table table-borderless table-responsive-sm">
                                        <tbody>
                                            <tr>
                                                <td width="10%">Nama Dokter</td>
                                                <td width="1%">:</td>
                                                <td width="10%">{{ ucwords($data_dokter->nama_dokter) }}</td>
                                            </tr>
                                            <tr>
                                                <td width="10%">SIP</td>
                                                <td width="1%">:</td>
                                                <td width="10%">{{ $data_dokter->no_sip }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <textarea name="" id="" cols="30" rows="10" class="form-control">{{ $data->resep_obat }}</textarea>
                        <div class="d-flex justify-content-between">
                            <div class="my-4">
                                <h4>Input Harga Obat</h4>
                            </div>
                            <div>
                                <div class="form-group my-4">
                                    <button type="button" class="btn btn-primary " id="addBtn">Tambah </button>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <form action="{{ route('transaksi-obat.data-obat.post') }}" class="mt-4" method="POST">
                            @csrf
                            <div id="formContainer">
                                <div class="row form-row my-3">
                                    <div class="form-group col-md-4">
                                        <label for="obat">Nama Obat</label>
                                        <select class="form-control obat-select" name="obat[]" required>
                                            <option value="">Pilih Obat</option>
                                            @foreach($obat as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_obat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="qty">Qty</label>
                                        <input type="number" class="form-control qty-input" name="qty[]" required min="1">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="harga">Harga</label>
                                        <input type="number" class="form-control harga-input" disabled>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="button" class="btn btn-danger remove-btn">Hapus</button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4>Total Detail</h4>
                            <div class="row test mt-4">
                                <input type="text" name="kode_transaksi" id="" value="{{ $data->kode_transaksi }}" hidden>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="total">Harga Embalase</label>
                                        <input type="number" name="embalase" class="form-control embalase" id="embalase"  value=" " placeholder="Masukkan harga embalase">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="total">Harga Lainnya</label>
                                        <input type="number" name="lainnya" class="form-control lainnya" id="lainnya"  value=" " placeholder="Masukkan harga lainnya">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="total">Total</label>
                                        <input type="number" class="form-control" name="total" id="total" readonly>
                                    </div>
                                </div>
                            </div>


                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="d-flex justify-content-end">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
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
