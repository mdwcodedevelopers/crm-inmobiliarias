<template>
    <div class="">
        <v-app-bar 
          color="white  "  
          prominent 
          dark 
          dense>
      
            <v-toolbar-title class="d-flex" >

              <a href="/" class="" style="text-decoration:none">
                <v-img src="/images/logo.png"  contain width="200" height="100"></v-img>
              </a> 
            </v-toolbar-title>
            <v-spacer></v-spacer>
                <a class="mx-2 my-auto black--text " style="font-size:1rem"  href="/admin/login">Iniciar sesión</a>
                <a class=" mx-2 my-auto black--text " style="font-size:1rem"  href="/admin/register">Registrarse</a>
        </v-app-bar>
        <v-navigation-drawer
        absolute
        bottom
        temporary
      >
        <v-list
          nav
          dense
        >
          <v-list-item-group
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
