<template>
  <div class="text-center">
    <v-card color="blue darken-4">
      <v-card-title class="display-1 text-white">
        Importar Contactos
      </v-card-title>
    </v-card>
    <div>
      <v-card>
        <v-card-title class="display-1 titulo-custom d-flex flex-column align-start">
            <p class="text-h6">Las columnas requeridas para importación de Contactos son:</p>
            <a href="/files/importacion-de-contacto.xlsx" class="btn btn-link" title="Descargar plantilla" download>Descargar plantilla</a>
        </v-card-title>
        <v-card-text>
            <v-container grid-list-md>
              <template>
                <!-- <p class="text-left text-subtitle-1"><strong>agente:</strong> Agente al que pertenece el Contacto</p> -->
                  <p class="text-left text-subtitle-1"><strong>nombre:</strong> Nombre del Contacto</p>
                  <p class="text-left text-subtitle-1"><strong>email:</strong> Correo Electrónico</p>
                  <p class="text-left text-subtitle-1"><strong>telefono_1:</strong> Teléfono 1</p>
                  <p class="text-left text-subtitle-1"><strong>telefono_2:</strong> Teléfono 2</p>
                  <p class="text-left text-subtitle-1"><strong>direccion:</strong> Dirección</p>
                  <p class="text-left text-subtitle-1"><strong>provincia:</strong> Provincia</p>
                  <p class="text-left text-subtitle-1"><strong>etiquetas:</strong> Cada una de las etiquetas correspondientes separadas por coma (,)</p>
              </template>
              <v-form ref="form" v-model="valid">
                <v-layout wrap>
                  <v-flex xs12>
                    <v-file-input truncate-length="15" v-model="file" :rules="inputRules"  label="Seleccione el archivo que desea importar:"></v-file-input>
                  </v-flex>
                  <v-flex xs12>
                      {{error}}
                  </v-flex>
                  <v-flex xs12>
                    <v-btn color="success" :disabled="!valid" @click.prevent="saveFile()">
                      <v-icon>mdi-plus</v-icon> Subir archivo excel
                    </v-btn>
                  </v-flex>
                </v-layout>
              </v-form>
            </v-container>
        </v-card-text>
      </v-card>
    </div>

  </div>
</template>


<script>
  export default {
    data() {
      return {
        file: null,
        valid: false,
        error: '',
        inputRules: [
          v => !!v || 'El campo es obligatorio',
        ],
      }
    },
    created() {
       this.$swal.fire({
                header:'Ayuda rápida',
                title: '<strong><u>Modulo de Importacion de contactos</u></strong>',
                html:
                    'Para poder importar contactos asegurese que el documento cumple con los nombres correctos en las columnas, '+
                    'puede tomar de guía la planilla acá colocada. <br> '+
                    '<strong>Si desea actualizar contactos ya agregados con el documento de exportación, recuerde que el identificador del contacto es el correo electrónico y que este es único para cada contacto.</strong>',
                showCloseButton: true,
                focusConfirm: false,
                })
    },
    methods: {
      saveFile() {

        if(!this.validateFile(this.file)){
          this.$swal.fire(
            'Error',
            this.error,
            'error'
          )
        }else{

          let InstFormData = new FormData();
          InstFormData.append('excel' , this.file);

          axios.post('/admin/contacts/import', InstFormData , {headers : {'content-type': 'multipart/form-data'}}).then((response) => {
            if (response.status == 200) {
              this.file = null;
              this.$swal.fire(
              'Archivo subido con exito',
              '',
              'success'
              );
            }
          }).catch(error => {
            this.$swal.fire({
              icon: 'Error',
              title: 'Ocurrio un error al subir el archivo',
              showConfirmButton: false,
              timer: 1500
            })
          });
        }
      },
      validateFile(uploadFile)
      {
        if( !uploadFile || uploadFile == null ){
            this.error= 'Debe seleccionar el archivo a subir';
            return false;
        }
        if (!window.FileReader) {
            this.error= 'El navegador no soporta la lectura de archivos';
            return false;
        }
        if (!(/\.(xls|xlsx)$/i).test(uploadFile.name)) {
            this.error = 'El archivo a adjuntar no es un formato valido';
            return false;
        }
        if (uploadFile.size > 1000000)
        {
            this.error='El peso del archivo no puede exceder los 500kb';
            return false;
        }
        return true;
      },
    },
  }
</script>

