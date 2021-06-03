<template>
    <div class="text-center px-4 d-flex align-items-center flex-column">
        <v-card class="d-flex flex-column flex-lg-row my-2 px-1 justify-space-around" style="width:100%">

            <v-col
                cols="12"
                md="12"
                lg="8"
            >
                <property-card :property="property"></property-card>
            </v-col>
            <v-col
                cols="12"
                md="12"
                lg="4"
            >

                        <v-card
                            class="mx-auto px-4"
                            outlined
                        >
                            <v-list-item four-line>

                            <v-list-item-content >
                                <div>

                                <v-icon class="p-4 white--text blue darken-3 rounded-circle my-5 "  x-large>mdi-contacts-outline</v-icon>
                                </div>

                                <v-list-item-title class="h5 mb-1 blue--text text--darken-4">
                                Contactate con nosotros
                                </v-list-item-title>
                                <v-list-item-subtitle class="text-left mt-5">Si estás interesado en esta propiedad dejanos <br> tus datos para que pronto uno de nuestros <br> agentes se contacte contigo</v-list-item-subtitle>

                            </v-list-item-content>

                            </v-list-item>

                            <v-card-actions>
                             <v-form
                                    ref="form"
                                    v-model="valid"
                                >
                                    <v-layout wrap>
                                            <v-flex xs12  >
                                                <v-text-field label="Nombre*" :rules="inputRule" v-model="user.name" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs12 >
                                                <v-text-field label="Correo*" :rules="mailRule" v-model="user.email" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs12  >
                                                <v-text-field label="Telefono 1*" :rules="numberRule" v-model="user.phone_1" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs12  >
                                                <v-text-field label="Telefono 2" :rules="numberRule2" v-model="user.phone_2" ></v-text-field>
                                            </v-flex>
                                            <v-flex xs12  >
                                                <v-text-field label="Dirección*" :rules="inputRule" v-model="direction" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs12  >
                                                <v-text-field label="Provincia*" :rules="inputRule" v-model="province" required></v-text-field>
                                            </v-flex>
                                            <v-flex xs12>
                                                <v-textarea label="Mensaje de contacto*" v-model="user.information"></v-textarea>
                                            </v-flex>
                                            <v-flex xs12>
                                                <small class="red--text">Los campos marcados con * son obligatorios</small>
                                            </v-flex>

                                    </v-layout>
                                <v-spacer></v-spacer>
                                <v-btn color="danger" @click="user={}">Borrar</v-btn>
                                <v-btn color="success" :disabled="!valid" @click="store()">Estoy interesado</v-btn>
                                </v-form>

                            </v-card-actions>
                        </v-card>
                        <v-row no-gutters class="my-3" v-if="">
                             <GmapMap :center='{lat: latitude, lng: longitude}' :zoom='12' style='width:100%;  height: 200px;'>
                                 <GmapMarker
                                        :position="{lat: latitude , lng:longitude }"
                                        :clickable="true"
                                        :draggable="true"
                                        @click="center={lat: latitude, lng: longitude}"
                                    />
                            </GmapMap>

                        </v-row>

                        <properties-recomended :property_id="property.id"></properties-recomended>
            </v-col>
        </v-card>
    <front-footer></front-footer>

    </div>
</template>

<script>
import {gmapApi} from 'vue2-google-maps'
export default {
    props: {
        property: Object,
    },
    data() {
        return {
             latitude: (this.property.latitude != null) ? parseFloat(this.property.latitude) : -34.6156625,
            longitude: (this.property.longitude != null) ? parseFloat(this.property.longitude) :-58.5033384,
            items:[],
            valid: false,
            province: '',
            direction: '',
            user: {
                information:'',
                property_id:'',
                property_name:'',
            },
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
            numberRule2: [
                v => /^[0-9]+([.][0-9]+)?$/.test(v)  || 'Debe ser un valor númerico',
            ],
        }
    },
     created(){
        axios.get("/api-user-info").then((response) => {
            if(response.data.user!=="")
            this.user = response.data.user;
          });
        },
    methods: {
                sendEmail(){
        this.$swal.fire(
                      'Su correo de pruebas ha sido enviado',
                      'Los correos serán enviados cuando se pase ha desarrollo.',
                      'success'
                    );
    },
        store() {
            this.user.property_id = this.property.id;
            this.user.property_name = this.property.title;
            this.user.agent_id = this.property.user_id;
            this.user.province = this.province;
            this.user.direction = this.direction;
          axios.post("/api-users-property", this.user).then((response) => {
              this.$swal.fire('Mensaje enviado, pronto nos estaremos comunicando con usted');
          }).catch(error => {
            this.$swal.fire(
              'Error',
              'Ocurrío un error al tratar de registrar el contacto, el correo esta en uso.',
              'error'
            )
          });
          },
    },
    computed: {
        google: gmapApi
    }

}
</script>
