<template>
    <!-- <v-row no-gutters class="d-flex flex-column"> -->
    
    <v-card no-gutters class="my-5 p-2">
        <h3 class="blue--text text--darken-4">Tambien te podría interesar</h3>
         <v-col  v-for="card in properties" :key="card.id" cols="12">
                        
                       <properties-card :card="card"></properties-card>
                       
                        
                    </v-col>
    </v-card>
</template>

<script>
export default {
    props:{
        property_id: Number,
    },
    data(){
        return {
            properties: [],
        }
    },
    created(){
        axios.get("/admin/api-properties-recomended?not=" +this.property_id).then((response) => {
            this.properties = response.data.properties;
        });
    },
}
</script>

<style>

</style>