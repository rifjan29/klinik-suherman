<figure class="text-lg-center">
    <img class="img-lg mb-3 img-avatar" src="{{ $data->foto != null ? asset('img/petugas/'.$data->foto) : asset('backend/assets/imgs/people/avatar-2.png') }}" alt="User Photo">
</figure>
<div class="row">
    <div class="col-md-6">
        <div class="mb-4">
            <label for="product_name" class="form-label">Nama Petugas</label>
            <input type="text" value="{{ old('nama_petugas',$data->nama_petugas) }}" readonly placeholder="Masukkan nama petugas" class="form-control" name="nama_petugas"/>
        </div>
        <div class="mb-4">
            <label for="product_name" class="form-label">Jabatan</label>
            <input type="text" value="{{ $data->jabatan }}" placeholder="Masukkan jabatan" class="form-control " readonly name="jabatan"/>
        </div>
        <div class="mb-4">
            <label for="product_name" class="form-label">Alamat</label>
            <textarea name="alamat" id="" cols="30" rows="10" class="form-control" placeholder="Masukkan alamat" readonly>{{ $data->alamat }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-4">
            <label for="product_name" class="form-label">Username</label>
            <input type="text" value="{{ old('username',$user->name) }}" placeholder="Masukkan username" readonly class="form-control " name="username"/>
        </div>
        <div class="mb-4">
            <label for="product_name" class="form-label">Email</label>
            <input type="text" value="{{ old('email',$user->email) }}" readonly placeholder="Masukkan email petugas" class="form-control " name="email"/>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="product_name" class="form-label">Jenis Kelamin</label>
                <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                    <input class="form-check-input" id="jenis_kelamin" name="jeni_kelamin" value="1" readonly {{ old('jenis_kelamin',$data->jenis_kelamin) == '1' ? "checked" : '' }} type="radio">
                    <span class="form-check-label"> Laki-Laki </span>
                </label>
                <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                    <input class="form-check-input" id="jeni_kelamin" name="jeni_kelamin" value="2" readonly {{ old('jenis_kelamin',$data->jenis_kelamin) == '2' ? "checked" : '' }} type="radio">
                    <span class="form-check-label"> Perempuan </span>
                </label>

            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end">
    <a href="{{ route('petugas.edit',$data->id) }}" class="btn btn-primary"> <i class="material-icons md-edit"></i>  Edit Profil</a>

</div>
