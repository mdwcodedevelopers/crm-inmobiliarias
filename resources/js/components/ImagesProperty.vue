<template>
    <div class="mt-4">
        <v-card class="d-flex p-2 " style="width:100%">
        <v-btn text href="/properties-user">
            <v-icon>mdi-chevron-left-circle-outline</v-icon>
        </v-btn>
        <span class="display-1">
            Regresar a propiedades
        </span>

        </v-card>
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
                                    v-model="archivo" accept="image/*" placeholder="Subir Archivo" label="Subir Archivo" prepend-icon="mdi-archive" ></v-file-input>
                                </v-flex>

                                <v-flex xs12>
                                    {{error}}
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="danger" @click="dialog = false">Cancelar</v-btn>
                        <v-btn color="success" @click.prevent="saveImage()">Crear</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-layout>
        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialogdelete" persistent max-width="600px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">Desea eliminar:</span>
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
        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialogimage" persistent max-width="600px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">Desea poner como imagen principal</span>
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
            <v-col  v-for="item in images" :key="item.id" cols="4" >
                <v-card>

                    <v-img :src="'../'+item.url_image" ></v-img>

                    <v-card-actions>
                        <!-- <v-btn color="#66BB6A" @click="edit(item.id,item.title,item.dimension,item.price,item.information)">
                            <v-icon color="#fff">
                                mdi-pencil
                            </v-icon>
                        </v-btn> -->
                        <v-btn color="primary" small class="m-3"  v-if="property.image == item.url_image" @click="setimage(item.url_image)">
                            Imagen principal
                    </v-btn>
                    <v-btn color="warning" small class="m-3"  v-else @click="setimage(item.url_image)">
                            Seleccionar como principal
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
        property:Object
    },
    data() {
        return {
            dialogimage: false,
            dialogedit: false,
            dialogdelete: false,
            error: '',
            image: null,
            images: [],
            dialog:false
        }
    },
    methods: {
        saveImage() {
            let InstFormData = new FormData();
            InstFormData.append('image' , this.image);
            InstFormData.append('property_id' , this.id);

            if( !this.validarImagen(this.image) ){
                this.$swal.fire(
                      'Error',
                      this.error,
                      'error'
                    )
            }else{
                axios.post('/admin/api-images', InstFormData , {headers : {'content-type': 'multipart/form-data'}}).then((response) => {
                    if (response.status == 200) {
                        this.dialog= false;
                        this.index();
                        this.$swal.fire(
                        'Imagen subida con exito',
                        '',
                        'success'
                        );
                    }
                }).catch(error => {
                    this.$swal.fire({
                        icon: 'Error',
                        title: 'Ocurrio un error al subir la imagen',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    });
            }
        },
        setimage(image){
            axios.put('/property-images-set/'+this.id,{
                image:image
            }).then((response) => {
                console.log(response);
                if (response.status == 200) {
                    this.property.image = image
                    this.index();
                }
            });
        },
        index(){
            axios.get("/admin/api-images?id=" + this.id).then((response) => {
                    this.images = response.data.images;
                    console.log(response);
                });
        },
        edit_model() {
            axios.put("/admin/api-images/" + this.id_edit, {
            }).then((response) => {
                if (response.status == 200) {
                    this.index();
                }
            });
        },
        delete_model() {
            console.log(this.id_delete);
            axios.delete("/admin/api-images/" + this.id_delete).then((response) => {
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
        },

        validarImagen(uploadFile){

            if (!window.FileReader) {
                this.error= 'El navegador no soporta la lectura de archivos';
                return false;
            }
            if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
                this.error = 'El archivo a adjuntar no es una imagen de un formato valido';
                return false;
            }
            if (uploadFile.size > 500000)
            {
                this.error='El peso de la imagen no puede exceder los 500kb';
                return false;
            }
            return true;
        }
    },
    created(){
        this.index();
    }
}
</script>
