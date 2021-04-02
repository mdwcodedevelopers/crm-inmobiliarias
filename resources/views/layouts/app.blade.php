<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--    <script src="{{ secure_asset('js/app.js') }}" defer></script>-->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!--     <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">

        <main class="fondo">
            <v-app class="fondo">
                <div class="h-full" style="background-color:#ECEFF1" >
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
    .form-control2 {
  display: block;
  width: 100%;
  height: calc(1.6em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 0.9rem;
  font-weight: 400;
  line-height: 1.6;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
}
    </style>

</html>
