<template>
   <div>
        <v-card class="p-3">

            <v-col
                cols="12"
                sm="12"
                class="p-3 d-flex justify-space-between my-2">
                    <div class="text--primary h2 ">
                        {{property.name}}
                    </div>
                    <div class="d-flex align-items-center">
                        <h5>
                                Precio: 
                        <span   class="success--text ">
                            {{property.price}} USD
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
            class="d-flex mx-4"
            >
                    {{property.dimension}} mt2 | 2 baños | 3 cuartos
            </v-col>
            <v-col
            >
                <v-card elevation="2">
                    <v-card-title class="primary--text">
                        Descripción
                    </v-card-title>
                    <v-card-text class="d-flex mx-3 black--text">
                        {{property.information}}
                    </v-card-text>
                </v-card>
            </v-col>
            
            <v-col
            >   
                <v-card elevation="2">
                    <v-card-title class="primary--text">
                        Información basica
                    </v-card-title>
                    <v-card-text class="d-flex mx-3 black--text" style="text-align:left">
                        <ul class="list-info">
                            <li>Antiguedad: </li>
                            <li>Condición: </li>
                            <li>Región: </li>
                            <li>Situación: </li>
                            <li>Estado: </li>
                        </ul>
                    </v-card-text>
                </v-card>
            </v-col>

                <v-col
            >
                <v-card elevation="2">
                    <v-card-title class="primary--text">
                        Ambientes
                    </v-card-title>
                    <v-card-text class="d-flex mx-3 black--text">
                         <ul class="list-info">
                            <li v-for="item in environments" :key="item.id">
                                 {{item.name}}: {{item.quantity}}
                            </li>
                        </ul>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col
            >
                <v-card elevation="2">
                    <v-card-title class="primary--text">
                        Servicios
                    </v-card-title>
                    <v-card-text class="d-flex mx-3 black--text">
                         <ul class="list-info">
                            <li v-for="item in services" :key="item.id">
                                 {{item.name}}
                            </li>
                        </ul>
                    </v-card-text>
                </v-card>
            </v-col>
            
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
            }
        },
        created(){
            console.log('kfñsd');
                this.index();
        },
        methods: {
            index() {
                axios.get("/admin/api-images?id=" + this.property.id).then((response) => {
                    this.items = response.data.images; 
                });
                axios.get("/admin/api-environment/" + this.property.id).then((response) => {
                    this.environments = response.data.environments; 
                });
                axios.get("/admin/api-service/" + this.property.id).then((response) => {
                    this.services = response.data.services; 
                });
            },
            }
}
</script>
