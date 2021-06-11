<template>
    <div class="text-center">
        <v-card color="blue darken-4" dark>
            <v-card-title class="text-center justify-center">
                <template>
                    <v-layout row justify-center>
                        <v-dialog v-model="dialog" persistent max-width="600px">
                            <v-card color="">
                                <v-card-title class="text-center">
                                    <span class="headline">Crear usuario</span>
                                </v-card-title>
                                <v-card-text>
                                    <v-container grid-list-md>
                                        <v-form
                                            ref="form"
                                            v-model="valid"
                                        >
                                            <v-layout wrap>
                                                <v-flex xs12 sm6 md6>
                                                    <v-text-field label="Nombre*" :rules="inputRule" v-model="user.name" required></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6>
                                                    <v-text-field label="Correo*" :rules="mailRule" v-model="user.email" required></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6 v-if="user.role_id==2 | rol==3">
                                                    <v-text-field label="Telefono 1*" :rules="numberRule" v-model="user.phone_1" required></v-text-field>
                                                </v-flex>
                                                 <v-flex xs12 sm6 md6 v-if="user.role_id==2 | rol==3">
                                                    <v-text-field label="Telefono 2" v-model="user.phone_2" required></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6 v-if="user.role_id==2 | rol==3">
                                                    <v-text-field label="Dirección"  v-model="user.direction" required></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6 v-if="user.role_id==2 | rol==3">
                                                    <v-text-field label="Provincia"  v-model="user.province" required></v-text-field>
                                                </v-flex>

                                                <v-flex xs12 sm6 md6>
                                                    <v-select
                                                    v-if="rol == 1"
                                                        no-data-text="No hay Roles"
                                                            v-model="user.role_id"
                                                            :items="roles"
                                                            :rules="selectRules"
                                                            item-text="name"
                                                            item-value="id"
                                                            label="Rol de usuario*"
                                                    ></v-select>
                                                </v-flex>
                                                <v-flex xs12>
                                                    <small class="red--text">Los campos marcados con * son obligatorios</small>
                                                </v-flex>
                                            </v-layout>
                                        </v-form>
                                    </v-container>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="danger" @click="dialog = false;error=''">Cancelar</v-btn>
                                    <v-btn color="success" :disabled="!valid" @click.prevent="create()">Crear</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-layout>
                </template>
            </v-card-title>

            <div class="display-1">Lista de Usuarios</div>

            <v-tabs  v-if="rol==1" v-model="tab" background-color="blue darken-4" dark>
                <v-tab v-for="itemtab in items" :key="itemtab">
                    {{ itemtab }}
                </v-tab>
            </v-tabs>

            
            <v-tabs  v-else v-model="tab" background-color="blue darken-4" dark>
                <v-tab>Clientes</v-tab>
            </v-tabs>

            <v-tabs-items v-model="tab" class="px-5 py-2">
                <v-btn color="success" dark absolute right fab class="mt-3" @click="dialog=true">
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
                <v-tab-item v-if="rol==1" :key="itemtab">

                    <v-card flat>

                        <v-card  color="orange" class="text-white my-2">

                            <v-card-title class="subtitle-2 mt-2" color="blue darken-4">Administradores</v-card-title>
                            <v-data-table no-results-text="No hay resultados" no-data-text="No hay Usuarios" :headers="headers" :items="admins" class="elevation-1" :search="search">
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

                                    <v-btn color="#ff9800" small @click="edit(item)">
                                        <v-icon color="#fff">
                                            mdi-pencil
                                        </v-icon>
                                    </v-btn>
                                    <v-btn color="#E53935"  small @click="delete_dialog(item.id,item.name,item.email)">
                                        <v-icon color="#fff">
                                            mdi-delete
                                        </v-icon>
                                    </v-btn>
                                </template>

                            </v-data-table>
                        </v-card>
                    </v-card>
                </v-tab-item>
                <v-tab-item v-if="rol==1">
                    <v-card class="my-4" color="blue darken-2">
                        <v-card-title class="subtitle-2 text-white my-2">Agentes</v-card-title>
                        <v-data-table no-data-text="No hay Usuarios" no-results-text="No hay resultados" :headers="headers" :items="agents" class="elevation-1" :search="search">
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

                                <v-btn color="#ff9800" small @click="edit(item)">
                                    <v-icon color="#fff">
                                        mdi-pencil
                                    </v-icon>
                                </v-btn>
                                <v-btn color="#E53935" small @click="delete_dialog(item.id,item.name,item.email)">
                                    <v-icon color="#fff">
                                        mdi-delete
                                    </v-icon>
                                </v-btn>
                            </template>

                        </v-data-table>
                    </v-card>
                </v-tab-item>

                <v-tab-item>
                    <v-card class="my-4" color="cyan darken-3">
                        <v-card-title class="subtitle-2 text-white">Clientes</v-card-title>
                        <v-data-table no-data-text="No hay Usuarios" no-results-text="No hay resultados" :headers="usersheader" :items="users" class="elevation-1" :search="search">
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

                                <v-btn color="#ff9800"  small @click="edit(item)">
                                    <v-icon color="#fff">
                                        mdi-pencil
                                    </v-icon>
                                </v-btn>
                                <v-btn color="#E53935" small @click="delete_dialog(item.id,item.name,item.email)">
                                    <v-icon color="#fff">
                                        mdi-delete
                                    </v-icon>
                                </v-btn>
                                <v-btn color="#66BB6A"  small @click="whatsapp(item.phone_1)">
                                    <v-icon color="#fff">
                                        mdi-whatsapp
                                    </v-icon>
                                </v-btn>
                            </template>

                        </v-data-table>
                    </v-card>
                </v-tab-item>
            </v-tabs-items>
        </v-card>

        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialogedit" persistent max-width="600px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">Editar usuario</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-form
                                    ref="form"
                                    v-model="valid"
                                >
                                   <v-layout wrap>
                                        <v-flex xs12 sm6 md6>
                                            <v-text-field label="Nombre*" :rules="inputRule" v-model="user.name" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md6>
                                            <v-text-field label="Correo*" :rules="mailRule" v-model="user.email" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md6 v-if="user.role_id==2 | rol==3">
                                            <v-text-field label="Telefono 1*" :rules="numberRule" v-model="user.phone" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md6 v-if="user.role_id==2 | rol==3">
                                            <v-text-field label="Dirección" v-model="user.direction" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md6 v-if="user.role_id==2 | rol==3">
                                            <v-text-field label="Provincia" v-model="user.province" required></v-text-field>
                                        </v-flex>

                                        <v-flex xs12 sm6 md6>
                                            <v-select
                                            v-if="rol == 1"
                                                no-data-text="No hay Roles"
                                                    v-model="user.role_id"
                                                    :items="roles"
                                                    :rules="selectRules"
                                                    item-text="name"
                                                    item-value="id"
                                                    label="Rol de usuario*"
                                            ></v-select>
                                        </v-flex>
                                        <v-flex xs12>
                                            <small class="red--text">Los campos marcados con * son obligatorios</small>
                                        </v-flex>
                                    </v-layout>
                                </v-form>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="danger" @click="dialogedit = false">Cancelar</v-btn>
                            <v-btn color="success" :disabled="!valid" @click.prevent="edit_model()">Editar</v-btn>
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
                            <span class="headline">Desea eliminar al usuario: {{name_delete}} ({{email_delete}})</span>
                        </v-card-title>
                        <v-card-text>

                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn @click="dialogdelete = false;error_edit=''">Cancelar</v-btn>
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
            drawer: false,
            dialog: false,
            dialogedit: false,
            dialogdelete: false,
            id_edit: '',
            error: '',
            id_delete: '',
            admins: [],
            agents: [],
            users: [],
            search: '',
            roles: [],
            user: {},
            name_delete: '',
            valid: false,
            email_delete: '',
            tab: null,
            itemtab: '',
            error_edit: '',
            items: [
                'Administradores', 'Agentes', 'Clientes'
            ],
             inputRule: [
                v => !!v || 'El campo es obligatorio',
              ],
              selectRule: [
                v => !!v || 'Debe seleccionar una opción',
              ],
              mailRule: [
                v => !!v || 'Debe dar un correo',
                v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'El Correo no es valido'
              ],
              numberRule: [
                v => !!v || 'El campo es obligatorio',
                v => /^[0-9]+([.][0-9]+)?$/.test(v)  || 'Debe ser un valor númerico',
              ],
        }
    },
    methods: {
        index() {
            axios.get("/admin/api-users").then((response) => {
                this.admins = response.data.admins;
                this.agents = response.data.agents;
                this.users = response.data.users;
                this.roles = response.data.roles;
                console.log(this.admins)
            });

        },
        create() {
                if(this.rol==3){
                    this.user.role_id = 2;
                }
                this.user.contact_id = true;
                if (this.user.role_id == 1 || this.user.role_id == 3) {
                    this.user.phone = "";
                    this.user.province = "";
                    this.user.direction = "";
                    this.user.contact_id = false;
                }
                this.$swal.fire(
                        'Haciendo la solicitud espere',
                        'Esto puede demorar un minuto',
                        'warning'); 
                axios.post("/admin/api-users", this.user).then((response) => {
                        this.index();
                        this.dialog = false;
                        // this.error='';
                        this.$swal('Usuario creado con exito', 'La contraseña y verificación fueron enviados al usuario', 'OK');
                        this.user= {};
                }).catch((e) => {
                    this.$swal({
                        title: 'Error al crear usuario, correo en uso',
                        type: 'warning'
                    });
                });
            
        },
        logout() {
            axios.post("/logout", {

            }).then((response) => {
                if (response.status == 200) {
                    window.location.href = "/"
                }
            });
        },
        edit_model() {
            this.user.contact_id = true;
                if (this.user.role_id == 1 || this.user.role_id == 3) {
                    this.user.phone_1 = '';
                    this.user.phone_2 = '';
                    this.user.province = '';
                    this.user.direction = '';
                    this.user.contact_id = false;
                }
                this.$swal.fire(
                        'Haciendo la solicitud espere',
                        'Esto puede demorar un minuto',
                        'warning'); 
                axios.put("/admin/api-users/" + this.user.id, this.user).then((response) => {
                    if (response.status == 200) {
                        this.index();
                        this.$swal('Usuario editado con exito', '', 'OK');
                        this.user = {};
                        this.dialogedit = false;
                    }
                }).catch(
                    this.error = "Error al crear Usuario, el email ya esta en uso"
                );
        },
        delete_model() {
            this.$swal.fire(
                        'Haciendo la solicitud espere',
                        'Esto puede demorar un minuto',
                        'warning'); 
            axios.delete("/admin/api-users/" + this.id_delete).then((response) => {
                if (response.status == 200) {
                    this.index(0, '');
                    this.dialogdelete = false;
                } else {
                    this.error = "Error al añadir propiedad";
                }
            });
        },
        edit(item) {
            this.dialogedit = true;
            this.user = item;
        },
        delete_dialog(id, name, email) {
            this.id_delete = id;
            this.name_delete = name;
            this.email_delete = email;
            this.dialogdelete = true;
        },
        whatsapp(phone) {
            window.location.href = 'https://api.whatsapp.com/send?phone=' + phone;
        }
    },
    created() {
        this.index(0, '');
    },
    computed: {
        headers() {
            return [{
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
                    align: 'center',
                    width: '12rem'
                },
            ]
        },
        usersheader() {
            return [{
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
                    value: 'province'
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
                    align: 'center',
                    width: '12rem'
                },
            ]
        }
    },
}
</script>
