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
                                    <h2 class="text-md-h1 text-h4 font-weight-bold">
                                        {{item.title}}
                                    </h2>
                                    
                                    <span class="text-md-h3 text-h5">
                                        {{item.subtitle}}
                                    </span>
                                    <div class="mt-3">
                                        <v-btn
                                            elevation="7"
                                            outlined
                                            x-large
                                            rounded
                                            color="white my-9"
                                            @click="item.url"
                                            >Ver más</v-btn>
                                    </div>
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
 
    <front-footer></front-footer>  
  
   </div>
</template>


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
