<template>
  <div class="text-left ">
    <v-card color="blue">
      <v-card-title class="display-1 text-white">
        Historial de Operaciones
      </v-card-title>
    </v-card>
    <v-card color="white" class="px-8">
      <v-container>
        <v-row  v-for="report in reports" :key="report.id">
          <v-col xs12 class="border-bottom border-secondary px-0">
            <p class="m-0">{{ report.type }} {{ report.information }}</p>
            <p class="m-0" style="color:#999">por {{ report.user.name }} -- {{ report.diff }} ({{ report.created }})</p>
          </v-col>
        </v-row>
      </v-container>
    </v-card>
  </div>
</template>

<script>
export default {
  props: {
    rol: Number
  },
  data() {
    return {
      reports: [],
      pagination: {
        'total' : 0,
        'current_page' : 0,
        'per_page' : 0,
        'last_page' : 0,
        'form' : 0,
        'to' : 0,
      },
      selectRules: [
        v => !!v || 'Debe seleccionar una opción',
      ],
    }
  },
  methods: {

  },
  created() {
    axios.get("/admin/reports/historical").then((response) => {
      this.reports = response.data.reports;
      this.pagination = response.data.pagination;
    });
  },
}
</script>
