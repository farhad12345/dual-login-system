<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin/favicon.ico') }}">
        <title>{{ config('app.name', 'آمرتم') }} - @yield('title', '')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .back{
        background-image: url('{{ asset('admin/ff1.jpg') }}');
        background-repeat: no-repeat;
        background-size: cover;
    }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased ">
        <div class="py-12 bg-blue-100 min-h-screen" >
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white shadow-md sm:rounded-lg overflow-hidden ">
                    <div class="w-full p-6 mt-6 px-6 py-4 text-gray-900 ">



            {{-- <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"> --}}
                {{ $slot }}
            </div>
        </div>
        </div>
    </div>
</div>
    </body>

</html>
