<template>
  <div class="text-center p-4 d-flex align-items-center flex-column">

<v-flex md10 style="overflow: auto"> 
    <v-card color="blue">
      <v-card-title class="display-1 text-white titulo-custom">
        Agenda de contactos
        <v-btn color="success" dark absolute right fab class="mt-1" @click="create()">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </v-card-title>
      <v-card-text class="d-flex text-white">
                Un listado completo de clientes.
            </v-card-text>
             <v-spacer></v-spacer>
    </v-card>
    <v-card>

      <v-text-field v-model="search" label="Buscar" class="mx-4"></v-text-field>
      <v-data-table 
        :headers="headers"  
        no-results-text="No hay resultados" 
        no-data-text="No hay contactos " 
        :items="contacts" 
        item-key="id" 
        class="elevation-1" 
        hide-default-footer
        disable-pagination
        :loading="contacts.length === 0"
        loading-text="Cargando... Por favor espere"
        :search="search">
        
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
            <v-btn color="#66BB6A"  small @click="whatsapp(item.phone_1)">  
                <v-icon color="#fff">
                    mdi-whatsapp
                </v-icon>
            </v-btn>
        </template>

      </v-data-table>
    </v-card>
</v-flex>
    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="600px">
          <v-card class="my-4">
            <v-card-title>
              <span class="headline">Crear Contacto</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12 md6 >
                        <v-text-field label="Nombre*" :rules="inputRule" v-model="contact.name" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                        <v-text-field label="Correo*" :rules="mailRule" v-model="contact.email" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 >
                        <v-text-field label="Telefono 1*" :rules="numberRule" v-model="contact.phone_1" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 >
                        <v-text-field label="Telefono 2*" :rules="numberRule" v-model="contact.phone_2" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 >
                        <v-text-field label="Dirección*" :rules="inputRule" v-model="contact.direction" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 >
                        <v-text-field label="Provincia*" :rules="inputRule" v-model="contact.province" required></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                      <v-select
                        v-model="contact_tag"
                        :items="tags"
                        :rules="selectRule"
                        item-value="id" 
                        label="Etiquetas:" 
                        attach
                        color="blue-grey lighten-2"
                        chips
                        multiple
                         hint="Escoge las etiquetas para segmentarlo"
                      >
                       <template v-slot:selection="data">
                      <!-- HTML that describe how select should render selected items -->
                     <v-chip
                        v-bind="data.attrs"
                        :input-value="data.selected"
                        close
                        @click="data.select"
                        @click:close="remove(data.item)"
                      > {{ data.item.group_name }} > {{ data.item.name }} </v-chip>

                    </template>
                    <template v-slot:item="data">
                       <v-list-item-content>
                        <v-list-item-title v-html="data.item.name"></v-list-item-title>
                        <v-list-item-subtitle v-html="data.item.group_name"></v-list-item-subtitle>
                      </v-list-item-content>
                    </template>
                     
                      </v-select>
                    </v-flex>
                    <v-flex xs12>
                        <small class="red--text">Los campos marcados con * son obligatorios</small>
                    </v-flex>
                  </v-layout>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="danger" @click="dialog = false">Cancelar</v-btn>
              <v-btn color="success" :disabled="!valid" @click.prevent="store()">Crear</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-layout>
    </template>

    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialogedit" persistent max-width="967px">
          <v-card>
            <v-card-title>
              <span class="headline">Editar Contacto</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
               <v-form ref="form-edit" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12 md6 >
                        <v-text-field label="Nombre*" :rules="inputRule" v-model="contact.name"  required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                        <v-text-field label="Correo*" :rules="mailRule" v-model="contact.email" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 >
                        <v-text-field label="Telefono 1*" :rules="numberRule" v-model="contact.phone_1" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 >
                        <v-text-field label="Telefono 2*" :rules="numberRule" v-model="contact.phone_2" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 >
                        <v-text-field label="Dirección*" :rules="inputRule" v-model="contact.direction" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6 >
                        <v-text-field label="Provincia*" :rules="inputRule" v-model="contact.province" required></v-text-field>
                    </v-flex>
                    <v-flex xs12>

                    <v-select
                        v-model="contact_tag"
                        :items="tags"
                        :rules="selectRule"
                        item-value="id" 
                        label="Etiquetas:" 
                        attach
                        color="blue-grey lighten-2"
                        chips
                        multiple
                         hint="Escoge las etiquetas para segmentarlo"
                      >
                       <template v-slot:selection="data">
                      <!-- HTML that describe how select should render selected items -->
                     <v-chip
                        v-bind="data.attrs"
                        :input-value="data.selected"
                        close
                        @click="data.select"
                        @click:close="remove(data.item)"
                      > {{ data.item.group_name }} > {{ data.item.name }} </v-chip>

                    </template>
                    <template v-slot:item="data">
                       <v-list-item-content>
                        <v-list-item-title v-html="data.item.name"></v-list-item-title>
                        <v-list-item-subtitle v-html="data.item.group_name"></v-list-item-subtitle>
                      </v-list-item-content>
                    </template>
                     
                      </v-select>
                    </v-flex>
                    <v-flex xs12>
                      <v-select no-data-text="No existen agentes registrados" v-model="contact.user_id" :items="tags" :rules="selectRule" item-text="name" item-value="id" label="Agente:"></v-select>
                    </v-flex>
                  </v-layout>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="danger" @click="dialogedit = false">Cancelar</v-btn>
              <v-btn color="success" :disabled="!valid" @click.prevent="update()">Editar</v-btn>
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
              <span class="headline">¿Esta seguro que desea eliminar este contacto?</span>
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

</style>

<script>
export default {
     data() {
        return {
            contacts: [],
            agents: [],
            tags: [],
            contact_tag: [],
            search: '',
            total:'',
            contact: {},
            dialog: false,
            dialogdelete: false,
            dialogedit: false,
            valid: false,
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
        }
    },
     methods: {
        index() {
            axios.get("/admin/api-contacts/" ).then((response) => {
                this.contacts = response.data.contacts;
                this.total = response.data.total;
                this.agents = response.data.agents;
                this.tags = response.data.tags;

                this.contacts.forEach(contact => {
                  if (contact.user_id === null) {
                      contact.agent = "Sin asignar";
                  }else{
                    this.agents.forEach(agent => {
                      if (contact.user_id === agent.id) {
                        contact.agent = agent.name;
                      }
                    });
                  };
                });
          });
        },
        whatsapp(phone) {
            window.open('https://api.whatsapp.com/send?phone=' + phone, '_blank');
        },
        remove (item) {
            const index = this.contact_tag.indexOf(item.id)
            if (index >= 0){
              this.contact_tag.splice(index, 1)
            }
          },
         create() {
          this.contact = {};
          this.dialog = true;
        },
        store() {
          this.contact.tags = this.contact_tag;
          axios.post("/admin/api-contacts", this.contact).then((response) => {
            if (response.status == 200) {
              console.log(response);
              this.index();
              this.contact = {};
              this.dialog = false;
              this.$swal.fire('Contacto registrado con exito');
              this.contact.tags = [];

            }
          }).catch(error => {
            this.$swal.fire(
              'Error',
              'Ocurrío un error al tratar de registrar el contacto, el correo esta en uso.',
              'error'
            )
          });
          },
          edit(contact) {
              this.contact= contact;
               this.dialogedit = true;
          },
          update(){
          this.contact.tags = this.contact_tag;
            axios.patch("/admin/api-contacts/" + this.contact.id, this.contact).then((response) => {
            if (response.status == 200) {
              this.index();
              this.contact = {};
              this.dialogedit = false;
              this.$swal.fire('Contacto actualizado con exito');
              this.contact.tags = []; 
            }
          }).catch(error => {
            this.$swal.fire(
              'Error',
              'Ocurrío un error al tratar de actualizar el contacto, intente nuevamente.',
              'error'
            )
          })
          },
            delete_dialog(id) {
              this.id_delete = id;
              this.dialogdelete = true;
            },
           delete_model() {
            axios.delete("/admin/api-contacts/" + this.id_delete).then((response) => {
              console.log(response);
              if (response.status == 200) {
                this.index(0, '');
                this.dialogdelete = false;
                this.$swal.fire(
                  'Propiedad eliminada con exito',
                  '',
                  'success'
                );
              }
        }).catch(error => {
          this.$swal.fire(
            'Error',
            'Hubo un error al tratar de eliminar la propiedad, intente nuevamente.',
            'error'
          )
        });
      },
        },
    computed: {
        headers() {
            return [
                {
                    text: 'Nombre',
                    value: 'name',
                    width: '10rem'
                },
                {
                    text: 'Email',
                    value: 'email',
                    width: '10rem'
                },
                {
                    text: 'Telefono 1',
                    value: 'phone_1',
                    width: '10rem'
                },
                {
                    text: 'Telefono 2',
                    value: 'phone_2',
                    width: '10rem'
                },
                {
                    text: 'Dirección',
                    value: 'direction',
                    width: '10rem'
                },
                {
                    text: 'Provincia',
                    value: 'province',
                    width: '10rem'
                },
                {
                    text: 'Creado',
                    value: 'created_at',
                    width: '10rem'
                },
                {
                    text: 'Agente',
                    value: 'agent',
                    width: '10rem'
                },
                {
                    text: 'Acciones',
                    value: 'action',
                    sortable: false,
                    align: 'center',
                    width: '12rem'
                },
                ];
            }
        },
    created() {
        this.index();
    },
    }
</script>