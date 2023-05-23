<x-app-layout>
    @section('content')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">Data {{ ucwords(str_replace('-',' ',Request::segment(3))) }}</h2>
            <div>
                <button onclick="history.back()" class="btn btn-light"><i class="text-muted material-icons md-arrow_back"></i>Kembali</button>
            </div>
        </div>
        <div class="card mb-4">
            <header class="card-header">
                <h4>Tambah Data Obat</h4>
            </header>
            <div class="card-body">
                <form action="{{ route('obat.store',$data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="product_name" class="form-label">Nama</label>
                        <input type="text" value="{{ old('name',$data->nama_obat) }}" placeholder="Masukkan nama kategori obat" class="form-control @error('name') is-invalid @enderror" name="name"/>
                        @error('name')
                            <div class="invalid-feedback">
                                {{$message}}.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="product_name" class="form-label">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror">
                            <option value="0">Pilih Katgori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" {{ $data->id_kategori == $item->id ? 'selected' : '' }}>{{ ucwords($item->name) }}</option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <div class="invalid-feedback">
                                {{$message}}.
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="product_name" class="form-label">Stok</label>
                        <input type="number" value="{{ old('stok',$data->stok) }}" placeholder="Masukkan stok obat" class="form-control @error('stok') is-invalid @enderror" name="stok"/>
                        @error('stok')
                            <div class="invalid-feedback">
                                {{$message}}.
                            </div>
                        @enderror
                    </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-outline-danger">Batal</button>
                    <button type="submit" class="btn btn-primary mx-2">Simpan</button>
                </form>

                </div>
            </div>
        </div>
        <!-- card end// -->
    </section>
    @endsection
</x-app-layout>
