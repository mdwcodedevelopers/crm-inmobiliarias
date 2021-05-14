<template>
  <v-container>
    <v-card color="blue">
      <v-card-title class="display-1 text-white">
        Ambientes
        <v-btn color="success" dark absolute right fab class="mt-1" @click="create()">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </v-card-title>
      <v-data-table :headers="headers"  no-results-text="No hay resultados" no-data-text="No hay ambientes " :items="environments" item-key="propeties-user" class="elevation-1" :search="search">
        <template v-slot:top>
          <v-toolbar flat>
            <v-text-field v-model="search" label="Buscar" class="mt-3"></v-text-field>
            <v-spacer></v-spacer>
          </v-toolbar>
        </template>
        <template v-slot:item.action="{ item }">
          <v-btn color="#ff9800" class="m-1" @click="edit(item.id)">
            <v-icon color="#fff">
                mdi-pencil
            </v-icon>
          </v-btn>
          <v-btn color="#E53935" class="m-1" @click="delete_dialog(item.id)">
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
              <span class="headline">Crear ambiente</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12>
                      <v-text-field label="Nombre del Ambiente" :rules="inputRules" v-model="environment.name" required></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                      <v-checkbox v-model="environment.type" label="¿Mostrar como servicio extra?" :value="1"></v-checkbox>
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
        <v-dialog v-model="dialogedit" persistent max-width="600px">
          <v-card class="my-4">
            <v-card-title>
              <span class="headline">Editar ambiente</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12>
                      <v-text-field label="Nombre del Servicio" :rules="inputRules" v-model="environment.name" required></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                      <v-checkbox v-model="environment.type" label="¿Mostrar como servicio extra?" :value="1"></v-checkbox>
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
              <v-btn color="success" :disabled="!valid" @click.prevent="update(environment.id)">Editar</v-btn>
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
              <span class="headline">¿Esta seguro que desea eliminar este Servicio?</span>
            </v-card-title>
            <v-card-text>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn @click="dialogdelete = false">Cancelar</v-btn>
              <v-btn color="#E53935" class="text-white" @click.prevent="destroy()">Eliminar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-layout>
    </template>

  </v-container>
</template>

<script>
  export default
  {
    data() {
      return {
        environment: {},
        environments: [],
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
      }
    },
    methods: {
      index(page, search) {
        axios.get("/admin/environments?&search=" + search).then((response) => {
          this.environments = response.data.environments;
        });
      },
      create() {
        this.environment = {};
        this.dialog = true;
      },
      store() {
        axios.post("/admin/environments", this.environment).then((response) => {
          if (response.status == 200) {
            this.index(0, '');
            this.environment = {};
            this.dialog = false;
            this.$swal.fire('Servicio registrado con exito');
          }
        }).catch(error => {
          this.$swal.fire('Error','Ocurrío un error al tratar de registrar el servicio, intente nuevamente.');
        });
      },
      edit(id) {
        axios.get("/admin/environments/" + id + '/edit').then((response) => {
          if (response.status == 200) {
            this.environment = response.data.environment;
            this.dialogedit = true;
          }
        }).catch(error => {
          this.$swal.fire('Error','Ocurrío un error al tratar de editar el servicio, intente nuevamente.');
        });
      },
      update(id) {
        axios.patch("/admin/environments/" + id, this.environment).then((response) => {
          if (response.status == 200) {
            this.index(0, '');
            this.environment = {};
            this.dialogedit = false;
            this.$swal.fire('Ambiente actualizada con exito','success');
          }
        })
        .catch(error => {
          this.$swal.fire('Error','Ocurrío un error al tratar de modificar el servicio, intente nuevamente.');
        });
      },
      delete_dialog(id) {
        this.id_delete = id;
        this.dialogdelete = true;
      },
      destroy() {
        axios.delete("/admin/environments/" + this.id_delete).then((response) => {
          if (response.status == 200) {
            this.index(0, '');
            this.dialogdelete = false;
            this.$swal.fire('Ambiente eliminada con exito','success');
          }
        }).catch(error => {
          this.$swal.fire('Error','Ocurrío un error al tratar de eliminar el servicio, intente nuevamente.');
        });
      },
    },
    created() {
      this.index(0, '');
    },
    computed: {
      headers() {
        return [
          {
            text: 'Nombre del servicio',
            value: 'name',
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
