<template>
    <div class="text-center p-4 d-flex align-items-center flex-column">
        <div>
            <ul class="d-flex list-status">
                <li class="blue-grey">
                    <span>0</span> 
                    <p>Sin contactar</p>
                </li>
                <li class="yellow darken-3">
                    <span>0</span> 
                    <p>Sin seguimiento</p>
                </li>
                <li class="red darken-1">
                    <span>0</span> 
                    <p>Pendiente contactar</p>
                </li>
                <li class="deep-orange darken-1">
                    <span>0</span> 
                    <p>Esperando respuesta</p>
                </li>
                <li class="light-green darken-1">
                    <span>0</span> 
                    <p>Evolucionando</p>
                </li>    
                <li class="cyan darken-1">
                    <span>0</span> 
                    <p>Tomar acción</p>
                </li>
                <li class="teal darken-1">
                    <span>0</span> 
                    <p>Congelado</p>
                </li>
            </ul>
        </div>
        <oportunities-table :oportunities="oportunities"> </oportunities-table>
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
        oportunities:Array,
    }

}
</script>
