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
                        Provincia: {{profile.province}}
                    </div>
                    <div class="text--primary">
                        Dirección: {{profile.direction}}
                    </div>
                </div>

            </v-card-text>
            <v-card-actions>
                <v-btn color="#66BB6A" @click="edit(profile.name,profile.email,profile.phone,profile.province,profile.direction)" class="text-white">
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
                            <span class="headline">Editar Moneda</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>

                                    <v-flex xs6>
                                        <v-text-field label="Nombre" v-model="name_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs6>
                                        <v-text-field label="Correo" v-model="email_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs6 v-if="profile.rol_id ==2">
                                        <v-text-field label="Moneda" v-model="phone_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs6 v-if="profile.rol_id ==2">
                                        <v-text-field label="Moneda" v-model="province_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 v-if="profile.rol_id ==2">
                                        <v-text-field label="Moneda" v-model="direction_edit" required></v-text-field>
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
                            <span class="headline">Editar Moneda</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs6>
                                        <v-text-field type="password" label="Contraseña anterior" v-model="passprev" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs6>
                                        <v-text-field type="password" label="" v-model="passnew" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs6>
                                        <v-text-field type="password" label="Correo" v-model="cpassnew" required></v-text-field>
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
            province: '',
            direction_edit: '',
            passprev:'',
            passnew:'',
            cpassnew:''
        }
    },
    methods: {
        index() {
            axios.get("/api-user").then((response) => {
                this.profile = response.data.user;
            });
        },
        edit(name, email, phone, province, direction) {

            this.dialogedit = true;
            this.name_edit = name;
            this.email_edit = email;
            this.phone_edit = phone;
            this.province = province;
            this.direction_edit = direction;
        },
        edit_model() {
            axios.post("/api-user", {
                name: this.name_edit,
                email: this.email_edit,
                phone: this.phone_edit,
                pronvince: this.province,
                direction: this.direction_edit
            }).then((response) => {
                if (response.status == 200) {
                    this.index();
                    this.name_edit = '';
                    this.email_edit ='';
                    this.phone_edit = '';
                    this.province = '';
                    this.direction_edit = '';
                    this.dialogedit = false;
                }
            });
        },
        modalpass() {
            this.dialogpass = true;
        },
        edit_pass() {
            axios.post("/api-password", {
                passprev:this.passprev,
                password:this.passnew
            }).then((response) => {
                console.log(response)
                if (response.status == 200) {
                    this.dialogpass = false;
                }
            });
        },
    },
    created() {
        this.index();
    }
}
</script>
