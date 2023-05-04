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
    <script>
        $(document).ready(function() {


        })
    </script>
    @endpush
    @section('content')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">Data {{ ucwords(str_replace('-',' ',Request::segment(3))) }}</h2>
            <div>
                <a href="{{ route('kasir.create') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Tambah Data</a>
            </div>
        </div>
        @include('components.notification')
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Email</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col" class="text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="input-upload">
                                            <img src="{{ $item->foto != null ? asset('img/kasir/'.$item->foto) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="photosPreview"/>
                                        </div>
                                    </td>
                                    <td><b>{{ $item->user->name }}</b></td>
                                    <td><b>{{ $item->nama_kasir }}</b></td>
                                    <td><b>{{ $item->user->email }}</b></td>
                                    <td><b>{{ $item->alamat }}</b></td>
                                    <td><b> {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y - H:i:s') }}</b></td>
                                    <td class="text-start">
                                        <div class="d-flex justify-content-start">
                                            <div>
                                                <a href="{{ route('kasir.edit',$item->id) }}" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i> Edit </a>
                                            </div>
                                            <div class="mx-2">
                                                @if (auth()->user()->id != $item->user->id)
                                                    <form action="{{ route('kasir.destroy',$item->id) }}" class="p-0 m-0" method="POST" onsubmit="return confirm('Move data to trash? ')">
                                                        @method('delete')
                                                        @csrf
                                                        <button  class="btn btn-sm font-sm btn-light rounded"> <i class="material-icons md-delete_forever"></i> Delete </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- dropdown //end -->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Tidak ada data</td>
                                </tr>
                            @endforelse
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
