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
<body>

    <header style="width: 100vw; background-color: #1A237E !important;">
        <div class="logo" style="display:flex; justify-content: space-between; align-items:center">
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
      style="text-align:center; background-color: #1A237E !important;"
      width="100%"
    >

      <div style=" color: #fff; padding-top:0px">
          <v-row style="display: flex; flex-direction: column; justify-content:center; padding: 5rem" >
              <v-col
                cols=12
                sd=12
                md=4
               >
                    <img src="/images/logo-footer-canepa.png"  width="350px" >
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
                        <li class=" font-weight-bold pb-3">Menu</li>
                        <li><a href="/#"> Home</a></li>
                        <li><a href="/#we-are">Quienes somos</a></li>
                        <li><a href="/properties">Propiedades</a></li>
                        <li><a href="/#contacts">Contacto</a></li>
                    </ul>
                </v-col>
                <v-col
                >
                    <ul style="text-align: left; list-style:none">
                        <li class=" font-weight-bold pb-3">Redes Cánepa</li>
                        <li><a href="https://www.facebook.com/inmobiliariadanielcanepa/">Facebook</a></li>
                        <li><a href="https://www.instagram.com/inmobiliariadanielcanepa">Instagram</a></li>
                        <li><a href="#">Mercado Libre</a></li>
                    </ul>
                </v-col>
                <v-col
                >
                    <ul  style="text-align: left; list-style:none">
                        <li class=" font-weight-bold pb-3">Términos</li>
                        <li><a href="/politica-de-privacidad">Política de privacidad</a></li>
                        <li><a href="/terminos-y-condiciones">Términos y condiciones</a></li>
                        <li><a href="#">Trabajá con nosotros</a></li>
                        <li><a href="#">FAQ's</a></li>
                    </ul>
                </v-col>
              </v-col>
          </v-row>
      
      </div>

        <v-divider></v-divider>
      <div style="color: #fff" >
        <strong>Daniel Cánepa propiedades</strong>
      </div>
    <div>
  </v-footer>
    
    

</body>
<style>
    @media only screen and (max-width: 600px) {
    .flex-column{
        flex-direction: column 
    }

    }
    .font-weight-bold{
        font-weight: bold;
    }
    .w-100{
        width: 100vw;
    }
    .p-4{
        padding: 4rem;
    }
    .p-5{
        padding: 5rem;
    }
    .py-5{
        padding-top: 5rem;
        padding-bottom: 5rem;
    }
    .px-3{
        padding-left: 3rem;
        padding-right: 3rem;
    }
    .text-center{
        text-align: center;
    }
    .d-flex{
        display: flex;
    }
    .justify-content-center{
        justify-content: center;
    }
    .justify-content-between{
        justify-content: space-between;
    }
    .text-white{
        color: #fff;
    }
   .list {
        list-style: none;
        height: 13rem;
    }
    .list li {
        margin-bottom: 1rem;
    }
    .list li a{
        text-decoration: none;
        color:#fff;
    }
    body{
        margin: 0px;
    }
    *{
        font-family: 'Heebo', sans-serif !important;
    }
    .blue{
        background-color: #1A237E !important;
    }
</style>

</html>