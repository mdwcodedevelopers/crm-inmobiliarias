<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-F75KPNGC15"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-F75KPNGC15');
    </script>
</head>
<body>
    <div id="app">

        <main class="fondo">
            <v-app class="fondo">
                <div class="h-full" style="background-color:#ECEFF1;" >
                @yield('content')

                </div>

            </v-app>
        </main>
        </v-card>
    </div>
</body>
<style>
    html{
        background-color:#CFD8DC;
    }
    *{
        font-family: 'Heebo', sans-serif;

    }
    </style>

</html>
