<template>
    <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
      
    >
      <template v-slot:activator="{ on, attrs }">
            <v-card-title class="display-1 text-white p-6">Nueva Oportunidad
              <v-btn
                color="success"
                dark
                absolute
                right
                fab
                class="mt-1"
                v-bind="attrs"
                v-on="on"
                @click="newOps()"
              >
                <v-icon>mdi-plus</v-icon>
              </v-btn></v-card-title>

      </template>
      <v-card>
        <v-card-title>
          <span class="headline">Nueva Oportunidad</span>
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
              <v-text-field
                  v-model="oportunity.name"
                  label="Nombre de la oportunidad*"
                  :rules="inputRule"
                ></v-text-field>    
                <v-select
                  v-model="oportunity.contact_id"
                  :items="contacts"
                  item-text="name"
                  item-value="id"
                  label="Contacto"
                ></v-select>
                <v-select
                  v-model="oportunity.status_id"
                  :items="status"
                  item-text="name"
                  item-value="id"
                  label="Estado*"
                  :rules="selectRule"
                ></v-select>
                <v-select
                  v-model="oportunity.property_id"
                  :items="properties"
                  item-text="title"
                  item-value="id"
                  label="Propiedades"
                ></v-select>
                <v-textarea
                  v-model="oportunity.description"
                  :rules="inputRule"
                  label="Descripción de la oportunidad*"
                ></v-textarea>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                class="py-0"
              >
                <div class="text-overline">*Indica la vigencia</div>
                        <v-date-picker
                        small
                        v-model="oportunity.vigency"
                        full-width
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
            color="blue darken-1"
            text
            :disabled="!valid || oportunity.vigency == null"
            @click="store()"
          >
            Guardar
          </v-btn>

        </v-card-actions>
          <div class="message-report bg-success" v-if="responseRequest.length">{{responseRequest}}</div>
      </v-card>
    </v-dialog>
</template>


<style scoped>
.message-report{
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 5px;
}
</style>

<script>
  export default {
      props:{
          status: Array,
      },
    data: () => ({
      valid: false,
      dialog: false,
      oportunity:{},
      properties:[],
      contacts:[],
      responseRequest:[],
      inputRule: [
          v => !!v || 'El campo es obligatorio',
      ],
      selectRule: [
          v => !!v || 'Debe seleccionar una opción',
      ],
    }),
    computed:{
        getContacts(){
          axios.get('/admin/api-contacts').then((response) =>{
            this.contacts= response.data.contacts;
          });
          axios.get('/admin/api-properties').then((response) =>{
            this.properties= response.data.properties.data;
          });
        },
        disabledButton(){
            if (  this.oportunity.name  == "" | this.oportunity.vigency == "" | this.oportunity.status_id == "") {
                       return true;
            }else{
                return false;
            }
        }
    },
    methods:{
      newOps(){
        this.getContacts,
        this.responseRequest=[];
      },
        store(){
            this.valid= false;
            axios.post('/admin/api-oportunities', this.oportunity).then((response) => {
                this.dialog = false;
              this.$swal("Oportunidad guardada con exito","", "success").then(() => {
              this.$emit('updateData');
              });
            }).catch(error => {
                this.dialog = false;
              this.$swal("Ocurrio un error al crear la oportunidad", "","error");
            });;
           
            this.oportunity= {};
        },
    }
  }
</script>