<template>

  <div class="text-center">

    <v-card color="blue darken-4">
      <v-card-title class="display-1 text-white">
        Lista de Propiedades
        <v-btn color="success" dark absolute right fab class="mt-1" @click="create()">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </v-card-title>
      <v-data-table :headers="headers"  no-results-text="No hay resultados" no-data-text="No hay propiedades " :items="properties" item-key="propeties-user" class="elevation-1" :search="search">
        <template v-slot:item.imagen="{ item }">
          <v-img :src="'../../'+item.image" height="100" width="100"></v-img>
        </template>
        <template v-slot:top>
          <v-toolbar flat>
            <v-text-field v-model="search" label="Buscar" class="mt-3"></v-text-field>
            <v-spacer></v-spacer>
            <v-btn @click="exportPdfProperties()" color="#E53935" dark>Pdf General <v-icon>mdi-file-pdf</v-icon></v-btn>
          </v-toolbar>
        </template>
        <template v-slot:item.type="{ item }">
          {{ types[item.type-1]['name'] }}
        </template>
        <template v-slot:item.action="{ item }">
          <a v-if="role==1" class="m-1 btn" style="background:#E53935;height:36px;min-width:64px;padding:4px 16px;" :href="'/admin/reports/property/'+item.id">
            <v-icon color="#fff">
                mdi-file-pdf
            </v-icon>
          </a>
          <v-btn color="#ff9800" class="m-1" @click="edit(item.id)">
            <v-icon color="#fff">
                mdi-pencil
            </v-icon>
          </v-btn>
          <v-btn small  v-if="role==1" color="#E53935" class="m-1" @click="delete_dialog(item.id)">
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
                      <v-text-field label="Provincia" :rules="inputRules" v-model="property.province"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-select no-data-text="No existen estatus registrados" v-model="property.status_id" :items="status" :rules="selectRules" item-text="name" item-value="id" label="Estatus" ></v-select>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field label="Precio" :rules="numberRules" v-model="property.price" persistent-hint required></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-select no-data-text="No existen monedas registradas" v-model="property.currency_id" :items="currencies" :rules="selectRules" item-text="name" item-value="id" label="Moneda" ></v-select>
                    </v-flex>
                    <v-flex xs12>
                      <v-textarea name="input-7-1" rows="3" label="Información de la Propiedad" :rules="inputRules" v-model="property.information"></v-textarea>
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
                    <v-flex xs12 sm6 md4 style="align-self:center;">
                       <v-img :src="'../../'+imageprincipal" width="100%"></v-img>
                    </v-flex>
                    <v-flex xs12 sm6 md8>
                      <v-flex xs12>
                        <v-text-field label="Titulo" :rules="inputRules" v-model="property.title" required></v-text-field>
                      </v-flex>
                      <v-flex xs12>
                        <v-text-field label="Provincia" :rules="inputRules" v-model="property.province"></v-text-field>
                      </v-flex>
                      <v-flex xs12>
                        <v-text-field label="Localidad" :rules="inputRules" v-model="property.location"></v-text-field>
                      </v-flex>
                      <v-flex xs12>
                        <v-text-field label="Sub-división" :rules="inputRules" v-model="property.subdivision_1"></v-text-field>
                      </v-flex>
                    </v-flex>
                    <v-flex xs12 md4>
                      <v-checkbox class="pr-6" v-model="property.show_web" label="Mostrar en la Web" :value="1"></v-checkbox>
                    </v-flex>
                    <v-flex xs12 md8>
                      <v-text-field label="Sub-división"  v-model="property.subdivision_2"></v-text-field>
                    </v-flex>
                    <template>
                      <v-card>
                        <v-tabs background-color="grey accent-4" center-active dark  v-model="tab" width="100%">
                          <v-tab>DETALLES</v-tab>
                          <v-tab>MULTIMEDIA</v-tab>
                          <v-tab>NOTIFICACIONES</v-tab>
                        </v-tabs>
                        <v-tabs-items v-model="tab">
                          <v-tab-item>
                            <v-card flat>
                              <v-container>
                                <v-card-title class="headline">
                                  Posición Geográfica
                                </v-card-title>
                                <v-card-text>
                                  <v-layout wrap>
                                    <v-flex xs6>
                                      <v-text-field label="Longitud" v-model="property.longitude"></v-text-field>
                                    </v-flex>
                                    <v-flex xs6>
                                      <v-text-field label="Latitud" v-model="property.latitude"></v-text-field>
                                    </v-flex>
                                  </v-layout>
                                  <v-row no-gutters class="my-3" v-show="property.longitude && property.latitude">
                                    <GmapMap map-type-id="terrain" style="width:100%;" :center="{lat:10, lng:10}">
                                      <GmapMarker :position="google && new google.maps.LatLng(property.latitude, property.longitude)"/>
                                      />
                                    </GmapMap>
                                  </v-row>
                                </v-card-text>
                              </v-container>
                            </v-card>
                            <v-card flat>
                              <v-container>
                                <v-card-title class="headline">
                                  Información Básica
                                </v-card-title>
                                <v-card-text>
                                  <v-form ref="form" v-model="valid">
                                    <v-layout wrap>
                                      <v-flex xs12>
                                        <v-textarea name="input-7-1" rows="3" label="Información de la Propiedad" :rules="inputRules" v-model="property.information"></v-textarea>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-text-field label="Precio" :rules="numberRules" v-model="property.price" persistent-hint required></v-text-field>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-select no-data-text="No existen monedas registradas" v-model="property.currency" :items="currencies" :rules="selectRules" item-text="name" item-value="id" label="Moneda" ></v-select>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-text-field label="Dimensiones" :rules="numberRules" v-model="property.dimension"></v-text-field>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-select no-data-text="No existen tipos de propiedad registradas" v-model="property.type" :items="types" :rules="selectRules" item-text="name" item-value="id" label="Tipo de Propiedad"></v-select>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-select no-data-text="No existen situaciones registradas" v-model="property.situation" :items="situations" :rules="selectRules" item-text="name" item-value="id" label="Situación actual" ></v-select>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-select no-data-text="No existen estatus registrados" v-model="property.status_id" :items="status" :rules="selectRules" item-text="name" item-value="id" label="Estatus" ></v-select>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-select no-data-text="No existen antiguedades registradas" v-model="property.antiquity" :items="antiquitys" :rules="selectRules" item-text="name" item-value="id" label="Antigüedad" ></v-select>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-select no-data-text="No existen condiciones registradas" v-model="property.condition" :items="conditions" :rules="selectRules" item-text="name" item-value="id" label="Condición" ></v-select>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-select no-data-text="No existen ubicaciones registradas" v-model="property.keys" :items="locations" :rules="selectRules" item-text="name" item-value="id" label="Ubicación de llaves" ></v-select>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-text-field label="Cantidad de Ambientes" :rules="numberRules" v-model="property.environments"></v-text-field>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-text-field label="Cantidad de Plantas" :rules="numberRules" v-model="property.plants"></v-text-field>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-text-field label="Cantidad de Baños" :rules="numberRules" v-model="property.bedrooms"></v-text-field>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-text-field label="Cantidad de Toilettes" :rules="numberRules" v-model="property.toilettes"></v-text-field>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-text-field label="Cantidad de Tocadores" :rules="numberRules" v-model="property.dresser"></v-text-field>
                                      </v-flex>                                                                         <v-flex xs12 sm6 md6>
                                        <v-text-field label="Cantidad de Cocheras" :rules="numberRules" v-model="property.chocheras"></v-text-field>
                                      </v-flex>
                                      <v-flex xs12>
                                        {{error}}
                                      </v-flex>
                                    </v-layout>
                                  </v-form>
                                </v-card-text>
                              </v-container>
                            </v-card>
                            <v-divider></v-divider>
                            <v-card flat>
                              <v-card-title class="headline">
                                Servicios
                              </v-card-title>
                              <v-card-text>
                                <template>
                                  <v-container fluid>
                                    <v-row>
                                      <v-col cols="3"  class="m-0 py-0" v-for="(s,index) in services" :key="index">
                                        <v-checkbox class="m-0 p-0" light :label="s.name" v-model="service" v-bind:value="s.id">
                                        </v-checkbox>
                                      </v-col>
                                    </v-row>
                                  </v-container>
                                </template>
                              </v-card-text>
                            </v-card>
                            <v-divider></v-divider>
                            <v-card flat>
                              <v-card-title class="headline">
                                Ambientes
                              </v-card-title>
                              <v-card-text>
                                <template>
                                  <v-container fluid>
                                    <v-row>
                                      <v-col cols="3" class="m-0 py-0" v-for="(e,index) in envs" :key="index">
                                        <v-checkbox class="m-0 p-0" light :label="e.name" v-model="env" :value="e.id">
                                        </v-checkbox>
                                      </v-col>
                                    </v-row>
                                  </v-container>
                                </template>
                              </v-card-text>
                            </v-card>
                            <v-divider></v-divider>
                            <v-card flat>
                              <v-card-title class="headline">
                                Adicionales
                              </v-card-title>
                              <v-card-text>
                                <template>
                                  <v-container fluid>
                                    <v-row>
                                      <v-col cols="3"  class="m-0 py-0" v-for="(e,index) in extras" :key="index">
                                        <v-checkbox class="m-0 p-0" light :label="e.name" v-model="extra" :value="e.id">
                                        </v-checkbox>
                                      </v-col>
                                    </v-row>
                                  </v-container>
                                </template>
                              </v-card-text>
                            </v-card>
                          </v-tab-item>

                          <v-tab-item>
                            <v-card flat  width="100%">
                              <v-card-title class="headline">
                                Subir Imagenes de la Propiedad
                              </v-card-title>
                              <v-card-text>
                                <v-container>
                                  <v-form ref="form" v-model="valid">
                                    <v-layout wrap>
                                      <v-flex xs12 sm6 md6>
                                      <image-propertie  :id="property.id" :key="property.id"/>
                                      </v-flex>
                                    </v-layout>
                                  </v-form>
                                </v-container>
                              </v-card-text>
                            </v-card>
                          </v-tab-item>

                          <v-tab-item>
                            <v-card flat  width="100%">
                              <v-card-title class="headline">
                                Notificaciones de la Propiedad
                              </v-card-title>
                              <v-card-text>
                                <v-container>
                                  <v-row  v-for="report in reports" :key="report.id">
                                    <v-col xs12 class="border-bottom border-secondary px-0">
                                      <p class="m-0">{{ report.type }} {{ report.information }}</p>
                                      <p class="m-0" style="color:#999">por {{ report.user.name }} -- {{ report.diff }} ({{ report.created }})</p>
                                    </v-col>
                                  </v-row>
                                </v-container>
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
              <v-btn color="success" :disabled="!valid" @click.prevent="update(property.id)">Guardar</v-btn>
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
  import {gmapApi} from 'vue2-google-maps';
  import jsPDF from 'jspdf';
  import 'jspdf-autotable'
  export default {
    props: {
      role: Number
    },
    data() {
      return {
        markers: [
          {
            position: 12
          }
        ],
        image: null,
        imageprincipal: '',
        property: {},
        properties: [],
        status: [],
        currencies: [],
        types: [],
        situations: [],
        antiquitys: [],
        conditions: [],
        locations: [],
        reports: [],
        envs: [],
        services: [],
        extras: [],
        env: [],
        service: [],
        extra: [],
        tab: null,
        search: '',
        valid: false,
        dialog: false,
        dialogedit: false,
        dialogdelete: false,
        error: '',
        id_delete: '',
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
          this.properties = response.data.properties;
          this.status = response.data.status;
          this.currencies = response.data.currencies;
          this.types = response.data.types;
          this.situations = response.data.situations;
          this.antiquitys = response.data.antiquitys;
          this.conditions = response.data.conditions;
          this.locations = response.data.locations;
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
      edit(id) {
        axios.get("/admin/property-user/" + id).then((response) => {
          if (response.status == 200) {
            this.property = response.data.property;
            this.reports = response.data.reports;
            this.envs = response.data.envs;
            this.services = response.data.services;
            this.extras = response.data.extras;
            this.env = response.data.env;
            this.service = response.data.service;
            this.extra = response.data.extra;
            this.imageprincipal = response.data.imagen;
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
      update(id) {
        axios.patch("/admin/property-user/" + id,
        {
          prop: this.property,
          envs: this.env,
          services: this.service,
          extras: this.extra
        }).then((response) => {
          if (response.status == 200) {
            this.index(0, '');
            this.property = {};
            this.dialogedit = false;
            this.imageprincipal = '';
            this.$swal.fire(
              'Propiedad actualizada con exito',
              'success'
            );
          }
        })
        .catch(error => {
          this.$swal.fire(
            'Error',
            'Hubo un error al tratar de modificar la propiedad. Por favor, intente nuevamente.',
            'error'
          )
        });
      },
      delete_model() {
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
      delete_dialog(id) {
        this.id_delete = id;
        this.dialogdelete = true;
      },
      saveImage() {
        let InstFormData = new FormData();
        InstFormData.append('image' , this.image);
        InstFormData.append('property_id' , this.property.id);

        axios.post('/admin/api-images', InstFormData , {headers : {'content-type': 'multipart/form-data'}}).then((response) => {
          if (response.status == 200) {
            this.dialog= false;
            this.index();
            this.$swal.fire(
            'Imagen subida con exito',
            '',
            'success'
            );
          }
        }).catch(error => {
          this.$swal.fire({
            icon: 'Error',
            title: 'Ocurrio un error al subir la imagen',
            showConfirmButton: false,
            timer: 1500
          })
        });
      },
      exportPdfProperties() {
        var columns = [
          {
            title: 'Propiedad',
            dataKey: 'title',
          },
          {
            title: 'Ciudad',
            dataKey: 'province'
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
            title: 'Moneda',
            dataKey: 'currency'
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
       this.$swal.fire({
                header:'Ayuda rápida',
                title: '<strong><u>Modulo de Propiedades</u></strong>',
                html:
                    'Desde el Módulo de propiedades podrás crear y administrar las propiedades que se mostraran a los clientes. <br> '+
                    'Para crear una oportunidad primero deberas llenar la información básica y guardarla' +
                    'y luego deberas editarla y llenar el resto de los datos requeridos <br> '+
                    '<strong>Recuerda que para que se muestren a los clientes deberas maracar la casilla de Mostrar en la web '+
                    'Desde aca puedes ver tambien los tiquets de oportunidades de otros agentes y puedes transferirles </strong>' ,
                showCloseButton: true,
                focusConfirm: false,
                })
    },
    validarImagen(uploadFile)
    {
      if (!window.FileReader) {
          this.error= 'El navegador no soporta la lectura de archivos';
          return false;
      }
      if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
          this.error = 'El archivo a adjuntar no es una imagen de un formato valido';
          return false;
      }
      if (uploadFile.size > 500000)
      {
          this.error='El peso de la imagen no puede exceder los 500kb';
          return false;
      }
      return true;
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
            text: 'Provincia',
            value: 'province'
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
            width: '13rem',
            sortable: false
          },
        ];
      },
      google: gmapApi,
    },
  }
</script>
