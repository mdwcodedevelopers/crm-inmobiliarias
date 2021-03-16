<template>
    <div class="container">
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
              v-for="card in cards"
              :key="card.title"
              :cols="card.flex"
            >
              <v-card>
                <v-img
                  :src="card.src"
                  class="white--text align-end"
                  gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                  height="200px"
                >

                </v-img>
                <v-card-title v-text="card.title"></v-card-title>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-chip
                  class="mt-2 ml-4"
                  color="#38c172"
                  text-color="#fff"
                >
                  En venta
                </v-chip>
                </v-card-actions>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
        <div class="text-center">
            <v-pagination
              v-model="page"
              :length="4"
              circle
            ></v-pagination>
          </div>
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
        colors: [
          'indigo',
          'warning',
          'pink darken-2',
          'red lighten-1',
          'deep-purple accent-4',
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
                console.log(response.data.Properties);

                this.properties = response.data.Properties.data;
                this.paginate = response.data.pagination.data;
            });
          }
      },
      created(){
          this.index(0,'');
      }
    }
  </script>
