<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
               <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    .logo {
        /* width: 180px;
    height: 170px;  */
        max-height: 250px;
        max-width: 240px;
        object-fit: contain;
        position: absolute;
        margin-top: -119px;
        color: white
    }

    .back {
        background-image: url('{{ asset('admin/ff2.jpg') }}');
        background-repeat: no-repeat;
        background-size: cover;
    }

    .table-blue th {
        background-color: #003366 !important;
        color: white !important;
    }

    .table-blue td {

        color: black !important;
    }

    .table-blue th {

        color: black !important;
    }

    .table-blue tbody tr:nth-child(even) {
        background-color: #E6F7FF !important;
    }

    .table-blue tbody tr:nth-child(odd) {
        background-color: #CCEBFF !important;
    }

    .table-blue td,
    .table-blue th {
        border-color: #003366 !important;
    }

    .btn-primary {
        background-color: #0066CC !important;
        border-color: #0066CC !important;
    }

    .btn-primary:hover {
        background-color: #0052A3 !important;
        border-color: #0052A3 !important;
    }

    .btn-warning {
        background-color: #FFCC00 !important;
        border-color: #FFCC00 !important;
    }

    .btn-danger {
        background-color: #FF3300 !important;
        border-color: #FF3300 !important;
    }

    .rtl-container {
        direction: rtl;
        text-align: right;
    }

    .table>:not(caption)>*>*:nth-child(even),
    .table tbody tr:nth-child(even) {
        background-color: #F0F8FF !important;
        /* Alice Blue */
        color: #003366;
        /* Navy Text */
    }

    .table>:not(caption)>*>*:nth-child(odd),
    .table tbody tr:nth-child(odd) {
        background-color: #DDEEFF !important;
        /* Light Steel Blue */
        color: #003366;
        /* Navy Text */
    }

    .table>:not(caption)>*>* th {
        background-color: #003366 !important;
        /* Navy */
        color: #FFFFFF !important;
        /* White Text */
        border: 1px solid #003366 !important;

    }

</style>

<body class="font-sans antialiased ">
    <div class="min-h-screen bg-gray-100 back">
        @include('layouts.wahajnavigation')

        <!-- Centered Logo -->

     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <!-- Page Heading -->
        @isset($header)
            <header class="bg-black shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
                    {{ $header }}
                </div>
            </header>
        @endisset

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>


</html>
