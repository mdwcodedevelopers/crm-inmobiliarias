<template>
    <div class="">
        <v-card class="mx-auto">

            <v-card-text>
                <p class="display-2 blue--text text--darken-2 font-weight-bold">
                    Mi perfil
                </p>
                <v-form
                    ref="form"
                    v-model="valid"
                >
                    <v-layout wrap style="width">
                            <v-flex xs12  >
                                <v-text-field label="Nombre*" :rules="inputRule" :disabled="!disabledInput" v-model="profile.name" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 >
                                <v-text-field label="Correo*" :rules="mailRule" :disabled="!disabledInput" v-model="profile.email" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 v-if="profile.role_id == 2" >
                                <v-text-field label="Telefono 1*" :rules="numberRule" :disabled="!disabledInput" v-model="profile.phone_1" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 v-if="profile.role_id == 2" >
                                <v-text-field label="Telefono 2*" :rules="numberRule" :disabled="!disabledInput" v-model="profile.phone_2" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 v-if="profile.role_id == 2" >
                                <v-text-field label="Dirección*" :rules="inputRule" :disabled="!disabledInput" v-model="profile.direction" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 v-if="profile.role_id == 2" >
                                <v-text-field label="Provincia*" :rules="inputRule" :disabled="!disabledInput" v-model="profile.province" required></v-text-field>
                            </v-flex>
                            
                        </v-layout>
                <v-spacer></v-spacer>
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
            valid:false,
            disabledInput: false,
            dialogpass: false,
            dialogedit: false,
            passnew: '',
            cpassnew: '',
            error: '',
            error_edit: '',
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
        
        update() {
                axios.put("/admin/api-users/" + this.profile.id,this.profile).then((response) => {
                        // console.log(response.data);
                        this.profile = response.data.user;
                        this.disabledInput = false;
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
