<template>
    <div class="text-center">
        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialog" persistent max-width="600px">
                    <template v-slot:activator="{ on }">
                        <v-btn color="success" class="my-4" dark v-on="on">Agregar propiedad <v-icon>mdi-home-circle</v-icon> </v-btn>
                    </template>
                    <v-card class="my-4">
                        <v-card-title>
                            <span class="headline">Crear propiedad</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Titulo" v-model="title" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Dimensiones" v-model="dimension"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Precio" v-model="price" persistent-hint required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <select class="form-control mt-2" placeholder="Estado" v-model="currency_id">
                                            <option selected disabled>Moneda
                                            </option>
                                            <option v-for="item in currency" :value="item.id">
                                                {{ item.currency }}
                                            </option>
                                        </select>

                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Información de la propiedad" v-model="information" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <select class="form-control mt-2" placeholder="Estado" v-model="status_id" required>
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
                            <v-btn color="danger" @click="dialog = false">Cancelar</v-btn>
                            <v-btn color="success" @click.prevent="create()">Crear</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-layout>
        </template>
        <v-data-table :headers="headers" :items="properties" item-key="propeties-user" class="elevation-1" :search="search">
            <template v-slot:top>
                <v-text-field v-model="search" label="Buscar" class="mx-4"></v-text-field>
            </template>
            <template>
                <tr>
                    <td></td>
                    <td>
                    </td>
                    <td colspan="4"></td>
                </tr>
            </template>
            <template v-slot:item.action="{ item }">

                <v-btn color="#66BB6A" @click="edit(item.id,item.title,item.dimension,item.price,item.information)">
                    <v-icon color="#fff">
                        mdi-pencil
                    </v-icon>
                </v-btn>
                <v-btn color="warning" @click="delete_dialog(item.id,item.title)">
                    <v-icon color="#fff">
                        mdi-file-image
                    </v-icon>
                </v-btn>
                <v-btn color="#E53935" @click="delete_dialog(item.id,item.title)">
                    <v-icon color="#fff">
                        mdi-delete
                    </v-icon>
                </v-btn>
            </template>

        </v-data-table>
        <template>
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
        </template>
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
    </div>
</template>

<script>
export default {
    props: {
        rol: Number
    },
    data() {
        return {
            paginate: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            properties: [],
            status: [],
            currency:[],
            search: '',
            dialog: false,
            dialogedit: false,
            dialogdelete: false,
            title: '',
            currency_id:'',
            information: '',
            price: '',
            dimension: '',
            id_edit: '',
            title_edit: '',
            information_edit: '',
            price_edit: '',
            dimension_edit: '',
            currency_id_edit:'',
            error: '',
            id_delete: '',
            propiedad_eliminar: '',
            status_id: '',
            status_id_edit: ''
        }
    },
    methods: {
        index(page, search) {
            if (this.rol == 2) {
                axios.get("/api-properties-user?&search=" + search).then((response) => {
                    this.properties = response.data.Properties;
                    this.status = response.data.status;
                    this.currency=response.data.currency;
                });
            } else {
                axios.get("/api-properties-admin?search=" + search).then((response) => {
                    this.properties = response.data.Properties;
                    this.status = response.data.status;
                    this.currency=response.data.currency;

                });
            }
        },
        create() {
            console.log(this.status_id);
            axios.post("/api-images", {
                title: this.title,
                information: this.information,
            }).then((response) => {
                if (response.status == 200) {
                    this.index(0, '');
                    this.title = '';
                    this.information = '';
                    this.price = '';
                    this.dimension = '';
                    this.status_id_edit = '';
                    this.dialog = false;
                    this.currency_id='';
                }
            });
        },
        edit_model() {
            axios.put("/api-properties/" + this.id_edit, {
                title: this.title_edit,
                dimension: this.dimension_edit,
                information: this.information_edit,
                price: this.price_edit,
                status: this.status_id_edit,
                currency_id:this.currency_id_edit
            }).then((response) => {
                if (response.status == 200) {
                    this.index(0, '');
                    this.title_edit = '';
                    this.information_edit = '';
                    this.price_edit = '';
                    this.dimension_edit = '';
                    this.status_id_edit = '';
                    this.dialogedit = false;
                    this.currency_id_edit=''
                }
            });
        },
        delete_model() {
            console.log(this.id_delete);
            axios.delete("/api-properties/" + this.id_delete).then((response) => {
                console.log(response);
                if (response.status == 200) {
                    this.index(0, '');
                    this.dialogdelete = false;
                } else {
                    this.error = "Error al añadir propiedad";
                }
            });
        },
        edit(id, title, dimension, price, info) {
            this.dialogedit = true;
            this.id_edit = id;
            this.title_edit = title;
            this.information_edit = info;
            this.price_edit = price;
            this.dimension_edit = dimension;
            console.log(this.id_edit)
        },
        delete_dialog(id, title) {
            this.id_delete = id;
            this.dialogdelete = true;
            this.propiedad_eliminar = title;
        },
        prueba(){
            console.log(this.currency_id_edit);
        }
    },
    created() {
        this.index(0, '');
    },
    computed: {
        headers() {
            if(this.rol==1){
                return [
                {
                    text: 'Imagen',
                    value: 'image'
                },{
                    text: 'Propiedad',
                    align: 'start',
                    sortable: true,
                    value: 'title',
                },
                // { text: 'Ciudad', value: 'city' },
                {
                    text: 'Información',
                    value: 'information'
                },
                {
                    text: 'Precio',
                    value: 'price'
                },
                {
                    text: 'Dimensión',
                    value: 'dimension'
                },
                {
                    text: 'Estatus',
                    value: 'status'
                },
                {
                    text: 'Usuario',
                    value: 'name'
                },
                {
                    text: 'Moneda',
                    value: 'currency'
                },
                {
                    text: 'Acciones',
                    value: 'action',
                    sortable: false,
                    align: 'center'
                },
            ]
            }
            else{
                return [{
                    text: 'Propiedad',
                    align: 'start',
                    sortable: true,
                    value: 'title',
                },
                // { text: 'Ciudad', value: 'city' },
                {
                    text: 'Información',
                    value: 'information'
                },
                {
                    text: 'Precio',
                    value: 'price'
                },
                {
                    text: 'Dimensión',
                    value: 'dimension'
                },
                {
                    text: 'Estatus',
                    value: 'name'
                },
                {
                    text: 'Moneda',
                    value: 'currency'
                },
                {
                    text: 'Acciones',
                    value: 'action',
                    sortable: false,
                    align: 'center'
                },
            ]
            }

        },
    },
}
</script>
