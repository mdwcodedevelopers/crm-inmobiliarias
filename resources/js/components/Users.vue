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
                                        <v-form
                                            ref="form"
                                            v-model="valid"
                                        >
                                            <v-layout wrap>
                                                <v-flex xs12 sm6 md6>
                                                    <v-text-field label="Nombre*" :rules="[v => !!v || 'Debe seleccionar un nombre']" v-model="name" required></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6>
                                                    <v-text-field label="Correo*" :rules="mailRule" v-model="email" required></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6 v-if="role_id==2 | rol==3">
                                                    <v-text-field label="Telefono" :rules="phoneRule" v-model="phone" required></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6 v-if="role_id==2 | rol==3">
                                                    <v-text-field label="Provincia" :rules="[v => !!v || 'Debe escoger una opción']" v-model="province" required></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6 v-if="role_id==2 | rol==3">
                                                    <v-text-field label="Dirección" :rules="[v => !!v || 'Debe llenar la dirección']" v-model="direction" required></v-text-field>
                                                </v-flex>

                                                <v-flex xs12 sm6 md6>
                                                    <v-select
                                                    v-if="rol == 1"
                                                        no-data-text="No hay Roles"
                                                            v-model="role_id"
                                                            :items="roles"
                                                            :rules="selectRules"
                                                            item-text="name"
                                                            item-value="id"
                                                            label="Rol de usuario*"
                                                    ></v-select>
                                                </v-flex>
                                                <v-flex xs12>
                                                    {{error}}
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

            <v-tabs  v-if="rol==1" v-model="tab" background-color="blue" dark>
                <v-tab v-for="itemtab in items" :key="itemtab">
                    {{ itemtab }}
                </v-tab>
            </v-tabs>

            
            <v-tabs  v-else v-model="tab" background-color="blue" dark>
                <v-tab>Usuarios</v-tab>
            </v-tabs>

            <v-tabs-items v-model="tab" class="px-5 py-2">
                <v-btn color="success" dark absolute right fab class="mt-3" @click="dialog=true">
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
                <v-tab-item v-if="rol==1" :key="itemtab">

                    <v-card flat>

                        <v-card  color="orange" class="text-white my-2">

                            <v-card-title class="subtitle-2 mt-2" color="blue">Administradores</v-card-title>
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

                                    <v-btn color="#66BB6A" small @click="edit(item.id,item.name,item.email,1)">
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

                                <v-btn color="#66BB6A" small @click="edit(item.id,item.name,item.email,3)">
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
                        <v-card-title class="subtitle-2 text-white">Usuarios</v-card-title>
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

                                <v-btn color="#66BB6A"  small @click="edit(item.id,item.name,item.email,2)">
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
                                            <v-text-field label="Nombre" :rules="[v => !!v || 'Debe seleccionar un nombre']" v-model="name_edit" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md6>
                                            <v-text-field label="Correo" :rules="mailRule" v-model="email_edit" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md6 v-if="role_id_edit==2 || rol==3">
                                            <v-text-field label="Telefono" :rules="phoneRule" v-model="phone_edit" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md6 v-if="role_id_edit==2 || rol==3">
                                            <v-text-field label="Provincia" :rules="[v => !!v || 'Debe escoger una opción']" v-model="province_edit" required></v-text-field>
                                        </v-flex>
                                        <v-flex xs12 sm6 md6 v-if="role_id_edit==2 || rol==3" >
                                            <v-text-field label="Dirección"  :rules="[v => !!v || 'Debe llenar la dirección']" v-model="direction_edit" required></v-text-field>
                                        </v-flex>

                                        <v-flex xs12 sm6 md6>
                                            <v-select
                                                    v-if="rol == 1"
                                                no-data-text="No hay Roles"
                                                    v-model="role_id_edit"
                                                    :items="roles"
                                                    :rules="selectRules"
                                                    item-text="name"
                                                    item-value="id"
                                                    label="Rol de usuario*"
                                            ></v-select>
                                        </v-flex>
                                        <v-flex xs12>
                                            {{error_edit}}
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
            name: '',
            role_id: 0,
            email: '',
            phone: '',
            province: '',
            direction: '',
            name_edit: '',
            role_id_edit: '',
            email_edit: '',
            phone_edit: '',
            province_edit: '',
            direction_edit: '',
            error_edit: '',
            name_delete: '',
            valid: false,
            email_delete: '',
            tab: null,
            itemtab: '',
            error_edit: '',
            items: [
                'Administradores', 'Agentes', 'Usuarios'
            ],
             selectRules: [
                v => !!v || 'Debe escoger una opción',
            ],
             mailRule: [
                v => !!v || 'Debe dar un correo',
                v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'El Correo no es valido'
            ],
             phoneRule: [
                v => !!v || 'Debe dar un telefono',
                v => v.length != 10 || "El télefono debe de ser valido",
                v => /^([0-9])*$/.test(v) ||  "El télefono debe de ser valido"
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
            if (this.role_id != 0 || this.email != '' || this.name != '') {
                if(this.rol==3){
                    this.role_id = 2;
                }
                if (this.role_id == 1 || this.role_id == 3) {
                    this.phone = "";
                    this.province = "";
                    this.direction = "";
                }
                axios.post("/admin/api-users", {
                    name: this.name,
                    email: this.email,
                    role_id: this.role_id,
                    phone: this.phone,
                    province: this.province,
                    direction: this.direction
                }).then((response) => {
                        this.index();
                        this.dialog = false;
                        // this.error='';
                        this.$swal('Usuario creado con exito', 'La contraseña y verificación fueron enviados al usuario', 'OK');
                        this.name = "";
                        this.email = "";
                        this.role_id = "";
                        this.phone = "";
                        this.province = "";
                        this.direction = "";
                }).catch((e) => {
                    this.$swal({
                        title: 'Error al crear usuario, correo en uso',
                        type: 'warning'
                    });
                });
            } else {
                this.$swal({
                    title: 'Complete todos los campos',
                    type: 'warning'
                });

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
                if (this.role_id_edit == 1 || this.role_id_edit == 3) {
                    this.phone_edit = '';
                    this.province_edit = '';
                    this.direction_edit = '';
                }
                axios.put("/admin/api-users/" + this.id_edit, {
                    name: this.name_edit,
                    email: this.email_edit,
                    role_id: this.role_id_edit,
                    phone: this.phone_edit,
                    province: this.province_edit,
                    direction: this.direction_edit
                }).then((response) => {
                    if (response.status == 200) {
                        this.index();
                        this.dialogedit = false;
                        this.name_edit = "";
                        this.email_edit = "";
                        this.role_id_edit = "";
                        this.phone_edit = "";
                        this.province_edit = "";
                        this.direction_edit = "";
                    }
                }).catch(
                    this.error = "Error al crear Usuario, el email ya esta en uso"
                );
        },
        delete_model() {
            axios.delete("/admin/api-users/" + this.id_delete).then((response) => {
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
            this.role_id_edit = rol;
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
                    align: 'center'
                },
            ]
        }
    },
}
</script>
