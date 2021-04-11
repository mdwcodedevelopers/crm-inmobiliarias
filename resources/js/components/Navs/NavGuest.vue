<template>
    <div class="">
        <v-app-bar color="light-blue darken-1 " dark>

            <v-toolbar-title> <a href="/" class="text-white" style="text-decoration:none">Home</a> </v-toolbar-title>

            <v-spacer></v-spacer>

                <a class="text-white mx-2" href="/login">Iniciar sesión</a>

                <a class="text-white mx-2" href="/register">Registrarse</a>
        </v-app-bar>
        <v-navigation-drawer
        v-model="drawer"
        absolute
        bottom
        temporary
      >
        <v-list
          nav
          dense
        >
          <v-list-item-group
            v-model="group"
            active-class="deep-purple--text text--accent-4"
          >
            <v-list-item>
              <v-list-item-title>Oportunidades</v-list-item-title>
            </v-list-item>

            <v-list-item>
              <v-list-item-title>Mi empresa</v-list-item-title>
            </v-list-item>

            <v-list-item>
              <v-list-item-title>Usuarios</v-list-item-title>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-navigation-drawer>
    </div>


</template>
