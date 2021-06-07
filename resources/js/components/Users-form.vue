<template>
    <div class="text-center p-5">
        <div v-if="created">
            <p class="h3">Ya se ha registrado, revise su correo para confirmar su registro</p>
        </div>
                  
        <v-form
            ref="form"
            v-model="valid"
            v-else
        >
            <v-layout wrap>
                    <v-flex xs12 md6 class="px-3" >
                        <v-text-field label="Nombre*" :rules="inputRule" v-model="user.name" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 class="px-3">
                        <v-text-field label="Correo*" :rules="mailRule" v-model="user.email" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 class="px-3" >
                        <v-text-field label="Telefono 1*" :rules="numberRule" v-model="user.phone_1" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 class="px-3" >
                        <v-text-field label="Telefono 2" v-model="user.phone_2" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 class="px-3" >
                        <v-text-field label="Dirección*" :rules="inputRule" v-model="user.direction" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 class="px-3" >
                        <v-text-field label="Provincia*" :rules="inputRule" v-model="user.province" required></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                        <small class="red--text">Los campos marcados con * son obligatorios</small>
                    </v-flex>
            </v-layout>
        <v-spacer></v-spacer>
        <v-btn color="danger" @click="user={}">Borrar</v-btn>
        <v-btn color="success" :disabled="!valid" @click.prevent="create()">Crear</v-btn>
        </v-form>
    </div>
</template>

<script>
export default {
    props: {
        rol: Number
    },
    data() {
        return {
            created: false,
            valid: false,
            user:{},
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
        
        create() {
                this.user.role_id = 2;
                this.user.contact_id = true;

                axios.post("/admin/api-users",this.user).then((response) => {
                        this.$swal('Usuario creado con exito', 'Revise su correo electrónico para confirmar el correo y recibir su contraseña', 'OK');
                        this.user= {};
                        this.created= true;

                }).catch((e) => {
                    this.$swal({
                        title: 'Error al crear usuario',
                        type: 'warning'
                    });
                });

        },
        
    }
}
</script>
