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
                        <div class="card" style="border-radius:40px;">
                            <div class="card-body p-4">
                                <form class="mb-3 mt-md-4" method="POST" action="{{ route('loginPost') }}">
                                    @csrf
                                    <div class="section-title">
                                        <h2 class="">Login</h2>
                                    </div>
                                    <div class="p-5">
                                        @if (\Session::has('alert'))
                                            <div class="alert alert-danger">
                                                <div>{{Session::get('alert')}}</div>
                                            </div>
                                        @endif
                                        @if (\Session::has('alert-success'))
                                            <div class="alert alert-success">
                                                <div>{{Session::get('alert-success')}}</div>
                                            </div>
                                        @endif
                                        {{ csrf_field() }}
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-text border border-end-0 p-3" style="background-color:white; border-radius:20px 0 0 20px; box-shadow: 5px 5px #c7c7c7" id="basic-addon1"><i class="fa-solid fa-user" style="color: rgb(139, 139, 139)"></i></span>
                                            <input type="username" name="username" id="username" class="form-control border border-start-0" placeholder="Username" style="border-radius:0 20px 20px 0; box-shadow: 5px 5px #c7c7c7" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-text border border-end-0 p-3" style="background-color:white; border-radius:20px 0 0 20px; box-shadow: 5px 5px #c7c7c7" id="basic-addon1"><i class="fa-solid fa-lock" style="color: rgb(139, 139, 139)"></i></span>
                                            <input type="password" name="password" id="password" class="form-control border border-start-0" placeholder="Password" style="border-radius:0 20px 20px 0; box-shadow: 5px 5px #c7c7c7" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                        <p class="fw-">Didn’t have account?<span class="fw-bolder"> <a href="{{ route('login.register') }}" class="mx-1" style="color: #37517E"> Sign up</a></span></p>
                                        <div class="d-flex justify-content-center p-1 mt-5">
                                            <button type="submit" class="btn btn-lg btn-primary text-center" style="background-color: #37517E; border:0; border-radius:20px"><span class="p-4" style="font-size: 16px">Login</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
