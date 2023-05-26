<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container-fluid d-flex align-items-center">
      <h1 class="logo me-auto mx-5"><a href="{{ route('beranda') }}">
        <div class="d-flex">
            <div id="img_heading">
                <img src="{{ asset('frontend/assets/img/logo-1.png') }}" class="img-fluid"   alt="">
            </div>
            <div class="align-self-center mx-4" id="header_heading">
                KLINIK rawat inap <br>
                DR. SUHERMAN
            </div>
        </div>
        </a>
      </h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="{{ route('beranda') }}">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
          <li><a class="nav-link scrollto" href="#why-us">Profil</a></li>
          <li class="dropdown"><a href="#services"><span>Pelayanan</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{ route('rawat-jalan') }}">Rawat Jalan</a></li>
              <li><a href="{{ route('rawat-inap') }}">Rawat Inap</a></li>
              <li><a href="{{ route('penunjang') }}">Penunjang</a></li>
              <li><a href="{{ route('ugd') }}">UGD</a></li>
              <li><a href="{{ route('e-ambulance') }}">E-Ambulance</a></li>
              <li><a href="{{ route('e-konsultasi.index') }}">E-Konsultasi</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#portfolio">Dokter</a></li>
          <li><a class="nav-link scrollto" href="#team">Kritik dan Saran</a></li>
          <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
          @if (Session::get('id'))
          <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Akun<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ route('profil') }}">Profil</a></li>
                  <li><a href="{{ route('e-ambulance.fitur') }}">Pilihan Menu</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a href="{{ route('logout') }}" style="color:red">Logout</a></li>
              </ul>
         </li>
          {{-- <li><a class="nav-link scrollto" href="#"><button type="button" class="btn btn-outline-primary rounded-5 fw-normal border border-2 border-info" style="color: white;"><span class="p-3">Akun</span></button></a></li>
          <li><a class="nav-link scrollto" href="{{ route('logout') }}"><button type="button" class="btn btn-outline-primary rounded-5 fw-normal border border-2 border-info" style="color: white;"><span class="p-3">Logout</span></button></a></li> --}}
          @else
          <li><a class="nav-link scrollto" href="{{ route('login.register') }}"><button type="button" class="btn btn-outline-primary rounded-5 fw-normal border border-2 border-info" ><span class="p-3">Daftar</span></button></a></li>
          <li><a class="nav-link scrollto" href="{{ route('login.index') }}"><button type="button" class="btn btn-outline-primary rounded-5 fw-normal border border-2 border-info" ><span class="p-3">Masuk</span></button></a></li>
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
