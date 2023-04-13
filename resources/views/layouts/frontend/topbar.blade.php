<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container-fluid d-flex align-items-center">

      <h1 class="logo me-auto mx-4"><a href="{{ route('beranda') }}">
        <div class="d-flex">
            <div>
                <img src="{{ asset('frontend/assets/img/logo-1.png') }}" class="img-responsive" width="100"  alt="">
            </div>
            <div class="align-self-center mx-4">
                KLINIK rawat inap <br>
                DR. SUHERMAN
            </div>

        </div>
        </a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar mx-4">
        <ul>
          <li><a class="nav-link scrollto active" href="{{ route('beranda') }}">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
          <li><a class="nav-link scrollto" href="#why-us">Profil</a></li>
          <li class="dropdown"><a href="#services"><span>Pelayanan</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{ route('rawat-jalan') }}">Rawat Jalan</a></li>
              <li><a href="{{ route('rawat-inap') }}">Rawat Inap</a></li>
              <li><a href="{{ route('penunjang') }}">Penunjang</a></li>
              <li><a href="{{ route('ugd') }}">UGD</a></li>
              <li><a href="{{ route('e-ambulance') }}">E-Ambulance</a></li>
              <li><a href="{{ route('e-konsultasi') }}">E-Konsultasi</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#portfolio">Dokter</a></li>
          <li><a class="nav-link scrollto" href="#team">Kritik dan Saran</a></li>
          <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
          <li><a class="nav-link scrollto" href="{{ route('login.register') }}"><button type="button" class="btn btn-outline-primary rounded-5 fw-normal border border-2 border-info" style="color: white;"><span class="p-3">Daftar</span></button></a></li>
          <li><a class="nav-link scrollto" href="{{ route('login.index') }}"><button type="button" class="btn btn-outline-primary rounded-5 fw-normal border border-2 border-info" style="color: white;"><span class="p-3">Masuk</span></button></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
