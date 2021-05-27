<template>
    <div class="text-center p-4 d-flex align-items-center flex-column">
        
        
        <div>
            <ul class="d-flex list-status flex-wrap justify-center  ">
                <li v-for="state in status" :style="{ backgroundColor: state.color}" :key="state.id">
                    <span>{{state.count }}</span> 
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
        rol: Number,
    },
    data: () => ({
        status: [],
        counterStatus: [0,0,0,0,0,0,0],
    }),
    created() {
        this.index();
        this.$swal.fire({
                header:'Ayuda rápida',
                title: '<strong><u>Modulo de Oportunidades</u></strong>',
                html:
                    'El Modulo de oportunidades es un manejador de tiquets para los clientes '+
                    'de la empresa, Aca puedes mantener un control de tus pendientes ademas de asignarles '+ 
                    'Estatus o directamente cerrarlos.<br>'+
                    'Desde aca puedes ver tambien los tiquets de oportunidades de otros agentes y puedes transferirles ' +
                    'tus oportunidades<br>' + '<strong>Cuando un cliente se encuentra interesado en una propiedad que tu has publicado,'+
                    'automaticamente se crea una oportunidad y se asigna a ti con un periodo de 3 dias de duracion, recuerda revisarlas.</strong>',
                showCloseButton: true,
                focusConfirm: false,
                })
    },
    methods:{
        index(){
            axios.get("/admin/api-oportunities").then((response) => {
                this.status = response.data.status;
            });
        },
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
