<template>
    <div class="text-center">
        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialog" persistent max-width="600px">
                    <template v-slot:activator="{ on }">
                        <v-btn color="success" dark v-on="on">Nueva propiedad</v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">Crear propiedad</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field label="Titulo" v-model="title" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field label="Dimensiones" v-model="dimension"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field label="Precio" v-model="price" persistent-hint required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field label="Información de la propiedad" v-model="information" required></v-text-field>
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
        <v-data-table :headers="headers" :items="properties" item-key="name" class="elevation-1" :search="search">
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
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field label="Titulo" v-model="title_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field label="Dimensiones" v-model="dimension_edit"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field label="Precio" v-model="price_edit"  required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field label="Información de la propiedad" v-model="information_edit" required></v-text-field>
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
                            <v-btn color="success" @click.prevent="edit_model()">Eliminar</v-btn>
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
            search: '',
            dialog: false,
            dialogedit: false,
            dialogdelete: false,
            title: '',
            information: '',
            price: '',
            dimension: '',
            id_edit: '',
            title_edit: '',
            information_edit: '',
            price_edit: '',
            dimension_edit: '',
            error: '',
            id_delete: '',
            propiedad_eliminar:''
        }
    },
    methods: {
        index(page, search) {
            axios.get("/api-properties-user?page=" + page + "&search=" + search).then((response) => {
                this.properties = response.data.Properties;
            });
        },
        create() {

            axios.post("/api-properties", {
                title: this.title,
                information: this.information,
                price: this.price,
                dimension: this.dimension
            }).then((response) => {
                if (response.status == 200) {
                    this.index(0, '');
                    this.title = '';
                    this.information = '';
                    this.price = '';
                    this.dimension = '';
                    this.dialog = false;
                }
            });
        },
        edit_model() {
            const edit={
                title: this.title_edit,
                information: this.information_edit,
                price: this.price_edit,
                dimension: this.dimension_edit
            };
            axios.put("/api-properties-put/"+this.id_edit ,{edit} ).then((response) => {
                if (response.status == 200) {
                    this.index(0, '');
                    this.title_edit = '';
                    this.information_edit = '';
                    this.price_edit = '';
                    this.dimension_edit = '';
                    this.dialogedit = false;
                }
            });
        },
        delete_model() {
            console.log("sdsadsad");
            console.log(this.id_delete);
            axios.delete("/api-properties/" + this.id_delete).then((response) => {
                console.log(response);
                if (response.status == 200) {
                    this.index(0, '');
                    this.dialog = false;
                } else {
                    this.error = "Error al añadir propiedad";
                }
            });
        },
        edit(id,title,info,price,dimension) {
            this.dialogedit = true;
            this.id_edit=id;
            this.title_edit=title;
            this.information_edit=info;
            this.price_edit= price;
            this.dimension_edit= dimension;
        },
        delete_dialog(id,title) {
            this.id_delete = id;
            this.dialogdelete = true;
            this.propiedad_eliminar=title;
        }
    },
    created() {
        this.index(0, '');
    },
    computed: {
        headers() {
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
                    text: 'Actions',
                    value: 'action',
                    sortable: false,
                    align: 'center'
                },
            ]
        },
    },
}
</script>

