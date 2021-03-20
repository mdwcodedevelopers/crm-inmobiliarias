<template>
    <div>
        <!--<v-row justify="space-around">
            <v-icon @click="model--">
              mdi-minus
            </v-icon>
            {{ model }}
            <v-icon @click="model++">
              mdi-plus
            </v-icon>
          </v-row>-->
          <v-carousel v-model="model">
            <v-carousel-item
              :key="color"
            >
              <v-sheet
                :color="color"
                height="100%"
                tile
              >
                <v-row
                  class="fill-height"
                  align="center"
                  justify="center"
                >
                  <div class="display-3">
                    Bienvenidos a la familia Cánepa.
                    Somos la inmobiliaria con más de 40 años en el mercado.
                  </div>

                </v-row>

              </v-sheet>

            </v-carousel-item>
            <v-carousel-item
            :key="color"
          >
            <v-sheet
              :color="color"
              height="100%"
              tile
            >
              <v-row
                class="fill-height"
                align="center"
                justify="center"
              >
                <div class="display-3">

                  Desarrollamos viviendas, edificios, barrios; pero sobre todo, desarrollamos sueños.
                </div>

              </v-row>

            </v-sheet>

          </v-carousel-item>
          </v-carousel>
      <v-card
      class="mx-auto my-3"
      max-width="400"
      <v-row align="center">
      <v-col
        class="d-flex"
        cols="12"
        sm="6"
      >
         <v-select
          :items="items"
          label="Ciudad"
        ></v-select>
      </v-col>
      <v-col
      class="d-flex"
      cols="12"
      sm="6"
    >
    <v-text-field label="Buscar propiedades" append-icon="mdi-magnify"></v-text-field>

    </v-col>
    </v-row>

        <v-container fluid>

          <v-row dense>
            <v-col
              v-for="card in properties"
              :key="card.title"
              cols=4
            >
            <h3 class="text-center venta mt-3">{{card.name}}</h3>
              <v-card>
                <v-img
                  src="https://cdn.vuetifyjs.com/images/cards/house.jpg"
                  class=""
                  gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                  height="200px"
                >

                </v-img>
                <v-card-title v-text="card.title"></v-card-title>

                <v-card-actions>
                    <v-chip
                    color="#2979FF"
                    text-color="#fff"
                    class="mr-1"
                  >
                     {{card.dimension}} mt2
                  </v-chip>
                    <v-chip
                    color="#38c172"
                    text-color="#fff"
                    class="mr-3"
                  >
                     {{card.price}}
                  </v-chip>
                </v-card-actions>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
        <div class="text-center">
            <v-pagination
              v-model="page"
              color="#2979FF"
              :length="paginate.last_page"
              circle
            ></v-pagination>
          </div>
          <v-footer
          color=""
        >
            <v-btn
            v-for="link in links"
            :key="link"
            color="white"
            text
            rounded
          >
          {{link}}
          </v-btn>
        </v-footer>
    </div>
</template>
<script>
    export default {
      data: () => ({
        page: 1,
        paginate: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
        properties:[],
        cards: [
          { title: 'Pre-fab homes', src: 'https://cdn.vuetifyjs.com/images/cards/house.jpg', flex: 4 },
          { title: 'Favorite road trips', src: 'https://cdn.vuetifyjs.com/images/cards/road.jpg', flex: 4 },
          { title: 'Best airlines', src: 'https://cdn.vuetifyjs.com/images/cards/plane.jpg', flex: 4 },
          { title: 'Pre-fab homes', src: 'https://cdn.vuetifyjs.com/images/cards/house.jpg', flex: 4 },
          { title: 'Favorite road trips', src: 'https://cdn.vuetifyjs.com/images/cards/road.jpg', flex: 4 },
          { title: 'Best airlines', src: 'https://cdn.vuetifyjs.com/images/cards/plane.jpg', flex: 4 },
          { title: 'Pre-fab homes', src: 'https://cdn.vuetifyjs.com/images/cards/house.jpg', flex: 4 },
          { title: 'Favorite road trips', src: 'https://cdn.vuetifyjs.com/images/cards/road.jpg', flex: 4 },
          { title: 'Best airlines', src: 'https://cdn.vuetifyjs.com/images/cards/plane.jpg', flex: 4 },
          { title: 'Pre-fab homes', src: 'https://cdn.vuetifyjs.com/images/cards/house.jpg', flex: 4 },
          { title: 'Favorite road trips', src: 'https://cdn.vuetifyjs.com/images/cards/road.jpg', flex: 4 },
          { title: 'Best airlines', src: 'https://cdn.vuetifyjs.com/images/cards/plane.jpg', flex: 4 },
        ],
        links: [
          'Home',
          'Acerca de nosotros',
          'Propiedades',
          'Contacto',
          '',

        ],
        colors: [
          'primary',
          'secondary',
          'yellow darken-2',
          'red',
          'orange',
        ],
        model: 0,
        colors: [
          '#38c172',
          '#38c172',
          '#38c172',
          '#38c172',
          '#38c172',
        ],
        slides: [
          'First',
          'Second',
          'Third',
          'Fourth',
          'Fifth',
        ],
      }),
      methods:{
          index(page,search){
            axios.get("/api-properties?page=" + page + "&search=" + search).then((response) => {
                this.properties = response.data.Properties.data;
                this.paginate = response.data.pagination;
            });
          }
      },
      created(){
          this.index(0,'');
      },

    }
  </script>
<style >
    .venta{
        background-color: #38c172;
        color: #fff;

    }
</style>
