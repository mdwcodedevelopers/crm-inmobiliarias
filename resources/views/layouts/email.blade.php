<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

      {{-- <script src="{{ secure_asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
         {{-- <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body style="box-sizing: border-box; margin: 0px">

    <header style="background-color: #1A237E; padding: 3rem">
        <div class="logo" style=" width: 100%; display:flex; justify-content: space-between; align-items:center">
            <img src="{{asset('images/logo-footer-canepa.png')}}" alt="Logo canepa" width="200">
            <h3><a href="{{  url('/')}}" style=" color: #fff;">Enlace al Sitio Web</a></h3>
        </div>
    </header>
    <div class="container" style="padding: 4rem">
        @yield('content')

    </div>
    <v-footer
    dark
    padless
    style="width:100vw"
  >
    <div
      flat
      tile
      style="text-align:center; background-color: #1A237E !important; padding: 3rem"
      width="100%"
    >

      <div style=" color: #fff; padding-top:0px">
          <v-row style="display: flex; flex-direction: column; justify-content:center;" >
              <v-col
                cols=12
                sd=12
                md=4
               >
            <img src="{{asset('images/logo-footer-canepa.png')}}" alt="Logo canepa" width="200">
                    <p style="text-align: left; margin-top: 5rem">
                        Contamos con más de 30 años
                        de experiencia en negocios inmobiliarios.
                    </p>
              </v-col>
              <v-col
              cols=12
                sd=12
                md=8
                style="display: flex; flex-direction: column; justify-content:center; padding-left: 3rem;  padding-right: 3rem;" 
              >
                <v-col>

                    <ul style="text-align: left; list-style:none" >
                        <li class=" font-weight-bold pb-3" style="font-weight: bold; font-size:1.5rem">Menu</li>
                        <li><a href="{{url('/')}}" style="color:#fff; padding-left: 1rem"> Home</a></li>
                        <li><a href="{{url('/#we-are')}}" style="color:#fff; padding-left: 1rem">Quienes somos</a></li>
                        <li><a href="{{url('/properties')}} " style="color:#fff; padding-left: 1rem">Propiedades</a></li>
                        <li><a href="{{url('/#contacts')}}" style="color:#fff; padding-left: 1rem">Contacto</a></li>
                    </ul>
                </v-col>
                <v-col
                >
                    <ul style="text-align: left; list-style:none">
                        <li class=" font-weight-bold pb-3" style="font-weight: bold; font-size:1.5rem">Redes Cánepa</li>
                        <li><a href="https://www.facebook.com/inmobiliariadanielcanepa/" style="color:#fff; padding-left: 1rem">Facebook</a></li>
                        <li><a href="https://www.instagram.com/inmobiliariadanielcanepa" style="color:#fff; padding-left: 1rem">Instagram</a></li>
                        <li><a href="#" style="color:#fff; padding-left: 1rem">Mercado Libre</a></li>
                    </ul>
                </v-col>
                <v-col
                >
                    <ul  style="text-align: left; list-style:none">
                        <li class=" font-weight-bold pb-3" style="font-weight: bold; font-size:1.5rem">Términos</li>
                        <li><a href="{{url('/politica-de-privacidad')}}" style="color:#fff; padding-left: 1rem">Política de privacidad</a></li>
                        <li><a href="{{url('/terminos-y-condiciones')}}" style="color:#fff; padding-left: 1rem">Términos y condiciones</a></li>
                        <li><a href="#" style="color:#fff; padding-left: 1rem">Trabajá con nosotros</a></li>
                        <li><a href="#" style="color:#fff; padding-left: 1rem">FAQ's</a></li>
                    </ul>
                </v-col>
              </v-col>
          </v-row>
      
      </div>

        <v-divider></v-divider>
      <div style="color: #fff; font-size:2rem" >
        <strong>Daniel Cánepa propiedades</strong>
      </div>
    <div>
  </v-footer>
    
    

</body>

</html>