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
                            <div class="card position-absolute top-50 start-50 translate-middle" style="border-radius:40px; width:80%">
                                <div class="card-body p-5">
                                    <div class="section-title">
                                        <h2 class="">Forgot Password</h2>
                                    </div>
                                    @if (\Session::has('alert-danger'))
                                        <div class="alert alert-danger">
                                            <div>{{Session::get('alert-danger')}}</div>
                                        </div>
                                    @endif
                                    @if (\Session::has('alert-success'))
                                        <div class="alert alert-success">
                                            <div>{!! nl2br(e(\Session::get('alert-success'))) !!}</div>
                                        </div>
                                    @endif
                                    <form class="row g-3" action="{{ route('resetPasswordPost') }}" method="post">
                                        @csrf
                                        <div class="col-md-12 p-2">
                                            <label for="password" class="col-form-label fw-bold">Password</label>
                                            <input type="password" name="password" class="form-control shadow rounded-4 mt-1  @error('password') is-invalid @enderror" id="password" placeholder="Masukkan Password Anda" style="height: 50px;" required>
                                            <div class="d-flex justify-content-end pt-3">
                                                <div>
                                                    <label for="">
                                                        <input type='checkbox' id='toggle' value='0'>
                                                        <span id='toggleText' class="align-center-self">Show</span>
                                                    </label>
                                                </div>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <label for="password" class="col-form-label fw-bold">Ulangi Password</label>
                                            <input type="password" id="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control shadow rounded-4 mt-1 @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  placeholder="Masukkan Ulang Password Anda" style="height: 50px;" required>
                                            <div class="d-flex justify-content-end pt-3">
                                                <div>
                                                    <label for="">
                                                        <input type='checkbox' id='toggleDua' value='0'>
                                                        <span id='toggleTextDua' class="align-center-self">Show</span>
                                                    </label>
                                                </div>
                                            </div>
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-center p-1 mt-5">
                                            <button type="submit" class="btn btn-lg btn-primary text-center" style="background-color: #37517E; border:0; border-radius:20px"><span class="p-4" style="font-size: 16px">Reset Password</span></button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#toggle").change(function(){

                // Check the checkbox state
                if($(this).is(':checked')){
                // Changing type attribute
                    $("#password").attr("type","text");

                    // Change the Text
                    $("#toggleText").text("Hide");
                    }else{
                    // Changing type attribute
                    $("#password").attr("type","password");

                    // Change the Text
                    $("#toggleText").text("Show");
                }

            });
            $("#toggleDua").change(function(){

                // Check the checkbox state
                if($(this).is(':checked')){
                // Changing type attribute
                    $("#password_confirmation").attr("type","text");

                    // Change the Text
                    $("#toggleTextDua").text("Hide");
                    }else{
                    // Changing type attribute
                    $("#password_confirmation").attr("type","password");

                    // Change the Text
                    $("#toggleTextDua").text("Show");
                }

            });
        });
    </script>
</html>
