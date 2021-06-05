<template>
    <div class="">
        <v-app-bar color="blue darken-4 " dark>
            <!-- <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon> -->
            <v-toolbar-title>{{ title }}</v-toolbar-title>

            <v-spacer></v-spacer>
            <!-- <v-menu
                bottom
                offset-y
                left
                :close-on-content-click = "false"
                >
                <template v-slot:activator="{ on, attrs }">

                        <a href="#"
                        v-bind="attrs"
                        v-on="on"
                        onclick="return false"
                        >
                        <v-icon>mdi-calendar</v-icon>
                        </a>
                </template>

                <v-list min-height="5rem" max-height="70vh" width="300px" dense>
                    <v-subheader class="mx-1 text-h5">Eventos</v-subheader>
                     <v-list-item-group
                        color="primary"
                        max='0'
                    >
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title>No tienes Eventos aún</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    </v-list-item-group>
                </v-list>

            </v-menu> -->
            <v-menu
                bottom
                left
                :close-on-content-click = "false"
                >
                <template v-slot:activator="{ on, attrs }">
                    <div
                        v-if="countNotifications !== 0"
                    >
                    <v-badge
                        color="red"
                        :content="countNotifications"
                        class="mx-4"
                        >
                    <a href="#"
                        v-bind="attrs"
                        v-on="on"
                    >
                    <v-icon>mdi-bell</v-icon>
                    </a>
                    </v-badge>
                    </div>
                    <div
                        v-else
                    >
                     <a href="#"
                        v-bind="attrs"
                        class="mx-4"
                        v-on="on"
                    >
                    <v-icon>mdi-bell</v-icon>
                    </a>
                    </div>

                </template>

                <v-list min-height="5rem" max-height="70vh" width="300px">
                    <v-subheader class="mx-1 text-h5">Notificaciones</v-subheader>
                     <v-list-item-group
                        color="primary"
                    >
                    <v-list-item v-for="(notify, index) in notifications" :class="{'blue lighten-3': notify.status == '1', 'white': notify.status == '0' }" :key="index" @click="notifyRead(notify)">

                        <v-list-item-content  >
                            <v-list-item-title style="white-space: inherit;">{{notify.type}}</v-list-item-title>
                            <v-list-item-subtitle style="white-space: inherit;">{{notify.information}}</v-list-item-subtitle>
                            <v-list-item-action-text v-text="notify.diff"></v-list-item-action-text>
                        </v-list-item-content>

                    </v-list-item>
                    </v-list-item-group>

                    <v-list-item  v-if="notifications.length=== 0">
                         <v-list-item-content >
                            <v-list-item-title>No tienes notificaciones aún</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>

            </v-menu>
            <button @click.prevent="logout()">
                <v-icon>mdi-import</v-icon>

            </button>
        </v-app-bar>
      
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
    .list-nav-sidebar{
        max-height: calc(100vh - 12rem);
        overflow: auto;
    }
</style>

<script>
export default {
    props:{
            title:String,
            role: Number,
        },
    data: () => ({
        drawer: true,
        notifications: [],
        countNotifications: 0,
    }),

    watch: {
        // group() {
        //     this.drawer = false
        // },
    },
    created() {
        this.getNotifications();
        setInterval(function () {
		    this.getNotifications();
		 }.bind(this), 300000);
  },
    methods:{
        logout() {
            axios.post("/admin/logout", {

            }).then((response) => {
                console.log(response);
                    window.location.href ="/admin/"
            });
        },
        getNotifications(){
            let count = 0;
            axios.get("/admin/notify").then((response) => {
                this.notifications = response.data.notifications;
                 this.notifications.forEach(element => {
                     (element.status==1) ? count++ : '';
                 });
                 this.countNotifications =count;
            });
        },
        notifyRead(item){
            axios.put("/admin/notify/"+ item.id).then((response) => {
                    item.status="0",
                    this.countNotifications--
                });
        }
    }

}
</script>
