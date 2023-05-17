<header class="main-header navbar">
    <div class="col-search">

    </div>
    <div class="col-nav">
        <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
        <ul class="nav">

            <li class="nav-item">
                <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
            </li>
            <li class="nav-item">
                <a href="#" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
            </li>

            <li class="dropdown nav-item">
                @php
                    if (auth()->user()->role == 'apotek') {
                         $data = \App\Models\Apotek::where('id_user',auth()->user()->id)->first();
                    }else if (auth()->user()->role == 'dokter') {
                        $data = \App\Models\Dokter::where('id_user',auth()->user()->id)->first();
                    }else if (auth()->user()->role == 'petugas') {
                        $data = \App\Models\Petugas::where('id_user',auth()->user()->id)->first();
                    }else if (auth()->user()->role == 'kasir') {
                        $data = \App\Models\Kasir::where('id_user',auth()->user()->id)->first();
                    } else {
                        $data = \App\Models\Admin::where('id_user',auth()->user()->id)->first();
                    }
                @endphp
                @if (auth()->user()->role == 'apotek')
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="{{  $data->foto != null ? asset('img/apotek/'.$data->foto) : asset('backend/assets/imgs/people/avatar-2.png') }}" alt="User" /></a>
                @elseif (auth()->user()->role == 'dokter')
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="{{  $data->foto != null ? asset('img/dokter/'.$data->foto) : asset('backend/assets/imgs/people/avatar-2.png') }}" alt="User" /></a>
                @elseif (auth()->user()->role == 'petugas')
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="{{  $data->foto != null ? asset('img/petugas/'.$data->foto) : asset('backend/assets/imgs/people/avatar-2.png') }}" alt="User" /></a>
                @elseif (auth()->user()->role == 'kasir')
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="{{  $data->foto != null ? asset('img/kasir/'.$data->foto) : asset('backend/assets/imgs/people/avatar-2.png') }}" alt="User" /></a>
                @else
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="{{  $data->foto != null ? asset('img/admin/'.$data->foto) : asset('backend/assets/imgs/people/avatar-2.png') }}" alt="User" /></a>

                @endif
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                    <a class="dropdown-item" href="{{ route('profile-user',auth()->user()->id) }}"><i class="material-icons md-perm_identity"></i>Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalLogout"><i class="material-icons md-exit_to_app"></i>Logout</a>
                </div>
            </li>
        </ul>
    </div>
</header>
