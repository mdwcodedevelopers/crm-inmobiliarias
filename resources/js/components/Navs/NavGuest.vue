<template>
    <div>
        <v-toolbar 
          color="white"  
          prominent 
          dense
          class="d-none d-lg-block d-xl-block d-md-block">
      
            <v-toolbar-title class="d-flex" >

              <a href="/" class="" style="text-decoration:none">
                <v-img src="/images/logo.png"  contain width="200" height="100"></v-img>
              </a> 
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <a class="mx-2 my-auto blue--text  text--darken-2 font-weight-medium " style="font-size:1rem"  href="/#">Home</a>
            <a class="mx-2 my-auto blue--text  text--darken-2 font-weight-medium " style="font-size:1rem"  href="/#we-are">Quienes somos</a>
            <a class="mx-2 mr-5 my-auto blue--text  text--darken-2 font-weight-medium " style="font-size:1rem"  href="/properties">Propiedades</a>
            <a class="mx-2 mr-5 my-auto blue--text  text--darken-2 font-weight-medium " style="font-size:1rem"  href="/#contacts">Contactos</a>

            <v-btn rounded color="success" href="/admin/login"  class="my-auto">Iniciar sesión</v-btn>
            <!-- <a class="mx-2 my-auto black--text "  style="font-size:1rem"  href="/admin/login">Iniciar sesión</a> -->
            <a class=" mx-2 my-auto black--text " style="font-size:1rem"  href="/admin/register">Registrarse</a>
        </v-toolbar>

      <v-toolbar prominent color="white" id="nav-mobile" class="d-lg-none d-xl-none">
        <v-toolbar-title>
           <a href="/" class="" style="text-decoration:none">
            <v-img src="/images/logo.png"  contain width="200" height="100"></v-img>
          </a> 
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn @click="dialog=true" icon class="my-auto mr-3">
          <v-icon class="blue--text text--darken-4" large>mdi-menu</v-icon>
        </v-btn>
      </v-toolbar>
      
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
          <!-- <v-toolbar-side-icon dark slot="activator"></v-toolbar-side-icon> -->
          <v-card>
            <v-toolbar flat prominent class="blue darken-4 white--text">
              <v-toolbar-title>
                <a href="/" class="" style="text-decoration:none">
                  <v-img src="/images/logo-footer-canepa.png"  contain width="200" height="100"></v-img>
                </a>
              </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn @click="dialog = false" icon>
                <v-icon  class="white--text" large>mdi-close</v-icon>
              </v-btn>
            </v-toolbar>

            <v-list class="d-flex flex-column p-4  justify-space-between" height="60vh">
              
            <div class="d-flex flex-column">
              <a class="my-3  blue--text  text--darken-2 font-weight-medium " style="font-size:1rem"  href="/#">Home</a>
              <a class="my-3  blue--text  text--darken-2 font-weight-medium " style="font-size:1rem"  href="/#we-are">Quienes somos</a>
              <a class="my-3  blue--text  text--darken-2 font-weight-medium " style="font-size:1rem"  href="/#properties">Propiedades</a>
              <a class="my-3  blue--text  text--darken-2 font-weight-medium " style="font-size:1rem"  href="/#contacts">Contactos</a>
            </div>
            
            <div>
              <v-btn rounded color="success" href="/admin/login"  class="my-auto">Iniciar sesión</v-btn>
              <a class=" mx-2 my-auto black--text " style="font-size:1rem"  href="/admin/register">Registrarse</a>
            </div>
            </v-list>
          </v-card>
        </v-dialog>

    </div>


</template>

<style scoped>
</style>
<script>
export default {
  props:{
    homepage: String
  },
  data(){
    return{
       dialog: false,
    }
  }
}
</script>