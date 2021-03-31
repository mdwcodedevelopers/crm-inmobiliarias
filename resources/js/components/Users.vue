<template>
    <div class="text-center">
        <template >
            <v-layout row justify-center>
                <v-dialog v-model="dialog" persistent max-width="600px">
                    <template v-slot:activator="{ on }" >
                        <v-btn color="success" class="my-4" dark v-on="on">Crear usuario  <v-icon>mdi-account-multiple-plus </v-icon></v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">Crear propiedad</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Nombre" v-model="name" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Correo" v-model="email" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Telefono" v-model="phone" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Provincia" v-model="province" required></v-text-field>
                                    </v-flex>  <v-flex xs12 sm6 md6>
                                        <v-text-field label="Dirección" v-model="direction" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <!-- <v-select
                                        v-model="rol_id"
                                        :item-value="roles.id"
                                        :items="roles"
                                        label="Rol de usuario"
                                        single-line
                                      ></v-select> -->
                                      <select class="form-control mt-2" placeholder="Estado" v-model="rol_id">
                                        <option selected disabled>Moneda
                                        </option>
                                        <option v-for="item in roles" :value="item.id" >
                                            {{ item.rol }}
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
        <v-card class="my-4">
            <card-title class="display-1 mt-2" color="blue">Administradores</card-title>
            <v-data-table :headers="headers" :items="admins" item-key="propeties-user" class="elevation-1" :search="search">
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
                    <v-btn color="#E53935" @click="delete_dialog(item.id)">
                        <v-icon color="#fff">
                            mdi-delete
                        </v-icon>
                    </v-btn>
                </template>

            </v-data-table>
        </v-card>

        <v-card class="my-4">
            <card-title class="display-1">Agentes</card-title>
            <v-data-table :headers="headers" :items="agents" item-key="propeties-user" class="elevation-1" :search="search">
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
        </v-card>
        <v-card class="my-4">
            <card-title class="display-1">Usuarios</card-title>
            <v-data-table :headers="usersheader" :items="users" item-key="propeties-user" class="elevation-1" :search="search">
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
        </v-card>

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
                                            <option v-for="item in currency" :value="item.id">
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
            dialog: false,
            dialogedit: false,
            dialogdelete: false,
            id_edit: '',
            error: '',
            id_delete: '',
            // propiedad_eliminar: '',
            admins:[],
            agents:[],
            users:[],
            search:'',
            roles:[],
            name:'',
            rol_id:'',
            email:'',
            phone:'',
            province:'',
            direction:'',
            name_edit:'',
            rol_id_edit:'',
            email_edit:'',
            phone_edit:'',
            province_edit:'',
            direction_edit:''
        }
    },
    methods: {
        index() {
            axios.get("/api-users").then((response) => {
                this.admins = response.data.admins;
                this.agents = response.data.agents;
                this.users = response.data.users;
                this.roles=response.data.roles;
                console.log(this.admins)
            });

        },
        create() {
            axios.post("/api-users", {
                name: this.name,
                email: this.email,
                rol_id:this.rol_id,
                phone:this.phone,
                pronvince:this.province,
                direction:this.direction
            }).then((response) => {
                if (response.status == 200){
                    this.index();
                    this.dialog = false;
                    this.name="";
                    this.email="";
                    this.rol_id="";
                    this.phone="";
                    this.province="";
                    this.direction="";
                }
            });
        },
        edit_model() {
            axios.put("/api-users/" + this.id_edit, {
                name: this.name_edit,
                email: this.email_edit,
                rol_id:this.rol_id_edit,
                phone:this.phone_edit,
                pronvince:this.province_edit,
                direction:this.direction_edit
            }).then((response) => {
                if (response.status == 200) {
                    this.index();
                    this.dialogedit = false;
                    this.name_edit="";
                    this.email_edit="";
                    this.rol_id_edit="";
                    this.phone_edit="";
                    this.province_edit="";
                    this.direction_edit="";
                }
            });
        },
        delete_model() {
            // console.log(this.id_delete);
            axios.delete("/api-users/" + this.id_delete).then((response) => {
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
            // this.dialogedit = true;
            // this.id_edit = id;
            // this.title_edit = title;
            // this.information_edit = info;
            // this.price_edit = price;
            // this.dimension_edit = dimension;
            // console.log(this.id_edit)
        },
        delete_dialog(id) {
             console.log("sadsad");
            this.id_delete = id;
            this.dialogdelete = true;
        },
    },
    created() {
        this.index(0, '');
    },
    computed: {
        headers() {
                return [
                    {
                        text: 'Usuario',
                        value: 'name'
                    },
                    {
                        text: 'Correo',
                        value: 'email'
                    },
                    {
                        text: 'Acciones',
                        value: 'action',
                        sortable: false,
                        align: 'center'
                    },
                ]
        },
        usersheader(){
            return [
                    {
                        text: 'Usuario',
                        value: 'name'
                    },
                    {
                        text: 'Correo',
                        value: 'email'
                    },
                    {
                        text: 'Telefono',
                        value: 'phone'
                    },
                    {
                        text: 'Provincia',
                        value: 'pronvince'
                    },
                    {
                        text: 'Dirección',
                        value: 'direction'
                    },
                    {
                        text: 'Correo',
                        value: 'email'
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
}
</script>
