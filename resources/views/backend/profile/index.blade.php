<x-app-layout>
    @push('css')
        <style>
            .page-item.active .page-link{
                background-color: #219ebc !important;
                border-color: #8ecae6;
            }
        </style>
    @endpush
    @push('js')
    <script>
        $(document).ready(function() {


        })
    </script>
    @endpush
    @section('content')
    <section class="content-main">
        @include('components.notification')
        <div class="card mb-4">
            <div class="card-body">
                <div class="mb-4">
                    <h2 class="text-center">Profil User</h2>
                    <hr>
                </div>
                @if (auth()->user()->role == 'petugas')
                    @include('backend.profile.petugas')
                @elseif (auth()->user()->role == 'apotek')
                    @include('backend.profile.apotek')
                @elseif (auth()->user()->role == 'dokter')
                    @include('backend.profile.dokter')
                @elseif (auth()->user()->role == 'kasir')
                    @include('backend.profile.kasir')
                @else
                    @include('backend.profile.admin')
                @endif

            </div>
        </div>
        <!-- card end// -->
    </section>
    @endsection
</x-app-layout>
