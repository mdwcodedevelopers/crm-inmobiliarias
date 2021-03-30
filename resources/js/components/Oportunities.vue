<template>
    <div class="text-center p-4 d-flex align-items-center flex-column">
        <div>
            <ul class="d-flex list-status">
                <li>
                    <span>0</span> 
                    <p>Sin contactar</p>
                </li>
                <li class="yellow lighten-2">
                    <span>0</span> 
                    <p>Sin seguimiento</p>
                </li>
                <li class="red lighten-2">
                    <span>0</span> 
                    <p>Pendiente contactar</p>
                </li>
                <li class="deep-orange lighten-2">
                    <span>0</span> 
                    <p>Esperando respuesta</p>
                </li>
                <li class="light-green lighten-2">
                    <span>0</span> 
                    <p>Evolucionando</p>
                </li>    
                <li class="cyan lighten-2">
                    <span>0</span> 
                    <p>Tomar acción</p>
                </li>
                <li class="teal lighten-2">
                    <span>0</span> 
                    <p>Congelado</p>
                </li>
            </ul>
        </div>
        <oportunities-table> </oportunities-table>
    </div>
</template>

<style scoped>
    .list-status{
        list-style: none;
    }
    .list-status li{
        padding: 20px 20px;
        font-weight: 600;
    }

    
</style>


<script>
export default {
}
</script>
