<template>
  
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
                        <li><a href="#"> Home</a></li>
                        <li><a href="#">Quienes somos</a></li>
                        <li><a href="#">Propiedades</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                </v-col>
                <v-col
                >
                    <ul class="list text-left ">
                        <li class=" font-weight-bold pb-3">Redes Cánepa</li>
                        <li><a href="#"><v-icon class="mr-2">mdi-facebook</v-icon>Facebook</a></li>
                        <li><a href="#"><v-icon class="mr-2">mdi-instagram</v-icon>Instagram</a></li>
                        <li><a href="#"><v-icon class="mr-2">mdi-shopping-outline</v-icon>Mercado Libre</a></li>
                    </ul>
                </v-col>
                <v-col
                >
                    <ul class="list text-left">
                        <li class=" font-weight-bold pb-3">Términos</li>
                        <li><a href="#">Política de privacidad</a></li>
                        <li><a href="#">Términos y condiciones</a></li>
                        <li><a href="#">Trabajá con nosotros</a></li>
                        <li><a href="#">FAQ's</a></li>
                    </ul>
                </v-col>
              </v-col>
          </v-row>
      
      </v-card-text>

        <v-divider></v-divider>
      <v-card-text class="white--text">
        Copyright {{ new Date().getFullYear() }} — <strong>Daniel Cánepa propiedades</strong>
      </v-card-text>
    </v-card>
  </v-footer>
  
</template>


<style scoped>
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

</style>

<script>

</script>
