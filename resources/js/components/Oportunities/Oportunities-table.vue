<template>
  <v-card color="blue">
  
    <new-oportunity 
    :status="status" 
     @updateData="changeUser()"></new-oportunity>

    <v-data-table
      v-model="selected"
      :headers="headers"
      item-key="id"
      group-by="status"
      show-select
      :items="datas"
      class="elevation-1"
      :search="search"
      no-data-text="No hay datos disponibles"
      no-results-text="No hay resultados"
    >
      <template v-slot:top>
        <v-toolbar
          flat
          height="100px"
        >
        <!-- Modal de delete -->
          <div v-if="rol==1" style="height:100% !important" class="d-flex align-items-center">
            <template>
                  <v-dialog
                    v-model="deleteDialog"
                    width="600"
                  >
                  <template v-slot:activator="{ on, attrs }">
                      <v-btn
                          :disabled="selected.length=== 0"
                          small
                          text
                          v-bind="attrs"
                          v-on="on"
                          >
                        <v-icon
                          >
                          mdi-delete
                      </v-icon>
                      Eliminar oportunidad
                      </v-btn>
                  </template>

                    <v-card>
                      <v-card-title class="headline grey lighten-2">
                        Enviar Email
                      </v-card-title>

                      <v-card-text>
                        <v-row>
                          <v-col
                              cols="12"
                            >
                            <p>¿Esta seguro que desea eliminar esta oportunidad? Luego no podrá recuperarla</p>
                            </v-col>

                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn color="blue darken-1" text @click="deleteDialog = false">Cancelar</v-btn>
                              <v-btn color="red darken-1"  @click="deleteOportunity()">Eliminar</v-btn>
                              <v-spacer></v-spacer>
                          </v-card-actions>
                        </v-row>
                      </v-card-text>
                    </v-card>
                  </v-dialog>
            </template>

            <v-divider
                class="mx-4"
                inset
                vertical
              ></v-divider>
          </div>
        <!-- Modal de email -->
        <template>
              <v-dialog
                v-model="emailDialog"
                width="600"
              >
              <template v-slot:activator="{ on, attrs }">
                  <v-btn
                      :disabled="selected.length=== 0"
                      small
                      text
                      v-bind="attrs"
                      v-on="on"
                      >
                    <v-icon
                      >
                      mdi-email
                  </v-icon>
                  Enviar Email
                  </v-btn>
              </template>

                <v-card>
                  <v-card-title class="headline grey lighten-2">
                    Enviar Email
                  </v-card-title>

                  <v-card-text>
                    <v-row>
                      <v-col
                          cols="12"
                          sm="12"
                        >

                        <v-text-field
                          v-model="emailText.asunto"
                          label="Asunto"
                        ></v-text-field>
                        </v-col>

                        <v-col
                          cols="12"
                          sm="12"
                        >
                        <v-textarea
                          v-model="emailText.texto"
                          label="Texto de email"
                        ></v-textarea>
                        </v-col>


                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="blue darken-1" text @click="emailDialog = false">Cancelar</v-btn>
                          <v-btn color="blue darken-1" text  :disabled="Object.entries(emailText).length === 0" @click="sendEmail(selected)">Enviar mensaje</v-btn>
                          <v-spacer></v-spacer>
                      </v-card-actions>
                    </v-row>
                  </v-card-text>
                </v-card>
              </v-dialog>
        </template>

          <v-divider
            class="mx-4"
            inset
            vertical
          ></v-divider>

        <!-- Modal de status -->
        <template>
              <v-dialog
                v-model="statusDialog"
                width="600"
              >
              <template v-slot:activator="{ on, attrs }">
                  <v-btn
                      :disabled="selected.length=== 0 || selected[0].closed === 1"
                      small
                      text
                      v-bind="attrs"
                      v-on="on"
                      >
                    <v-icon
                      >
                    mdi-source-branch
                  </v-icon>
                  Cambiar estado
                  </v-btn>
              </template>

                <v-card>
                  <v-card-title class="headline grey lighten-2">
                    <small>
                      Está a punto de cambiar un estado. ¿Está seguro?
                    </small>
                  </v-card-title>

                  <v-card-text>
                    <v-row>
                      <v-col
                        >
                        <v-select
                          v-model="newStatus"
                          :items="status"
                          item-text="name"
                          item-value="id"
                          label=" Seleccione estado"
                        ></v-select>
                      </v-col>


                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="blue darken-1" text @click="statusDialog = false">Cancelar</v-btn>
                          <v-btn color="blue darken-1" text :disabled="newStatus.length==0" @click="changeStatus()">Cambiar</v-btn>
                          <v-spacer></v-spacer>
                      </v-card-actions>
                    </v-row>
                  </v-card-text>
                </v-card>
              </v-dialog>
        </template>

          <v-divider
            class="mx-4"
            inset
            vertical
          ></v-divider>


          <!-- Modal de cerrar oportunidad -->
        <template>
              <v-dialog
                v-model="closeDialog"
                width="600"
              >
              <template v-slot:activator="{ on, attrs }">
                  <v-btn
                      :disabled="selected.length=== 0 || selected[0].closed === 1"
                      small
                      text
                      v-bind="attrs"
                      v-on="on"
                      >
                    <v-icon
                      >
                    mdi-gavel
                  </v-icon>
                  Cerrar Oportunidad
                  </v-btn>
              </template>

                <v-card>
                  <v-card-title class="headline grey lighten-2">
                    <small>
                      Está a punto de cerrar {{selected.length}} oportunidades. ¿Está seguro?
                    </small>
                  </v-card-title>

                  <v-card-text>
                    <v-row>
                      <v-col
                      cols=12
                      sd=12
                        >
                        <p style="margin-top: 20px">Motivo :</p>
                        <v-select
                          v-model="newStatus"
                          :items="reasons"
                          item-text="name"
                          item-value="id"
                          label=" Seleccione una opción"
                        ></v-select>
                      </v-col>

                      <v-col
                      cols=12
                      sd=12
                        >
                        <v-textarea
                          v-model="description"
                          label="Descripcion"
                        ></v-textarea>
                      </v-col>


                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="blue darken-1" text @click="closeDialog = false">Cancelar</v-btn>
                          <v-btn color="blue darken-1" text :disabled="newStatus.length==0 || description.length==0" @click="closeOportunity()">Cerrar oportunidades</v-btn>
                          <v-spacer></v-spacer>
                      </v-card-actions>
                    </v-row>
                  </v-card-text>
                </v-card>
              </v-dialog>
        </template>

          <v-divider
            class="mx-4"
            inset
            vertical
          ></v-divider>

          <!-- Modal de reasignar -->
        <template>
              <v-dialog
                v-model="statusReassign"
                width="600"
              >
              <template v-slot:activator="{ on, attrs }">
                  <v-btn
                      :disabled="selected.length=== 0 || selected[0].closed === 1"
                      small
                      text
                      v-bind="attrs"
                      v-on="on"
                      >
                    <v-icon
                      >
                    mdi-account-supervisor
                  </v-icon>
                  Reasignar Oportunidades
                  </v-btn>
              </template>

                <v-card>
                  <v-card-title class="headline grey lighten-2">
                    <small>
                      Está a punto de reasignar {{selected.length}} contactos. ¿Está seguro?
                    </small>
                  </v-card-title>

                  <v-card-text>
                    <v-row>
                      <v-col
                      cols=12
                      sm=4
                        >
                        <h4 style="margin-top:10px;">Nuevo agente:</h4>

                      </v-col>
                      <v-col
                      cols=12
                      sm=6
                        >
                        <v-select
                          v-model="newUser"
                          :items="users"
                          item-text="name"
                          item-value="id"
                          label=" Seleccione agente"
                        ></v-select>
                      </v-col>


                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="blue darken-1" text @click="statusReassign = false">Cancelar</v-btn>
                          <v-btn color="blue darken-1" text :disabled="newUser.length===0" @click="assignUser()">Cambiar</v-btn>
                          <v-spacer></v-spacer>
                      </v-card-actions>
                    </v-row>
                  </v-card-text>
                </v-card>
              </v-dialog>
        </template>



          <v-divider
            class="mx-4"
            inset
            vertical
          ></v-divider>
          <div>
              <b>
              Ver oportunidades de
              </b>
              <v-select
            v-model="userSelected"
            :items="users"
            item-text="name"
            item-value="id"
            label=" Seleccione usuario"
            @change="changeUser()"
          ></v-select>
          </div>

        </v-toolbar>
        <v-text-field v-model="search" label="Buscar" class="mx-4"></v-text-field>

      </template>

      <template v-slot:group.header="{ group, toggle, isOpen }">
        <td :colspan="6" style="text-align: initial; padding-left:2rem;">
          <v-btn @click="toggle" x-small icon :ref="group">
              <v-icon v-if="isOpen">mdi-minus</v-icon>
              <v-icon v-else>mdi-plus</v-icon>
          </v-btn>
          <span class="mx-5 font-weight-bold">{{ group }}</span>
        </td>
      </template>

      <template v-slot:item.actions="{ item }">
        <note-action :element="item"></note-action>
      </template>


      <template v-slot:no-data>
          <h3>Seleccione un usuario para ver sus oportunidades o agregue una oportunidad</h3>
      </template>

      <template v-slot:item.contact="{ item } ">
      <v-menu
          top
          offset-y
          :close-on-content-click = "false"
        >
          <template v-slot:activator="{ on, attrs }">
            <a href="#"
              class="ma-2"
              v-bind="attrs"
              v-on="on"
              onclick="return false"
            >
              {{item.contact}}
            </a>
          </template>
          <v-list>
            <contact-card
                :contact="item.contact"
                :img="item.img_contact"
                :tel1="item.tel_1"
                :tel2="item.tel_2"
                :email="item.email"></contact-card>
          </v-list>
        </v-menu>

      </template>


      <!-- <template v-slot:item.vigency="{ item }">

        <v-progress-linear
              :value=item.vigency
              color="light-green darken-4">
        </v-progress-linear>

      </template> -->
    </v-data-table>
  </v-card>
</template>

<style scoped>
  .v-toolbar__content{
    display: flex;
    align-items: center;
  }
</style>

<script>
  export default {
    props:{
        users:Array,
        status: Array,
        rol: Number,
    },
    data: () => ({
      datas:[],
      selected: [],
      userSelected: [],
      search: '',
      newStatus:[],
      description:[],
      newUser:[],
      emailText:[],
      colorGroup: [],
      deleteDialog: false,
      dialogDelete: false,
      emailDialog: false,
      statusDialog: false,
      closeDialog: false,
      statusReassign: false,
    }),

    computed: {
       headers(){
              return[
                {
                    text: 'Contacto',
                    value: 'contact'
                },
                {
                    text: 'Nombre',
                    align: 'start',
                    sortable: true,
                    value: 'name',
                },
                {
                    text: 'Vigencia',
                    value: 'vigency'
                },
                {
                    text: 'Notas',
                    sortable: false,
                    value: 'actions'
                },
                {
                    text: 'Ultima Actualización',
                    value: 'updated_at'
                },
            ]
         },
            reasons(){
              return[
                {
                id:1,
                name:'Compró con nosotros'
              },
              {
                id:2,
                name:'Alquiló con nosotros'
              },
              {
                id:3,
                name:'Compró con otro'
              },
              {
                id:4,
                name:'Alquiló con otro'
              },
              {
                id:5,
                name:'Fantasma'
              },
              {
                id:6,
                name:'Tasación exitosa (Ingreso a la propiedad)'
              },
              {
                id:7,
                name:'Tasación suspendida (No ingreso a la propiedad)'
              },
              ]
            }
    },

    methods: {
      initialize () {
        // this.datas = this.oportunities
      },
      sendEmail(item){
        let params;
        item.forEach(element => {
          params={
            name: element.contact,
            oportunity: element.name,
            email: element.email,
            subject: this.emailText.asunto,
            text: this.emailText.texto
          }
          axios.post('/api-oportunities/sendMail', params).then((response) =>{
            console.log(response);
          });
        });
        this.emailDialog=false;
      },
      changeUser(){
        if (this.userSelected.length !== 0) {
          axios.get('/api-oportunities/' + this.userSelected).then((response) => {
            console.log('Buscando las oporunidades de el usuario id='+ this.userSelected);
  
            this.datas = response.data.oportunities;
            this.datas.forEach(element => {
              if (element.closed =="1") {
                element.status = "Cerrado";
              };
              this.$emit('updateList', this.datas);
            });
          });
        }

      },
      changeStatus(){
        let params;

        this.selected.forEach(element => {
          console.log(element);
          params = {
            status_id: this.newStatus,
            user_id: element.user_id,
          };
        axios.put('/api-oportunities/' + element.id, params ).then((response) => {
              console.log(response);
              element.status=this.status[this.newStatus-1].name;
        });
        this.selected=[];
        });
        this.statusDialog = false
      },
      closeOportunity(){
        let params={
          reason:this.newStatus,
          description:this.description,
        };
        this.selected.forEach(element => {
          axios.put('/api-oportunities/close/' + element.id, params ).then((response) => {
            console.log(response);
            element.status='Cerrado';
            element.closed=1;
            this.closeDialog = false;
          });
        });
      },
      assignUser(){
        let params;
        let index;
        this.selected.forEach(element => {
          params = {
            status_id: element.status_id,
            user_id: this.newUser,
          };
          axios.put('/api-oportunities/' + element.id, params ).then((response) => {
              console.log(response);
              index = this.datas.findIndex( x => x.name == element.name)-1;
              this.datas.splice(index,1)
        });
        this.selected=[];
        });
        this.statusReassign = false
      },
      deleteOportunity(){
        let index;

        this.selected.forEach(element => {
          axios.delete('/api-oportunities/' + element.id ).then((response) => {
            console.log(response);
              index = this.datas.findIndex( x => x.name == element.name)-1;
              this.datas.splice(index,1);
              this.deleteDialog=false;
          });
          });
        // axios.delete('interesed/' + this.selected.id).then((response) => {
        //       console.log(response);
        // });
      }
    },
  }
</script>
