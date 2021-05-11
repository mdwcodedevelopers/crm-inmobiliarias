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
        <v-toolbar-title>{{contact.name}} </v-toolbar-title>
        <v-btn
              icon
              color="grey"
            >
              <v-icon>mdi-star</v-icon>
            </v-btn>
        </v-toolbar>
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
                                    <v-list-item v-text="contact.email"></v-list-item>
                                </v-list-item-content>
                            </v-list-item>

                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon >mdi-phone</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item v-text="contact.phone_1"></v-list-item>
                                </v-list-item-content>
                            </v-list-item>

                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon > mdi-cellphone</v-icon>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item v-text="contact.phone_2"></v-list-item>
                                </v-list-item-content>
                            </v-list-item>

                        </v-list-item>
                    </v-list-item-group>
                    </v-list>
            </v-card-text>
            </v-card>
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
            contact: Object,
            tel1: String,
            tel2: String,
            email: String,
        },
        
        }
</script>