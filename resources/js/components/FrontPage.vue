<template>
   <div class="white">
        <section id="carousel">
             <v-carousel 
                cycle 
                :show-arrows="false"
                hide-delimiter-background
                hide-delimiter 
                show-arrows-on-hover
                >
                    <v-carousel-item 
                        v-for="(item,i) in items" :key="i" 
                        gradient="to top right, rgba(21, 73, 129, 0.5), rgba(25,32,72,.7)"
                        :src="item.src" 
                        >
                        <div class="d-flex pl-9 align-center" style="height:100%">
                            <v-fade-transition>
                                <div class="d-flex flex-column ">
                                    <h2 class="text-md-h1 text-h3 font-weight-bold">
                                        {{item.title}}
                                    </h2>
                                    
                                    <span class="text-md-h3 text-h4">
                                        {{item.subtitle}}
                                    </span>
                                    <v-btn
                                        elevation="7"
                                        outlined
                                        x-large
                                        rounded
                                        color="white my-9"
                                        width="6rem"
                                        class="my-3"
                                        @click="item.url"
                                        >Ver más</v-btn>
                                </div>
                            </v-fade-transition>
                        </div>
                        </v-carousel-item>
                </v-carousel>
        </section>
            
        <section id="we-are" style="height:300px" class="text-center py-8">
            <h2 class="display-1 font-weight-bold blue--text text--darken-4 ">
                Quiénes somos
            </h2>
            <p class="mt-9">Somos la inmobiliaria con más de 40 años en el mercado. <br>
            Desarrollamos viviendas, edificios, barrios; pero sobre todo, desarrollamos sueños.</p>
            <p class="grey--text text--darken-2 font-weight-bold ">Bienvenidos a la familia Cánepa.</p>
        </section>

        <section id="parallax">
           <v-card>
                <v-img
                    src="/images/parallax-background.jpg"
                    gradient="to top right, rgba(21, 73, 129, 0.5), rgba(25,32,72,.7)"
                    position="top center"
                    class="white--text d-flex text-center justify-content-center align-center"
                    height="450px"
                >
                <v-card-title class="justify-content-center display-1 font-weight-medium" >Nuestros terrenos</v-card-title>
                <v-card-subtitle class="white--text display-1 my-5 font-italic font-weight-medium">El mejor verde del Oeste</v-card-subtitle>
                <v-card-text>Barrio Papa Francisco, Marino Acosta, Pcia. de Buenos Aires.</v-card-text>
                <v-btn
                elevation="7"
                outlined
                x-large
                rounded
                color="white my-9"
                >Ver más</v-btn>
                </v-img>
            </v-card>
        </section>
        <section id="properties">
            <properties />

        </section>
        <section class ="blue lighten-1 p-5 white--text text-center" id="contacts" width="100%" >
        <h2 class="mb-9 display-2">Conectate con Cánepa</h2>
        <div class="d-flex justify-space-around flex-column flex-sm-column  flex-md-row" width="80%">
            <div>
                <v-icon class="p-4 white--text blue lighten-3 rounded-circle my-4" x-large>mdi-map-marker</v-icon>
                <p>Av. Presidente Perón 25569, Merlo</p>
            </div>
            <div>
                <v-icon class="p-4 white--text blue lighten-3 rounded-circle my-4" x-large>mdi-phone</v-icon>
                <p>+54 220 482-3266</p>
            </div>
            <div>
                <v-icon class="p-4 white--text blue lighten-3 rounded-circle my-4" x-large>mdi-email</v-icon>
                <p>danielcanepaventas@gmail.com</p>
            </div>
        </div>  
        </section>
  <v-footer
    dark
    padless
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
  
  
   </div>
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
export default {
     data() {
            return {
                items:[
                    {
                        src: "/images/slideBg001.jpg",
                        title: 'NAKABUCHI ACQUA',
                        subtitle: 'Conocé una de nuestras mejores inversiones',
                        url: ''
                    },
                     {
                        src: "/images/slideBg002.jpg",
                        title: 'PH EN VENTA',
                        subtitle: 'Interesante inversión con una ubicación ideal',
                        url: ''
                    },
                ],
                
            }
        },
  }
</script>
