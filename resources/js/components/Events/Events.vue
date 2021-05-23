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
            <calendar :events="datas"></calendar>
        </v-tab-item>
        <v-tab-item>
            <v-data-table
            :headers="headers"
            item-key="id"
            group-by="name"
            :items="datas"
            class="elevation-1"
            no-data-text="No tienes eventos registrados"
            no-results-text="No hay resultados"
            >
                <template v-slot:item.agents="{ item }">
                    <v-chip
                        v-for="(agent, index) in getName(item.agents, agents)"
                        :key="index"
                        class="m-1"
                        color="green"
                        text-color="white"
                    > {{agent[0].name}} </v-chip>
                </template>
                <template v-slot:item.clients="{ item }">
                    <v-chip
                        v-for="(client, index) in  getName(item.clients, contacts)"
                        :key="index"
                        class="m-1"
                        color="green"
                        text-color="white"
                    > {{client[0].name}} </v-chip>
                </template>

                <template v-slot:item.completed="{ item }">
                    {{item.completed === "0" ? 'En espera' : (item.completed === "1" ? 'Terminado': 'Fracasado') }}
                </template>

                <template v-slot:group.header="{ group, toggle, isOpen }"> 
                    <td :colspan="8" style="text-align: initial; padding-left:2rem;" :style="{ backgroundColor: color(group)}">
                    <v-btn @click="toggle" x-small icon :ref="group">
                        <v-icon v-if="isOpen">mdi-minus</v-icon>
                        <v-icon v-else>mdi-plus</v-icon>
                    </v-btn>
                    <span class="mx-5 font-weight-bold">{{ group }}</span>
                    </td>
                </template>
                    
                  <template v-slot:item.action="{ item }">
                    <v-btn color="success"  small @click="view(item)">
                        <v-icon color="#fff">
                            mdi-eye
                        </v-icon>
                    </v-btn>
                    <v-btn color="#E53935" small @click="delete_dialog(item.id)" v-if="item.completed == '0' || role == 1">
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
                        v-model="event.date"
                        :min="today"
                        >
                        </v-date-picker>
                      
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
                    color="success"
                    :disabled="!valid"
                    @click="store()"
                >
                    Guardar
                </v-btn>

                </v-card-actions>
            </v-card>
        </v-dialog>

        <!--Modal de ver evento -->
        <v-dialog v-model="dialogedit" persistent max-width="800px">
             <v-card>
                <v-card-title>
                    <v-row>
                        <v-col cols="6 d-flex align-items-center">
                            <span class="headline">Evento</span>
                        </v-col>
                        <v-col cols="6">
                            <v-select
                                v-model="event.event_types_id"
                                :items="types"
                                item-text="name"
                                item-value="id"
                                label="Tipo de evento*"
                                :rules="selectRule"
                                disabled
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
                        disabled
                        label="Propiedades:"
                        ></v-select>
                        <v-select
                            v-model="clients_events"
                            :items="contacts"
                            item-value="id"
                            label="Clientes invitados:"
                            attach
                            color="blue-grey lighten-2"
                            chips
                            disabled
                            multiple
                            hint="min: 1 max: 3"
                        >
                            <template v-slot:selection="data">
                            <!-- HTML that describe how select should render selected items -->
                            <v-chip
                                v-bind="data.attrs"
                                :input-value="data.selected"
                                @click="data.select"
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
                            v-model="agents_events"
                            :items="agents"
                            item-value="id"
                            label="Agentes invitados:"
                            attach
                            color="blue-grey lighten-2"
                            chips
                            disabled
                            multiple
                            hint="min: 1 max: 3"
                        >
                            <template v-slot:selection="data">
                            <!-- HTML that describe how select should render selected items -->
                            <v-chip
                                v-bind="data.attrs"
                                :input-value="data.selected"
                                @click="data.select"
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
                                v-model="event.completed"
                                :items="status"
                                item-text="name"
                                item-value="value"
                                label="Estatus del evento"
                                :disabled="event.name == 'Completado con exito' ||  event.name == 'Fallido'"
                                
                            ></v-select>
                              <v-textarea
                            v-model="event.report"
                            :disabled="event.completed === '0' || event.name == 'Completado con exito' || event.name == 'Fallido' "
                            label="Reporte de finalizacion*"
                            ></v-textarea>
                    </v-col>
                    <v-col
                        cols="12"
                        sm="6"
                        class="py-0"
                    >
                        <v-btn
                            color="warning"
                            @click="event.postponed = !event.postponed"
                            class="my-2"
                            v-if="event.completed == '0'"
                            small
                        >
                            Posponer
                        </v-btn>
                        <v-date-picker
                        v-model="event.start"
                        :min="today"
                        :disabled="!event.postponed"
                        >
                        </v-date-picker>
                       
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
                    @click="dialogedit = false; index() "
                >
                    Cerrar
                </v-btn>
                <v-btn
                    color="success"
                    :disabled="event.completed == '0' && !event.postponed "
                    v-if="event.name != 'Completado con exito' && event.name != 'Fallido'"
                    @click="update()"
                >
                    Actualizar
                </v-btn>

                </v-card-actions>
            </v-card>
        </v-dialog>

    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialogdelete" persistent max-width="600px">
          <v-card>
            <v-card-title>
              <span class="headline">¿Esta seguro que desea eliminar este evento?</span>
            </v-card-title>
            <v-card-text>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn @click="dialogdelete = false">Cancelar</v-btn>
              <v-btn color="#E53935" class="text-white" @click.prevent="delete_model()">Eliminar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-layout>
    </template>

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
        role: Number,
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
      clients_events: [],
      agents_events: [],
      dialog: false,
      menu1: false,
      menu2: false,
      dialogedit: false,
      dialogdelete: false,
      id_delete: '',
      event:{},
      today: (new Date()).toISOString() ,  
      inputRule: [  
          v => !!v || 'El campo es obligatorio',
      ],
      selectRule: [
          v => !!v || 'Debe seleccionar una opción',
      ],
    }),
    created() {
        this.getData();
        this.index();
    },
    methods:{
        index(){
            axios.get('/admin/api-events').then((response) =>{
            this.events= response.data.event_types;
            this.datas= response.data.events;
             this.datas.forEach(element => {
              if (element.completed =="1") {
                element.name = "Completado con exito";
              }else if(element.completed =="2"){
                  element.name = "Fallido";
              };
              this.$emit('updateList', this.datas);
            });
          });    
        },
        getName(item, list){
          let x =[];
          let i =0;
          item.forEach(element => {
             x[i] = list.filter(function (el) {return el.id == element.user_id});
             i++;
          });
            return x;
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
            this.dialog= true;
            this.event = {};
        },
        view(item){
            this.event = item;
            var i = 0;
            var j = 0;
            this.clients_events =[];
            this.agents_events =[];
            this.event.clients.forEach(element => {
                    this.clients_events[i] = element.user_id;
                    i++;
                });
            i=0;
            this.event.agents.forEach(element => {
                this.agents_events[i] = element.user_id;
                i++;
            });
            this.dialogedit= true;
            this.event.postponed= false;
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
            if (item == "Completado con exito") {
                return "#4DCD12";
            }else if(item == "Fallido"){
                return "#F50000";
            }else{
                let index = this.types.filter(function (el) {return el.name == item});
                return index[0].color;
            }
      },
      store() {
        this.valid = false; 
        axios.post("/admin/api-events", this.event).then((response) => {
            this.index();
            this.event = {};
            this.dialog = false;
            this.$swal.fire('Evento registrado con exito');
        }).catch(error => {
          this.$swal.fire(
            'Error',
            'Ocurrío un error al tratar de registrar el evento, intente nuevamente, recuerde llenar todos los datos.',
            'error'
          )
          this.valid = true; 
        });
      },
      update() {
        this.valid = false; 
        axios.patch("/admin/api-events/" +  this.event.id, this.event).then((response) => {
            this.index();
            this.event = {};
            this.dialogedit = false;
            this.$swal.fire('Evento actualizado con exito');
        }).catch(error => {
          this.$swal.fire(
            'Error',
            'Solo puede posponer hasta 3 veces un evento, debe cerrarlo y crear el reporte',
            'error'
          )
          this.valid = true; 
        });
      },
      delete_dialog(id) {
        this.id_delete = id;
        this.dialogdelete = true;
      },
       delete_model() {
            axios.delete("/admin/api-events/" + this.id_delete).then((response) => {
                this.index();
                this.dialogdelete = false;
                this.$swal.fire(
                  'Evento eliminado con exito',
                  '',
                  'success'
                );
        }).catch(error => {
          this.$swal.fire(
            'Error',
            'Hubo un error al tratar de eliminar el evento, intente nuevamente.',
            'error'
          )
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
                    value: 'start',
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
                {
                    text: 'Acciones',
                    value: 'action',
                    width: '13rem',
                    sortable: false
                },
                
            ]
         },
         status(){
             return[
                 {
                    name: 'En espera a ocurrir',
                    value: "0",
                 },
                 {
                    name: 'Completado con exito',
                    value: "1",
                 },
                 {
                    name: 'Fallido',
                    value: "2",
                 },
             ]
         }
    }

}
</script>