<template>
  <div class="text-center p-4 d-flex align-items-center flex-column">
        
        <div>
            <h4>Tus eventos:</h4>
            <ul class="d-flex list-types flex-wrap justify-center  ">
                <li v-for="type in types" :style="{ backgroundColor: type.color}" :key="type.id">
                    <p>{{type.name}}</p>
                    <span>{{type.count }}</span> 
                </li>
            </ul>
        </div>
        <v-card color="blue w-100">
            <v-card-title class="display-1 text-white titulo-custom">
                Nuevo evento
                <v-card-actions
                style="position:absolute; right:0px"
                >
                <v-btn color="success" dark fab class="mt-1" @click="create()">
                <v-icon>mdi-plus</v-icon>
                </v-btn>
            </v-card-actions>
            </v-card-title>
            <v-spacer></v-spacer>
        </v-card>

          <v-data-table
            v-model="selected"
            :headers="headers"
            item-key="id"
            group-by="event_type"
            :items="datas"
            class="w-100 elevation-1"
            no-data-text="No tienes eventos registrados"
            no-results-text="No hay resultados"
            >

                <template v-slot:group.header="{ group, toggle, isOpen }"> 
                    <td :colspan="8" style="text-align: initial; padding-left:2rem;" :style="{ backgroundColor: color(group)}"  >
                    <v-btn @click="toggle" x-small icon :ref="group">
                        <v-icon v-if="isOpen">mdi-minus</v-icon>
                        <v-icon v-else>mdi-plus</v-icon>
                    </v-btn>
                    <span class="mx-5 font-weight-bold">{{ group }}</span>
                    </td>
                </template>
                    
                  <template v-slot:item.action="{ item }">
                    <v-btn color="#ff9800"  small @click="edit(item)">
                        <v-icon color="#fff">
                            mdi-pencil
                        </v-icon>
                    </v-btn>
                    <v-btn color="#E53935" small @click="delete_dialog(item.id)">
                        <v-icon color="#fff">
                            mdi-delete
                        </v-icon>
                    </v-btn>
                </template>       


            </v-data-table>

   </div>
</template>


<style scoped>
    .list-types{
        list-style: none;
    }
    .list-types li{
        padding: 20px 20px;
        color: rgb(250, 240, 240);
        font-weight: 500;
    }
</style>
<script>
export default {
    props:{
        types: Array,
    },
     data: () => ({
      datas:[],
    }),
    methods:{
        color(item){
        if(item != "Cerrado"){
          let index = this.types.filter(function (el) {return el.name == item});
          console.log(index[0].color);
          return index[0].color;
        }
      },
    },
     computed: {
       headers(){
              return[
                {
                    text: 'Fecha',
                    align: 'start',
                    sortable: true,
                    value: 'date',
                },
                {
                    text: 'Agentes',
                    width: '13rem',
                    sortable: false,
                    value: 'agents',
                },
                {
                    text: 'Clientes',
                    value: 'clients'
                },
                
                {
                    text: 'Estatus',
                    value: 'completed'
                },
                {
                    text: 'Reporte',
                    value: 'report'
                },
            ]
         },
    }

}
</script>