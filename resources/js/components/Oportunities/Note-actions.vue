<template>
  <div>
            <v-dialog
              v-model="noteDialog"
              width="500"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-btn 
                    color="#66BB6A" 
                    v-bind="attrs"
                    v-on="on"
                    >
                  <v-icon color="#fff" >
                      mdi-comment
                  </v-icon>
                </v-btn>
              </template>

              <v-card>
                <v-card-title class="headline grey lighten-2">
                  Nueva Nota
                </v-card-title>
                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col
                        cols="12"
                        sm="12"
                      >
                        <v-text-field
                          v-model="newNote.title"
                          label="Titulo de Nota"
                        ></v-text-field>
                      </v-col>
                      <v-col
                        cols="12"
                        sm="12"
                      >
                        <v-text-field
                          v-model="newNote.description"
                          label="Descripcion de Nota"
                        ></v-text-field>
                      </v-col>

                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="noteDialog = false">Cancelar</v-btn>
                        <v-btn color="blue darken-1" text @click="saveNote(element.id)">Guardar</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                       
                    </v-row>
                  </v-container>
                </v-card-text>
              </v-card>
            </v-dialog>


            <v-dialog
              v-model="historyDialog"
              width="500"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-btn 
                    color="#66BB6A" 
                    v-bind="attrs"
                    v-on="on"
                    @click="history()"
                    >
                  <v-icon color="#fff" >
                      mdi-history
                  </v-icon>
                </v-btn>
              </template>

              <v-card>
                <v-card-title class="headline grey lighten-2">
                  Historial de cambios
                </v-card-title>

                <v-card-text>
                  <ul>
                    <li>Creado el {{element.created_at}}</li>
                    <li v-for="item in list" :key="item.note_id"> 
                        Nota:{{item.title}} <br> 
                         &nbsp;&nbsp;&nbsp;&nbsp;{{item.description}} <br> 
                         &nbsp;&nbsp;&nbsp;&nbsp;Creada el {{item.created_at}} </li>
                    <li v-if="element.closed">Cerrada el {{element.deleted_at}} por</li>
                  </ul>
                </v-card-text>
              </v-card>
            </v-dialog>
  </div>
</template>

<script>
export default {
    props:{
        element: Object,
    },
    data: () => ({
      noteDialog: false,
      historyDialog: false,
      list:[],
      newNote: []
    }),
    methods:{
      saveNote (id) {
        let params ={
          title: this.newNote.description,
          description: this.newNote.title,
          oportunity_id: id,
        };
           
        axios.post('/api-notes', params).then((response) =>{
          this.noteDialog = false;
          console.log(response);
          this.newNote= [];

        });

      },
        history(){
            let date;
            axios.get("/api-notes/" + this.element.id).then((response) => {
                this.list = response.data;
                // console.log(this.list.sort((a, b) => a.created_at.getTime() > .created_at.getTime()));

            });
      }
    }
}
</script>