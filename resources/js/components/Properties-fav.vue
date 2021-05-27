<template>

    <div class="text-center">

        <v-card color="blue darken-4">
            <v-card-title class="display-1 text-white">
                Lista de Propiedades favoritas
            </v-card-title>
        </v-card>
        <v-card>
            <v-card-text>
                <section id="properties">
                       <v-row>
                    <v-col  v-for="card in properties" :key="card.id" cols="12" sm="12" md="4">
                        
                       <properties-card :card="card"></properties-card>
                        <!-- <h3 class="text-center venta mt-3">{{card.name}}</h3>
                        <v-card>
                            <v-img :src="'../../'+card.image" class="" gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)" height="200px">

                            </v-img>
                            <v-card-title v-text="card.title"></v-card-title>

                            <v-card-actions>
                                <div class="d-flex flex-column">
                                    <v-chip color="#38c172" text-color="#fff" class="m-1 font-weight-bold">
                                        {{card.price}}
                                        <span class="px-1" v-if="card.currency_id==1"> USD</span>
                                        <span class="px-1" v-else> EUR</span>
                                    </v-chip>
                                    <v-chip color="#2979FF" text-color="#fff" class="m-1 font-weight-bold">
                                        {{card.dimension}} mt2
                                    </v-chip>
                                </div>
                                <v-btn
                                class="ma-2"
                                outlined
                                color="indigo"
                                @click="show(card.id)"
                                absolute
                                right
                              >
                                Ver más
                              </v-btn>
                            </v-card-actions>
                        </v-card> -->
                    </v-col>
                </v-row>
                </section>
            </v-card-text>
        </v-card>

    </div>
</template>


<script>
export default {
    props:{
        properties: Array,
    }
}
</script>
