<template>
    <v-container>
        <carousel>
            <slide class="py-4">
                <v-card color="#0D47A1" class="mx-auto text-white" max-width="344">
                    <v-card-text>
                        <p class="display-4 text--primary text-white">
                            Bienvenidos a la familia Cánepa
                        </p>
                    </v-card-text>
                    <h3 class="mx-2 ">Somos la inmobiliaria con más de 40 años en el mercado.</h3>
                </v-card>
            </slide>
            <slide class="py-4">
                <v-card color="#fff" class="mx-auto " max-width="344">
                    <v-card-text>
                        <p class=" text--primary">
                            Desarrollamos viviendas, edificios, barrios; pero sobre todo, desarrollamos sueños.
                        </p>
                    </v-card-text>
                </v-card>
            </slide>
            <slide class="py-4">

            </slide>
        </carousel>
        <v-alert dense color="#2196F3" class="text-white">
            Nuestras propiedades
        </v-alert>
        <v-card class="mx-auto my-3" max-width="400" <v-row align="center">

            <v-col class="d-flex" cols="12" sm="6">
                <v-select :items="items" label="Ciudad"></v-select>
            </v-col>
            <v-col class="d-flex" cols="12" sm="6">

                <v-text-field label="Buscar propiedades" append-icon="mdi-magnify"></v-text-field>
                <v-btn @click="index()"></v-btn>
            </v-col>
            </v-row>

            <v-container fluid>

                <v-row>
                    <v-col v-for="card in properties" :key="card.title" cols="4">
                        <h3 class="text-center venta mt-3">{{card.name}}</h3>
                        <v-card>
                            <v-img src="https://cdn.vuetifyjs.com/images/cards/house.jpg" class="" gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)" height="200px">

                            </v-img>
                            <v-card-title v-text="card.title"></v-card-title>

                            <v-card-actions>
                                <v-chip color="#2979FF" text-color="#fff" class="mr-1">
                                    {{card.dimension}} mt2
                                </v-chip>
                                <v-chip color="#38c172" text-color="#fff" class="mr-3">
                                    {{card.price}}
                                </v-chip>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
            <div class="text-center">
                <v-pagination v-model="page" color="#2979FF" :length="paginate.last_page" circle></v-pagination>
            </div>
            <v-row>
                <div class="text-center">
                    <v-chip class="ma-2" label>
                        Label
                    </v-chip>

                    <v-chip class="ma-2" color="pink" label text-color="white">
                        <v-icon left>
                            mdi-label
                        </v-icon>
                        Tags
                    </v-chip>

                    <v-chip class="ma-2" color="primary" label>
                        <v-icon left>
                            mdi-account-circle-outline
                        </v-icon>
                        John Leider
                    </v-chip>

                    <v-chip class="ma-2" close color="cyan" label text-color="white">
                        <v-icon left>
                            mdi-twitter
                        </v-icon>
                        New Tweets
                    </v-chip>
                </div>

            </v-row>
            <v-row>
                <v-footer color="">
                    <v-btn v-for="link in links" :key="link" color="white" text rounded>
                        {{link}}
                    </v-btn>
                </v-footer>
            </v-row>

    </v-container>
</template>

<script>
import {
    Carousel,
    Slide
} from 'vue-carousel';
export default {
    components: {
        Carousel,
        Slide
    },
    data: () => ({

        paginate: {
            total: 0,
            current_page: 0,
            per_page: 0,
            last_page: 0,
            from: 0,
            to: 0
        },
        properties: [],
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
    methods: {
        index(page, search) {
            axios.get("/api-properties-user?page=" + page + "&search=" + search).then((response) => {
                this.properties = response.data.Properties.data;
                this.paginate = response.data.pagination;
            });
        },

    },
    created() {
        this.index(0, '');
    },


}
</script>

<style>
.venta {
    background-color: #38c172;
    color: #fff;

}

.VueCarousel-slide {
    position: relative;
    background: #2962FF;
    color: #fff;
    font-family: Arial;
    text-align: center;
    min-height: 100px;
}

.label {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

slide {
    margin: 600px;
}

row {
    margin-top: 10px;
}
</style>
