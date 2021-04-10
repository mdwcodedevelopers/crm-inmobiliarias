<template>
    <div class="">
        <v-app-bar color="light-blue darken-1 " dark>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Propiedades</v-toolbar-title>

            <v-spacer></v-spacer>
            <button @click.prevent="logout()">
                <v-icon>mdi-import</v-icon>

            </button>
        </v-app-bar>
        <v-navigation-drawer v-model="drawer" absolute bottom temporary>
            
            <v-list color="light-blue darken-1 ">
                <v-list-item>
                    <v-list-item-content>
                        LOGO
                        <!-- <v-img src="/images/main-transparent.png"  contain height="50"></v-img> -->
                        <v-list-item-title class="title white--text">
                            Application
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
    
            <v-list nav dense>
                <v-list-item-group v-model="group" active-class="deep-purple--text text--accent-4">
                    <v-list-item>
                        <a href="/users">Usuarios</a>
                    </v-list-item>
                    <v-list-item>
                        <a href="/properties-user">Propiedades</a>
                    </v-list-item>
                    <v-list-item>
                        <a href="/tickets">Tickets</a>
                    </v-list-item>
                    <v-list-item>
                        <a href="/interested">Interesados de compra</a>
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
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>
    </div>

</template>

<script>
export default {
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
