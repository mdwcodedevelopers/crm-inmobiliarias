<template>
    <div class="">
        <v-card class="mx-auto">
            <v-img :src="company.image_url"></v-img>

            <v-card-text>
                <p class="display-1 text--primary">
                    {{company.name}}
                </p>
                <div class="text--primary">
                    {{company.information}}

                </div>
            </v-card-text>
            <v-card-actions>
                <v-btn color="#66BB6A" @click="edit(company.name,company.information)">
                    <v-icon color="#fff">
                        mdi-pencil
                    </v-icon>
                </v-btn>
                <v-btn color="warning" @click="modalimage()">
                    <v-icon color="#fff">
                        mdi-file-image
                    </v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>
        <template>
            <v-layout row justify-center>
                <v-dialog v-model="dialogedit" persistent max-width="600px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">Editar Moneda</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>

                                    <v-flex xs12>
                                        <v-text-field label="Moneda" v-model="name_edit" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field label="Moneda" v-model="info_edit" required></v-text-field>
                                    </v-flex>

                                </v-layout>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="danger" @click="dialogedit = false">Cancelar</v-btn>
                            <v-btn color="success" @click.prevent="edit_model()">Editar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-layout>
        </template>
        <v-layout row justify-center>
            <v-dialog v-model="dialog" persistent max-width="600px">

                <v-card>
                    <v-card-title>
                        <span class="headline">Añadir imagen</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md6>
                                    <v-file-input v-model="archivo" placeholder="Subir Archivo" label="Subir Archivo" prepend-icon="mdi-archive"></v-file-input>

                                </v-flex>

                                <v-flex xs12>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="danger" @click="dialog = false">Cancelar</v-btn>
                        <v-btn color="success" @click.prevent="edit_image()">Crear</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            company: [],
            dialog: false,
            dialogedit: false,
            name_edit: '',
            info_edit: '',
            archivo: null
        }
    },
    methods: {
        index() {
            axios.get("/admin/api-company?id=1").then((response) => {
                this.company = response.data.company;
            });
        },
        edit(name, info) {

            this.dialogedit = true;
            this.name_edit = name;
            this.info_edit = info;
        },
        edit_model() {
            axios.put("/admin/api-company/1", {
                name: this.name_edit,
                information: this.info_edit
            }).then((response) => {
                if (response.status == 200) {
                    this.index();
                    this.id_edit = '';
                    this.dialogedit = false;
                }
            });
        },
        modalimage() {
            this.dialog = true;
        },
        edit_image() {
            let InstFormData = new FormData();
            InstFormData.append('imagen', this.archivo);
            axios.post('/company-image/1', InstFormData, {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }).then((response) => {
                if (response.status == 200) {
                    this.index();
                }
            });
        },
    },
    created() {
        this.index();
    }
}
</script>
