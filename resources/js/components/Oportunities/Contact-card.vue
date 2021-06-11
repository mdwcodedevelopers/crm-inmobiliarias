<template>
    <v-card
        max-width="344"
        outlined
    >
        <v-list-item three-line>
        <v-list-item-content>
            <div class="overline mb-4">
            {{contact.direction}}
            </div>
            <v-list-item-title class="headline mb-4">
            {{contact.name}}
            </v-list-item-title>
            <v-list-item-subtitle><v-icon class="mr-3" x-small>mdi-phone</v-icon>{{contact.phone_1}}</v-list-item-subtitle>
            <v-list-item-subtitle><v-icon class="mr-3" x-small>mdi-phone</v-icon>{{contact.phone_2}}</v-list-item-subtitle>
            <v-list-item-subtitle><v-icon class="mr-3" x-small>mdi-email-outline</v-icon>{{contact.email}}</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-actions>
            <v-btn color="#66BB6A"  small @click="whatsapp(contact.phone_1)">
                <v-icon color="#fff">
                    mdi-whatsapp
                </v-icon>
            </v-btn>
        </v-list-actions>
        </v-list-item>

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
            contact: Object,
        },
        methods:{
            whatsapp(phone) {
                window.open('https://api.whatsapp.com/send?phone=' + phone, '_blank');
            },
        }
        }
</script>