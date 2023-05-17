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
            .thumb_up i{
                font-size: 60px;
            }
            .thumb_up span{
                font-size: 24px;
            }
            .thumb_down{

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

        })
    </script>
    @endpush
    @section('content')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">{{ ucwords(str_replace('-',' ',Request::segment(3))) }}</h2>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card mb-4">
                    <header class="card-header">
                        <h4 class="text-center mb-3">Rating dan Penilaian</h4>
                    </header>
                    <div class="card-body">
                        <div class="d-flex justify-content-center thumb_up">
                            <div class="d-flex p-4">
                                <i class="icon material-icons md-thumb_up"></i>
                                <span class="mx-2">5.0</span>
                            </div>
                            <div class="d-flex p-4 thumb_down">
                                <i class="icon material-icons md-thumb_down"></i>
                                <span class="mx-2">5.0</span>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-bordered table-responsive-sm">
                            <tr>
                                <td width="25%"><h4>Diagnosa Rinci</h4></td>
                                <td width="1%"><h4>:</h4></td>
                                <td >
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%"><h4>Jawaban Memuaskan</h4></td>
                                <td width="1%"><h4>:</h4></td>
                                <td >
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%"><h4>Cepat Membalas</h4></td>
                                <td width="1%"><h4>:</h4></td>
                                <td >
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%"><h4>Profesionalitas Dokter</h4></td>
                                <td width="1%"><h4>:</h4></td>
                                <td >
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%"><h4>Ramah Kepada Pasien</h4></td>
                                <td width="1%"><h4>:</h4></td>
                                <td >
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <header class="card-header">
                        <h4>Ulasan</h4>
                    </header>
                    <div class="card-body">
                        <div class="itemside">
                            <div class="left">
                                <img src="{{ asset('backend/assets/imgs/people/avatar-2.png') }}" class="img-sm img-avatar" alt="Userpic" />
                            </div>
                            <div class="info pl-3">
                                <h6 class="mb-0 title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur voluptatem, in voluptatum repellat ab fugiat sint quos aperiam neque, harum consectetur ipsum sit, animi sapiente eius facere eum provident debitis.</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="itemside mt-4">
                            <div class="left">
                                <img src="{{ asset('backend/assets/imgs/people/avatar-2.png') }}" class="img-sm img-avatar" alt="Userpic" />
                            </div>
                            <div class="info pl-3">
                                <h6 class="mb-0 title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur voluptatem, in voluptatum repellat ab fugiat sint quos aperiam neque, harum consectetur ipsum sit, animi sapiente eius facere eum provident debitis.</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- card end// -->
    </section>
    @endsection
</x-app-layout>
