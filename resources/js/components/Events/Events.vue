<template>
  <div class="text-center p-4 d-flex align-items-center flex-column">
        
        <div>
            <h4>Eventos:</h4>
            <ul class="d-flex list-types flex-wrap justify-center  ">
                <li v-for="type in types" :style="{ backgroundColor: type.color}" :key="type.id">
                    <p class="h4">{{type.name}}</p>
                    <span class="h4">{{type.count }}</span> 
                </li>
            </ul>
        </div>
        <v-card color="blue darken-4 w-100">
            <v-card-title class="display-1 text-white titulo-custom">
                Tus Eventos:
                <v-card-actions
                style="position:absolute; right:0px"
                >
                <v-btn color="success" dark fab class="mt-1" @click="create()">
                <v-icon>mdi-plus</v-icon>
                </v-btn>
            </v-card-actions>
            </v-card-title>
            <v-spacer></v-spacer>
        </v-card>
    <v-tabs v-model="tab">
        <v-tab><v-icon>mdi-calendar</v-icon></v-tab>
        <v-tab><v-icon>mdi-format-list-bulleted</v-icon></v-tab>
    </v-tabs>
    <v-tabs-items class="w-100" v-model="tab">
        <v-tab-item>
            <calendar></calendar>
        </v-tab-item>
        <v-tab-item>
            <v-data-table
            :headers="headers"
            item-key="id"
            group-by="event_type"
            :items="datas"
            class="elevation-1"
            no-data-text="No tienes eventos registrados"
            no-results-text="No hay resultados"
            >
                <

                <template v-slot:group.header="{ group, toggle, isOpen }"> 
                    <!-- <td :colspan="8" style="text-align: initial; padding-left:2rem;" :style="{ backgroundColor: color(group)}"  > -->
                    <td :colspan="8" style="text-align: initial; padding-left:2rem;" >
                    <v-btn @click="toggle" x-small icon :ref="group">
                        <v-icon v-if="isOpen">mdi-minus</v-icon>
                        <v-icon v-else>mdi-plus</v-icon>
                    </v-btn>
                    <span class="mx-5 font-weight-bold">{{ group }}</span>
                    </td>
                </template>
                    
                  <template v-slot:item.action="{ item }">
                    <v-btn color="#ff9800"  small @click="edit(item)">
                        <v-icon color="#fff">
                            mdi-pencil
                        </v-icon>
                    </v-btn>
                    <v-btn color="#E53935" small @click="delete_dialog(item.id)">
                        <v-icon color="#fff">
                            mdi-delete
                        </v-icon>
                    </v-btn>
                </template>       


            </v-data-table>

        </v-tab-item>
    </v-tabs-items>
          <!--Modal de crear nuevo evento -->
        <v-dialog v-model="dialog" persistent max-width="800px">
             <v-card>
                <v-card-title>
                    <v-row>
                        <v-col cols="6 d-flex align-items-center">
                            <span class="headline">Nuevo Evento</span>
                        </v-col>
                        <v-col cols="6">
                            <v-select
                                v-model="event.event_types_id"
                                :items="types"
                                item-text="name"
                                item-value="id"
                                label="Tipo de evento*"
                                :rules="selectRule"
                                absolute
                                right
                            ></v-select>
                        </v-col>
                    </v-row>

                </v-card-title>
                <v-card-text>
                <v-container>
                    <v-form ref="form" v-model="valid">
                    <v-row>
                        
                    <v-col
                        cols="12"
                        sm="6"
                        class="py-0"
                    >
                    <v-alert v-if="event.event_types_id" :color="alertColor"> {{descriptionEvent(event.event_types_id)}}</v-alert>
                        <v-select
                        v-model="event.property_id"
                        :items="properties"
                        item-text="title"
                        item-value="id"
                        label="Escoge una Propiedad"
                        ></v-select>
                        <v-select
                            v-model="event.contacts"
                            :items="contacts"
                            :rules="selectRule"
                            item-value="id"
                            label="Seleccione los clientes:"
                            attach
                            color="blue-grey lighten-2"
                            chips
                            multiple
                            hint="min: 1 max: 3"
                        >
                            <template v-slot:selection="data">
                            <!-- HTML that describe how select should render selected items -->
                            <v-chip
                                v-bind="data.attrs"
                                :input-value="data.selected"
                                close
                                @click="data.select"
                                @click:close="remove(data.item, event.contacts)"
                            > {{ data.item.name }} </v-chip>

                            </template>
                            <template v-slot:item="data">
                            <v-list-item-content>
                                <v-list-item-title v-html="data.item.name"></v-list-item-title>
                                <v-list-item-subtitle v-html="data.item.group_name"></v-list-item-subtitle>
                            </v-list-item-content>
                            </template>
                        </v-select>    
                        <v-select
                            v-model="event.agents"
                            :items="agents"
                            :rules="selectRule"
                            item-value="id"
                            label="Seleccione los agentes:"
                            attach
                            color="blue-grey lighten-2"
                            chips
                            multiple
                            hint="min: 1 max: 3"
                        >
                            <template v-slot:selection="data">
                            <!-- HTML that describe how select should render selected items -->
                            <v-chip
                                v-bind="data.attrs"
                                :input-value="data.selected"
                                close
                                @click="data.select"
                                @click:close="remove(data.item, event.agents)"
                            > {{ data.item.name }} </v-chip>

                            </template>
                            <template v-slot:item="data">
                            <v-list-item-content>
                                <v-list-item-title v-html="data.item.name"></v-list-item-title>
                                <v-list-item-subtitle v-html="data.item.group_name"></v-list-item-subtitle>
                            </v-list-item-content>
                            </template>
                        </v-select>    
                    </v-col>
                    <v-col
                        cols="12"
                        sm="6"
                        class="py-0"
                    >
                        <div class="text-overline">*Indica la Fecha del evento</div>
                        
                        <v-date-picker
                        v-model="event.date_1"
                        >
                        </v-date-picker>
                        <div class="text-overline">*Indica la hora de inicio</div>
                        <v-menu
                            ref="menu_1"
                            v-model="menu1"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            :return-value.sync="event.hour_ini"
                            transition="scale-transition"
                            offset-y
                            max-width="290px"
                            min-width="290px"
                        >
                            <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="event.hour_ini"
                                label="HH:MM:SS"
                                prepend-icon="mdi-clock-time-four-outline"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                            </template>
                            <v-time-picker
                                v-if="menu1"
                                v-model="event.hour_ini"
                                full-width
                                use-seconds
                                @click:second="$refs.menu_1.save(event.hour_ini)"
                            ></v-time-picker>
                        </v-menu>
                        <!-- <div class="text-overline">*Indica la hora de finalizacion</div>
                        <v-menu
                            ref="menu_2"
                            v-model="menu2"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            :return-value.sync="event.hour_end"
                            transition="scale-transition"
                            offset-y
                            max-width="290px"
                            min-width="290px"
                        >
                            <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="event.hour_end"
                                label="HH:MM:SS"
                                use-seconds
                                prepend-icon="mdi-clock-time-four-outline"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                            </template>
                            <v-time-picker
                            v-if="menu2"
                            v-model="event.hour_end"
                            full-width
                            use-seconds
                            @click:second="$refs.menu_2.save(event.hour_end)"
                            ></v-time-picker>
                        </v-menu> -->
                    </v-col>
                    </v-row>
                    </v-form>
                </v-container>
                </v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="dialog = false"
                >
                    Cancelar
                </v-btn>
                <v-btn
                    color="blue darken-1"
                    text
                    :disabled="!valid"
                    @click="store()"
                >
                    Guardar
                </v-btn>

                </v-card-actions>
            </v-card>
        </v-dialog>
   </div>
</template>


<style scoped>
    .list-types{
        list-style: none;
    }
    .list-types li{
        padding: 1rem 3rem;
        color: rgb(250, 240, 240);
        font-weight: 500;
    }
</style>
<script>
export default {
    props:{ 
        types: Array,
    },
     data: () => ({
      datas:[],
      tab: null,
      alertColor: '',
      events:[],
      valid: false,
      contacts:[],
      agents:[],
      properties:[],
      dialog: false,
      menu1: false,
      menu2: false,
      event:{},
      inputRule: [
          v => !!v || 'El campo es obligatorio',
      ],
      selectRule: [
          v => !!v || 'Debe seleccionar una opción',
      ],
    }),
    created() {
        this.index();
    },
    methods:{
        index(){
            axios.get('/admin/api-events').then((response) =>{
            this.events= response.data.event_types;
            this.datas= response.data.events;
          });
        },
        getData(){
          axios.get('/admin/api-contacts').then((response) =>{
            this.contacts= response.data.contacts;
            this.agents= response.data.agents;
          });
          axios.get('/admin/api-properties').then((response) =>{
            this.properties= response.data.properties.data;
          });
        },
        create(){
            this.getData();
            this.dialog= true;
            this.event = {};
        },
         remove (item, selected) {
            const index = selected.indexOf(item.id)
            if (index >= 0){
              selected.splice(index, 1)
            }
          },
        descriptionEvent(item){
            let index = this.types.filter(function (el) {return el.id == item});
            this.alertColor= index[0].color;
            return index[0].description;
        },
        color(item){
        if(item != "Cerrado"){
          let index = this.types.filter(function (el) {return el.name == item});
          console.log(index[0].color);
          return index[0].color;
        }
      },
      store() {
        this.event.date = this.event.date_1 + " " + this.event.hour_ini;
        console.log(this.event.date);
        this.valid = false; 
        axios.post("/admin/api-events", this.event).then((response) => {
            this.index();
            this.property = {};
            this.dialog = false;
            this.$swal.fire('Evento registrado con exito');
        }).catch(error => {
          this.$swal.fire(
            'Error',
            'Ocurrío un error al tratar de registrar la propiedad, intente nuevamente, recuerde que los precios y las dimensiones deben ser unicamente en numeros y máximo 2 decimales.',
            'error'
          )
          this.valid = true; 
        });
      },
    },
     computed: {
       headers(){
              return[
                {
                    text: 'Fecha',
                    align: 'start',
                    sortable: true,
                    value: 'date',
                },
                {
                    text: 'Agentes',
                    width: '13rem',
                    sortable: false,
                    value: 'agents',
                },
                {
                    text: 'Clientes',
                    value: 'clients'
                },
                
                {
                    text: 'Estatus',
                    value: 'completed'
                },
                {
                    text: 'Reporte',
                    value: 'report'
                },
            ]
         },
    }

}
</script>