<template>
    <div>

        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialog" persistent max-width="800px">
                    <template v-slot:activator="{ on }">
                        <v-btn color="success" class="my-4" dark v-on="on">Crear Tipo de evento 
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">Crear Tipo de evento</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                            <v-form  ref="form" v-model="valid">
                                <v-layout wrap>
                                    <v-flex xs12 md6 class="px-3">
                                        <v-text-field  class="my-1" label="Nombre de Evento*" v-model="event.name" :rules="inputRule" required></v-text-field>
                                        <v-text-field  class="my-1" label="Minimo de clientes*" v-model="event.min_clients" :rules="numberRule" required></v-text-field>
                                        <v-text-field  class="my-1" label="Minimo de agentes*" v-model="event.min_agents" :rules="numberRule" required></v-text-field>
                                        <v-subheader class="black--text">Notificaciones antes del evento</v-subheader>
                                        <v-divider></v-divider>
                                        <div class="d-flex ">
                                            <v-checkbox class="m-0 p-0" light label="Notificar a los clientes"  v-model="event.notify_before">
                                            </v-checkbox>
                                            <v-checkbox class="m-0 p-0" light label="Notificar a los agentes" v-model="event.notify_before_agent">
                                            </v-checkbox>
                                        </div>
                                        <v-textarea  class="my-1" label="Mensaje de notificación  de agentes*" :rules="inputRule" v-model="event.message_before" required></v-textarea>
                                        <v-subheader class="black--text">Notificaciones despues del evento</v-subheader>
                                        <v-divider></v-divider>
                                        <div class="d-flex ">
                                            <v-checkbox class="m-0 p-0" light label="Notificar a los clientes" v-model="event.notify_after">
                                            </v-checkbox>
                                            <v-checkbox class="m-0 p-0" light label="Notificar a los agentes"  v-model="event.notify_after_agent">
                                            </v-checkbox>
                                        </div>
                                        <v-textarea  class="my-1" label="Mensaje de notificación  de agentes*" :rules="inputRule" v-model="event.message_after" required></v-textarea>
                                    </v-flex>
                                    <v-flex xs12 md6 class="px-3">
                                        <v-textarea  class="my-1" label="Descripcion*" :rules="inputRule" v-model="event.description" required></v-textarea>
                                        <p>Color del evento</p>
                                        <v-color-picker v-model="color" mode="hexa" mode.sync="hex"></v-color-picker>
                                    </v-flex>
                                </v-layout>
                            </v-form>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="danger" @click="dialog = false; error=''">Cancelar</v-btn>
                            <v-btn color="success" :disabled="!valid"  @click.prevent="create()">Crear</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-layout>
        </template>
        <v-data-table 
            :headers="headers" 
            :items="events"  
            no-results-text="No hay resultados" 
            no-data-text="No hay Estados" 
            class="elevation-1" 
            :search="search"
            >
           <template
                v-slot:body="{ items }"
            >
                    <tbody>
                    <tr
                        v-for="item in items"
                        :key="item.name"
                        :style="{ backgroundColor: item.color}" 
                    >
                        <td 
                        class=" subtitle-1 font-weight-black"
                        style="text-align:left"
                        >{{ item.name }}</td>
                        <td
                        class="subtitle-1 font-weight-black"
                        style="text-align:left"
                        >{{ item.description }}</td>
                        <td
                        class="subtitle-1 font-weight-black"
                        style="text-align:left"
                        >{{ item.min_clients }}</td>
                        <td
                        class="subtitle-1 font-weight-black"
                        style="text-align:left"
                        >{{ item.min_agents }}</td>
                        <td>
                            <v-btn color="#ff9800" @click="edit(item)">
                                <v-icon color="#fff">
                                    mdi-pencil
                                </v-icon>
                            </v-btn>

                            <v-btn color="#E53935" @click="delete_dialog(item)">
                                <v-icon color="#fff">
                                    mdi-delete
                                </v-icon>
                            </v-btn>
                        </td>
                    </tr>
                    </tbody>
      </template>
            
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
          

        </v-data-table>
        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialogedit" persistent max-width="600px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">Editar Evento</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-form  ref="form" v-model="valid">
                                    <v-layout wrap>
                                        <v-flex xs12 md6 class="px-3">
                                            <v-text-field  class="my-1" label="Nombre de Evento*" v-model="event.name" :rules="inputRule" required></v-text-field>
                                            <v-text-field  class="my-1" label="Minimo de clientes*" v-model="event.min_clients" :rules="numberRule" required></v-text-field>
                                            <v-text-field  class="my-1" label="Minimo de agentes*" v-model="event.min_agents" :rules="numberRule" required></v-text-field>
                                            <v-subheader class="black--text">Notificaciones antes del evento</v-subheader>
                                            <v-divider></v-divider>
                                            <div class="d-flex ">
                                                <v-checkbox class="m-0 p-0" light label="Notificar a los clientes"  v-model="event.notify_before">
                                                </v-checkbox>
                                                <v-checkbox class="m-0 p-0" light label="Notificar a los agentes" v-model="event.notify_before_agent">
                                                </v-checkbox>
                                            </div>
                                            <v-textarea  class="my-1" label="Mensaje de notificación*" :rules="inputRule" v-model="event.message_before" required></v-textarea>
                                            <v-subheader class="black--text">Notificaciones despues del evento</v-subheader>
                                            <v-divider></v-divider>
                                            <div class="d-flex ">
                                                <v-checkbox class="m-0 p-0" light label="Notificar a los clientes"  v-model="event.notify_after">
                                                </v-checkbox>
                                                <v-checkbox class="m-0 p-0" light label="Notificar a los agentes" v-model="event.notify_after_agent">
                                                </v-checkbox>
                                            </div>
                                            <v-textarea  class="my-1" label="Mensaje de notificación*" :rules="inputRule" v-model="event.message_after" required></v-textarea>
                                        </v-flex>
                                        <v-flex xs12 md6 class="px-3">
                                            <v-textarea  class="my-1" label="Descripcion*" :rules="inputRule" v-model="event.description" required></v-textarea>
                                            <p>Color del evento</p>
                                            <v-color-picker v-model="color" mode="hexa" mode.sync="hex"></v-color-picker>
                                        </v-flex>
                                    </v-layout>
                                </v-form>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="danger" @click="dialogedit = false;error_edit=''">Cancelar</v-btn>
                            <v-btn color="success" :disabled="!valid" @click.prevent="edit_model()">Guardar</v-btn>
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
                            <span class="headline">Desea eliminar el evento: {{events_eliminar}}</span>
                        </v-card-title>
                        <v-card-text>

                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn @click="dialogdelete = false">Cancelar</v-btn>
                            <v-btn color="#E53935" class="text-white" @click.prevent="delete_model(item)">Eliminar</v-btn>
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
            events: [],
            event: {},
            valid: false,
            dialog: false,
            dialogedit: false,
            dialogdelete: false,
            color: '',
            search: '',
            id_delete: '',
            events_eliminar: '',
            drawer: false,
            group: null,
            inputRule: [
                v => !!v || 'El campo es obligatorio',
            ],
            numberRule: [
                v => !!v || 'El campo es obligatorio',
                v => /^[0-9]+([.][0-9]+)?$/.test(v)  || 'Debe ser un valor númerico',
                v => v <= 10 || 'Es demasiado',
            ],
        }
    },
    watch: {
        group() {
            this.drawer = false
        },
    },
    methods: {
        index() {
            axios.get("/admin/api-event-types").then((response) => {
                this.events = response.data.events;
            });
        },
        create() {
            this.event.color = this.color
                axios.post("/admin/api-event-types", this.event).then((response) => {
                        this.$swal('Evento creado con exito', '', 'success');
                        this.index();
                        this.event={},
                        this.dialog = false;
                }).catch(error => {
                        this.$swal('Error al añadir evento', 'Seleccione todos los campos', 'error');
                });

        },
        edit_model() {
            this.event.color = this.color;
                axios.put("/admin/api-event-types/" + this.event.id, this.event).then((response) => {
                    this.event = {};
                        this.dialogedit = false;
                        this.index();
                }).catch(error => {
                        this.$swal('Error al editar evento', 'Seleccione todos los campos', 'error');
                });
           
        },
        delete_model() {
            console.log(this.id_delete);
            axios.delete("/admin/api-event-types/" + this.id_delete).then((response) => {
                console.log(response);
                    this.dialogdelete = false;
                    this.index();
            }).catch(error => {
                     this.error = "Error al eliminar evento";
                });
        },
        edit(item) {
            this.event = item;
            this.color = item.color;
            this.dialogedit = true;
        },
        delete_dialog(item) {
            this.id_delete = item.id;
            this.dialogdelete = true;
            this.events_eliminar = item.name;
        }
    },
    created() {
        this.index();
    },
    computed: {
        headers() {
            return [{
                    text: 'Evento',
                    align: 'start',
                    sortable: true,
                    value: 'name',
                    width: "10rem"
                },
                {
                    text: 'Descripción',
                    value: 'description',
                    width: "23rem"
                },
                 {
                    text: 'Minimo de clientes',
                    value: 'min_clients',
                },
                {
                    text: 'Minimo de agentes',
                    value: 'min_agents',
                },
                {
                    text: 'Acciones',
                    value: 'action',
                    width: "13rem"
                }
            ]
        },
    },
}
</script>
