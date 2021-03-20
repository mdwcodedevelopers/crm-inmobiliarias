<template>
    <v-footer
      color="primary lighten-1"
    >

        <v-btn
          v-for="link in links"
          :key="link"
          color="white"
          text
          rounded
        >
          {{ link }}
        </v-btn>
    </v-footer>
  </template>
<script>
    export default {
      data: () => ({
        links: [
          'Home',
          'Acerca de nosotros',
          'Propiedades',
          'Contacto',
        ],
      }),
    }
  </script>
