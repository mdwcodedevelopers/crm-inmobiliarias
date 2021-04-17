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
        <v-navigation-drawer v-model="drawer" color="light-blue darken-1 " absolute bottom temporary>

            <v-list color="white ">
                <v-list-item>
                    <v-list-item-content>
                        <a href="/admin/" class="">
                            
                            <v-img src="/images/logo.png"  contain width="200" height="100"></v-img>

                        </a>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <v-list nav dense  class="nav-list my-6">

                <v-list-item-group v-model="group" active-class="deep-purple--text text--accent-4">
                    <v-list-item>
                        <v-icon color="white" class="px-2">
                            mdi-file-document
                        </v-icon>
                        <a href="/admin/">Pagina web</a>
                    </v-list-item>
                    <v-list-item>
                        <v-icon color="white" class="px-2">
                            mdi-account-box-multiple
                        </v-icon>
                        <a href="/admin/users">Usuarios</a>
                    </v-list-item>

                    <v-list-item>
                        <v-icon color="white" class="px-2">
                            mdi-home-currency-usd
                        </v-icon>
                        <a href="/admin/currency">Monedas</a>
                    </v-list-item>
                    <v-list-item>
                        <v-icon color="white" class="px-2">
                           mdi-office-building
                        </v-icon>
                        <a href="/admin/properties-user">Propiedades</a>
                    </v-list-item>
                    <v-list-item>
                        <v-icon color="white" class="px-2">
                            mdi-list-status
                        </v-icon>
                        <a href="/admin/status">Estatus de propiedades</a>
                    </v-list-item>
                    <v-list-item>
                        <v-icon color="white" class="px-2">
                            mdi-apple-keyboard-option
                        </v-icon>
                        <a href="/admin/interested">Oportunidades</a>
                    </v-list-item>

                    <v-list-item>
                        <v-icon color="white" class="px-2">
                            mdi-account
                        </v-icon>
                        <a href="/admin/profile">Mi perfil</a>
                    </v-list-item>
                    <v-list-item>
                        <v-icon color="white" class="px-2">
                            mdi-account
                        </v-icon>
                        <a href="/admin/home">Estaditicas</a>
                    </v-list-item>
                    <v-list-item>
                        <v-icon color="white" class="px-2">
                            mdi-history
                        </v-icon>
                        <a href="/admin/reports">Historial de operaciones</a>
                    </v-list-item>
                    <v-list-item>
                        <v-icon color="white" class="px-2">
                            mdi-cog
                        </v-icon>
                        <a href="/admin/config">Mi Empresa</a>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>
    </div>

</template>

<style scoped>
    .v-list-item a:hover{
        text-decoration: none;
    }
    .nav-list a{
        color: #fff;
    }
</style>

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
            axios.post("/admin/logout", {

            }).then((response) => {
                console.log(response);  
                    window.location.href ="/admin/"
            });
        }
    }

}
</script>
