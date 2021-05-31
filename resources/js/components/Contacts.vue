<template>
  <div class="text-center  d-flex">


 <v-col
    cols="12"
    sm="3">
    <v-card>
      <v-card-title class="display-1 titulo-custom">
          Filtros
      </v-card-title>
      <v-card-text>

          <v-form ref="form" v-model="valid" style="width: 100%" >
                  <v-layout wrap>
                    <v-flex xs12 class="pr-3">
                      <h5 class="black--text text-left">Ver solo contactos de: </h5>
                        <v-select
                          v-model="filter.agent"
                          :items="agents_filter"
                          item-text="name"
                          item-value="id"
                          label="Agentes:"
                          attach
                          :rules="selectRule"
                          style="max-height=42px"
                          color="blue-grey lighten-2"
                          chips
                        >
                        <template v-slot:selection="data">
                        <!-- HTML that describe how select should render selected items -->
                      <v-chip
                          v-bind="data.attrs"
                          :input-value="data.selected"
                          close
                          @click:close="filter.agent = ''"
                        > {{ data.item.name }} </v-chip>

                      </template>
                        </v-select>
                    </v-flex>

                    <v-flex xs12  class="pr-3">
                      <h5 class="black--text text-left">Estados de oportunidades: </h5>
                        <v-select
                        v-model="filter.oportunity"
                        :items="oportunities"
                        item-text="name"
                        item-value="id"
                        label="Oportunidades:"
                        attach
                        style="max-height=42px"
                        color="blue-grey lighten-2"
                        chips
                      >
                      <template v-slot:selection="data">
                        <!-- HTML that describe how select should render selected items -->
                      <v-chip
                          v-bind="data.attrs"
                          :input-value="data.selected"
                          close
                          @click:close="filter.oportunity = ''"
                        > {{ data.item.name }} </v-chip>
                      </template>
                      </v-select>
                    </v-flex>


                    <v-flex xs12  class="pr-3">
                      <h5 class="black--text text-left">Con la etiqueta: </h5>
                        <v-select
                          v-model="filter.tag"
                          :items="tags"
                          item-value="id"
                          label="Etiquetas:"
                          attach
                          color="blue-grey lighten-2"
                          :disabled="filter.noTag !== ''"
                          style="max-height=42px"
                          chips
                        >
                        <template v-slot:selection="data">
                        <!-- HTML that describe how select should render selected items -->
                      <v-chip
                          v-bind="data.attrs"
                          :input-value="data.selected"
                          close
                          @click:close="filter.tag = ''"
                        > {{ data.item.name }} </v-chip>

                      </template>
                      <template v-slot:item="data">
                        <v-list-item-content>
                          <v-list-item-title v-html="data.item.name"></v-list-item-title>
                          <v-list-item-subtitle v-html="data.item.group_name"></v-list-item-subtitle>
                        </v-list-item-content>
                      </template>
                        </v-select>
                    </v-flex>

                    <!-- <v-flex xs12  class="pr-3">
                      <h5 class="black--text text-left">Sin la etiqueta: </h5>
                        <v-select
                          v-model="filter.noTag"
                          :items="tags"
                          item-value="id"
                          label="Etiquetas:"
                          attach
                          style="max-height=42px"
                          color="blue-grey lighten-2"
                          :disabled="filter.tag !== '' "
                          chips
                        >
                        <template v-slot:selection="data">
                      <v-chip
                          v-bind="data.attrs"
                          :input-value="data.selected"
                          close
                          @click:close="filter.noTag = ''"
                        >  {{data.item.name}} </v-chip>

                      </template>
                      <template v-slot:item="data">
                        <v-list-item-content>
                          <v-list-item-title v-html="data.item.name"></v-list-item-title>
                          <v-list-item-subtitle v-html="data.item.group_name"></v-list-item-subtitle>
                        </v-list-item-content>
                      </template>

                        </v-select>
                    </v-flex> -->

                    <v-flex xs12 >
                        <v-btn  class="my-1" @click="filter.agent = '', filter.oportunity= '',filter.tag= '',filter.noTag= ''">Borrar</v-btn>
                        <v-btn  class="my-1" color="success" :disabled="!valid"  @click.prevent="filterSearch()">Buscar</v-btn>
                    </v-flex>
                  </v-layout>
          </v-form>
      </v-card-text>
    </v-card>
 </v-col>

  <v-col
      cols="12"
      sm="9"
  >
    <v-card color="blue darken-4">
      <v-card-title class="display-1 text-white titulo-custom">
        Agenda de contactos
      <v-card-actions style="position:absolute; right:0px">
        <a class="m-1 btn bg-white text-dark mr-3" :href="'/admin/contacts/export?agent=' + filter.agent + '&oportunity=' + filter.oportunity + '&tag=' + filter.tag + '&noTag=' + filter.noTag">
          <v-icon>
              mdi-file-pdf
          </v-icon>
          Exportar a excel
        </a>
        <v-btn color="success" dark fab class="mt-1" @click="create()">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </v-card-actions>
      </v-card-title>
      <v-card-text class="d-flex text-white">
                Un listado completo de clientes.
            </v-card-text>
             <v-spacer></v-spacer>
    </v-card>

    <v-card >
      <v-text-field v-model="search" label="Buscar" class="mx-4"></v-text-field>

      <v-data-table
        :headers="headers"
        no-results-text="No hay resultados"
        no-data-text="No hay contactos "
        :items="contacts"
        item-key="id"
        id="contactTable"
        class="elevation-1"
        hide-default-footer
        disable-pagination
        loading-text="Cargando... Por favor espere"
        :search="search"
        ref="table">

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
        <template v-slot:item.tags="{ item }">
            <v-chip
                v-for="tag in tagsName(item.tags)"
                :key="tag.id"
                class="m-1"
                color="orange"
                text-color="white"
            > {{tag[0].name}} </v-chip>
        </template>

      </v-data-table>
    </v-card>
 </v-col>

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
                      <v-select no-data-text="No existen agentes registrados" v-model="contact.user_id" :items="agents" :rules="selectRule" item-text="name" item-value="id" label="Agente:"></v-select>
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
  .v-select.v-select--chips .v-select__selections {
    max-height: 42px !important;
  }
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
            agents_filter: [
              {
                id: -1,
                name: "Ver todos los contactos"
              },
              {
                id: -2,
                name: "Contactos sin asignar"
              },

            ],
            oportunities: [],
            filter: {
              agent: '',
              oportunity: '',
              tag: '',
              noTag: ''
            },
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
            axios.get("/admin/api-contacts").then((response) => {
                this.agents = response.data.agents;
                this.tags = response.data.tags;
                this.oportunities = response.data.oportunities;
                var i=2;
                this.agents.forEach(element => {
                  this.agents_filter.push({
                      id: element.id,
                      name: element.name
                  });
                });
          });
        },
        filterSearch() {
            axios.get("/admin/api-contacts-search?agent=" + this.filter.agent + "&oportunity=" + this.filter.oportunity + "&tag=" + this.filter.tag + "&noTag=" + this.filter.noTag ).then((response) => {
                this.$swal.fire({
                  icon: 'success',
                  title: 'Busqueda terminada',
                  showConfirmButton: false,
                  timer: 1500
                })

                this.contacts = response.data.contacts;
                this.total = response.data.total;

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
        tagsName(tags){
          let x =[];
          var i = 0;
          tags.forEach(element => {
             x[i] = this.tags.filter(function (el) {return el.id == element.tag_id});
             i++;
          });
            return x;
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
              this.filterSearch();
              this.contact = {};
              this.dialog = false;
              this.$swal.fire('Contacto registrado con exito');
              this.contact_tag = [];

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
              this.contact = contact;
              var i = 0;
                this.contact_tag =[];
                this.contact.tags.forEach(element => {
                  this.contact_tag[i] = element.tag_id;
                i++;
              });
              this.dialogedit = true;
          },
          update(){
          this.contact.tags = this.contact_tag;
            axios.patch("/admin/api-contacts/" + this.contact.id, this.contact).then((response) => {
            if (response.status == 200) {
              this.filterSearch();
              this.contact = {};
              this.dialogedit = false;
              this.$swal.fire('Contacto actualizado con exito');
              this.contact_tag = [];
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
                this.filterSearch();
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
                    sortable: false,
                    value: 'phone_1',
                    width: '10rem'
                },
                {
                    text: 'Telefono 2',
                    sortable: false,
                    value: 'phone_2',
                    width: '10rem'
                },
                {
                    text: 'Dirección',
                    sortable: false,
                    value: 'direction',
                    width: '10rem'
                },
                {
                    text: 'Provincia',
                    sortable: false,
                    value: 'province',
                    width: '10rem'
                },
                {
                    text: 'Etiquetas',
                    sortable: false,
                    value: 'tags',
                    width: '20rem'
                },
                {
                    text: 'Agente',
                    value: 'agent',
                    width: '10rem'
                },
                {
                    text: 'Creado',
                    value: 'created_at',
                    width: '10rem'
                },
                {
                    text: 'Actualizado',
                    value: 'updated_at',
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
