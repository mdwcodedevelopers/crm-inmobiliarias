<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

      {{-- <script src="{{ secure_asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
         {{-- <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

    <header class="w-100 blue">
        <div class="logo p-4 d-flex justify-content-between align-items-center">
            <img src="{{asset('images/logo-footer-canepa.png')}}" alt="Logo canepa" width="150">
            <h3><a href="{{  url('/')}}" class="text-white">Enlace al Sitio Web</a></h3>
        </div>
    </header>
    <div class="container py-5">
        @yield('content')

    </div>
    <front-footer></front-footer>  
    
    </div>

</body>
<style>
  
    *{
        font-family: 'Heebo', sans-serif !important;
    }
    .blue{
        background-color: #1A237E !important;
    }
</style>

</html>