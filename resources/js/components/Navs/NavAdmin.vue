<template>
    <div class="">
        <v-app-bar color="light-blue darken-1 " dark>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>{{ title }}</v-toolbar-title>

            <v-spacer></v-spacer>
            <button @click.prevent="logout()">
                <v-icon>mdi-import</v-icon>

            </button>
        </v-app-bar>
        <v-navigation-drawer v-model="drawer" absolute bottom temporary>
            <v-list nav dense>
                <v-list-item-group v-model="group" active-class="deep-purple--text text--accent-4">
                    <v-list-item>
                        <a href="/users">Usuarios</a>
                    </v-list-item>

                    <v-list-item>
                        <a href="/currency">Monedas</a>
                    </v-list-item>
                    <v-list-item>
                        <a href="/">Trabajadores de la empresa</a>
                    </v-list-item>
                    <v-list-item>
                        <a href="/properties-user">Propiedades</a>
                    </v-list-item>
                    <v-list-item>
                        <a href="/status">Estatus de propiedades</a>
                    </v-list-item>
                    <v-list-item>
                        <a href="/tickets">Tickets</a>
                    </v-list-item>
                    <v-list-item>
                        <a href="/interesed">Interesados de compra</a>
                    </v-list-item>

                    <v-list-item>
                        <a href="/profile">Mi perfil</a>
                    </v-list-item>

                    <v-list-item>
                        <a href="/share">Compartir</a>
                    </v-list-item>
                    <v-list-item>
                        <a href="/web">Pagina web</a>
                    </v-list-item>
                    <v-list-item>
                        <a href="/statistics">Estaditicas</a>
                    </v-list-item>
                    <v-list-item>
                        <a href="/edictions">Historial de ediciones</a>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>
    </div>

</template>

<script>
export default {
    props:{
            title:String,
        },
    data: () => ({
        drawer: false,
        group: null,
    }),
    
    watch: {
        group() {
            this.drawer = false
        },
    },
    methods:{
        logout() {
            axios.post("/logout", {

            }).then((response) => {
                if (response.status == 200) {
                    window.location.href ="/"
                }
            });
        }
    }
    
}
</script>
