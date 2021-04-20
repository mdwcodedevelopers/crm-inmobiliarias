<template>
    <v-container>
        <!--<carousel>
            <slide class="py-4">
                <v-card color="#0D47A1" class="mx-auto text-white" max-width="344">
                    <v-card-text>
                        <h1 class="text-white">
                            Bienvenidos a la familia Cánepa
                        </h1>
                    </v-card-text>
                    <h3 class="mx-2 ">Somos la inmobiliaria con más de 40 años en el mercado.</h3>
                </v-card>
            </slide>
            <slide class="py-4">
                <v-card color="#fff" class="mx-auto " max-width="344">
                    <v-card-text>
                        <h5 class=" text--primary">
                            Desarrollamos viviendas, edificios, barrios; pero sobre todo, desarrollamos sueños.
                        </h5>
                    </v-card-text>
                </v-card>
            </slide>
            <slide class="py-4">

            </slide>
        </carousel>-->

       <v-row align="center">

            <v-col class="d-flex" cols="12" sm="4">
                <v-select :items="items" label="Ciudad"></v-select>
            </v-col>
            <v-col class="d-flex" cols="12" sm="6">

                <v-text-field label="Buscar propiedades" v-model="search"></v-text-field>
            </v-col>
            <v-col class="d-flex" cols="12" sm="2">

                <v-btn @click="index()" color="success" rounded><v-icon>mdi-magnify</v-icon> </v-btn>

            </v-col>

            </v-row>
            <v-alert dense color="#2196F3" class="text-white">
                Propiedades disponibles: {{total}}
            </v-alert>
            <v-container fluid>

                <v-row>
                    <v-col  v-for="card in properties" :key="card.id" cols="12" sm="12" md="4">
                        <h3 class="text-center venta mt-3">{{card.name}}</h3>
                        <v-card>
                            <v-img :src="'../'+card.image" class="" gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)" height="200px">

                            </v-img>
                            <v-card-title v-text="card.title"></v-card-title>

                            <v-card-actions>
                                <v-chip color="#2979FF" text-color="#fff" class="mr-1">
                                    {{card.dimension}} mt2
                                </v-chip>
                                <v-chip color="#38c172" text-color="#fff" class="mr-3">
                                    {{card.price}} 
                                    <span class="px-1" v-if="card.currency_id==1"> USD</span>
                                    <span class="px-1" v-else> EUR</span>
                                    
                                </v-chip>
                                <v-btn
                                class="ma-2"
                                outlined
                                color="indigo"
                                @click="show(card.id)"
                              >
                                Ver más
                              </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
            <v-pagination v-model="paginate.current_page"     @input="onPageChange()" :total-visible="10"  :length="paginate.last_page" circle></v-pagination>

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
            current_page: 1,
            per_page: 0,
            last_page: 0,
            from: 0,
            to: 0
        },
        total:0,
        search:'',
        properties: [],
        links: [
            'Home',
            'Acerca de nosotros',
            'Propiedades',
            'Contacto',

        ],
        model: 0,
        items:['sads']
    }),
    methods: {
        index() {
            axios.get("/admin/api-properties?page=" +this.paginate.current_page + "&search=" + this.search).then((response) => {
                this.properties = response.data.properties.data;
                this.paginate = response.data.pagination;
                this.total=response.data.total;
            });
            console.log(this.search)
        },
        onPageChange() {
            this.index();
        },
        show(id){
            window.location.href ='/admin/property/'+id;
        }
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
