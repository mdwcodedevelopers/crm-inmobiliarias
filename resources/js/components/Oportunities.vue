<template>
    <div class="text-center p-4 d-flex align-items-center flex-column">
        <div>
            <ul class="d-flex list-status">
                <li v-for="state in status" :style="{ backgroundColor: state.color}">
                    <span>0</span> 
                    <p>{{state.name}}</p>
                </li>
            </ul>
        </div>
        <oportunities-table :users="users"> </oportunities-table>
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
