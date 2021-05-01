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
                <v-flex xs12 >
                    <v-text-field label="Nombre*" :rules="[v => !!v || 'Debe seleccionar un nombre']" v-model="name" required></v-text-field>
                </v-flex>
                <v-flex xs12 >
                    <v-text-field label="Correo*" :rules="mailRule" v-model="email" required></v-text-field>
                </v-flex>
                <v-flex xs12  >
                    <v-text-field label="Telefono" :rules="phoneRule" v-model="phone" required></v-text-field>
                </v-flex>
                <v-flex xs12  >
                    <v-text-field label="Provincia" :rules="[v => !!v || 'Debe escoger una opción']" v-model="province" required></v-text-field>
                </v-flex>
                <v-flex xs12  >
                    <v-text-field label="Dirección" :rules="[v => !!v || 'Debe llenar la dirección']" v-model="direction" required></v-text-field>
                </v-flex>
                <v-flex xs12>
                        <small class="red--text">Los campos marcados con * son obligatorios</small>
                    </v-flex>
            </v-layout>
        <v-spacer></v-spacer>
        <v-btn color="danger" @click="dialog = false;error=''">Cancelar</v-btn>
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
            email: '',
            phone: '',
            province: '',
            direction: '',
            
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
        
        create() {
            if (this.role_id != 0 || this.email != '' || this.name != '') {
                
                axios.post("/admin/api-users", {
                    name: this.name,
                    email: this.email,
                    role_id: 2,
                    phone: this.phone,
                    province: this.province,
                    direction: this.direction
                }).then((response) => {
                        this.$swal('Usuario creado con exito', 'Revise su correo electrónico para confirmar el correo y recibir su contraseña', 'OK');
                        this.name = "";
                        this.email = "";
                        this.role_id = "";
                        this.phone = "";
                        this.province = "";
                        this.direction = "";
                        this.created= true;

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
        
    }
}
</script>
