<template>
    <div class="">
        <v-card class="mx-auto">

            <v-card-text>
                <p class="display-1 text--primary">
                    Nombre: {{profile.name}}
                </p>
                <div class="text--primary">
                    Correo: {{profile.email}}
                </div>
                <div v-if="profile.rol_id ==2">
                    <div class="text--primary">
                        Telefono:{{profile.phone}}
                    </div>
                    <div class="text--primary">
                        Provincia: {{profile.pronvince}}
                    </div>
                    <div class="text--primary">
                        Dirección: {{profile.direction}}
                    </div>
                </div>

            </v-card-text>
            <v-card-actions>
                <v-btn color="#66BB6A" @click="edit(profile.name,profile.email,profile.phone,profile.pronvince,profile.direction)" class="text-white">
                    Editar perfil
                </v-btn>
                <v-btn color="#66BB6A" @click="modalpass()" class="text-white">
                    Cambiar contraseña
                </v-btn>
            </v-card-actions>
        </v-card>
        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialogedit" persistent max-width="600px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">Editar Usuario</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>

                                    <v-flex xs6>
                                        <v-text-field label="Nombre*" v-model="name_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs6>
                                        <v-text-field label="Correo*" v-model="email_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs6 v-if="profile.rol_id ==2">
                                        <v-text-field label="Teléfono*" v-model="phone_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs6 v-if="profile.rol_id ==2">
                                        <v-text-field label="Provincia*" v-model="province_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 v-if="profile.rol_id ==2">
                                        <v-text-field label="Dirección*" v-model="direction_edit" required></v-text-field>
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
                <v-dialog v-model="dialogpass" persistent max-width="600px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">Editar Usuario</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs6>
                                        <v-text-field type="password" label="Contraseña nueva*" v-model="passnew" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs6>
                                        <v-text-field type="password" label="Confirmar nueva contraseña*" v-model="cpassnew" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs6>
                                        {{error_edit}}
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="danger" @click="dialogpass = false">Cancelar</v-btn>
                            <v-btn color="success" @click.prevent="edit_pass()">Editar</v-btn>
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
            profile: [],
            dialogpass: false,
            dialogedit: false,
            name_edit: '',
            email_edit: '',
            phone_edit: '',
            province_edit: '',
            direction_edit: '',
            passnew: '',
            cpassnew: '',
            error: '',
            error_edit: ''
        }
    },
    methods: {
        index() {
            axios.get("/admin/api-user").then((response) => {
                this.profile = response.data.user;
            });
        },
        edit(name, email, phone, province, direction) {
            this.dialogedit = true;
            this.name_edit = name;
            this.email_edit = email;
            this.phone_edit = phone;
            this.province_edit = province;
            this.direction_edit = direction;
        },
        edit_model() {
            if (this.profile.rol_id == 2 && this.phone_edit == '' || this.province_edit == '' || this.direction_edit == '') {
                this.error = 'Complete todos los campos';
            } else if (this.email_edit == '' || this.name_edit == '') {
                this.error = 'Complete todos los campos';
            } else {
                axios.post("/admin/api-user", {
                    name: this.name_edit,
                    email: this.email_edit,
                    phone: this.phone_edit,
                    pronvince: this.province_edit,
                    direction: this.direction_edit
                }).then((response) => {
                    if (response.status == 200) {
                        this.index();
                        this.name_edit = '';
                        this.email_edit = '';
                        this.phone_edit = '';
                        this.province_edit = '';
                        this.direction_edit = '';
                        this.dialogedit = false;
                    }
                }).catch(this.error = 'Error al editar, email repetido');
            }

        },
        modalpass() {
            this.dialogpass = true;
        },
        edit_pass() {
            let pass1 = this.passnew;
            let pass2 = this.cpassnew;
            if (pass1 != pass2) {
                this.error_edit = 'Las contraseñas no coinciden';
            } else {
                axios.post("/admin/api-password", {
                    password: this.passnew
                }).then((response) => {
                    if (response.status == 200) {
                        this.dialogpass = false;
                    }
                });
            }
        },
    },
    created() {
        this.index();
    }
}
</script>
