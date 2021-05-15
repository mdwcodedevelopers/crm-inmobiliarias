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

                <v-list-item-group v-model="group" active-class=" text--accent-4">
                    <v-list-item>
                        <v-icon color="white" class="px-2">
                            mdi-web
                        </v-icon>
                        <a href="/">Pagina web</a>
                    </v-list-item>
                    <v-list-group
                        no-action
                        sub-group
                        prepend-icon=""
                        color="light-blue darken-3"
                        class="text--white drop-custom-list "
                        >
                        <template v-slot:activator>
                            <v-list-item-content
                                color="white"
                                 >
                                <v-list-item-title>
                                    <v-icon color="white" class="px-2">
                                        mdi-account-box-multiple
                                    </v-icon>
                                    Contactos
                                </v-list-item-title>
                            </v-list-item-content>
                        </template>

                        <v-list-item>
                            <a href="/admin/contacts">Listado</a>
                        </v-list-item>

                        <v-list-item>
                            <a href="/admin/contacts/tags">Etiquetas</a>
                        </v-list-item>

                        <v-list-item disabled>
                            <a href="/admin/contacts">Migraciones</a>
                        </v-list-item>
                    </v-list-group>
                    <v-list-item v-if="role == 1 || role == 3 ">
                        <v-icon color="white"  class="px-2">
                           mdi-office-building
                        </v-icon>
                        <a href="/admin/properties-user">Propiedades</a>
                    </v-list-item>
                    <v-list-item v-if="role == 1 || role == 3 ">
                        <v-icon color="white"  class="px-2">
                            mdi-speedometer
                        </v-icon>
                        <a href="/admin/oportunities">Oportunidades</a>
                    </v-list-item>
                    <v-list-item v-if="role == 1 || role == 3">
                        <v-icon color="white" class="px-2">
                            mdi-cog-calendar
                        </v-icon>
                        <a href="/admin/events" >Mis Eventos</a>
                    </v-list-item>
                    <v-list-item v-if="role == 1">
                        <v-icon color="white" class="px-2">
                            mdi-cog-transfer-outline
                        </v-icon>
                        <a href="/admin/environments/init" >Ambientes</a>
                    </v-list-item>
                    <v-list-item v-if="role == 1">
                        <v-icon color="white" class="px-2">
                            mdi-cog-transfer-outline
                        </v-icon>
                        <a href="/admin/services/init" >Servicios</a>
                    </v-list-item>
                    <v-list-item v-if="role == 1 || role == 3 ">
                        <v-icon color="white" class="px-2">
                            mdi-account-multiple
                        </v-icon>
                        <a href="/admin/users">Lista de usuarios</a>
                    </v-list-item>
                    <v-list-item>
                        <v-icon color="white" class="px-2">
                            mdi-account
                        </v-icon>
                        <a href="/admin/profile">Mi perfil</a>
                    </v-list-item>

                    <v-list-item v-if="role == 1" disabled>
                        <v-icon color="white" class="px-2">
                            mdi-chart-bar
                        </v-icon>
                        <a href="/admin/home" >Estaditicas</a>
                    </v-list-item>
                    <v-list-item v-if="role == 1">
                        <v-icon color="white" class="px-2">
                            mdi-file-document
                        </v-icon>
                        <a href="/admin/reports" >Reportes</a>
                    </v-list-item>
                    <v-list-item v-if="role == 1">
                        <v-icon color="white" class="px-2">
                            mdi-chat-typing
                        </v-icon>
                        <a href="/admin/reports/view" >Notificaciones del Sistema</a>
                    </v-list-item>
                    <v-list-item v-if="role == 1">
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
    .nav-list a, .nav-list .v-list-item__title{
        color: #fff !important;
    }

   .v-list--nav  .v-list-item{
        padding-left: 24px !important;
    }
    .v-list--dense .v-list-item .v-list-item__title{
        font-weight: 400 !important;
    }
    .drop-custom-list .v-list-group__items{
        background-color: #2a414d !important;
    }
    .drop-custom-list .v-list-group__items .v-list-item{
        padding-left: 50px !important;
    }
</style>

<script>
export default {
    props:{
            title:String,
            role: Number,
        },
    data: () => ({
        drawer: false,
        group: null,
    }),

    watch: {
        // group() {
        //     this.drawer = false
        // },
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
