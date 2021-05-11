<template>
    <v-card
        max-width="344"
        outlined
    >
        <v-list-item three-line>
        <v-list-item-content>
            <div class="overline mb-4">
            {{property.status.name}}
            </div>
            <v-list-item-title class="headline mb-4">
            {{property.title}}
            </v-list-item-title>
            <v-list-item-subtitle>{{property.information}}</v-list-item-subtitle>
        </v-list-item-content>

        <v-list-item-avatar
            tile
            size="80"
            color="grey"
            > <v-img
            height="100%"
            :src="'../../'+property.images[0].url"
            ></v-img></v-list-item-avatar>
        </v-list-item>

        <v-card-text class="font-weight-bold blue--text text--darken-4 text-left">
            {{property.price}} {{property.currency.name}} | {{property.dimension}} mt2 
        </v-card-text>
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
            property: [],
            }),
        props:{
            property_id: Number,
        },
        created(){
        axios.get("/admin/api-properties/" + this.property_id).then((response) => {
            this.property = response.data.property;
          });
        },
        
        }
</script>