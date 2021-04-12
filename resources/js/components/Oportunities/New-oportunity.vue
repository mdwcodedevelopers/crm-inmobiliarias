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
            <v-row>
            
              <v-col
                cols="12"
                sm="6"
                class="py-0"
              >
              <v-text-field
                  v-model="oportunity.name"
                  label="Nombre de la oportunidad*"
                  required
                ></v-text-field>    
                <v-select
                  v-model="oportunity.contact_id"
                  :items="contacts"
                  item-text="name"
                  item-value="id"
                  label="Contacto*"
                  required
                ></v-select>
                <v-select
                  v-model="oportunity.status_id"
                  :items="status"
                  item-text="name"
                  item-value="id"
                  label="Estado*"
                  required
                ></v-select>
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
                        required
                        full-width
                        >
                        </v-date-picker>
              </v-col>
            </v-row>
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
            :disabled="disabledButton"
            @click="addOportunity()"
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
      dialog: false,
      oportunity:{
          contact_id: "",
          name: "",
          vigency: "",
          status_id: ""
      },
      contacts:[],
      responseRequest:[],
    }),
    computed:{
        getContacts(){
          axios.get('/api-contacts').then((response) =>{
            this.contacts= response.data;
          });
        },
        disabledButton(){
            if (  this.oportunity.contact_id == "" | this.oportunity.name  == "" | this.oportunity.vigency == "" | this.oportunity.status_id == "") {
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
        addOportunity(){
            let newOportunity = {
                name: this.oportunity.name,
                vigency: this.oportunity.vigency,
                contact_id: this.oportunity.contact_id,
                status_id: this.oportunity.status_id 
            }

            axios.post('/api-oportunities/', newOportunity).then((response) => {
              console.log(response);
              this.responseRequest="Registro guardado";
              setTimeout(() => this.dialog = false, 2000);
              this.$emit('updateData');
            });
           
            this.oportunity= [];
        },
    }
  }
</script>