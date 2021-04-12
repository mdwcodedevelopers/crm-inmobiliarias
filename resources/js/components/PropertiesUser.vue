<template>
    <div class="text-center">

        <v-card color="blue">
            <v-card-title class="display-1 text-white">Propiedades             <v-btn
                color="success"
                dark
                absolute
                right
                fab
                class="mt-1"
                @click="dialog=true"
              >
                <v-icon>mdi-plus</v-icon>
              </v-btn></v-card-title>

            <v-data-table :headers="headers"  no-results-text="No hay resultados" no-data-text="No hay propiedades " :items="properties" item-key="propeties-user" class="elevation-1" :search="search">
                <template v-slot:item.imagen="{ item }">
                    <v-img :src="'../'+item.image" height="100" width="100"></v-img>  
                </template>
                <template v-slot:top>
                    <v-toolbar flat>
                    <v-text-field v-model="search" label="Buscar" class="mt-3"></v-text-field>
                    <v-spacer></v-spacer>
            <v-btn @click="exportPDF()" color="#E53935" dark>Pdf <v-icon>mdi-file-pdf</v-icon></v-btn>

                    </v-toolbar>
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

                    <v-btn color="#66BB6A" class="m-1" @click="edit(item.id,item.title,item.dimension,item.price,item.information)">
                        <v-icon color="#fff">
                            mdi-pencil
                        </v-icon>
                    </v-btn>
                    <v-btn color="warning" class="m-1" @click="images(item.id)">
                        <v-icon color="#fff">
                            mdi-file-image
                        </v-icon>
                    </v-btn>
                    <v-btn color="blue darken-2" class="m-1" @click="shareFace(item.id)">
                        <v-icon color="#fff">
                            mdi-facebook
                        </v-icon>
                    </v-btn>
                    <v-btn color="blue darken-1" class="m-1" @click="shareTwit(item.id)">
                        <v-icon color="#fff">
                            mdi-twitter
                        </v-icon>
                    </v-btn>
                    <v-btn v-if="rol==1" color="#E53935" class="m-1" @click="delete_dialog(item.id,item.title)">
                        <v-icon color="#fff">
                            mdi-delete
                        </v-icon>
                    </v-btn>

                </template>

            </v-data-table>
        </v-card>
        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialog" persistent max-width="600px">

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
                                        <v-select
                                        no-data-text="No hay Monedas "
                                            v-model="currency_id"
                                            :items="currency"
                                            item-text="currency"
                                            item-value="id"
                                            label=" Moneda"
                                        ></v-select>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Información de la propiedad" v-model="information" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-select
                                        no-data-text="No hay Estatus "
                                            v-model="status_id"
                                            :items="status"
                                            item-text="status"
                                            item-value="id"
                                            label="Estatus"
                                        ></v-select>
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
                                         <v-select
                                        no-data-text="No hay Monedas "
                                            v-model="currency_id_edit"
                                            :items="currency"
                                            item-text="currency"
                                            item-value="id"
                                            label=" Moneda"
                                        ></v-select>

                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Información de la propiedad" v-model="information_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-select
                                            v-model="status_id_edit"
                                            :items="status"
                                            item-text="status"
                                            item-value="id"
                                            label="Estatus"
                                            required
                                        ></v-select>

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
import jsPDF from 'jspdf';
import 'jspdf-autotable'
export default {
    props: {
        rol: Number
    },
    data() {
        return {
            properties: [],
            status: [],
            currency: [],
            search: '',
            dialog: false,
            dialogedit: false,
            dialogdelete: false,
            title: '',
            currency_id: '',
            information: '',
            price: '',
            dimension: '',
            id_edit: '',
            title_edit: '',
            information_edit: '',
            price_edit: '',
            dimension_edit: '',
            currency_id_edit: '',
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
                    this.currency = response.data.currency;
                });
            } else {
                axios.get("/api-properties-admin?search=" + search).then((response) => {
                    this.properties = response.data.Properties;
                    this.status = response.data.status;
                    this.currency = response.data.currency;

                });
            }
        },
        create() {
            axios.post("/api-properties", {
                title: this.title,
                information: this.information,
                price: this.price,
                dimension: this.dimension,
                status: this.status_id,
                currency_id: this.currency_id
            }).then((response) => {
                if (response.status == 200) {
                    this.index(0, '');
                    this.title = '';
                    this.information = '';
                    this.price = '';
                    this.dimension = '';
                    this.status_id = '';
                    this.dialog = false;
                    this.currency_id = '';
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
                currency_id: this.currency_id_edit
            }).then((response) => {
                if (response.status == 200) {
                    this.index(0, '');
                    this.title_edit = '';
                    this.information_edit = '';
                    this.price_edit = '';
                    this.dimension_edit = '';
                    this.status_id_edit = '';
                    this.dialogedit = false;
                    this.currency_id_edit = ''
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
        prueba() {
            console.log(this.currency_id_edit);
        },
        images(id) {
            window.location.href = "/property-images/" + id;
        },
        shareFace(id) {
            window.open("https://www.facebook.com/sharer/sharer.php?u=https://" + window.location.host + "/property/" + id, '_blank');
            // window.location.href=;
        },
        shareTwit(id) {
            window.open("https://twitter.com/intent/tweet?text=Me gusta esta propiedad https://" + window.location.host + "/property/" + id, '_blank');
            // window.location.href=;
        },
        exportPDF() {
            if (this.rol == 1) {
                var columns = [

                    {
                        title: 'Propiedad',
                        dataKey: 'title',
                    },
                    {
                        title: 'Ciudad',
                        dataKey: 'city'
                    },
                    {
                        title: "Información",
                        dataKey: "information"
                    },
                    {
                        title: 'Precio',
                        dataKey: 'price'
                    },

                    {
                        title: 'Dimensión',
                        dataKey: 'dimension'
                    },
                    {
                        title: 'Estatus',
                        dataKey: 'status'
                    },
                    {
                        title: 'Usuario',
                        dataKey: 'name'
                    },
                    {
                        title: 'Moneda',
                        dataKey: 'currency'
                    },
                ];
            } else {
                var columns = [

                    {
                        title: 'Propiedad',
                        dataKey: 'title',
                    },
                    {
                        title: 'Ciudad',
                        dataKey: 'city'
                    },
                    {
                        title: "Información",
                        dataKey: "information"
                    },
                    {
                        title: 'Precio',
                        dataKey: 'price'
                    },

                    {
                        title: 'Dimensión',
                        dataKey: 'dimension'
                    },
                    {
                        title: 'Estatus',
                        dataKey: 'status'
                    },
                    {
                        title: 'Moneda',
                        dataKey: 'currency'
                    },
                ];
            }
            var doc = new jsPDF('p', 'pt');
            doc.text('Propiedades', 40, 40);
            doc.autoTable(columns, this.properties, {
                margin: {
                    top: 60
                },
            });
            doc.save('Propiedades.pdf');
        }
    },
    created() {
        this.index(0, '');
    },
    computed: {
        headers() {
            if (this.rol == 1) {
                return [{
                        text: 'Imagen',
                        value: 'imagen'
                    }, {
                        text: 'Propiedad',
                        align: 'start',
                        sortable: true,
                        value: 'title',
                    },
                    {
                        text: 'Ciudad',
                        value: 'city'
                    },
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
            } else {
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
