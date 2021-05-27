<template>
  <div>
      <v-row no-gutters >
           <v-col
           class="p-5"
                >
                    <ul class="list text-left ">
                        <li class=" font-weight-bold pb-3">Redes Cánepa</li>
                        <li><a href="https://www.facebook.com/inmobiliariadanielcanepa/"><v-icon class="mr-2">mdi-facebook</v-icon>Facebook</a></li>
                        <li><a href="https://www.instagram.com/inmobiliariadanielcanepa"><v-icon class="mr-2">mdi-instagram</v-icon>Instagram</a></li>
                        <li><a href="#"><v-icon class="mr-2">mdi-shopping-outline</v-icon>Mercado Libre</a></li>
                    </ul>
                    <ul class="list text-left">
                        <li class=" font-weight-bold pb-3">Términos</li>
                        <li><a href="/politica-de-privacidad">Política de privacidad</a></li>
                        <li><a href="/terminos-y-condiciones">Términos y condiciones</a></li>
                        <li><a href="#">Trabajá con nosotros</a></li>
                        <li><a href="#">FAQ's</a></li>
                    </ul>
                </v-col>
      </v-row>
  </div>
</template>

<script>
export default {

}
</script>

<style>
    
    .list {
        list-style: none;
        height: 13rem;
    }
    .list li {
        margin-bottom: 1rem;
    }
    .list li a{
        text-decoration: none;
    }
</style>