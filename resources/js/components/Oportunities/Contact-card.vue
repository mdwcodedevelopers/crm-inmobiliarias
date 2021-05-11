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
        
        }
</script>