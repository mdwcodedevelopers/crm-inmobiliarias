<template>
  <v-card class="d-flex">
    <v-img
    height="100%"
    src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
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
                        <v-list-item
                        v-for="(item, i) in items"
                        :key="i"
                        >
                        <v-list-item-icon>
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="item.text"></v-list-item-title>
                        </v-list-item-content>
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

<script>
    export default {
        data: () => ({
            items: [
                { text: 'maildeprueba@mail.com', icon: 'mdi-email' },
                { text: '11 1213 1415', icon: 'mdi-phone' },
                { text: '11 1213 1415', icon: 'mdi-cellphone' },
            ],
            }),
        props:{
            contact:String,
        },
    }
</script>