<template>
  <div class="text-left">
    <v-card color="blue">
      <v-card-title class="display-1 text-white">
        Reportes
        <small class="caption w-100 mt-2">Información estadística para analizar las operaciones de la compañia.</small>
      </v-card-title>
    </v-card>
    <v-card color="white">
      <v-hover>
        <template v-slot:default="{ hover }">
          <v-card :elevation="hover ? 10 : 5" class="mx-auto pa-6">
          <v-container>
            <v-layout wrap>
              <v-flex xs3 sm1>
                <v-icon color="dark" class="px-2" size="45">
                  mdi-account-circle
                </v-icon>
              </v-flex>
              <v-flex xs9 sm11>
                <h6><a href="#" v-on:click="dialog = 1">CONTACTOS CREADOS (POR ETIQUETAS)</a></h6>
                <small>En este reporte usted podrá consultar la asignación de clientes por Vendedor, así como también por un Grupo de Etiquetas en particular.</small>
              </v-flex>
            </v-layout>
          </v-container>
          </v-card>
        </template>
      </v-hover>
      <div class="my-6"></div>
      <v-hover>
        <template v-slot:default="{ hover }">
          <v-card :elevation="hover ? 10 : 5" class="mx-auto pa-6">
          <v-container>
            <v-layout wrap>
              <v-flex xs1>
                <v-icon color="dark" class="px-2" size="45">
                  mdi-format-list-bulleted
                </v-icon>
              </v-flex>
              <v-flex xs11>
                <h6><a href="#" v-on:click="dialog = 2">ANALISIS DE CONTACTOS POR CADA USUARIO</a></h6>
                <small>En este reporte podrás ver cuántos contactos fueron creados/asignados a cada usuario y como lo gestionaron en un periodo de tiempo.</small>
              </v-flex>
            </v-layout>
          </v-container>
          </v-card>
        </template>
      </v-hover>
      <div class="my-6"></div>
      <v-hover>
        <template v-slot:default="{ hover }">
          <v-card :elevation="hover ? 10 : 5" class="mx-auto pa-6">
          <v-container>
            <v-layout wrap>
              <v-flex xs1>
                <v-icon color="dark" class="px-2" size="45">
                  mdi-home
                </v-icon>
              </v-flex>
              <v-flex xs11>
                <h6><a href="#" v-on:click="dialog = 3">MOVIMIENTO DE PROPIEDADES</a></h6>
                <small>Cómo tus prpiedades disponibles están siendo involucradas en los diferentes tipos de eventos.</small>
              </v-flex>
            </v-layout>
          </v-container>
          </v-card>
        </template>
      </v-hover>
      <div class="my-6"></div>
      <v-hover>
        <template v-slot:default="{ hover }">
          <v-card :elevation="hover ? 10 : 5" class="mx-auto pa-6">
          <v-container>
            <v-layout wrap>
              <v-flex xs1>
                <v-icon color="dark" class="px-2" size="45">
                  mdi-filter-variant
                </v-icon>
              </v-flex>
              <v-flex xs11>
                <h6><a href="#" v-on:click="dialog = 4">PATRONES DE BÚSQUEDA</a></h6>
                <small>Analiza el comportamiento de tus contactos basados en sus búsquedas.</small>
              </v-flex>
            </v-layout>
          </v-container>
          </v-card>
        </template>
      </v-hover>
    </v-card>
    <!-- #1 REPORTE ------------->
    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialog"  v-if="dialog === 1" persistent max-width="100%">
          <v-card class="my-4">
            <v-card color="">
              <v-card-title class="display-1">
                <h4>CONTACTOS CREADOS (POR ETIQUETAS)</h4>
                <small class="caption w-100 mt-2">En este reporte usted podrá consultar la asignación de clientes por Vendedor, así como también por un Grupo de Etiquetas en particular.</small>
              </v-card-title>
            </v-card>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs6 sm4 md4>
                      <v-menu v-model="dateShowOne" transition="scale-transition" offset-y min-width="auto">
                        <template v-slot:activator="{ on, attrs }">
                          <v-text-field v-model="dateOne" :rules="inputRules" label="Fecha desde" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"></v-text-field>
                        </template>
                        <v-date-picker v-model="dateOne" @input="dateShowOne = false"></v-date-picker>
                      </v-menu>
                    </v-flex>
                    <v-flex xs6 sm4 md4>
                      <v-menu v-model="dateShowTwo" transition="scale-transition" offset-y min-width="auto">
                        <template v-slot:activator="{ on, attrs }">
                          <v-text-field v-model="dateTwo" :rules="inputRules" label="Fecha hasta" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"></v-text-field>
                        </template>
                        <v-date-picker v-model="dateTwo" @input="dateShowTwo = false"></v-date-picker>
                      </v-menu>
                    </v-flex>
                    <v-flex xs12 sm4 md4>
                      <v-select v-model="filter.tag" :items="tags" :rules="selectRules" item-value="id" label="Grupo de Etiquetas:" attach color="blue-grey lighten-2" multiple style="max-height=42px">
                        <template v-slot:selection="data">
                          <v-chip v-bind="data.attrs" :input-value="data.selected" close @click:close="filter.tag = ''"> {{ data.item.name }}
                          </v-chip>
                        </template>
                        <template v-slot:item="data">
                          <v-list-item-content>
                            <v-list-item-title v-html="data.item.name"></v-list-item-title>
                            <v-list-item-subtitle v-html="data.item.group_name"></v-list-item-subtitle>
                          </v-list-item-content>
                        </template>
                      </v-select>
                    </v-flex>
                  </v-layout>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-container>
                <v-layout wrap class="text-center">
                  <v-flex xs12 sm6 md6>
                    <v-btn color="danger" class="w-100" @click="closeDialog()">Cancelar</v-btn>
                  </v-flex>
                  <v-flex xs12 sm6 md6>
                    <v-btn color="success" class="w-100" :disabled="!valid" @click="getData()">Generar</v-btn>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-layout>
    </template>
    <!-- #2 REPORTE ------------->
    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialog"  v-if="dialog === 2" persistent max-width="100%">
          <v-card class="my-4">
            <v-card color="">
              <v-card-title class="display-1">
                <h4>ANALISIS DE CONTACTOS POR CADA USUARIO</h4>
                <small class="caption w-100 mt-2">En este reporte podrás ver cuántos contactos fueron creados/asignados a cada usuario y como lo gestionaron en un periodo de tiempo.</small>
              </v-card-title>
            </v-card>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs6 sm6 md6>
                      <v-menu v-model="dateShowOne" transition="scale-transition" offset-y min-width="auto">
                        <template v-slot:activator="{ on, attrs }">
                          <v-text-field v-model="dateOne" :rules="inputRules" label="Fecha desde" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"></v-text-field>
                        </template>
                        <v-date-picker v-model="dateOne" @input="dateShowOne = false"></v-date-picker>
                      </v-menu>
                    </v-flex>
                    <v-flex xs6 sm6 md6>
                      <v-menu v-model="dateShowTwo" transition="scale-transition" offset-y min-width="auto">
                        <template v-slot:activator="{ on, attrs }">
                          <v-text-field v-model="dateTwo" :rules="inputRules" label="Fecha hasta" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"></v-text-field>
                        </template>
                        <v-date-picker v-model="dateTwo" @input="dateShowTwo = false"></v-date-picker>
                      </v-menu>
                    </v-flex>
                  </v-layout>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-container>
                <v-layout wrap class="text-center">
                  <v-flex xs12 sm6 md6>
                    <v-btn color="danger" class="w-100" @click="closeDialog()">Cancelar</v-btn>
                  </v-flex>
                  <v-flex xs12 sm6 md6>
                    <v-btn color="success" class="w-100" :disabled="!valid" @click="getData()">Generar</v-btn>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-layout>
    </template>
    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialog"  v-if="dialog === 3" persistent max-width="600px">
          <v-card class="my-4">
            <v-card-title>
              <span class="headline">Crear propiedad3</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>

              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="danger" @click="dialog = 0">Cancelar</v-btn>
              <v-btn color="success">Generar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-layout>
    </template>
    <template>
      <v-layout row justify-center>
        <v-dialog v-model="dialog"  v-if="dialog === 4" persistent max-width="600px">
          <v-card class="my-4">
            <v-card-title>
              <span class="headline">Crear propiedad4</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>

              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="danger" @click="dialog = 0">Cancelar</v-btn>
              <v-btn color="success">Generar</v-btn>
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
      contacts: [],
      tags: [],
      search: '',
      dialog: 0,
      valid: false,
      dateOne: new Date().toISOString().substr(0, 10),
      dateTwo: new Date().toISOString().substr(0, 10),
      dateShowOne: false,
      dateShowTwo: false,
      filter: {
        tag: '',
      },
      picker: '',
      inputRules: [
        v => !!v || 'El campo es obligatorio',
      ],
      selectRules: [
        v => !!v || 'Debe seleccionar una opción',
      ],
    }
  },
  methods: {
    getData() {
      axios.get("/admin/reports/contacts-pdf" + "?report=" + this.dialog + "&tag=" + this.filter.tag + "&date_init=" + this.dateShowOne + "&date_end=" + this.dateShowTwo).then((response) => {
        this.contacts = response.data.contacts;
      });
      if( this.dialog == 1 )
        this.contactsByTag();
      else if( this.dialog == 2 )
        this.contactsByUser();
    },
    closeDialog() {
      this.dialog = 0;
      this.dateOne = new Date().toISOString().substr(0, 10);
      this.dateTwo = new Date().toISOString().substr(0, 10);
      this.contacts = [];
      this.tags = [];
    },
    contactsByTag() {
      let columns = [
      {   title: "Nombre",   dataKey: "name" },
      {   title: "Email",   dataKey: "email" },
      {   title: "Teléfono 1",   dataKey: "phone_1" },
      {   title: "Teléfono 2",   dataKey: "phone_2" },
      {   title: "Dirección",   dataKey: "direction" },
      {   title: "Provincia",   dataKey: "province" },
      {   title: "Etiquetas",   dataKey: "tags" },
      {   title: "Creado",   dataKey: "created_at" }];

      let doc_1 = new jsPDF('p', 'pt');
      doc_1.text('Lista de Contactos - Filtro por Etiquetas', 40, 40);
      doc_1.autoTable(columns, this.contacts, {
        margin: {
          top: 60
        },
      });
      doc_1.save('reporte.pdf');
    },
    contactsByUser() {
      let contactsbyuser = [
      {   title: "Usuario",   dataKey: "name" },
      {   title: "Cantidad de Contactos",   dataKey: "quantity" }];

      let doc_2 = new jsPDF('p', 'pt');
      doc_2.text('Lista de Contactos por Usuario', 40, 40);
      doc_2.autoTable(contactsbyuser, this.contacts, {
        margin: {
          top: 60
        },
      });
      doc_2.save('reporte.pdf');
    },
  },
  created() {
    axios.get("/admin/reports/created").then((response) => {
      this.tags = response.data.tags;
    });
  },
}
</script>
