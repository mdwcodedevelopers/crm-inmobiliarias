<template>

  <div class="text-center">

    <v-card color="blue">
      <v-card-title class="display-1 text-white">
        Propiedades
        <v-btn color="success" dark absolute right fab class="mt-1" @click="create()">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </v-card-title>
      <v-data-table :headers="headers"  no-results-text="No hay resultados" no-data-text="No hay propiedades " :items="properties" item-key="propeties-user" class="elevation-1" :search="search">
        <template v-slot:item.imagen="{ item }">
          <v-img :src="'../'+item.image" height="100" width="100"></v-img>
        </template>
          <template v-slot:item.type="{ item }">
            {{ types[item.type-1]['name'] }}
          </template>
        <template v-slot:item.action="{ item }">
          <v-btn v-if="rol==1" color="#E53935" class="m-1" @click="exportPDF(item.id)">
            <v-icon color="#fff">
                mdi-file-pdf
            </v-icon>
          </v-btn>
          <v-btn color="#66BB6A" class="m-1" @click="edit(item.id)">
            <v-icon color="#fff">
                mdi-pencil
            </v-icon>
          </v-btn>
          <v-btn v-if="rol==1" color="#E53935" class="m-1" @click="delete_dialog(item.id)">
            <v-icon color="#fff">
                mdi-delete
            </v-icon>
          </v-btn>
        </template>
      </v-data-table>
    </v-card>

    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="600px">
          <v-card class="my-4">
            <v-card-title>
              <span class="headline">Crear propiedad</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12 sm6 md6>
                      <v-text-field label="Titulo" :rules="inputRules" v-model="property.title" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-select no-data-text="No existen tipos de propiedad registradas" v-model="property.type" :items="types" :rules="selectRules" item-text="name" item-value="id" label="Tipo de Propiedad"></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field label="Dirección" :rules="inputRules" v-model="property.country"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-select no-data-text="No existen estatus registrados" v-model="property.status_id" :items="status" :rules="selectRules" item-text="name" item-value="id" label="Estatus" ></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field label="Precio" :rules="numberRules" v-model="property.price" persistent-hint required></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-select no-data-text="No existen monedas registradas" v-model="property.currency" :items="currencies" :rules="selectRules" item-text="name" item-value="id" label="Moneda" ></v-select>
                    </v-flex>
                    <v-flex xs12>
                        {{error}}
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
              <span class="headline">Editar propiedad</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12 sm6 md6>
                      <v-text-field label="Titulo" :rules="inputRules" v-model="property.title" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-select no-data-text="No existen tipos de propiedad registradas" v-model="property.type" :items="types" :rules="selectRules" item-text="name" item-value="id" label="Tipo de Propiedad"></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field label="Dirección" :rules="inputRules" v-model="property.country"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-select no-data-text="No existen estatus registrados" v-model="property.status_id" :items="status" :rules="selectRules" item-text="name" item-value="id" label="Estatus" ></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field label="Precio" :rules="numberRules" v-model="property.price" persistent-hint required></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-select no-data-text="No existen monedas registradas" v-model="property.currency" :items="currencies" :rules="selectRules" item-text="name" item-value="id" label="Moneda" ></v-select>
                    </v-flex>
                    <v-flex xs12>
                      {{error}}
                    </v-flex>
                    <template>
                      <v-card>
                        <v-tabs background-color="grey accent-4" center-active dark >
                          <v-tab>DETALLES</v-tab>
                          <v-tab>MULTIMEDIA</v-tab>
                          <v-tab>ARCHIVOS</v-tab>
                          <v-tab>HISTORIA</v-tab>
                          <v-tab>PORTALES</v-tab>
                        </v-tabs>
                        <v-tabs-items v-model="tabs">
                          <v-tab-item>
                            <v-card flat>
                              <v-card-title class="headline">
                                Detalles de la Propiedad
                              </v-card-title>
                              <v-card-text>

                              </v-card-text>
                            </v-card>
                            <v-card flat>
                              <v-card-title class="headline">
                                Fotos y Videos
                              </v-card-title>
                              <v-card-text>

                              </v-card-text>
                            </v-card>
                            <v-card flat>
                              <v-card-title class="headline">
                                Archivos de la Propiedad
                              </v-card-title>
                              <v-card-text>

                              </v-card-text>
                            </v-card>
                            <v-card flat>
                              <v-card-title class="headline">
                                Detalles de la Propiedad
                              </v-card-title>
                              <v-card-text>

                              </v-card-text>
                            </v-card>
                            <v-card flat>
                              <v-card-title class="headline">
                                Detalles de la Propiedad
                              </v-card-title>
                              <v-card-text>

                              </v-card-text>
                            </v-card>
                            <v-card flat>
                              <v-card-title class="headline">
                                Detalles de la Propiedad
                              </v-card-title>
                              <v-card-text>

                              </v-card-text>
                            </v-card>
                          </v-tab-item>
                        </v-tabs-items>
                      </v-card>
                    </template>
                  </v-layout>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="danger" @click="dialogedit = false">Cancelar</v-btn>
              <v-btn color="success" :disabled="!valid" @click.prevent="edit_model()">Editar</v-btn>
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
              <span class="headline">¿Esta seguro que desea eliminar esta propiedad?</span>
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

<script>
  import jsPDF from 'jspdf';
  import 'jspdf-autotable'
  export default {
    props: {
      rol: Number
    },
    data() {
      return {
        property: {},
        properties: [],
        status: [],
        currencies: [],
        types: [],
        search: '',
        valid: false,
        dialog: false,
        dialogedit: false,
        dialogdelete: false,
        error: '',


        id_delete: '',
        propiedad_eliminar: '',


        inputRules: [
          v => !!v || 'El campo es obligatorio',
        ],
        selectRules: [
          v => !!v || 'Debe seleccionar una opción',
        ],
        numberRules: [
          v => !!v || 'El campo es obligatorio',
          v => /^[0-9]+([.][0-9]+)?$/.test(v)  || 'Debe ser un valor númerico',
        ],
      }
    },
    methods: {
      index(page, search) {
        axios.get("/admin/api-properties-user?&search=" + search).then((response) => {
          console.log(response);
          this.properties = response.data.properties;
          this.status = response.data.status;
          this.currencies = response.data.currencies;
          this.types = response.data.types;
        });
      },
      create() {
        this.property = {};
        this.dialog = true;
      },
      store() {
        axios.post("/admin/api-properties", this.property).then((response) => {
          if (response.status == 200) {
            this.index(0, '');
            this.property = {};
            this.dialog = false;
            this.$swal.fire('Propiedad registrada con exito');
          }
        }).catch(error => {
          this.$swal.fire(
            'Error',
            'Ocurrío un error al tratar de registrar la propiedad, intente nuevamente, recuerde que los precios y las dimensiones deben ser unicamente en numeros y máximo 2 decimales.',
            'error'
          )
        });
      },
      edit_model() {
        axios.put("/admin/api-properties/" + this.property).then((response) => {
          if (response.status == 200) {
            this.index(0, '');
            this.property = {};
            this.dialogedit = false;
            this.$swal.fire(
              'Propiedad actualizada con exito',
              'Para agregar imagenes seleccione el boton de imagenes a la derecha de la tabla.',
              'success'
            );
          }
        }).catch(error => {
          this.$swal.fire(
            'Error',
            'Hubo un error al tratar de editar la propiedad, intente nuevamente, recuerde que los precios y las dimensiones deben ser unicamente en numeros y máximo 2 decimales.',
            'error'
          )
        });
      },
      delete_model() {
        console.log(this.id_delete);
        axios.delete("/admin/api-properties/" + this.id_delete).then((response) => {
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
      edit(id) {
        axios.get("/admin/property-user/" + id).then((response) => {
          if (response.status == 200) {
            this.property = response.data.property;
            //this.property.type = types[response.data.property.type];
            this.dialogedit = true;
          }
        }).catch(error => {
          this.$swal.fire(
            'Error',
            'Hubo un error al tratar de editar la propiedad, intente nuevamente.',
            'error'
          )
        });
      },
      delete_dialog(id, title) {
        this.id_delete = id;
        this.dialogdelete = true;
        this.propiedad_eliminar = title;
      },
      images(id) {
        window.location.href = "/property-images/" + id;
      },
      exportPDF() {
        var columns = [
          {
            title: 'Propiedad',
            dataKey: 'title',
          },
          {
            title: 'Ciudad',
            dataKey: 'city'
          },
          {
            title: "Información",
            dataKey: "information"
          },
          {
            title: 'Precio',
            dataKey: 'price'
          },
          {
            title: 'Dimensión',
            dataKey: 'dimension'
          },
          {
            title: 'Estatus',
            dataKey: 'status'
          },
          {
            title: 'Usuario',
            dataKey: 'name'
          },
          {
            title: 'Moneda',
            dataKey: 'currency'
          },
        ];

        var doc = new jsPDF('p', 'pt');
        doc.text('Propiedades', 40, 40);
        doc.autoTable(columns, this.properties, {
          margin: {
            top: 60
          },
        });

        doc.save('Propiedades.pdf');
      }
    },
    created() {
      this.index(0, '');
    },
    computed: {
      headers() {
        return [
          {
            text: 'Imagen',
            value: 'imagen'
          },
          {
            text: 'Propiedad',
            value: 'title',
          },
          {
            text: 'Tipo',
            value: 'type',
          },
          {
            text: 'Dirección',
            value: 'country'
          },
          {
            text: 'Precio',
            value: 'price'
          },
          {
            text: 'Moneda',
            value: 'currency'
          },
          {
            text: 'Estatus',
            value: 'status'
          },
          {
            text: 'Usuario',
            value: 'user'
          },
          {
            text: 'Acciones',
            value: 'action',
            sortable: false
          },
        ];
      },
    },
  }
</script>
