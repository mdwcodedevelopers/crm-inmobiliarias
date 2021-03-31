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
        <v-btn small text @click="sendEmail(selected[0].contact)">
          <v-icon
          >
            mdi-email
          </v-icon>
            Enviar Email
        </v-btn>
         <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-btn small text>
            <v-icon
            >
              mdi-source-branch
            </v-icon>
            Cambiar estado
        </v-btn>       
         <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-btn small text>
            <v-icon
            >
              mdi-gavel
            </v-icon>
            Cerrar Oportunidad
        </v-btn> 
         <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-btn small text>
            <v-icon
            >
              mdi-account-supervisor
            </v-icon>
            Reasignar Oportunidades
        </v-btn> 
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
          :items="users"
          label="usuarios"
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
                        <v-btn color="blue darken-1" text @click="saveNote(newNote)">Guardar</v-btn>
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
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
    
    <template v-slot:item.contact="{ item }">
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
        oportunities:Object,
    },
    data: () => ({
      datas:[],
      selected: [],
      users:[],
      newNote: [
          {
            title: null,
            description: null,
          }
      ],
      noteDialog: false,
      historyDialog: false,
      dialogDelete: false,
      headers:[
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
            ],
    }),

    computed: {
    },

    watch: {
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        this.datas = this.oportunities
      },
      saveNote (note) {
        console.log(note.title);
        console.log(note.description);
        this.noteDialog = false;
      },
      sendEmail(item){
        console.log(item);
      }
    },
  }
</script>