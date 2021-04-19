<template>
    <div class="">
        <v-card class="mx-auto">

            <v-card-text>
                <p class="display-2 text--primary">
                    Mi perfil
                </p>
                <v-form>
                <div class="text--primary">
                    Nombre: {{profile.name}}
                </div>
                    <v-text-field  :rules="[v => !!v || 'Debe seleccionar un nombre']" v-model="name_edit" v-if="disabledInput" :placeholder="profile.name" required></v-text-field>
                <div class="text--primary">
                    Correo: {{profile.email}}
                </div>
                    <v-text-field  :rules="mailRule" v-model="email_edit" v-if="disabledInput" :placeholder="profile.email" required></v-text-field>
                <div v-if="profile.role_id == 2">
                    <div class="text--primary">
                        Telefono: {{profile.phone}}
                    </div>
                    <v-text-field  :rules="phoneRule" v-model="phone_edit" v-if="disabledInput" :placeholder="profile.phone" required></v-text-field>
                    <div class="text--primary">
                        Provincia: {{profile.province}}
                    </div>
                    <v-text-field  :rules="[v => !!v || 'Debe seleccionar una provincia']" v-model="province_edit" v-if="disabledInput" :placeholder="profile.province" required></v-text-field>
                    <div class="text--primary">
                        Dirección: {{profile.direction}}
                    </div>
                    <v-text-field  :rules="[v => !!v || 'Debe seleccionar una dirección']" v-model="direction_edit" v-if="disabledInput" :placeholder="profile.direction" required></v-text-field>
                </div>
                {{error}}
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="error" v-if="disabledInput" @click="disabledInput=false" class="text-white">
                    cancelar
                </v-btn>
                <v-btn color="warning" v-if="disabledInput" @click="update()" class="text-white">
                    Guardar perfil
                </v-btn>
                <v-btn color="#66BB6A" v-else @click="disabledInput=true" class="text-white">
                    Editar perfil
                </v-btn>
                <v-btn color="#66BB6A" @click="modalpass()" class="text-white">
                    Reiniciar contraseña
                </v-btn>
            </v-card-actions>
        </v-card>
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
                                    <v-flex xs12>
                                    
                                        <v-flex xs6>
                                            <v-text-field type="password" label="Contraseña actual*" v-model="passold" required></v-text-field>
                                        </v-flex>
                                    </v-flex>
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
    props:{
        profile: Object,
    },
    data() {
        return {
            
            disabledInput: false,
            dialogpass: false,
            dialogedit: false,
            name_edit: '',
            email_edit: '',
            phone_edit: '',
            province_edit: '',
            passold: '',
            direction_edit: '',
            passnew: '',
            cpassnew: '',
            error: '',
            error_edit: '',
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
        
        update() {
            if (this.profile.role_id == 1 || this.profile.role_id == 3) {
                    this.phone_edit = '';
                    this.province_edit = '';
                    this.direction_edit = '';
                }
                axios.put("/admin/api-users/" + this.profile.id, {
                    name: this.name_edit,
                    email: this.email_edit,
                    role_id: this.profile.role_id,
                    phone: this.phone_edit,
                    province: this.province_edit,
                    direction: this.direction_edit
                }).then((response) => {
                        // console.log(response.data);
                        this.profile = response.data.user;
                        this.disabledInput = false;
                        this.name_edit = "";
                        this.email_edit = "";
                        this.role_id_edit = "";
                        this.phone_edit = "";
                        this.province_edit = "";
                        this.direction_edit = "";
                        this.$swal({
                        title: 'Usuario editado con exito',
                        type: 'ok'
                    });
                }).catch((e) => {
                    this.$swal({
                        title: 'Error al editar usuario',
                        type: 'warning'
                    });
                });

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
                this.$swal.fire(
                        'Haciendo la solicitud espere',
                        'Esto puede demorar un minuto',
                        'warning');
                axios.post("/admin/api-password/"+ this.profile.id, {
                    password: this.passnew,
                    passold: this.passold
                }).then((response) => {
                    if (response.status == 200) {
                        this.dialogpass = false;
                        this.$swal.fire(
                        'Contraseña cambiada',
                        'Le llegaran un correo confirmando el cambio',
                        'ok'
                    );
                    }
                }).catch((e) => {
                    this.$swal.fire(
                        'Error al editar usuario',
                        'Contraseña incorrecta',
                        'error'
                    );
                });
            }
        },
    }
}
</script>
