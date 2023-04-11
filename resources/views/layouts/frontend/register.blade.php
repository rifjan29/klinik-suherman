<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Klinik Suherman</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="{{ asset('') }}frontend/assets/img/favicon.png" rel="icon">
        <link href="{{ asset('') }}frontend/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('') }}frontend/assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="{{ asset('') }}frontend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('') }}frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="{{ asset('') }}frontend/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="{{ asset('') }}frontend/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="{{ asset('') }}frontend/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="{{ asset('') }}frontend/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ asset('') }}frontend/assets/css/style.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Custom styles for this template -->
        <link href="signin.css" rel="stylesheet">
    </head>

    <body class="login">
        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6">
                        <div class="position-relative">
                            <div class="card position-absolute top-50 start-50 translate-middle" style="border-radius:40px; width:250%">
                                <div class="card-body p-5">
                                    <form action="" class="mb-3 mt-md-4">
                                        <div class="section-title">
                                            <h2 class="">Create Account</h2>
                                        </div>
                                        <div class="p-3 mx-2">
                                            <div class="row">
                                                <div class="col-md-6 p-4">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label for="" class="col-form-label fw-bold">Nama Lengkap</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control shadow rounded-4" id="" placeholder="Masukkan Nama Lengkap" style="height: 130%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 p-4">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label for="" class="col-form-label fw-bold">Agama</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control shadow rounded-4" id="" placeholder="Masukkan Agama" style="height: 130%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 p-4">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label for="" class="col-form-label fw-bold">Tempat/Tanggal Lahir</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control shadow rounded-4" id="" placeholder="Masukkan Tempat dan Tanggal Lahir" style="height: 90%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 p-4">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <p class="fw-bold fs-6">Status Perkawinan</p>
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="d-flex justify-content-start">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                                    <label class="form-check-label" for="flexRadioDefault1">Kawin</label>
                                                                </div>
                                                                <div class="form-check mx-4">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                                    <label class="form-check-label" for="flexRadioDefault2">Belum Kawin</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 p-4">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <p class="fw-bold fs-6">Jenis Kelamin</p>
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="d-flex justify-content-start">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefaultNew" id="flexRadioDefault3">
                                                                    <label class="form-check-label" for="flexRadioDefault3">Laki-Laki</label>
                                                                </div>
                                                                <div class="form-check mx-4">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" checked>
                                                                    <label class="form-check-label" for="flexRadioDefault4">Perempuan</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 p-4">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label for="" class="col-form-label fw-bold">Pekerjaan</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control shadow rounded-4" id="" placeholder="Masukkan Pekerjaan" style="height: 130%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 p-4">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label for="" class="col-form-label fw-bold">Alamat</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control shadow rounded-4" id="" placeholder="Masukkan Alamat" style="height: 130%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 p-4">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label for="" class="col-form-label fw-bold">Nomor Telepon</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control shadow rounded-4" id="" placeholder="Masukkan Nomor Telepon" style="height: 130%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center p-1 mt-5">
                                                <button type="button" class="btn btn-lg btn-primary text-center" style="background-color: #37517E; border:0; border-radius:20px"><span class="p-4" style="font-size: 16px">Sign Up</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
