<template>
    <div class="text-center">
        <v-card color="blue" dark>
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
                                        <v-layout wrap>
                                            <v-flex xs12 sm6 md6>
                                                <v-text-field label="Nombre*" v-model="name" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm6 md6>
                                                <v-text-field label="Correo*" v-model="email" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm6 md6 v-if="rol_id==2">
                                                <v-text-field label="Telefono" v-model="phone" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm6 md6 v-if="rol_id==2">
                                                <v-text-field label="Provincia" v-model="province" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm6 md6 v-if="rol_id==2">
                                                <v-text-field label="Dirección" v-model="direction" required></v-text-field>
                                            </v-flex>

                                            <v-flex xs12 sm6 md6>
                                                <select class="form-control mt-2" placeholder="Estado" v-model="rol_id">
                                                    <option selected disabled>Rol de Usuario*
                                                    </option>
                                                    <option v-for="item in roles" :value="item.id">
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
                                    <v-btn color="danger" @click="dialog = false;error=''">Cancelar</v-btn>
                                    <v-btn color="success" @click.prevent="create()">Crear</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-layout>
                </template>
            </v-card-title>

            <div class="display-1">Lista de Usuarios</div>

            <v-tabs v-model="tab" background-color="blue" dark>
                <v-tab v-for="itemtab in items" :key="itemtab">
                    {{ itemtab }}
                </v-tab>
            </v-tabs>

            <v-tabs-items v-model="tab">
                <v-btn
                color="success"
                dark
                absolute
                right
                fab
                class="mt-3"
                @click="dialog=true"
              >
                <v-icon>mdi-plus</v-icon>
              </v-btn>
                <v-tab-item :key="itemtab">

                    <v-card flat>

                        <v-card color="orange" class="text-white my-2">

                            <v-card-title class="display-1 mt-2" color="blue">Administradores</v-card-title>
                            <v-data-table rows-per-page-items="[20, 10, 30, 40]"
                            loading-text="Loading... Please wait" no-data-text="No hay datos disponibles" :headers="headers" :items="admins" item-key="propeties-user" class="elevation-1" :search="search">
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

                                    <v-btn color="#66BB6A" @click="edit(item.id,item.name,item.email,1)">
                                        <v-icon color="#fff">
                                            mdi-pencil
                                        </v-icon>
                                    </v-btn>
                                    <v-btn color="#E53935" @click="delete_dialog(item.id,item.name,item.email)">
                                        <v-icon color="#fff">
                                            mdi-delete
                                        </v-icon>
                                    </v-btn>
                                </template>

                            </v-data-table>
                        </v-card>
                    </v-card>
                </v-tab-item>
                <v-tab-item>
                    <v-card class="my-4" color="blue darken-2">
                        <v-card-title class="display-1 text-white my-2">Agentes</v-card-title>
                        <v-data-table no-data-text="No hay datos disponibles" :headers="headers" :items="agents" item-key="propeties-user" class="elevation-1" :search="search">
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

                                <v-btn color="#66BB6A" @click="edit(item.id,item.name,item.email,3)">
                                    <v-icon color="#fff">
                                        mdi-pencil
                                    </v-icon>
                                </v-btn>
                                <v-btn color="#E53935" @click="delete_dialog(item.id,item.name,item.email)">
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
                        <v-card-title class="display-1 text-white">Usuarios</v-card-title>
                        <v-data-table no-data-text="No hay datos disponibles" :headers="usersheader" :items="users" item-key="propeties-user" class="elevation-1" :search="search">
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

                                <v-btn color="#66BB6A" @click="edit(item.id,item.name,item.email,2)">
                                    <v-icon color="#fff">
                                        mdi-pencil
                                    </v-icon>
                                </v-btn>
                                <v-btn color="#E53935" @click="delete_dialog(item.id,item.name,item.email)">
                                    <v-icon color="#fff">
                                        mdi-delete
                                    </v-icon>
                                </v-btn>
                                <v-btn color="#66BB6A" @click="whatsapp(item.phone)">
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
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Nombre" v-model="name_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="Correo" v-model="email_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6 v-if="rol_id_edit==2">
                                        <v-text-field label="Telefono" v-model="phone_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6 v-if="rol_id_edit==2">
                                        <v-text-field label="Provincia" v-model="province_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6 v-if="rol_id_edit==2">
                                        <v-text-field label="Dirección" v-model="direction_edit" required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6>
                                        <select class="form-control mt-2" placeholder="Estado" v-model="rol_id_edit">
                                            <option selected disabled>Moneda
                                            </option>
                                            <option v-for="item in roles" :value="item.id">
                                                {{ item.rol }}
                                            </option>
                                        </select>
                                    </v-flex>
                                    <v-flex xs12>
                                        {{error_edit}}
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
            name: '',
            rol_id: 0,
            email: '',
            phone: '',
            province: '',
            direction: '',
            name_edit: '',
            rol_id_edit: '',
            email_edit: '',
            phone_edit: '',
            province_edit: '',
            direction_edit: '',
            error_edit: '',
            name_delete: '',
            email_delete: '',
            tab: null,
            itemtab: '',
            error_edit: '',
            items: [
                'Administradores', 'Agentes', 'Usuarios'
            ],
        }
    },
    methods: {
        index() {
            axios.get("/api-users").then((response) => {
                this.admins = response.data.admins;
                this.agents = response.data.agents;
                this.users = response.data.users;
                this.roles = response.data.roles;
                console.log(this.admins)
            });

        },
        create() {
            if (this.rol_id != 0 || this.email != '' || this.name != '') {
                if (this.rol_id == 1 || this.rol_id == 3) {
                    this.phone = "";
                    this.province = "";
                    this.direction = "";
                }
                axios.post("/api-users", {
                    name: this.name,
                    email: this.email,
                    rol_id: this.rol_id,
                    phone: this.phone,
                    pronvince: this.province,
                    direction: this.direction
                }).then((response) => {
                    if (response.status == 200) {
                        this.index();
                        this.dialog = false;
                        this.name = "";
                        this.email = "";
                        this.rol_id = "";
                        this.phone = "";
                        this.province = "";
                        this.direction = "";
                    } else {
                        this.error = "Error al crear Usuario";
                    }
                }).catch(
                    this.error = "Error al crear Usuario, el email ya esta en uso"
                );
            } else {

                this.error = 'Complete todos los campos obligarios';

            }
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
            if (this.rol_id != 0 || this.email != '' || this.name != '') {
                if (this.rol_id_edit == 1 || this.rol_id_edit == 3) {
                    this.phone_edit = '';
                    this.province_edit = '';
                    this.direction_edit = '';
                }
                axios.put("/api-users/" + this.id_edit, {
                    name: this.name_edit,
                    email: this.email_edit,
                    rol_id: this.rol_id_edit,
                    phone: this.phone_edit,
                    pronvince: this.province_edit,
                    direction: this.direction_edit
                }).then((response) => {
                    if (response.status == 200) {
                        this.index();
                        this.dialogedit = false;
                        this.name_edit = "";
                        this.email_edit = "";
                        this.rol_id_edit = "";
                        this.phone_edit = "";
                        this.province_edit = "";
                        this.direction_edit = "";
                    }
                }).catch(
                    this.error = "Error al crear Usuario, el email ya esta en uso"
                );
            }else{
                this.error_edit = 'Complete todos los campos obligarios';
            }
        },
        delete_model() {
            axios.delete("/api-users/" + this.id_delete).then((response) => {
                if (response.status == 200) {
                    this.index(0, '');
                    this.dialogdelete = false;
                } else {
                    this.error = "Error al añadir propiedad";
                }
            });
        },
        edit(id, name, email, rol) {
            this.dialogedit = true;
            this.id_edit = id;
            this.name_edit = name;
            this.email_edit = email;
            this.rol_id_edit = rol;
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
                    align: 'center'
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
