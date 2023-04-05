<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="index.html" class="brand-wrap">
            {{-- <img src="{{ asset('') }}backend/assets/imgs/logo.png" class="logo" alt="Nest Dashboard" /> --}}
            <h4><strong>Administrator</strong></h4>
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('dashboard') }}">
                    <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="menu-item has-submenu">
                <a class="menu-link" href="page-form-product-1.html">
                    <i class="icon material-icons md-add_box"></i>
                    <span class="text">Master Data</span>
                </a>
                <div class="submenu">
                    <a href="">Data Admin</a>
                    <a href="">Data Dokter</a>
                    <a href="">Data Petugas</a>

                </div>
            </li>
            <li class="menu-item ">
                <a class="menu-link" href="">
                    <i class="icon material-icons md-airport_shuttle"></i>
                    <span class="text">Data Ambulance</span>
                </a>
            </li>
            <li class="menu-item ">
                <a class="menu-link" href="">
                    <i class="icon material-icons md-add_alert"></i>
                    <span class="text">Data Konsultasi</span>
                </a>
            </li>
            <li class="menu-item ">
                <a class="menu-link" href="">
                    <i class="icon material-icons md-assignment"></i>
                    <span class="text">Data Resep</span>
                </a>
            </li>
            <li class="menu-item ">
                <a class="menu-link"  href="">
                    <i class="icon material-icons md-person"></i>
                    <span class="text">Data Pasien</span>
                </a>
            </li>
            {{-- <li class="menu-item {{ Request::segment(2) == 'data-produksi-udang' ? 'active' : '' }}">
                <a class="menu-link"  href="{{ route('data-produksi-udang.index') }}">
                    <i class="icon material-icons md-shopping_bag"></i>
                    <span class="text">Data Produksi Udang</span>
                </a>
            </li>
            <li class="menu-item {{ Request::segment(2) == 'data-saldo' ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('data-saldo.index') }}">
                    <i class="icon material-icons md-pie_chart"></i>
                    <span class="text">Data Saldo</span>
                </a>
            </li>

            <li class="menu-item has-submenu {{ Request::segment(2) == 'biaya-tetap' ? 'active' : '' }} {{ Request::segment(2) == 'biaya-variabel' ? 'active' : '' }}">
                <a class="menu-link" href="page-transactions-1.html">
                    <i class="icon material-icons md-monetization_on"></i>
                    <span class="text">Biaya</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('biaya-tetap.index') }}">Biaya Tetap</a>
                    <a href="{{ route('biaya-variabel.index') }}">Biaya Variabel</a>
                </div>
            </li>
            <li class="menu-item {{ Request::segment(2) == 'peramalan-profit' ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('peramalan-profit.index') }}">
                    <i class="icon material-icons md-assessment"></i>
                    <span class="text">Peramalan Profit</span>
                </a>
            </li>

        </ul>
        <hr />
        <ul class="menu-aside">
            <li class="menu-item {{ Request::segment(2) == 'data-akun' ? 'active' : '' }}">
                <a class="menu-link"  href="{{ route('data-akun.index') }}">
                    <i class="icon material-icons md-person"></i>
                    <span class="text">Data Akun</span>
                </a>
            </li>
            <li class="menu-item {{ Request::segment(2) == 'log-aktivitas' ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('log-aktivitas.index') }}">
                    <i class="icon material-icons md-settings"></i>
                    <span class="text">Log Activities</span>
                </a>
            </li> --}}

        </ul>
        <br />
        <br />
    </nav>
</aside>
