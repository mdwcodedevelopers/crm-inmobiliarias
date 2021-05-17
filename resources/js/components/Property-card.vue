<template>
   <div>
        <v-card class="p-3">

            <v-col
                cols="12"
                sm="12"
                class="p-3 d-flex justify-space-between my-2">
                    <div class="text--primary h2 ">
                        {{property.title}}
                    </div>
                    <div class="d-flex align-items-center">
                        <h5>
                                Precio:
                        <span   class="success--text ">
                            {{property.price}} {{property.currency.name}}
                        </span>
                        </h5>
                    </div>
            </v-col>

                <v-col
            >
                <v-carousel :show-arrows="true">
                    <v-carousel-item
                        v-for="(item,i) in items" :key="i"
                        :src="'../../'+item.url"
                        >

                        </v-carousel-item>
                </v-carousel>
            </v-col>
            <v-col
            class="d-flex justify-space-between mx-4"
            >
            <v-card-text class="font-weight-bold blue--text text--darken-4 text-left" style="font-size:1.25rem">
                {{property.status.name}} | {{property.dimension}} mt2  | {{property.toilettes}}  baños | {{property.bedrooms}}  cuartos
            </v-card-text>
                <v-card-actions absolute right>
                    <v-btn color="blue darken-4"><v-icon class="white--text">mdi-facebook</v-icon></v-btn>
                    <v-btn color="purple lighten-2"><v-icon class="white--text">mdi-instagram</v-icon></v-btn>
                    <v-btn color="light-blue darken-2"><v-icon class="white--text">mdi-twitter</v-icon></v-btn>
                </v-card-actions>
            </v-col>
                <v-card elevation="2">
            <v-col
            >
                    <v-card-title class="primary--text">
                        Descripción
                    </v-card-title>
                    <v-card-text class="d-flex mx-3 black--text">
                        {{property.information}}
                    </v-card-text>
            </v-col>

            <v-col
            >
                    <v-card-title class="primary--text">
                        Información basica
                    </v-card-title>
                    <v-card-text class="d-flex mx-3 black--text" style="text-align:left">
                        <ul class="list-info">
                            <li>Provincia: {{property.province}}</li>
                            <li>Región: {{property.location}}</li>
                            <li>Antiguedad: {{helper_show(antiquitys,property.antiquity).name}}</li>
                            <li>Condición: {{helper_show(conditions,property.condition).name}}</li>
                            <li>Situación: {{helper_show(situations,property.situation).name}}</li>
                        </ul>
                    </v-card-text>
            </v-col>

                <v-col
            >
                    <v-card-title class="primary--text">
                        Ambientes
                    </v-card-title>
                    <v-card-text class="d-flex mx-3 black--text">
                             <v-row no-gutters class="text-left ">
                            <v-col cols="12" sm="3" v-for="item in  environments" :key="item.id">
                                <span class="d-flex align-start my-2">
                                    <v-icon>mdi-check-box-outline</v-icon> {{item.name}}
                                </span>
                            </v-col>
                            </v-row>
                    </v-card-text>
            </v-col>
            <v-col
            >
                    <v-card-title class="primary--text">
                        Servicios
                    </v-card-title>
                    <v-card-text class="d-flex mx-3 black--text">
                        <v-row no-gutters class="text-left ">
                            <v-col v-for="item in services" :key="item.id" cols="12" sm="3">
                                <span class="d-flex align-start my-2" >
                                    <v-icon>mdi-check-box-outline</v-icon> {{item.name}}
                                </span>
                            </v-col>
                        </v-row>

                    </v-card-text>
            </v-col>
        </v-card>

        </v-card>
   </div>
</template>


<style scoped>
    .list-info{
        list-style: none;
        text-align:left;
    }
</style>

<script>
export default {
        props: {
                property: Object,
            },
        data() {
            return {
                items:[],
                environments:[],
                services:[],
                situations:[],
                antiquitys:[],
                conditions:[],
                locations:[],
            }
        },
        created(){
                this.index();
        },
        methods: {
            index() {
                axios.get("/admin/api-images?id=" + this.property.id).then((response) => {
                    this.items = response.data.images;
                });
                axios.get("/admin/api-environment/" + this.property.id).then((response) => {
                    this.environments = response.data.environments;
                    this.situations = response.data.situations;
                    this.antiquitys = response.data.antiquitys;
                    this.conditions = response.data.conditions;
                    this.locations = response.data.locations;
                });
                axios.get("/admin/api-service/" + this.property.id).then((response) => {
                    this.services = response.data.services;
                });
            },
            helper_show(helper, id){
            let x = helper.filter(function (el) {return el.id == id});
                return x[0];
            }
            }
}
</script>
