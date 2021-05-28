<template>
  <div>
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

                <v-card-text class="pt-0">
                <div class="title font-weight-light mb-2">
                    Usuarios registrados
                </div>
                <div class="subheading font-weight-light grey--text">
                    Last Campaign Performance
                </div>
                <v-divider class="my-2"></v-divider>
                <v-icon
                    class="mr-2"
                    small
                >
                    mdi-clock
                </v-icon>
                <span class="caption grey--text font-weight-light">last registration 26 minutes ago</span>
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

                <v-card-text class="pt-0">
                <div class="title font-weight-light mb-2">
                    Usuarios registrados
                </div>
                <div class="subheading font-weight-light grey--text">
                    Last Campaign Performance
                </div>
                <v-divider class="my-2"></v-divider>
                <v-icon
                    class="mr-2"
                    small
                >
                    mdi-clock
                </v-icon>
                <span class="caption grey--text font-weight-light">last registration 26 minutes ago</span>
                </v-card-text>
            </v-card>
          </v-col>
          
      </v-row>
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