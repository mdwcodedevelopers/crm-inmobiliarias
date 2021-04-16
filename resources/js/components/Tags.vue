<template>
    <div class="text-center p-4 d-flex align-items-center flex-column">

        <v-card class="d-flex my-6 py-4 justify-space-around" style="width:100%">
            <div>
                <v-card-title>Etiquetas de Contactos</v-card-title>
                <v-card-subtitle>Segmentará tus contactos de acuerdo a sus intereses</v-card-subtitle>
            </div>
            <v-card-actions>
                <v-btn
                    color="success"

                >
                    <v-icon>
                        mdi-plus-circle
                    </v-icon>
                    Nueva Etiqueta
                </v-btn>

                <v-btn
                >
                    Nuevo grupo de etiquetas
                </v-btn>
            </v-card-actions>
        </v-card>


        <v-card 
            color
            elevation="2"
            style="width:100%">

            <v-container
                class="d-flex flex-column align-star ml-0">

                <v-expansion-panels 
                accordion
                >
                    <v-expansion-panel
                        class="my-1 panel-expansion"
                        v-for="group in groups"
                        :key="group.id"
                        @click="selected=[]"
                    >
                        <v-expansion-panel-header
                        color="grey lighten-1">
                            {{group.name}}
                            </v-expansion-panel-header>


                        <v-expansion-panel-content>
                            <div 
                                class="expansion-panel-subheader grey lighten-2 py-2"
                            >
                                <v-btn 
                                    small
                                    text
                                    >
                                    Editar grupo
                                </v-btn>
                                
                                <v-btn 
                                    small
                                    text
                                    >
                                    Borrar grupo
                                </v-btn>

                                 
                                <v-btn 
                                    :disabled="selected.length=== 0"
                                    small
                                    text
                                    >
                                    Borrar etiquetas seleccionadas
                                </v-btn>

                                 
                                <v-btn 
                                    :disabled="selected.length=== 0"
                                    small
                                    text
                                    >
                                    Remover del grupo
                                </v-btn>

                                 
                                <v-btn 
                                    :disabled="selected.length=== 0"
                                    small
                                    text
                                    >
                                    Unificar etiquetas
                                </v-btn>
                            
                            </div>                            
                            <ul 
                                multiple
                                class="list-tags "
                            >
                                <li 
                                    v-for="item in groupFilter(group.id)"
                                    :key="item.id"
                                class="d-flex align-items-center">
                                    <v-checkbox
                                        v-model="selected"
                                        :value="item.id"
                                        multiple
                                    >
                                        <template v-slot:label>{{item.name}} | {{item.count}} contactos</template>
                                    </v-checkbox>
                                    <div class="actions-items">
                                        <v-btn
                                            small
                                            text
                                        >
                                            <v-icon>mdi-pencil</v-icon>
                                        </v-btn>
                                        <!-- <v-btn
                                            small
                                            text
                                        >
                                            <v-icon>mdi-plus-circle</v-icon>
                                        </v-btn> -->
                                    </div>

                                </li>

                            </ul>

                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>
            </v-container>
        </v-card>
    </div>
</template>

<style scoped>
    .panel-expansion{
        width: 20rem;
    }
    .list-tags{
        list-style: none;
    }
</style>

<script>
export default {
    
    props:{
        groups: Array,
        tags: Array,
    },
    data: () => ({
        selected:[],
        new:[],
    }),
    methods:{
        groupFilter(id){
            let x = this.tags.filter(function (el) {return el.group_id == id});

            return x;
        }
            
    }
}

</script>