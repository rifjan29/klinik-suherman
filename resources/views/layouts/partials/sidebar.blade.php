<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <div class="d-flex">
            <div>
                <img src="{{ asset('frontend/assets/img/logo-1.png') }}" class="img-responsive" width="50"  alt="">
            </div>
            <div class="align-self-center mx-4">
                @if (auth()->user()->role == 'apotek')
                    <h4>E-Apotek</h4>
                @elseif (auth()->user()->role == 'dokter')
                    <h4>E-Konsultasi</h4>
                @elseif (auth()->user()->role == 'petugas')
                    <h4>E-Ambulance</h4>
                @elseif (auth()->user()->role == 'kasir')
                    <h4>Kasir</h4>
                @else
                    <h4>E-Administrator</h4>
                @endif
            </div>

        </div>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            @if (auth()->user()->role == 'apotek')
                <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="menu-link" href="{{ route('dashboard') }}">
                        <i class="icon material-icons md-home"></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item has-submenu {{ Request::segment(2) == 'e-apotek' ? 'active' : '' }}">
                    <a class="menu-link" href="page-form-product-1.html">
                        <i class="icon material-icons md-assignment"></i>
                        <span class="text">Data E-Apotek</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ route('riwayat-ambulance') }}">List Resep</a>
                        <a href="{{ route('riwayat-ambulance') }}">Laporan Resep </a>
                    </div>
                </li>
            @elseif (auth()->user()->role == 'dokter')
                <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="menu-link" href="{{ route('dashboard') }}">
                        <i class="icon material-icons md-home"></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item has-submenu {{ Request::segment(2) == 'e-konsultasi' ? 'active' : '' }}">
                    <a class="menu-link" href="page-form-product-1.html">
                        <i class="icon material-icons md-add_alert"></i>
                        <span class="text">Data E-Konsultasi</span>
                    </a>
                    <div class="submenu">
                        @if (auth()->user()->role == 'kasir')
                            <a href="{{ route('riwayat-ambulance') }}">List Transaksi </a>
                        @endif
                        <a href="{{ route('riwayat-ambulance') }}">Rating Dokter </a>
                        <a href="{{ route('riwayat-ambulance') }}">Riwayat Konsultasi </a>
                        <a href="{{ route('riwayat-ambulance') }}">Laporan Konsultasi </a>
                    </div>
                </li>
            @elseif (auth()->user()->role == 'petugas' || auth()->user()->role == 'kasir')
                <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="menu-link" href="{{ route('dashboard') }}">
                        <i class="icon material-icons md-home"></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item has-submenu {{ Request::segment(2) == 'ambulance' ? 'active' : '' }}">
                    <a class="menu-link" href="page-form-product-1.html">
                        <i class="icon material-icons md-airport_shuttle"></i>
                        <span class="text">Data E-Ambulance</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ route('list-ambulance') }}">List Pemesanan </a>
                        <a href="{{ route('riwayat-ambulance') }}">Riwayat Pemesanan </a>
                        <a href="{{ route('riwayat-ambulance') }}">Laporan E-Ambulance </a>
                    </div>
                </li>
                @if (auth()->user()->role == 'kasir')
                    <li class="menu-item has-submenu {{ Request::segment(2) == 'e-konsultasi' ? 'active' : '' }}">
                        <a class="menu-link" href="page-form-product-1.html">
                            <i class="icon material-icons md-add_alert"></i>
                            <span class="text">Data E-Konsultasi</span>
                        </a>
                        <div class="submenu">
                            @if (auth()->user()->role == 'kasir')
                                <a href="{{ route('riwayat-ambulance') }}">List Transaksi </a>
                            @else
                                <a href="{{ route('riwayat-ambulance') }}">Rating Dokter </a>
                                <a href="{{ route('riwayat-ambulance') }}">Riwayat Konsultasi </a>
                                <a href="{{ route('riwayat-ambulance') }}">Laporan Konsultasi </a>

                            @endif
                        </div>
                    </li>
                    <li class="menu-item has-submenu {{ Request::segment(2) == 'e-apotek' ? 'active' : '' }}">
                        <a class="menu-link" href="page-form-product-1.html">
                            <i class="icon material-icons md-assignment"></i>
                            <span class="text">Data E-Apotek</span>
                        </a>
                        <div class="submenu">
                            <a href="{{ route('riwayat-ambulance') }}">List Transaksi Resep</a>
                        </div>
                    </li>
                @endif


            @else
                <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="menu-link" href="{{ route('dashboard') }}">
                        <i class="icon material-icons md-home"></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item has-submenu {{ Request::segment(2) == 'master-data' ? 'active' : '' }}">
                    <a class="menu-link" href="page-form-product-1.html">
                        <i class="icon material-icons md-add_box"></i>
                        <span class="text">Master Data</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ route('poli.index') }}"> Poli</a>
                        <a href="{{ route('admin.index') }}"> Admin</a>
                        <a href="{{ route('dokter.index') }}"> Dokter</a>
                        <a href="{{ route('petugas.index') }}"> Petugas</a>
                        <a href="{{ route('apotek.index') }}"> Apotek</a>
                        <a href="{{ route('ambulance.index') }}"> Ambulance</a>
                        <a href="{{ route('kasir.index') }}"> Kasir</a>
                        <a href="{{ route('bank.index') }}"> Bank</a>

                    </div>
                </li>
                <li class="menu-item has-submenu {{ Request::segment(2) == 'ambulance' ? 'active' : '' }}">
                    <a class="menu-link" href="page-form-product-1.html">
                        <i class="icon material-icons md-airport_shuttle"></i>
                        <span class="text">Data E-Ambulance</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ route('riwayat-ambulance') }}">List Pemesanan </a>
                        <a href="{{ route('riwayat-ambulance') }}">Riwayat Pemesanan </a>
                        <a href="{{ route('riwayat-ambulance') }}">Laporan E-Ambulance </a>
                    </div>
                </li>
                <li class="menu-item has-submenu {{ Request::segment(2) == 'e-konsultasi' ? 'active' : '' }}">
                    <a class="menu-link" href="page-form-product-1.html">
                        <i class="icon material-icons md-add_alert"></i>
                        <span class="text">Data E-Konsultasi</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ route('riwayat-ambulance') }}">Rating Dokter </a>
                        <a href="{{ route('riwayat-ambulance') }}">List Transaksi </a>
                        <a href="{{ route('riwayat-ambulance') }}">Riwayat Konsultasi </a>
                        <a href="{{ route('riwayat-ambulance') }}">Laporan Konsultasi </a>
                    </div>
                </li>

                <li class="menu-item has-submenu {{ Request::segment(2) == 'e-apotek' ? 'active' : '' }}">
                    <a class="menu-link" href="page-form-product-1.html">
                        <i class="icon material-icons md-assignment"></i>
                        <span class="text">Data E-Apotek</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ route('riwayat-ambulance') }}">List Transaksi Resep</a>
                        <a href="{{ route('riwayat-ambulance') }}">Laporan Resep </a>
                    </div>
                </li>

                <li class="menu-item ">
                    <a class="menu-link"  href="">
                        <i class="icon material-icons md-person"></i>
                        <span class="text">Data Pasien</span>
                    </a>
                </li>
                <li class="menu-item ">
                    <a class="menu-link"  href="">
                        <i class="icon material-icons md-add_alert"></i>
                        <span class="text">Data Kritik Dan Saran</span>
                    </a>
                </li>
            @endif



        </ul>
        <br />
        <br />
    </nav>
</aside>
