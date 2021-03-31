<template>
    <div class="mt-4">
        <v-card
        class="mx-auto
        my-3"
      >
        <v-card-text>
          <p class="display-1 text--primary">
            {{property.title}}
          </p>

          <div class="text--primary">
            {{property.information}}
          </div>

        </v-card-text>
        <v-card-actions>
            <v-chip color="#2979FF" text-color="#fff" class="mr-1">
                {{property.dimension}} mt2
            </v-chip>
            <v-chip color="#38c172" text-color="#fff" class="mr-3">
                {{property.price}}
            </v-chip>
                <v-btn color="success" @click="createmodal()" dark>Subir imagen</v-btn>
        </v-card-actions>
      </v-card>
        <v-layout row justify-center>
            <v-dialog v-model="dialog" persistent max-width="600px">

                <v-card>
                    <v-card-title>
                        <span class="headline">Añadir imagen</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md6>
                                    <v-file-input
v-model="archivo" placeholder="Subir Archivo" label="Subir Archivo" prepend-icon="mdi-archive" ></v-file-input>
                                   <!-- <input
                                            class="appearance-none border-2 border-gray-200 rounded-full w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                                            ref="image" type="file">-->
                                   <!-- <v-file-input ref="image" prepend-icon="mdi-camera" accept="image/png, image/jpeg, image/bmp" show-size counter multiple label="File input"></v-file-input>
                                   --></v-flex>


                                <v-flex xs12>
                                    {{error}}
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="danger" @click="dialog = false">Cancelar</v-btn>
                        <v-btn color="success" @click.prevent="create()">Crear</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-layout>
       <!-- <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialogedit" persistent max-width="600px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">Editar propiedad</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Titulo" v-model="title_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Dimensiones" v-model="dimension_edit"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Precio" v-model="price_edit" persistent-hint required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <select class="form-control mt-2" placeholder="Estado" @click="prueba()" v-model="currency_id_edit">
                                            <option selected disabled>Moneda
                                            </option>
                                            <option v-for="item in currency" :value="item.id" >
                                                {{ item.currency }}
                                            </option>
                                        </select>

                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Información de la propiedad" v-model="information_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <select class="form-control mt-2" placeholder="Estado" v-model="status_id_edit" required>
                                            <option selected disabled>Estatus
                                            </option>
                                            <option v-for="item in status" :value="item.id">
                                                {{ item.status }}
                                            </option>
                                        </select>

                                    </v-flex>
                                    <v-flex xs12>
                                        {{error}}
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="danger" @click="dialogedit = false">Cancelar</v-btn>
                            <v-btn color="success" @click.prevent="edit_model()">Editar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-layout>
        </template>-->
        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialogdelete" persistent max-width="600px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">Desea eliminar: {{propiedad_eliminar}}</span>
                        </v-card-title>
                        <v-card-text>

                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn @click="dialogdelete = false">Cancelar</v-btn>
                            <v-btn color="#E53935" class="text-white" @click.prevent="delete_model()">Eliminar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-layout>
        </template>

        <v-row>
            <v-col  v-for="card in properties" :key="card.id" cols="4" >
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
        <v-row>
            <v-col  v-for="item in images" :key="item.id" cols="4" >
                <v-card>
                    <v-img :src="'../'+item.url_image" ></v-img>

                    <v-card-actions>
                        <v-btn color="#66BB6A" @click="edit(item.id,item.title,item.dimension,item.price,item.information)">
                            <v-icon color="#fff">
                                mdi-pencil
                            </v-icon>
                        </v-btn>
                        <v-btn color="#E53935" @click="delete_dialog(item.id,item.title)">
                            <v-icon color="#fff">
                                mdi-delete
                            </v-icon>
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
      <!--  <div class="" v-for="item in images">
            <v-img :src="'../'+item.url_image"  height="200px" width="200px"></v-img>
            <v-btn color="#66BB6A" @click="edit(item.id,item.title,item.dimension,item.price,item.information)">
                <v-icon color="#fff">
                    mdi-pencil
                </v-icon>
            </v-btn>
            <v-btn color="#E53935" @click="delete_dialog(item.id,item.title)">
                <v-icon color="#fff">
                    mdi-delete
                </v-icon>
            </v-btn>
        </div>
    -->
    </div>
</template>

<script>
export default {
    props: {
        id:Number,
        property:Array
    },
    data() {
        return {
            dialog: false,
            dialogedit: false,
            dialogdelete: false,
            error:'',
            archivo:null,
            images: [],
        }
    },
    methods: {
        create() {
            let InstFormData = new FormData();
            InstFormData.append('imagen' , this.archivo);
            InstFormData.append('images_id' , this.id);
            // if (this.$refs.image) {
            //         this.image = this.$refs.image.files[0]
            //     }

            // // this.image = this.$refs.image.files[0];
            // console.log(this.image);
            // axios.post("/api-images", {
            //     images_id: this.id,
            //     imagen:this.image
            //     // image:this.$refs.image.files[0]
            // },).then((response) => {
            //     console.log(response)
            //     if (response.status == 200) {
            //     }
            // });
            axios.post('/api-images', InstFormData , {headers : {'content-type': 'multipart/form-data'}}).then((response) => {
                if (response.status == 200) {
                    this.index();
                }
            });
        },
        index(){
            axios.get("/api-images?id=" + this.id).then((response) => {
                    this.images = response.data.images;
                });
        },
        edit_model() {
            axios.put("/api-images/" + this.id_edit, {
            }).then((response) => {
                if (response.status == 200) {
                    this.index();
                }
            });
        },
        delete_model() {
            console.log(this.id_delete);
            axios.delete("/api-images/" + this.id_delete).then((response) => {
                console.log(response);
                if (response.status == 200) {
                    this.index();
                    this.dialogdelete = false;
                } else {
                    this.error = "Error al añadir propiedad";
                }
            });
        },
        edit(id, title) {
            this.dialogedit = true;
            console.log(this.id_edit)
        },
        delete_dialog(id, title) {
            this.id_delete = id;
            this.dialogdelete = true;
            this.propiedad_eliminar = title;
        },
        createmodal(){
            this.dialog=true;
        }
    },
    created(){
        this.index();
    }
}
</script>
