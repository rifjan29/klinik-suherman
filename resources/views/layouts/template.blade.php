<!DOCTYPE html>
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
  <!-- =======================================================
  * Template Name: Arsha
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  @stack('css')
</head>

<body>
  @include('layouts.frontend.topbar')
  <!-- ======= Hero Section ======= -->
  @yield('hero')

  <main id="main">
      @yield('content')
  </main><!-- End #main -->

  @include('layouts.frontend.footer')

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('') }}frontend/assets/vendor/aos/aos.js"></script>
  <script src="{{ asset('') }}frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('') }}frontend/assets/vendor/bootstrap/js/bootstrap.min.js"></script>☻
  <script src="{{ asset('') }}frontend/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset('') }}frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset('') }}frontend/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('') }}frontend/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="{{ asset('') }}frontend/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('') }}frontend/assets/js/main.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

  
  @stack('js')

</body>

</html>
