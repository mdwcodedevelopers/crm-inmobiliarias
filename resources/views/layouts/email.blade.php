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
    <v-footer
    dark
    padless
    style="width:100vw"
  >
    <v-card
      flat
      tile
      class="blue darken-4 white--text text-center"
      width="100%"
    >

      <v-card-text class="white--text pt-0">
          <v-row class="p-5 justify-content-center flex-column flex-sm-column  flex-md-row" >
              <v-col
                cols=12
                sd=12
                md=4
               >
                    <v-img src="/images/logo-footer-canepa.png"  contain width="22rem" ></v-img>
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
                        <li><a href="https://www.facebook.com/inmobiliariadanielcanepa/"><v-icon class="mr-2">mdi-facebook</v-icon>Facebook</a></li>
                        <li><a href="https://www.instagram.com/inmobiliariadanielcanepa"><v-icon class="mr-2">mdi-instagram</v-icon>Instagram</a></li>
                        <li><a href="#"><v-icon class="mr-2">mdi-shopping-outline</v-icon>Mercado Libre</a></li>
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
      
      </v-card-text>

        <v-divider></v-divider>
      <v-card-text class="white--text">
        <strong>Daniel Cánepa propiedades</strong>
      </v-card-text>
    </v-card>
  </v-footer>
    
    
    </div>

</body>
<style>
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

    *{
        font-family: 'Heebo', sans-serif !important;
    }
    .blue{
        background-color: #1A237E !important;
    }
</style>

</html>