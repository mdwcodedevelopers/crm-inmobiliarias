<template>
    <div class="text-center">
        <v-card color="blue">
            <div class="display-1 text-white">Lista de reportes</div>
            <v-data-table :headers="headers"  no-results-text="No hay resultados" no-data-text="No hay historial de reportes" :items="reports"  class="elevation-1" :search="search">
                <template v-slot:item.imagen="{ item }">

                    <v-img :src="'../'+item.image" height="100" width="100"></v-img>
                </template>
                <template v-slot:top>
                    <v-toolbar flat>
                        <v-text-field v-model="search" label="Buscar" class="mt-3"></v-text-field>
                        <v-spacer></v-spacer>
                        <v-btn color="#E53935" class="m-1" @click="exportPDF()" dark>PDF
                                <v-icon>mdi-file-pdf</v-icon>
                        </v-btn>
                    </v-toolbar>

                </template>
                <template>
                    <tr>
                        <td></td>
                        <td>
                        </td>
                        <td colspan="4"></td>
                    </tr>
                </template>
                <template v-slot:item.action="{ item }">
                    <v-btn color="#E53935" class="m-1" @click="delete_dialog(item.id,item.information)">
                        <v-icon color="#fff">
                            mdi-delete
                        </v-icon>
                    </v-btn>

                </template>

            </v-data-table>
        </v-card>

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
            reports: [],
            dialogdelete: false,
            id_delete: '',
            propiedad_eliminar: '',
            search: ''
        }
    },
    methods: {
        index() {
            axios.get("api-reports").then((response) => {
                this.reports = response.data.reports;
            });
        },
        delete_dialog(id, title) {
            this.id_delete = id;
            this.dialogdelete = true;
            this.propiedad_eliminar = title;
        },
        delete_model() {
            axios.delete("/admin/api-reports/" + this.id_delete).then((response) => {
                console.log(response);
                if (response.status == 200) {
                    this.index(0, '');
                    this.dialogdelete = false;
                } else {
                    this.error = "Error al añadir propiedad";
                }
            });
        },
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

    created() {
        this.index();
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
