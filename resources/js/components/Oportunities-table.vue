<template>
  <v-data-table
    v-model="selected"
    :headers="headers"
    item-key="id"
    group-by="status"
    show-select
    :items="datas"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
        height="100px"
      >
        <v-btn small text>
            Ocultar para reasignar
        </v-btn>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider> 

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
                          disabled
                          label="mail@mail.com"
                        ></v-text-field>
                      </v-col>
                      <v-col
                        cols="12"
                        sm="12"
                      >
                      <v-textarea
                        v-model="emailText"
                        label="Texto de email"
                      ></v-textarea>
                      </v-col>

                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="emailDialog = false">Cancelar</v-btn>
                        <v-btn color="blue darken-1" text @click="sendEmail(selected)">Enviar mensaje</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                  </v-row>
                </v-card-text>
              </v-card>
            </v-dialog>
          </div>
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
                    :disabled="selected.length=== 0"
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
                        label=" Seleccione estado"
                      ></v-select>
                    </v-col>
                      

                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="statusDialog = false">Cancelar</v-btn>
                        <v-btn color="blue darken-1" text @click="changeStatus()">Cambiar</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                  </v-row>
                </v-card-text>
              </v-card>
            </v-dialog>
          </div>
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
                    :disabled="selected.length=== 0"
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
                        label=" Seleccione una opción"
                      ></v-select>
                    </v-col>
                    
                    <v-col
                    cols=12
                    sd=12
                      >
                      <v-textarea
                        label="Descripcion"
                      ></v-textarea>
                    </v-col>
                      

                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="closeDialog = false">Cancelar</v-btn>
                        <v-btn color="blue darken-1" text @click="closeOportunity()">Cerrar oportunidades</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                  </v-row>
                </v-card-text>
              </v-card>
            </v-dialog>
          </div>
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
                    :disabled="selected.length=== 0"
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
                        label=" Seleccione agente"
                      ></v-select>
                    </v-col>
                      

                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="statusReassign = false">Cancelar</v-btn>
                        <v-btn color="blue darken-1" text @click="assignUser()">Cambiar</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                  </v-row>
                </v-card-text>
              </v-card>
            </v-dialog>
          </div>
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
          label=" Seleccione usuario"
          @change="changeUser()"
        ></v-select>
        </div>

      </v-toolbar>
    </template>


    <template v-slot:item.actions="{ item }">

        <template>

            <v-dialog
              v-model="noteDialog"
              width="500"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-btn 
                    color="#66BB6A" 
                    v-bind="attrs"
                    v-on="on"
                    >
                  <v-icon color="#fff" >
                      mdi-comment
                  </v-icon>
                </v-btn>
              </template>

              <v-card>
                <v-card-title class="headline grey lighten-2">
                  Nueva Nota
                </v-card-title>
                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col
                        cols="12"
                        sm="12"
                      >
                        <v-text-field
                          v-model="newNote.title"
                          label="Titulo de Nota"
                        ></v-text-field>
                      </v-col>
                      <v-col
                        cols="12"
                        sm="12"
                      >
                        <v-text-field
                          v-model="newNote.description"
                          label="Descripcion de Nota"
                        ></v-text-field>
                      </v-col>

                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="noteDialog = false">Cancelar</v-btn>
                        <v-btn color="blue darken-1" text @click="saveNote()">Guardar</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                       
                    </v-row>
                  </v-container>
                </v-card-text>
              </v-card>
            </v-dialog>
        </template>

        <template>
            <v-dialog
              v-model="historyDialog"
              width="500"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-btn 
                    color="#66BB6A" 
                    v-bind="attrs"
                    v-on="on"
                    >
                  <v-icon color="#fff" >
                      mdi-history
                  </v-icon>
                </v-btn>
              </template>

              <v-card>
                <v-card-title class="headline grey lighten-2">
                  Historial de cambios
                </v-card-title>

                <v-card-text>
                  <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>
                    <li>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</li>
                    <li>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                  </ul>
                </v-card-text>
              </v-card>
            </v-dialog>
          </div>
        </template>
    </template>
        
    
    <template v-slot:no-data> 
        <h3>Seleccione un usuario para ver sus oportunidades</h3>
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


    <template v-slot:item.vigency="{ item }">
     
      <v-progress-linear 
            :value=item.vigency 
            color="light-green darken-4">
      </v-progress-linear>

    </template>
  </v-data-table>
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
    },
    data: () => ({
      datas:[],
      selected: [ ],
      userSelected: [],
      newStatus:[],
      newUser:[],
      emailText:[],
      newNote: [
          {
            title: null,
            description: null,
          }
      ],
      noteDialog: false,
      historyDialog: false,
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
            status(){
              return[
                'Sin contactar', 
                'Sin seguimiento', 
                'Pendiente contactar',
                'Esperando respuesta',
                'Evolucionando',
                'Tomar acción',
                'Congelado'
            ]
         },
            reasons(){
              return[
                'Compró con nosotros', 
                'Alquiló con nosotros', 
                'Compró con otro',
                'Alquiló con otro',
                'Fantasma',
                'Busqueda suspendida',
                'Tasación exitosa (Ingreso a la propiedad)',
                'Tasación suspendida (No ingreso a la propiedad)',
                'Otro',
              ]
            }
    },

    watch: {
    },

    methods: {
      initialize () {
        // this.datas = this.oportunities
      },
      saveNote () {
        console.log(this.newNote.title);
        console.log(this.newNote.description);
        this.noteDialog = false;
      },
      sendEmail(item){
        item.forEach(element => {
          console.log(element.email);
        });
        this.emailDialog=false;
      },
      changeUser(){
        let index = this.users.findIndex(x => x.name === this.userSelected);
        let id_user = this.users[index].id;
        axios.get('/interesed/' + id_user).then((response) => {
          this.datas = response.data.oportunities;
          console.log(response.data.oportunities);
        });

      },
      changeStatus(){
        this.statusDialog = false
      },
      closeOportunity(){
        this.closeDialog = false
      },
      assignUser(){
        this.statusReassign = false
      }
    },
  }
</script>