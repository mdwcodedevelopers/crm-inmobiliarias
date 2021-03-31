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
      >
        <v-btn small text>
            Ocultar para reasignar
        </v-btn>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider> 
        <v-btn small text>
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

        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
            <!-- Popup de crear nota -->
          <v-card>
            <v-card-title>
              <span class="headline">Nueva</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                  <v-text-field
                      v-model="editedItem.contact"
                      label="Contacto"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.name"
                      label="Nombre"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.vigency"
                      label="Vigencia"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancelar
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Guardar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <!-- Popup de historial de cambios -->
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="headline">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>


  
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-comment
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-history
      </v-icon>
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

<script>
  export default {
    props:{
        oportunities:Object,
    },
    data: () => ({
      datas:[], 
      dialog: false,
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
      status:[],
      editedIndex: -1,
      editedItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
      defaultItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
    }),

    computed: {
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        this.datas = this.oportunities
      },

      editItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.desserts.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem)
        } else {
          this.desserts.push(this.editedItem)
        }
        this.close()
      },
    },
  }
</script>