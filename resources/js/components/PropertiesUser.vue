<template>

  <div class="text-center">

    <v-card color="blue">
      <v-card-title class="display-1 text-white">
        Propiedades
        <v-btn color="success" dark absolute right fab class="mt-1" @click="dialog=true">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </v-card-title>
      <v-data-table :headers="headers"  no-results-text="No hay resultados" no-data-text="No hay propiedades " :items="properties" item-key="propeties-user" class="elevation-1" :search="search">
        <template v-slot:item.imagen="{ item }">
          <v-img :src="'../'+item.image" height="100" width="100"></v-img>
        </template>
        <template v-slot:top>
          <v-toolbar flat>
            <v-text-field v-model="search" label="Buscar" class="mt-3"></v-text-field>
            <v-spacer></v-spacer>
            <v-btn @click="exportPDF()" color="#E53935" dark>
              Pdf <v-icon>mdi-file-pdf</v-icon></v-btn>
          </v-toolbar>
        </template>
        <template>
          <tr v-for="p in properties" :key="p.id">
            <td>{{ p.image }}</td>
            <td>{{ p.type }}</td>
            <td>{{ p.country }}, {{ p.region }}, {{ p.location }}</td>
            <td>{{ p.price }}</td>
            <td>{{ p.currency }}</td>
            <td>{{ p.dimension }}</td>
            <td>{{ p.status }}</td>
            <td>{{ p.user }}</td>
            <td></td>
          </tr>
        </template>
        <template v-slot:item.action="{ item }">
          <v-btn color="#66BB6A" class="m-1" @click="edit(item.id,item.title,item.dimension,item.price,item.information)">
            <v-icon color="#fff">
                mdi-pencil
            </v-icon>
          </v-btn>
          <v-btn color="warning" class="m-1" @click="images(item.id)">
            <v-icon color="#fff">
                mdi-file-image
            </v-icon>
          </v-btn>
          <v-btn color="blue darken-2" class="m-1" @click="shareFace(item.id)">
            <v-icon color="#fff">
                mdi-facebook
            </v-icon>
          </v-btn>
          <v-btn color="blue darken-1" class="m-1" @click="shareTwit(item.id)">
            <v-icon color="#fff">
                mdi-twitter
            </v-icon>
          </v-btn>
          <v-btn v-if="rol==1" color="#E53935" class="m-1" @click="delete_dialog(item.id,item.title)">
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
              <v-btn color="success" :disabled="!valid" @click.prevent="create()">Crear</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-layout>
    </template>

    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialogedit" persistent max-width="600px">
          <v-card>
            <v-card-title>
              <span class="headline">Editar propiedad</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12 sm6 md6>
                      <v-text-field label="Titulo" v-model="title_edit" :rules="inputRules" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field label="Precio" :rules="priceRules" v-model="price_edit" persistent-hint required></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-select no-data-text="No hay Monedas" v-model="selectRules" :items="currencies" :rules="selectRules" item-text="name" item-value="id" label=" Moneda" ></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-select v-model="status_id_edit" :items="status" item-text="status" :rules="selectRules" item-value="id" label="Estatus" required ></v-select>
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
              <span class="headline">Desea eliminar: {{propiedad_eliminar}}</span>
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

        id_edit: '',
        title_edit: '',
        information_edit: '',
        price_edit: '',
        dimension_edit: '',
        currency_id_edit: '',
        id_delete: '',
        propiedad_eliminar: '',
        status_id_edit: '',

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
        axios.put("/admin/api-properties/" + this.id_edit, {
          title: this.title_edit,
          dimension: this.dimension_edit,
          information: this.information_edit,
          price: this.price_edit,
          status: this.status_id_edit,
          currency_id: this.currency_id_edit
        }).then((response) => {
          if (response.status == 200) {
            this.index(0, '');
            this.title_edit = '';
            this.information_edit = '';
            this.price_edit = '';
            this.dimension_edit = '';
            this.status_id_edit = '';
            this.dialogedit = false;
            this.currency_id_edit = ''
            this.$swal.fire(
              'Propiedad editada con exito',
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
      edit(id, title, dimension, price, info) {
        this.dialogedit = true;
        this.id_edit = id;
        this.title_edit = title;
        this.information_edit = info;
        this.price_edit = price;
        this.dimension_edit = dimension;
        console.log(this.id_edit)
      },
      delete_dialog(id, title) {
        this.id_delete = id;
        this.dialogdelete = true;
        this.propiedad_eliminar = title;
      },
      prueba() {
        console.log(this.currency_id_edit);
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
            text: 'Dimensión',
            value: 'dimension'
          },
          {
            text: 'Estatus',
            value: 'status'
          },
          {
            text: 'Usuario',
            value: 'name'
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
