@forelse ($data as $item)
    <div class="col-md-4 p-2">
        <div class="card">
            <div class="card-body p-3 mt-3 mx-2">
                @if ($item->status == 'off')
                    <div class="d-flex justify-content-start"><span class="badge text-bg-danger">Offline</span></div>
                @elseif ($item->status == 'sibuk')
                    <div class="d-flex justify-content-start"><span class="badge text-bg-warning">Sibuk</span></div>
                @else
                    <div class="d-flex justify-content-start"><span class="badge text-bg-success">Aktif</span></div>
                @endif
                <img  class="rounded-circle mt-4 img-fluid" src="{{ $item->foto != null ? asset('img/dokter/'.$item->foto) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                <div class="mt-3">
                    <h4>{{ ucwords($item->nama_dokter) }}</h4>
                    <span style="color: #b4b4b4;">Dokter Umum</span>
                </div>
                <div class="mt-2">
                    <i class="fa-solid fa-thumbs-up"></i>
                    @php
                        $rating = App\Models\Penilaian::where('id_dokter',$item->id)->sum('suka');
                    @endphp
                    <span style="color: #b4b4b4;">{{ $rating }}</span>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="float-start">
                            <span style="color: #b4b4b4;">Mulai Dari</span><br>
                            <p style="font-weight: bold; color:#F4A223;">Rp.{{ number_format($item->nominal,2, ",", ".") }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="float-end mt-1">
                            @if ($item->status != 'off' || $item->status != 'sibuk')
                                <a class="btn btn-lg btn-primary text-center detailDokter" data-id="{{ $item->id }}" data-bs-toggle="modal" href="#exampleModalToggle">
                                    <span class="p-4" style="font-size: 16px">Konsultasi</span>
                                </a>
                            @else
                                <a class="btn btn-lg btn-primary text-center disabled" data-bs-toggle="modal" href="#exampleModalToggle" role="button">
                                    <span class="p-4" style="font-size: 16px">Konsultasi</span>
                                </a>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    <p class="text-center"> Data yang dicari tidak ditemukan</p>
@endforelse
