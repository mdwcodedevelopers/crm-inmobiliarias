<template>
      <v-card-text>
        <v-list
        two-line
        subheader
      >
        <v-subheader>Nueva propiedad</v-subheader>
        <v-row
        no-gutters
        style="flex-wrap: nowrap;"
      >
        <v-col
          cols="1"
          style="min-width: 100px; max-width: 100%;"
          class="flex-grow-1 flex-shrink-0"
        >
          <v-card
            class="pa-2"
            outlined
            tile
          >
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Nombre</v-list-item-title>
              <v-text-field
              v-model="firstname"
              :rules="nameRules"
              :counter="100"
              label=""
              required
            ></v-text-field>
            <v-list-item-title>Ciudad</v-list-item-title>
            <v-text-field
            v-model="firstname"
            :rules="nameRules"
            :counter="100"
            label=""
            required
          ></v-text-field>
            </v-list-item-content>
          </v-list-item>
          </v-card>
        </v-col>
        <v-col
          cols="5"
          style="min-width: 100px;"
          class="flex-grow-0 flex-shrink-1"
        >
          <v-card
            class="pa-2"
            outlined
            tile
          >
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Información</v-list-item-title>
              <v-text-field
              v-model="firstname"
              :rules="nameRules"
              :counter="300"
              label=""
              required
            ></v-text-field>
            <v-list-item-title>Dimensión</v-list-item-title>
            <v-text-field
            v-model="firstname"
            :rules="nameRules"
            :counter="10"
            label=""
            required
          ></v-text-field>
            </v-list-item-content>
          </v-list-item>
          </v-card>
        </v-col>
      </v-row>
      <v-row
        no-gutters
        style="flex-wrap: nowrap;"
      >
        <v-col
          cols="1"
          style="min-width: 100px; max-width: 100%;"
          class="flex-grow-1 flex-shrink-0"
        >
          <v-card
            class="pa-2"
            outlined
            tile
          >
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Tipo de venta</v-list-item-title>
              <v-text-field
              v-model="firstname"
              :rules="nameRules"
              :counter="100"
              label=""
              required
            ></v-text-field>
            </v-list-item-content>
          </v-list-item>
          </v-card>
        </v-col>
        <v-col
          cols="5"
          style="min-width: 100px;"
          class="flex-grow-0 flex-shrink-1"
        >
          <v-card
            class="pa-2"
            outlined
            tile
          >
          </v-card>
        </v-col>
      </v-row>
      </v-list>
      </v-card-text>
  </template>
  <script>
    export default {
      data: () => ({
        drawer: true,
        group: null,
      }),

      watch: {
        group () {
          this.drawer = true
        },
      },
    }
  </script>
