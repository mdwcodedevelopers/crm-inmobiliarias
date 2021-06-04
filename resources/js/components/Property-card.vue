<template>
   <div>
        <v-card class="p-3">

            <v-col
                cols="12"
                sm="12"
                class="pt-3 d-flex justify-space-between align-items-start my-2">
                    <div class="d-flex flex-column">
                        <div class="text--primary h2 ">
                            {{property.title}}
                        </div>
                        <div class="text-left grey--text text--lighten-1 ">
                            <v-icon class=" grey--text text--lighten-1 ">mdi-map-marker</v-icon>
                            <span>{{property.province}}</span>
                        </div>
                        <div class="text-left mt-3">
                             {{property.dimension}} mt2  | {{property.toilettes}}  baños | {{property.bedrooms}}  cuartos
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <h5>
                                Precio:
                        <span   class="success--text ">
                            {{property.price}} {{property.currency.name}}
                        </span>
                        <v-chip
                            class="ma-2"
                            color="primary"
                        >
                            {{property.status.name}}
                        </v-chip>
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
            class="d-flex flex-column flex-md-row justify-space-between mx-4"
            >
            <v-btn rounded class="purple darken-1 white--text" @click="favProperty()" >
                <v-icon v-if="!favorite" class="white--text">mdi-star-outline</v-icon>
                <v-icon v-else class="orange--text lighten-1--text">mdi-star</v-icon>
                Agregar a favoritos
            </v-btn>
            <!-- <v-card-text class="font-weight-bold blue--text text--darken-4 text-left" style="font-size:1.25rem">
                {{property.status.name}} | {{property.dimension}} mt2  | {{property.toilettes}}  baños | {{property.bedrooms}}  cuartos
            </v-card-text> -->
                <v-card-actions absolute right>
                    <v-btn color="blue darken-4" @click="facebook()"><v-icon class="white--text">mdi-facebook</v-icon></v-btn>
                    <v-btn color="light-blue darken-2" @click="twitter()"><v-icon class="white--text">mdi-twitter</v-icon></v-btn>
                    <v-btn color="green darken-2" @click="whatsapp()"><v-icon class="white--text">mdi-whatsapp</v-icon></v-btn>
                </v-card-actions>
            </v-col>
                <v-card elevation="2">
            <v-col
            >
                    <v-card-title class="primary--text">
                        Descripción
                    </v-card-title>
                    <v-card-text class="d-flex mx-3 black--text text-left">
                        {{property.information}}
                    </v-card-text>
            </v-col>

            <v-col
            >
                    <v-card-title class="primary--text">
                        Información básica
                    </v-card-title>
                    <v-card-text class="d-flex mx-3 black--text pb-0" style="text-align:left">
                        <ul class="list-info m-0">
                             <v-row no-gutters class="text-left">
                                <v-col cols="12" sm="4" class="mb-2">
                                    <li><strong>Propósito:</strong> {{property.status.name}}</li>
                                </v-col>
                                <v-col cols="12" sm="4" class="mb-2">
                                    <li><strong>Provincia:</strong> {{property.province}}</li>
                                </v-col>
                                <v-col cols="12" sm="4" class="mb-2">
                                    <li><strong>Región:</strong> {{property.location}}</li>                                
                                </v-col>
                                <v-col cols="12" sm="4" class="mb-2">
                                    <li><strong>Antiguedad:</strong> {{helper_show(antiquitys,property.antiquity).name}}</li>
                                </v-col>
                                <v-col cols="12" sm="4" class="mb-2">
                                    <li><strong>Condición:</strong> {{helper_show(conditions,property.condition).name}}</li>
                                </v-col>
                                <v-col cols="12" sm="4" class="mb-2">
                                    <li><strong>Situación:</strong> {{helper_show(situations,property.situation).name}}</li>
                                </v-col>
                                 <v-col cols="12" sm="4" class="mb-2">
                                    <li><strong>Plantas:</strong> {{property.plants}}</li>
                                </v-col>
                                 <v-col cols="12" sm="4" class="mb-2">
                                    <li><strong>Dormitorios:</strong> {{property.bedrooms}}</li>
                                </v-col>
                                 <v-col cols="12" sm="4" class="mb-2">
                                    <li><strong>Baño:</strong> {{property.toilettes}}</li>
                                </v-col>
                                 <v-col cols="12" sm="4" class="mb-2">
                                    <li><strong>Cocheras:</strong> {{property.chocheras}}</li>
                                </v-col>
                                 <v-col cols="12" sm="4" class="mb-2">
                                    <li><strong>Tamaño:</strong> {{property.dimension}} mt2</li>
                                </v-col>
                             </v-row>
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
                favorite:'',
                services:[],
                situations:[],
                antiquitys:[],
                conditions:[],
                locations:[],
            }
        },
        created(){
                this.index();
                this.favorite = this.property.favorite == 1 ? true : false;
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
            favProperty(){
                this.favorite = this.favorite == 1 ? 0 : 1;
                axios.get("/admin/api-properties-user/favorite/" + this.property.id).then((response) => {
                     this.favorite = (response.data == 1) ?  1 : 0;
                });
            },
            helper_show(helper, id){
            let x = helper.filter(function (el) {return el.id == id});
                return x[0];
            },
            facebook(){
                var currentUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + window.location.href;
                window.open(currentUrl, '_blank');
            },
            twitter(){
                var currentUrl = 'https://twitter.com/intent/tweet?text=&url=' + window.location.href;
                window.open(currentUrl, '_blank');
            },
            whatsapp(){
                var currentUrl = 'https://api.whatsapp.com/send?text=' + window.location.href;
                window.open(currentUrl, '_blank');
            }


            }
}
</script>
