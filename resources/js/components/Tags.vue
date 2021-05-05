<template>
    <div class="text-center p-4 d-flex align-items-center flex-column">

        <v-card class="d-flex my-6 py-4 justify-space-around" style="width:100%">
            <div>
                <v-card-title>Etiquetas de Contactos</v-card-title>
                <v-card-subtitle>Segmentará tus contactos de acuerdo a sus intereses</v-card-subtitle>
            </div>
            <v-card-actions>
                <v-btn
                    color="success"
                    @click="dialogTag = true"
                >
                    <v-icon>
                        mdi-plus-circle
                    </v-icon>
                    Nueva Etiqueta
                </v-btn>

                <v-btn
                    @click="dialogGroup = true"
                >
                    Nuevo grupo de etiquetas
                </v-btn>
            </v-card-actions>
        </v-card>


        <v-card 
            color
            elevation="2"
            style="width:100%">

            <v-container
                class="d-flex flex-column align-star ml-0">

                <v-expansion-panels 
                accordion
                >
                    <v-expansion-panel
                        class="my-1 panel-expansion"
                        v-for="group in groups"
                        :key="group.id"
                        @click="selected=[]"
                    >
                        <v-expansion-panel-header
                         color="blue lighten-1 white--text">
                            {{group.name}}
                            </v-expansion-panel-header>


                        <v-expansion-panel-content>
                            <div 
                                class="expansion-panel-subheader grey lighten-2 py-2"
                            >
                                <v-btn 
                                    small
                                    text
                                    @click="editGroup(group)"
                                    >
                                    Editar grupo
                                </v-btn>
                                
                                <v-btn 
                                    small
                                    text
                                    @click="deleteGroup(group)"

                                    >
                                    Borrar grupo
                                </v-btn>

                                 
                                <v-btn 
                                    :disabled="selected.length=== 0"
                                    small
                                    text
                                    @click="deleteSelected()"
                                    >
                                    Borrar etiquetas seleccionadas
                                </v-btn>
                                 
                                <v-btn 
                                    :disabled="selected.length < 2 "
                                    small
                                    text
                                    @click="unifySelected()"
                                    >
                                    Unificar etiquetas
                                </v-btn>
                            
                            </div>                            
                            <ul 
                                multiple
                                class="list-tags "
                            >
                                <li 
                                    v-for="item in groupFilter(group.id)"
                                    :key="item.id"
                                class="d-flex align-items-center">
                                    <v-checkbox
                                        v-model="selected"
                                        :value="item.id"
                                        multiple
                                    >
                                        <template v-slot:label>{{item.name}} | {{item.count}} contactos</template>
                                    </v-checkbox>
                                    <div class="actions-items">
                                        <v-btn
                                            small
                                            text
                                            @click="editTag(item)"
                                        >
                                            <v-icon>mdi-pencil</v-icon>
                                        </v-btn>
                                        <!-- <v-btn
                                            small
                                            text
                                        >
                                            <v-icon>mdi-plus-circle</v-icon>
                                        </v-btn> -->
                                    </div>

                                </li>

                            </ul>

                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>

        <!-- Dialog de crear etiquetas -->
        <v-dialog v-model="dialogTag" persistent max-width="600px">
          <v-card class="my-4">
            <v-card-title>
              <span class="headline">Crear Etiqueta</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12 md6>
                        <v-text-field label="Nombre*:" :rules="inputRule" v-model="tag.name" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-select
                        v-model="tag.group_tag_id"
                        :items="groups"
                        :rules="selectRule"
                        item-text="name" 
                        item-value="id" 
                        label="Grupos:" 
                      >              
                      </v-select>
                    </v-flex>
                    <v-flex xs12>
                        <small class="red--text">Los campos marcados con * son obligatorios</small>
                    </v-flex>
                  </v-layout>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="danger" @click="dialogTag = false">Cancelar</v-btn>
              <v-btn color="success" :disabled="!valid" @click.prevent="storeTag()">Crear</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <!-- Dialog de crear grupos -->
           <v-dialog v-model="dialogGroup" persistent max-width="600px">
          <v-card class="my-4">
            <v-card-title>
              <span class="headline">Crear Grupo de Etiquetas</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12 md6>
                        <v-text-field label="Nombre*:" :rules="inputRule" v-model="group.name" required></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                        <small class="red--text">Los campos marcados con * son obligatorios</small>
                    </v-flex>
                  </v-layout>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="danger" @click="dialogGroup = false">Cancelar</v-btn>
              <v-btn color="success" :disabled="!valid" @click.prevent="storeGroup()">Crear</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        
        <!-- Dialog de editar etiquetas -->
        <v-dialog v-model="dialogEditTag" persistent max-width="600px">
          <v-card class="my-4">
            <v-card-title>
              <span class="headline">Editar Etiqueta</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12 md6>
                        <v-text-field label="Nombre*:" :rules="inputRule" v-model="tag.name" required></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-select
                        v-model="tag.group_tag_id"
                        :items="groups"
                        :rules="selectRule"
                        item-text="name" 
                        item-value="id" 
                        label="Grupos:" 
                      >d                    
                      </v-select>
                    </v-flex>
                    <v-flex xs12>
                        <small class="red--text">Los campos marcados con * son obligatorios</small>
                    </v-flex>
                  </v-layout>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="danger" @click="dialogEditTag = false, tag = {}">Cancelar</v-btn>
              <v-btn color="success" :disabled="!valid" @click.prevent="updateTag()">Crear</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <!-- Dialog de editar grupos -->
           <v-dialog v-model="dialogEditGroup" persistent max-width="600px">
          <v-card class="my-4">
            <v-card-title>
              <span class="headline">Editar Grupo de Etiquetas</span>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-form ref="form" v-model="valid">
                  <v-layout wrap>
                    <v-flex xs12 md6>
                        <v-text-field label="Nombre*:" :rules="inputRule" v-model="group.name" required></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                        <small class="red--text">Los campos marcados con * son obligatorios</small>
                    </v-flex>
                  </v-layout>
                </v-form>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="danger" @click="dialogEditGroup = false, group={}">Cancelar</v-btn>
              <v-btn color="success" :disabled="!valid" @click.prevent="updateGroup()">Crear</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        </v-container>
        </v-card>
    </div>
</template>

<style scoped>
    .panel-expansion{
        width: 20rem;
    }
    .list-tags{
        list-style: none;
    }
</style>

<script>
export default {
    
    data: () => ({
        selected:[],
        new:[],
        dialogTag: false,
        dialogGroup:false,
        dialogEditTag: false,
        dialogEditGroup:false,
        valid: false,
        tag: {},
        group: {},
        groups: {},
        tags: {},
        inputRule: [
            v => !!v || 'El campo es obligatorio',
        ],
        selectRule: [
            v => !!v || 'Debe seleccionar una opción',
        ],
        
    }),
    created() {
        this.index();
    },
    methods:{
        index() {
            axios.get("/admin/api-tags/" ).then((response) => {
                this.groups = response.data.groups;
                this.tags = response.data.tags;
          });
        },
        groupFilter(id){
            let x = this.tags.filter(function (el) {return el.group_tag_id == id});
            return x;
        },
        editTag(tag){
            this.dialogEditTag = true;
            this.tag = tag;
        },
        editGroup(group){
            this.dialogEditGroup = true;
            this.group = group;
        },
        storeTag(){
            axios.post("/admin/api-tags/", this.tag).then((response) => {
            if (response.status == 200) {
              this.index();
              this.tag = {};
              this.dialogTag = false;
              this.$swal.fire('Etiqueta registrada con exito');
            }}).catch(error => {
            this.$swal.fire(
              'Error',
              'Ocurrío un error al tratar de registrar la etiqueta.',
              'error'
            )
          });
        },
        storeGroup(){
            axios.post("/admin/api-group-tags", this.group).then((response) => {
            if (response.status == 200) {
              this.index();
              this.tag = {};
              this.dialogGroup = false;
              this.$swal.fire('Grupo registrado con exito');
            }}).catch(error => {
            this.$swal.fire(
              'Error',
              'Ocurrío un error al tratar de registrar el grupo',
              'error'
            )
          });
        },
        updateTag(){
            axios.patch("/admin/api-tags/" + this.tag.id, this.tag).then((response) => {
            if (response.status == 200) {
              this.index();
              this.tag = {};
              this.dialogEditTag = false;
              this.$swal.fire('Etiqueta actualizada con exito');
            }}).catch(error => {
            this.$swal.fire(
              'Error',
              'Ocurrío un error al tratar de actualizar la etiqueta.',
              'error'
            )
          });
        },
        updateGroup(){
            axios.patch("/admin/api-group-tags/" + this.group.id, this.group).then((response) => {
            if (response.status == 200) {
              this.index();
              this.Group = {};
              this.dialogEditGroup = false;
              this.$swal.fire('Grupo actualizado con exito con exito');
            }}).catch(error => {
            this.$swal.fire(
              'Error',
              'Ocurrío un error al tratar de actualizar el grupo.',
              'error'
            )
          });
        },
        deleteGroup(group){
            this.$swal.fire({
            title: '¿Estas seguro que deseas eliminar este grupo?',
            text: 'Esta acción es irreversible y borrara todas las etiquetas que pertenezcan a este grupo',
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, estoy seguro, borralo!'
            }).then((result) => {
            if (result.isConfirmed) {
                axios.delete("/admin/api-group-tags/" + group.id).then((response) => {
              console.log(response);
              if (response.status == 200) {
                this.index();
                this.$swal.fire(
                '¡Eliminado!',
                'El grupo y las etiquetas pertenecientes fueron eliminadas.',
                'success'
                )
                  this.group={};
              }}).catch(error => {
                    this.$swal.fire(
                        'Error',
                        'Hubo un error al tratar de eliminar la propiedad, intente nuevamente.',
                        'error'
                    )
                })
            }
            })
        },
        deleteSelected(){
            this.$swal.fire({
            title: '¿Estas seguro que deseas eliminar las etiquetas?',
            text: 'Esta acción es irreversible',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            reverseButtons: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, eliminar!'
            }).then((result) => {
            if (result.isConfirmed) {
                var result;
                this.selected.forEach(element => {
                    axios.delete("/admin/api-tags/" + element).then((response) => {
                        result = true;
                        }).catch(error => {
                        result = false;
                    });
                });
                if (result) {
                    this.index();
                        this.$swal.fire(
                        '¡Eliminado!',
                        'La etiquetas fueron eliminadas.',
                        'success'
                        )
                        this.selected=[];
                }else{
                    this.$swal.fire(
                        'Error',
                            'Hubo un error al tratar de eliminar las etiquetas, intente nuevamente.',
                            'error'
                        )
                }
            }
            })
        },
        unifySelected(){
            this.$swal.fire({
            title: '¿Estas seguro que deseas unificar las etiquetas?',
            text: 'Todos los contactos se pasaran a esta nueva etiqueta',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Cancelar',
            reverseButtons: true,
            confirmButtonText: '¡Si, unificar!'
            }).then((result) => {
            if (result.isConfirmed) {
                this.$swal.fire(
                '¡Eliminado!',
                'La etiqueta fue eliminada.',
                'success'
                )
                this.selected=[];
            }
            })
        },
    }
}
</script>