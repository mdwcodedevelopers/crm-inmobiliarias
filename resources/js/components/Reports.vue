<template>
  <div class="text-left">
    <v-card color="blue">
      <v-card-title class="display-1 text-white">
        Reportes
      </v-card-title>
    </v-card>
    <v-card color="white">
      <v-hover>
        <template v-slot:default="{ hover }">
          <v-card :elevation="hover ? 10 : 5" class="mx-auto pa-6">
          <v-container>
            <v-layout wrap>
              <v-flex xs1>
                <v-icon color="dark" class="px-2" size="45">
                  mdi-account-circle
                </v-icon>
              </v-flex>
              <v-flex xs11>
                <h6><a href="#">CONTACTOS CREADOS POR ETIQUETAS</a></h6>
                <small>Información estadística para analizar las operaciones de la compañia.</small>
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
                <h6><a href="#">ANALISIS DE CONTACTO POR CADA USUARIO</a></h6>
                <small>Información estadística para analizar las operaciones de la compañia.</small>
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
                <h6><a href="#">MOVIMIENTO DE PROPIEDADES</a></h6>
                <small>Información estadística para analizar las operaciones de la compañia.</small>
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
                <h6><a href="#">PATRONES DE BÚSQUEDA</a></h6>
                <small>Información estadística para analizar las operaciones de la compañia.</small>
              </v-flex>
            </v-layout>
          </v-container>
          </v-card>
        </template>
      </v-hover>
    </v-card>
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
            reports: [],
            search: ''
        }
    },
    methods: {
        exportPDF() {
            let columns = [{
                    title: "Operación",
                    dataKey: "type"
                },
                {
                    title: "Dato",
                    dataKey: "table"
                },
                {
                    title: "Información",
                    dataKey: "information"
                },
                {
                    title: "Fecha",
                    dataKey: "created_at"
                },

            ];
            let doc = new jsPDF('p', 'pt');
            doc.text('To Do List', 40, 40);
            doc.autoTable(columns, this.reports, {
                margin: {
                    top: 60
                },
            });
            doc.save('Reportes.pdf');
        }
    },

    computed: {
        headers() {
            return [{
                    text: 'Operación',
                    align: 'start',
                    sortable: true,
                    value: 'type',
                },
                {
                    text: 'Dato',
                    value: 'table'
                },
                {
                    text: 'Información',
                    value: 'information'
                },
                {
                    text: 'Fecha',
                    value: 'created_at'
                },
                {
                    text: 'Acciones',
                    value: 'action',
                    sortable: false,
                    align: 'center'
                },

            ]
        },
    },
}
</script>
