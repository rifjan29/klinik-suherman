<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            #image{
                background-image: linear-gradient(rgba(28, 27, 27, 0.717), rgba(0, 0, 0, 0.5)), url("{{ asset('frontend/assets/img/bg.png') }}");

                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                position: relative;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 " id="image">
            <div>
                <a href="/">
                    <div class="flex items-center">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                        <div>
                            <h1 class="text-white text-2xl font-black mx-2 ">Klinik Rawat Inap Dr. Suherman</h1>
                            <small class="text-white  mx-2 ">Kabupaten Jember</small>
                        </div>

                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 backdrop-blur-sm bg-white/50 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
