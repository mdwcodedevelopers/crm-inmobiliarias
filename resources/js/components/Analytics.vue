<template>
  <div>
    <v-card class="white p-4">
      <v-card-title class="px-5 h2">Analiticas de los ultimos 7 días</v-card-title>
      <v-row>
          <v-col
            cols="12"
            md="8"
          >
          <v-card
                class="mt-4 mx-auto"
                max-width="800"
            >
                <v-sheet
                class="v-sheet--offset"
                color="blue"
                >
                <v-sparkline
                    :labels="labels"
                    :value="value"
                    color="white"
                    line-width="3"
                    padding="16"
                ></v-sparkline>
                </v-sheet>

                <v-card-text class="pt-0 d-flex justify-space-between">
                <div class="title  font-weight-light p-2 mb-2">
                   <div class="title text-center black--text font-weight-light mb-2">
                    Usuarios <br>
                    <span>3</span>
                  </div>
                </div>
                <div class="title  font-weight-light p-2 mb-2">
                   <div class="title text-center black--text font-weight-light mb-2">
                    Sesiones <br>
                    <span>7</span>
                  </div>
                </div>
                <div class="title  font-weight-light p-2 mb-2">
                   <div class="title text-center black--text font-weight-light mb-2">
                    Porcentaje de rebote <br>
                    <span>28,57%</span>
                  </div>
                </div>
                <div class="title  font-weight-light p-2 mb-2">
                   <div class="title text-center black--text font-weight-light mb-2">
                    Duración de la sesión <br>
                    <span>39 min y 39s</span>
                  </div>
                </div>
                </v-card-text>
            </v-card>
          </v-col>
          <v-col
            cols="12"
            md="4"
          >
          <v-card
                class="mt-4 mx-auto"
                max-width="500"
            >
                <v-sheet
                class="v-sheet--offset"
                color="cyan"
                >
                <v-sparkline
                    :labels="labels"
                    :value="value"
                    color="white"
                    line-width="3"
                    padding="16"
                ></v-sparkline>
                </v-sheet>

                <v-card-text class="pt-0 d-flex justify-space-between">
                <div class="title  font-weight-light p-2 mb-2">
                   <div class="title text-center black--text font-weight-light mb-2">
                    Usuarios registrados <br>
                    <span>3</span>
                  </div>
                </div>
                <div class="title  font-weight-light p-2 mb-2">
                   <div class="title text-center black--text font-weight-light mb-2">
                    Propiedades Favoritas <br>
                    <span>7</span>
                  </div>
                </div>
                </v-card-text>
            </v-card>
          </v-col>
          
      </v-row>
      <v-card-title class="px-5 h3">¿Qué páginas visitan sus usuarios?</v-card-title>
      <v-row>
          <v-col
            cols="12"
          >
         <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">
                    Página
                  </th>
                  <th class="text-left">
                    Numero de páginas visitadas
                  </th>
                  </th>
                  <th class="text-left">
                    Promedio de tiempo en la página
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                >
                  <td>/admin/contacts</td>
                  <td>5</td>
                  <td>00:04:19</td>
                </tr>
                <!-- <tr
                  v-for="item in desserts"
                  :key="item.name"
                >
                  <td>{{ item.name }}</td>
                  <td>{{ item.calories }}</td>
                  <td>{{ item.calories }}</td>
                </tr> -->
              </tbody>
            </template>
          </v-simple-table>
          </v-col>
        
          
      </v-row>
    </v-card>
  </div>
</template>

<script>
export default {
    data: () => ({
      labels: [
        '12am',
        '3am',
        '6am',
        '9am',
        '12pm',
        '3pm',
        '6pm',
        '9pm',
      ],
      value: [
        200,
        675,
        410,
        390,
        310,
        460,
        250,
        240,
      ],
    }),
  }
</script>

<style>

</style>