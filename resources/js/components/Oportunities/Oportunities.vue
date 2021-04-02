<template>
    <div class="text-center p-4 d-flex align-items-center flex-column">
        
        <new-oportunity :status="status" ></new-oportunity>
        
        <div>
            <ul class="d-flex list-status flex-wrap justify-center  ">
                <li v-for="state in status" :style="{ backgroundColor: state.color}" :key="state.id">
                    <span>0</span> 
                    <p>{{state.name}}</p>
                </li>
            </ul>
        </div>
        <oportunities-table :users="users" :status="status"> </oportunities-table>
    </div>
</template>

<style scoped>
    .list-status{
        list-style: none;
    }
    .list-status li{
        padding: 20px 20px;
        color: rgb(250, 240, 240);
        font-weight: 500;
    }

    
</style>


<script>
export default {
    props:{
        users:Array,
        status:Array,
    },

}
</script>
