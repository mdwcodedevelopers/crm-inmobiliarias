<template>
  <div class="text-center p-4 d-flex align-items-center flex-column">

<v-flex md8 style="overflow: auto"> 
    <v-card color="blue">
      <v-card-title class="display-1 text-white">
        Agenda de contactos
        <v-btn color="success" dark absolute right fab class="mt-1" @click="create()">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </v-card-title>
      <v-card-text class="d-flex text-white">
                Un listado completo de clientes.
            </v-card-text>
      <v-data-table 
        :headers="headers"  
        no-results-text="No hay resultados" 
        no-data-text="No hay contactos " 
        :items="contacts" 
        item-key="id" 
        class="elevation-1" 
        :search="search">
        
        <template v-slot:item.image="{ item }">
          <v-img :src="'../../'+item.image" height="100" width="100"></v-img>
        </template>

        <template v-slot:item.action="{ item }">

            <v-btn color="#66BB6A"  small @click="edit(item.id,item.name,item.email,2)">
                <v-icon color="#fff">
                    mdi-pencil
                </v-icon>
            </v-btn>
            <v-btn color="#E53935" small @click="delete_dialog(item.id,item.name,item.email)">
                <v-icon color="#fff">
                    mdi-delete
                </v-icon>
            </v-btn>
            <v-btn color="#66BB6A"  small @click="whatsapp(item.phone)">
                <v-icon color="#fff">
                    mdi-whatsapp
                </v-icon>
            </v-btn>
        </template>

      </v-data-table>
    </v-card>
</v-flex>
    <!-- <template>
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
                    <v-flex xs12 sm6 md4>
                       <v-img :src="'../'+property.image" width="100%"></v-img>
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
                      <v-flex xs12>
                        <v-text-field label="Sub-división"  v-model="property.subdivision_2"></v-text-field>
                      </v-flex>
                      <v-flex xs12>
                        <v-checkbox class="pr-6" v-model="property.show_web" label="Mostrar en la Web" value="1"></v-checkbox>
                      </v-flex>
                    </v-flex>
                    <template>
                      <v-card>
                        <v-tabs background-color="grey accent-4" center-active dark  v-model="tab" width="100%">
                          <v-tab>DETALLES</v-tab>
                          <v-tab>MULTIMEDIA</v-tab>
                        </v-tabs>
                        <v-tabs-items v-model="tab">
                          <v-tab-item>
                            <v-card flat>
                              <v-card-title class="headline">
                                Información Básica
                              </v-card-title>
                              <v-card-text>
                                <v-container>
                                  <v-form ref="form" v-model="valid">
                                    <v-layout wrap>
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
                                        <v-select no-data-text="No existen ubicaciones registradas" v-model="property.key" :items="locations" :rules="selectRules" item-text="name" item-value="id" label="Ubicación de llaves" ></v-select>
                                      </v-flex>
                                      <v-flex xs12 sm6 md6>
                                        <v-text-field label="Cantidad de Ambientes" :rules="numberRules" v-model="property.environ"></v-text-field>
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
                                </v-container>
                              </v-card-text>
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
                                      <v-col cols="3"  class="m-0 py-0" v-for="(service,index) in services" :key="index">
                                        <v-checkbox class="m-0 p-0" light :label="service.name" v-model="property.services" :value="service.id">
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
                                      <v-col cols="3" class="m-0 py-0" v-for="(env,index) in envs" :key="index">
                                        <v-checkbox class="m-0 p-0" light :label="env.name" v-model="property.environments" :value="env.id">
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
                                      <v-col cols="3"  class="m-0 py-0" v-for="(extra,index) in extras" :key="index">
                                        <v-checkbox class="m-0 p-0" light :label="extra.name" v-model="propertyextras" :value="extra.id">
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
                                      <image-propertie  :id="property.id" />
                                      </v-flex>
                                    </v-layout>
                                  </v-form>
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
              <v-btn color="success" :disabled="!valid" @click.prevent="update(property.id)">Editar</v-btn>
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
    </template> -->

  </div>
</template>

<style>

</style>

<script>
export default {
     data() {
        return {
            contacts: [],
            search: '',
            total:'',
        }
    },
     methods: {
        index() {
            axios.get("/admin/api-contacts").then((response) => {
                console.log(response);
                this.contacts = response.data.contacts;
                this.total = response.data.total;
            });
        },
        whatsapp(phone) {
            window.location.href = 'https://api.whatsapp.com/send?phone=' + phone;
        }
        },
    computed: {
        headers() {
            return [
                {
                    text: 'Imagen',
                    value: 'image'
                },
                {
                    text: 'Nombre',
                    value: 'name'
                },
                {
                    text: 'Email',
                    value: 'email'
                },
                {
                    text: 'Telefono 1',
                    value: 'phone_1'
                },
                {
                    text: 'Telefono 2',
                    value: 'phone_2'
                },
                {
                    text: 'Dirección',
                    value: 'direction'
                },
                {
                    text: 'Provincia',
                    value: 'province'
                },
                {
                    text: 'Creado',
                    value: 'created_at'
                },
                {
                    text: 'Agente',
                    value: 'agent_id'
                },
                {
                    text: 'Acciones',
                    value: 'action',
                    sortable: false,
                    align: 'center'
                },
                ];
            }
        },
    created() {
        this.index();
    },
    }
</script>