<template>
    <div class="text-center">
        <v-data-table
        :headers="headers"
        :items="desserts"
        item-key="name"
        class="elevation-1"
        :search="search"
      >
        <template v-slot:top>
          <v-text-field
            v-model="search"
            label="Buscar"
            class="mx-4"
          ></v-text-field>
        </template>
        <template >
          <tr>
            <td></td>
            <td>
              <v-text-field
                v-model="calories"
                type="number"
              ></v-text-field>
            </td>
            <td colspan="4"></td>
          </tr>
        </template>
      </v-data-table>
    </div>
  </template>

  <script>
    export default {
      data () {
        return {
          search: '',
          calories: '',
          desserts: [
            {
              name: 'Propiedad 1',
              city: 'Ciudad 1',
              info: 'Información 1',
              price: '1200000',
              dimension: '223 m2',
              status: 'En venta',
              categorie: 'Casa',
            },

          ],
        }
      },
      computed: {
        headers () {
          return [
            {
              text: 'Propiedad',
              align: 'start',
              sortable: false,
              value: 'name',
            }, { text: 'Ciudad', value: 'city' },
            { text: 'Información', value: 'info' },
            { text: 'Precio', value: 'price' },
            { text: 'Dimensión', value: 'dimension' },
            { text: 'Status', value: 'status' },
            { text: 'Categoria', value: 'categorie' },
          ]
        },
      },
      methods: {
        filterOnlyCapsText (value, search, item) {
          return value != null &&
            search != null &&
            typeof value === 'string' &&
            value.toString().toLocaleUpperCase().indexOf(search) !== -1
        },
      },
    }
  </script>
