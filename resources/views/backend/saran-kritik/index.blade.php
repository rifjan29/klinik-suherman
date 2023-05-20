<x-app-layout>
    @push('css')
        <style>
            .page-item.active .page-link{
                background-color: #219ebc !important;
                border-color: #8ecae6;
            }
            .break-line{
                white-space: pre-line;
            }

            .kritik-saran{
                width: 200px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
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

        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr style="text-align: center">
                                <th>No</th>
                                <th scope="col" class="break-line">Nama Lengkap</th>
                                <th scope="col" class="break-line">Subjek</th>
                                <th scope="col" class="break-line">Jenis Layanan</th>
                                <th scope="col" class="break-line">Nomor Telepon</th>
                                <th scope="col" class="break-line">Kepuasan 
                                  Rumah Sakit</th>
                                <th scope="col" class="break-line">Profesionalisme 
                                  Petugas Rumah Sakit</th>
                                <th scope="col" class="break-line">Fasilitas 
                                  Rumah Sakit</th>
                                <th scope="col" class="break-line">Waktu Layanan</th>
                                <th scope="col" class="break-line">Biaya Layanan</th>
                                <th scope="col" class="break-line">Kritik dan Saran</th>
                                <th scope="col" class="break-line">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr style="text-align: center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td><b>{{ $item->nama }}</b></td>
                                    <td><b>{{ ucwords($item->responden) }}</b></td>
                                    <td><b>E-{{ ucwords($item->layanan) }}</b></td>
                                    <td><b>{{ $item->no_hp }}</b></td>
                                    <td><b>
                                      @if ($item->kepuasan == '0')
                                        Sangat Tidak Puas
                                      @elseif ($item->kepuasan == '1')
                                        Tidak Puas
                                      @elseif ($item->kepuasan == '2')
                                        Puas
                                      @elseif ($item->kepuasan == '3')
                                        Sangat Puas
                                      @endif
                                    </b></td>
                                    <td><b>
                                      @if ($item->profesional == '0')
                                        Sangat Tidak Profesional
                                      @elseif ($item->profesional == '1')
                                        Tidak Profesional
                                      @elseif ($item->profesional == '2')
                                        Profesional
                                      @elseif ($item->profesional == '3')
                                        Sangat Profesional
                                      @endif
                                    </b></td>
                                    <td><b>
                                      @if ($item->fasilitas == '0')
                                        Sangat Buruk
                                      @elseif ($item->fasilitas == '1')
                                        Buruk
                                      @elseif ($item->fasilitas == '2')
                                        Baik
                                      @elseif ($item->fasilitas == '3')
                                        Sangat Baik
                                      @endif
                                    </b></td>
                                    <td><b>
                                      @if ($item->waktu == '0')
                                        Sangat Lambat
                                      @elseif ($item->waktu == '1')
                                        Lambat
                                      @elseif ($item->waktu == '2')
                                        Cepat
                                      @elseif ($item->waktu == '3')
                                        Sangat Cepat
                                      @endif
                                    </b></td>
                                    <td><b>
                                      @if ($item->biaya == '0')
                                        Sangat Mahal
                                      @elseif ($item->biaya == '1')
                                        Mahal
                                      @elseif ($item->biaya == '2')
                                        Murah
                                      @elseif ($item->biaya == '3')
                                        Sangat Murah
                                      @endif
                                    </b></td>
                                    <td class="kritik-saran"><b>{{ $item->kritik_saran }}</b></td>
                                    <td><b> {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y - H:i:s') }}</b></td>

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
