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

    <header class="w-100 blue">
        <div class="logo p-4 d-flex justify-content-between align-items-center">
            <img src="{{asset('images/logo-footer-canepa.png')}}" alt="Logo canepa" width="200">
            <h3><a href="{{  url('/')}}" class="text-white">Enlace al Sitio Web</a></h3>
        </div>
    </header>
    <div class="container p-4">
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
      class="blue text-center"
      width="100%"
    >

      <div class="text-white pt-0">
          <v-row class="d-flex flex-column  p-5 justify-content-center " >
              <v-col
                cols=12
                sd=12
                md=4
               >
                    <img src="/images/logo-footer-canepa.png"  width="350px" >
                    <p class="text-left mt-5">
                        Contamos con más de 30 años
                        de experiencia en negocios inmobiliarios.
                    </p>
              </v-col>
              <v-col
              cols=12
                sd=12
                md=8
                class="px-3 d-flex flex-column flex-sm-column  flex-md-row "
              >
                <v-col>

                    <ul class="list text-left ">
                        <li class=" font-weight-bold pb-3">Menu</li>
                        <li><a href="/#"> Home</a></li>
                        <li><a href="/#we-are">Quienes somos</a></li>
                        <li><a href="/properties">Propiedades</a></li>
                        <li><a href="/#contacts">Contacto</a></li>
                    </ul>
                </v-col>
                <v-col
                >
                    <ul class="list text-left ">
                        <li class=" font-weight-bold pb-3">Redes Cánepa</li>
                        <li><a href="https://www.facebook.com/inmobiliariadanielcanepa/">Facebook</a></li>
                        <li><a href="https://www.instagram.com/inmobiliariadanielcanepa">Instagram</a></li>
                        <li><a href="#">Mercado Libre</a></li>
                    </ul>
                </v-col>
                <v-col
                >
                    <ul class="list text-left">
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
      <div class="text-white">
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