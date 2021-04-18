<template>
    <div>

        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialog" persistent max-width="400px">
                    <template v-slot:activator="{ on }">
                        <v-btn color="success" class="my-4" dark v-on="on">Crear Estado de oportunidad 
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">Crear Estado de oportunidad</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12>
                                        <v-text-field label="Nombre de Estado*" v-model="name" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <p>Color del estado</p>
                                        <v-color-picker v-model="color" mode="hexa" mode.sync="hex"></v-color-picker>
                                    </v-flex>
                                    <v-flex xs12>
                                        {{error}}
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="danger" @click="dialog = false; error=''">Cancelar</v-btn>
                            <v-btn color="success" @click.prevent="create()">Crear</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-layout>
        </template>
        <v-data-table :headers="headers" :items="status"  no-results-text="No hay resultados" no-data-text="No hay Estados" class="elevation-1" :search="search">
           <template
                v-slot:body="{ items }"
            >
                    <tbody>
                    <tr
                        v-for="item in items"
                        :key="item.name"
                        :style="{ backgroundColor: item.color}" 
                    >
                        <td 
                        class=" subtitle-1 font-weight-black"
                        style="text-align:left"
                        >{{ item.name }}</td>
                        <td
                        class="subtitle-1 font-weight-black"
                        style="text-align:left"
                        >{{ item.color }}</td>
                        <td>
                            <v-btn color="#66BB6A" @click="edit(item.id,item.name,item.color)">
                                <v-icon color="#fff">
                                    mdi-pencil
                                </v-icon>
                            </v-btn>

                            <v-btn color="#E53935" @click="delete_dialog(item.id,item.name)">
                                <v-icon color="#fff">
                                    mdi-delete
                                </v-icon>
                            </v-btn>
                        </td>
                    </tr>
                    </tbody>
      </template>
            
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
          

        </v-data-table>
        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialogedit" persistent max-width="600px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">Editar Estado</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>

                                    <v-flex xs12>
                                        <v-text-field label="Estado" v-model="name" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <p>Color del estado</p>
                                        <v-color-picker v-model="color" mode="hexa" mode.sync="hex"></v-color-picker>
                                    </v-flex>
                                    <v-flex xs12>
                                        {{error_edit}}
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="danger" @click="dialogedit = false;error_edit=''">Cancelar</v-btn>
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
                            <span class="headline">Desea eliminar el estado: {{status_eliminar}}</span>
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
            status: [],
            dialog: false,
            dialogedit: false,
            dialogdelete: false,
            name: '',
            color:'',
            name_edit: '',
            error: '',
            error_edit: '',
            search: '',
            id_delete: '',
            status_eliminar: '',
            drawer: false,
            group: null,

        }
    },
    watch: {
        group() {
            this.drawer = false
        },
    },
    methods: {
        index() {
            axios.get("/admin/api-status-oportunities").then((response) => {
                this.status = response.data.status;
            });
        },
        create() {
                axios.post("/admin/api-status-oportunities", {
                    name: this.name,
                    color: this.color
                }).then((response) => {
                    if (response.status == 200) {
                        this.index();
                        this.name = '';
                        this.dialog = false;
                        this.$swal('Estado creado con exito', '', 'success');
                    }
                }).catch(error => {
                        this.$swal('Error al añadir estado', 'Seleccione todos los campos', 'error');
                });

        },
        edit_model() {
                axios.put("/admin/api-status-oportunities/" + this.id_edit, {
                    name: this.name,
                    color: this.color
                }).then((response) => {
                    if (response.status == 200) {
                        this.index();
                        this.id_edit = '';
                        this.dialogedit = false;
                    }
                }).catch(error => {
                        this.$swal('Error al editar estado', 'Seleccione todos los campos', 'error');
                });
           
        },
        delete_model() {
            console.log(this.id_delete);
            axios.delete("/admin/api-status-oportunities/" + this.id_delete).then((response) => {
                console.log(response);
                if (response.status == 200) {
                    this.index(0, '');
                    this.dialogdelete = false;
                }
            }).catch(error => {
                     this.error = "Error al añadir propiedad";
                });
        },
        edit(id, name, color) {
            this.dialogedit = true;
            this.id_edit = id;
            this.name = name;
            this.color = color;
        },
        delete_dialog(id, title) {
            this.id_delete = id;
            this.dialogdelete = true;
            this.status_eliminar = title;
        }
    },
    created() {
        this.index();
    },
    computed: {
        headers() {
            return [{
                    text: 'Estados',
                    align: 'start',
                    sortable: true,
                    value: 'name',
                },
                {
                    text: 'Colores',
                    value: 'color',
                },
                {
                    text: 'Acciones',
                    value: 'action',
                }
            ]
        },
    },
}
</script>
