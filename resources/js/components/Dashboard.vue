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
        </v-data-table>
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
            search: ''
        }
    },
    methods: {
        index(page, search) {
            axios.get("/api-properties-user?page=" + page + "&search=" + search).then((response) => {
                this.properties = response.data.Properties.data;
                console.log(this.properties);
                this.paginate = response.data.pagination;
            });
        }
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
            // { text: 'Status', value: 'status' },
            // { text: 'Categoria', value: 'categorie' },
          ]
        },
      },
}
</script>
