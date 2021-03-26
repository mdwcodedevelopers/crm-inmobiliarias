<template>
    <div >


    <v-app-bar
      color="deep-purple accent-4"
      dark
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title>Estatus</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-filter</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      absolute
      bottom
      temporary
    >
      <v-list
        nav
        dense
      >
        <v-list-item-group
          v-model="group"
          active-class="deep-purple--text text--accent-4"
        >
          <v-list-item>
            <v-list-item-title>Oportunidades</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-title>Mi empresa</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-title>Usuarios</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

    <template>
        <v-layout row justify-center>
            <v-dialog v-model="dialog" persistent max-width="400px">
                <template v-slot:activator="{ on }">
                    <v-btn color="success" dark v-on="on">Nuevo estado</v-btn>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="headline">Crear estado de propiedad</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12>
                                    <v-text-field label="Nombre" v-model="name" required></v-text-field>
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
    <v-data-table :headers="headers" :items="status" item-key="propeties-user" class="elevation-1" :search="search">
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

                                <v-flex xs12>
                                    <v-text-field label="Información de la propiedad" v-model="name_edit" required></v-text-field>
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
    data() {
        return {
            status: [],
            dialog: false,
            dialogedit: false,
            dialogdelete: false,
            name: '',
            name_edit:'',
            error: '',
            search: '',
            id_delete: '',
            propiedad_eliminar: '',
            drawer: false,
      group: null,

        }
    },
    watch: {
      group () {
        this.drawer = false
      },
    },
    methods: {
        index() {
            axios.get("/api-status").then((response) => {
                this.status = response.data.status;
            });
        },
        create() {

            axios.post("/api-status", {
                name: this.name,
            }).then((response) => {
                if (response.status == 200) {
                    this.index();
                    this.name = '';
                }
            });
        },
        edit_model() {
            axios.put("/api-status/" + this.id_edit, {
                name: this.name_edit,
            }).then((response) => {
                if (response.status == 200) {
                    this.index();
                    this.id_edit = '';
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
        edit(id, name) {
            this.dialogedit = true;
            this.id_edit = id;
            this.naem_edit =name;
        },
        delete_dialog(id, title) {
            this.id_delete = id;
            this.dialogdelete = true;
            this.propiedad_eliminar = title;
        }
    },
    created() {
        this.index();
    },
    computed: {
        headers() {
            return [{
                text: 'Nombre',
                align: 'start',
                sortable: true,
                value: 'name',
            }, ]
        },
    },
}
</script>
