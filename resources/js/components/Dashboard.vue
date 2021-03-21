<template>
    <div class="text-center">

        <v-data-table :headers="headers" :items="properties" item-key="name" class="elevation-1" :search="search">
            <template v-slot:top>
                <v-text-field v-model="search" label="Buscar" class="mx-4"></v-text-field>
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

                <v-btn color="#66BB6A">edit</v-btn>
                <v-btn color="#E53935" @click="delete_model(item.id)">delete</v-btn>
            </template>
        </v-data-table>
        <v-row justify="center">
            <v-dialog
              v-model="dialog"
              persistent
              max-width="600px"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="primary"
                  dark
                  v-bind="attrs"
                  v-on="on"
                >
                  Open Dialog
                </v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="headline">User Profile</span>
                </v-card-title>
                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col
                        cols="12"
                        sm="6"
                        md="4"
                      >
                        <v-text-field
                          label="Legal first name*"
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col
                        cols="12"
                        sm="6"
                        md="4"
                      >
                        <v-text-field
                          label="Legal middle name"
                          hint="example of helper text only on focus"
                        ></v-text-field>
                      </v-col>
                      <v-col
                        cols="12"
                        sm="6"
                        md="4"
                      >
                        <v-text-field
                          label="Legal last name*"
                          hint="example of persistent helper text"
                          persistent-hint
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          label="Email*"
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          label="Password*"
                          type="password"
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col
                        cols="12"
                        sm="6"
                      >
                        <v-select
                          :items="['0-17', '18-29', '30-54', '54+']"
                          label="Age*"
                          required
                        ></v-select>
                      </v-col>
                      <v-col
                        cols="12"
                        sm="6"
                      >
                        <v-autocomplete
                          :items="['Skiing', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
                          label="Interests"
                          multiple
                        ></v-autocomplete>
                      </v-col>
                    </v-row>
                  </v-container>
                  <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn
                    color="blue darken-1"
                    text
                    @click="dialog = false"
                  >
                    Close
                  </v-btn>
                  <v-btn
                    color="blue darken-1"
                    text
                    @click="dialog = false"
                  >
                    Save
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-row>
    </div>
</template>

<script>
export default {
    data() {
        return {
            paginate: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            properties: [],
            search: '',
               dialog: false,

        }
    },
    methods: {
        index(page, search) {
            axios.get("/api-properties-user?page=" + page + "&search=" + search).then((response) => {
                this.properties = response.data.Properties.data;
                console.log(this.properties);
                this.paginate = response.data.pagination;
            });
        },
        delete_model(id) {
            console.log(id);
      var r = confirm("You will erase a Propertie, are you sure?");
      if (r == true) {
        axios.delete("/api-properties/" + id).then((response) => {
          console.log(response);
          if (response.status == 200) {
        //     this.$toast.open("Post successfully deleted!");
             window.location.href = "/home";
          }
        });
      }
    },
    },
    created() {
        this.index(0, '');
    },
    computed: {
        headers () {
          return [
            {
              text: 'Propiedad',
              align: 'start',
              sortable: false,
              value: 'title',
            },
            // { text: 'Ciudad', value: 'city' },
            { text: 'Información', value: 'information' },
            { text: 'Precio', value: 'price' },
            { text: 'Dimensión', value: 'dimension' },
            { text: 'Actions', value: 'action', sortable: false, align: 'center'},
            // { text: 'Status', value: 'status' },
            // { text: 'Categoria', value: 'categorie' },
          ]
        },
      },
}
</script>
