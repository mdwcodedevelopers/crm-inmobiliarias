<template>
    <div class="text-center p-4 d-flex align-items-center flex-column">
        
        
        <div>
            <ul class="d-flex list-status flex-wrap justify-center  ">
                <li v-for="state in status" :style="{ backgroundColor: state.color}" :key="state.id">
                    <!-- <span>{{counterStatus[state.id-1] }}</span>  -->
                    <p>{{state.name}}</p>
                </li>
            </ul>
        </div>
        <oportunities-table 
            :users="users" 
            :status="status"
            :rol="rol"
            @updateList="updateStatusList(...arguments)"> </oportunities-table>
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
        rol: Number,
    },
    data: () => ({
        counterStatus: [0,0,0,0,0,0,0],
    }),
    methods:{
        updateStatusList(datas){  
            let i=0;
            this.status.forEach(element => {
                this.counterStatus[i]=0;
                i++;
            });
            
            datas.forEach(element => {
                this.counterStatus[element.status_id - 1]++;
            });
        }
    }

}
</script>
