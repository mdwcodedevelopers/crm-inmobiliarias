<template>
  <v-card class="d-flex">
    <v-img
    height="100%"
    :src="img"
    ></v-img>
    <div>
        <v-toolbar
        flat
        color="primary"
        dark
        >
        <v-toolbar-title>{{contact}}</v-toolbar-title>
        </v-toolbar>
        <v-tabs vertical>
        
        <v-tab>
            <v-icon left>
            mdi-newspaper
            </v-icon>
        </v-tab>
        <v-tab>
            <v-icon left>
            mdi-home
            </v-icon>
        </v-tab>
        <v-tab>
            <v-icon left>
            mdi-office-building
            </v-icon>
        </v-tab>
        
        <v-tab-item>
            <v-card flat>
            <v-card-text>
                 <v-list >
                    <v-list-item-group
                        color="primary"
                    >
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon >mdi-email</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title v-text="email"></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>

                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon >mdi-phone</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title v-text="tel1"></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>

                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon > mdi-cellphone</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title v-text="tel2"></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>

                        </v-list-item>
                    </v-list-item-group>
                    </v-list>
            </v-card-text>
            </v-card>
        </v-tab-item>
        <v-tab-item>
            <v-card flat>
            <v-card-text>
                <p>
                Este contacto no tiene propiedades destacadas
                </p>
            </v-card-text>
            </v-card>
        </v-tab-item>
        <v-tab-item>
            <v-card flat>
            <v-card-text>
                <p>
                Este contacto no tiene emprendimientos destacadas
                </p>
            </v-card-text>
            </v-card>
        </v-tab-item>
        </v-tabs>
       </div>
  </v-card>
</template>

<style scoped>
    .v-menu__content{
        min-width: 790px !important;
    }
</style>


<script>
    export default {
        data: () => ({
            items: [],
            }),
        props:{
            img: String,
            contact: String,
            tel1: String,
            tel2: String,
            email: String,
        },
        
        }
</script>