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
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(3))) }}</h2>
            {{-- <div>
                <a href="{{ route('dokter.create') }}" class="btn btn-danger"><i class="text-muted material-icons md-post_add"></i>Tambah Data</a>
            </div> --}}
        </div>
        @include('components.notification')
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto Mobil</th>
                                <th>No Plat</th>
                                <th scope="col">Tahun Mobil</th>
                                <th scope="col">No. Telp</th>
                                <th scope="col">Asal Mobil</th>
                                <th scope="col">Status Mobil</th>
                                <th>Tanggal</th>
                                <th scope="col" class="text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <th>
                                    <div class="input-upload">
                                        <img src="{{ asset('backend/assets/imgs/theme/upload.svg') }}" alt="">
                                    </div>
                                </th>
                                <td>P001 KY</td>
                                <td>2001</td>
                                <td>081215</td>
                                <td>Milik Pribadi</td>
                                <td> <span class="badge rounded-pill alert-success">Tersedia</span></td>
                                <td>12-May-2020 12:0:20</td>
                                <td class="text-start">
                                    <div class="d-flex justify-content-start">
                                        <div>
                                            <a href="" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i> Edit </a>
                                        </div>
                                        <div class="mx-2">
                                            <form action="" class="p-0 m-0" method="POST" onsubmit="return confirm('Move data to trash? ')">
                                                @method('delete')
                                                @csrf
                                                <button  class="btn btn-sm font-sm btn-light rounded"> <i class="material-icons md-delete_forever"></i> Delete </button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- dropdown //end -->
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <th>
                                    <div class="input-upload">
                                        <img src="{{ asset('backend/assets/imgs/theme/upload.svg') }}" alt="">
                                    </div>
                                </th>
                                <td>P001 KY</td>
                                <td>2001</td>
                                <td>081215</td>
                                <td>Milik Pribadi</td>
                                <td> <span class="badge rounded-pill alert-warning">Dipesan</span></td>
                                <td>12-May-2020 12:0:20</td>
                                <td class="text-start">
                                    <div class="d-flex justify-content-start">
                                        <div>
                                            <a href="" class="btn btn-sm font-sm rounded btn-brand"> <i class="material-icons md-edit"></i> Edit </a>
                                        </div>
                                        <div class="mx-2">
                                            <form action="" class="p-0 m-0" method="POST" onsubmit="return confirm('Move data to trash? ')">
                                                @method('delete')
                                                @csrf
                                                <button  class="btn btn-sm font-sm btn-light rounded"> <i class="material-icons md-delete_forever"></i> Delete </button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- dropdown //end -->
                                </td>
                            </tr>


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
