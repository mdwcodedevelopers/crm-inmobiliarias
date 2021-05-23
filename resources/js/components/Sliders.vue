<template>
  <v-container>
    <v-card color="blue darken-4">
      <v-card-title class="display-1 text-white">
        Sliders
        <v-btn color="success" dark absolute right fab class="mt-1" @click="create()">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </v-card-title>
      <v-data-table :headers="headers"  no-results-text="No hay resultados" no-data-text="No hay slides " :items="slides" class="elevation-1" :search="search">
        <template v-slot:item.image="{ item }">
          <v-img :src="item.image" height="100" width="100"></v-img>
        </template>
        
        <template v-slot:item.action="{ item }">
          <v-btn color="#ff9800" class="m-1" @click="edit(item)">
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
              <span class="headline">Crear Slide</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12>
                      <v-file-input
                        :rules="ruleImage"
                        accept="image/png, image/jpeg, image/bmp"
                        placeholder="Sube la foto"
                        prepend-icon="mdi-camera"
                        label="Slide imagen"
                        v-model="slide.image"
                      ></v-file-input>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-text-field label="Título" :rules="inputRules" v-model="slide.title" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-text-field label="Subtitulo" :rules="inputRules" v-model="slide.subtitle" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-text-field label="Texto Botón" :rules="inputRules" v-model="slide.button" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-text-field label="URL" :rules="inputRules" v-model="slide.url" required></v-text-field>
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
              <v-btn color="danger" @click="dialog = false; index()">Cancelar</v-btn>
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
              <span class="headline">Editar Slide</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12 md6>
                      <v-text-field label="Título" :rules="inputRules" v-model="slide.title" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-text-field label="Subtitulo" :rules="inputRules" v-model="slide.subtitle" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-text-field label="Texto Botón" :rules="inputRules" v-model="slide.button" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-text-field label="URL" :rules="inputRules" v-model="slide.url" required></v-text-field>
                    </v-flex>
                  </v-layout>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="danger" @click="dialogedit = false; index()">Cancelar</v-btn>
              <v-btn color="success" :disabled="!valid" @click.prevent="update()">Guardar</v-btn>
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
              <span class="headline">¿Esta seguro que desea eliminar este Slide?</span>
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
    </template> -->

  </v-container>
</template>

<script>
  export default {
    data() {
      return {
        slide: {},
        slides: [],
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
        ruleImage: [
        v => !v || v.size < 2000000 || '¡Debe pesar menos de 2MB!',
      ],
      }
    },
    methods: {
      index() {
         axios.get("/admin/api-slider").then((response) => {
                this.slides = response.data.sliders;
            });
      },
      create() {
        this.slide = {};
        this.dialog = true;
      },
      store() {
        this.valid= false;
          let formData = new FormData();
          formData.append("url", this.slide.url);
          formData.append("title", this.slide.title);
          formData.append("subtitle", this.slide.subtitle);
          formData.append("button", this.slide.button);
          formData.append("image", this.slide.image);
        axios.post("/admin/api-slider", formData, {headers: { "Content-Type": "multipart/form-data" }}).then((response) => {
          if (response.status == 200) {
            this.index();
            this.slide = {};
            this.dialog = false;
            this.$swal.fire('Slide registrado con exito');
            }
        }).catch(error => {
          this.$swal.fire('Error','Ocurrío un error al tratar de registrar el slide, intente nuevamente.');
          this.valid= true;
        });
      },
      edit(item) {
        this.slide = item;
        this.dialogedit=true;

      },
      update() {
        this.valid= false;
      
          axios.patch("/admin/api-slider/" + this.slide.id, this.slide).then((response) => {
            this.index();
            this.slide = {};
            this.dialogedit = false;
            this.$swal.fire('Slide actualizado con exito','success');
        })
        .catch(error => {
          this.$swal.fire('Error','Ocurrío un error al tratar de modificar el slide, intente nuevamente.');
          this.valid= true;
        });
      },
      delete_dialog(id) {
        this.id_delete = id;
        this.dialogdelete = true;
      },
      destroy() {
        this.valid= false;
        axios.delete("/admin/api-slider/" + this.id_delete).then((response) => {
          if (response.status == 200) {
            this.index(0, '');
            this.dialogdelete = false;
            this.$swal.fire('Slide eliminado con exito','success');
          }
        }).catch(error => {
          this.$swal.fire('Error','Ocurrío un error al tratar de eliminar el slide, intente nuevamente.');
        });
      },
    },
    created() {
      this.index();
    },
    computed: {
      headers() {
        return [
          {
            text: 'Imagen',
            value: 'image',
          },
          {
            text: 'Titulo',
            value: 'title',
          },
          {
            text: 'Subtitulo',
            value: 'subtitle',
          },
          {
            text: 'Texto Botón',
            value: 'button',
          },
          {
            text: 'URL',
            value: 'url',
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
