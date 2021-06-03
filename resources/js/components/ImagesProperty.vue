<template>
    <div class="mt-4">

        <v-btn color="success" @click="createmodal()" dark>Subir imagen</v-btn>
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
                        <v-btn color="success" @click.prevent="create()">Subir</v-btn>
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
            <v-col  v-for="item in images" :key="item.id" cols="12" sd="12"  >
                <v-card>

                    <v-img :src="'../../'+item.url" ></v-img>

                    <v-card-actions>
                        <!-- <v-btn color="#66BB6A" @click="edit(item.id,item.title,item.dimension,item.price,item.information)">
                            <v-icon color="#fff">
                                mdi-pencil
                            </v-icon>
                        </v-btn> -->
                        <v-btn color="primary" small class="m-3"  v-if="item.principal == 1 " @click="setimage(item.url_image)">
                            Imagen principal
                    </v-btn>
                    <v-btn color="warning" small class="m-3"  v-else @click="setimage(item)">
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

    </div>
</template>

<script>
export default {
    props: {
        id:Number,
    },
    data() {
        return {
            dialogimage: false,
            dialogedit: false,
            dialogdelete: false,
            error:'',
            archivo:null,
            images: [],
            dialog:false
        }
    },
    methods: {
        create() {
            let InstFormData = new FormData();
            InstFormData.append('imagen' , this.archivo);
            InstFormData.append('property_id' , this.id);

            if(!this.validarImagen(this.archivo)){
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
            axios.put('/admin/property-images-set/'+ image.id,{
                    principal: 1,
            }).then((response) => {
                console.log(response);
                    this.index();
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
            if (uploadFile.size > 1000000)
            {
                this.error='El peso de la imagen no puede exceder los 1MB';
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
