<template>
    <div class="text-center p-4 d-flex align-items-center flex-column">
        <v-row justify="center">
            <v-expansion-panels 
            width=
            accordion
            >
                <v-expansion-panel
                    class="panel-expansion"
                    v-for="group in groups"
                    :key="group.id"
                >
                    <v-expansion-panel-header
                    color="grey lighten-2">
                        {{group.name}}
                        </v-expansion-panel-header>
                    <v-expansion-panel-content class="">
                        
                        <ul 
                            multiple
                            class="list-tags "
                        >
                            <li 
                                v-for="item in groupFilter(group.id)"
                                :key="item.id"
                            class="d-flex align-items-center">
                                <v-checkbox
                                    v-model="selected[group.id]"
                                    value=""
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
                                    <v-btn
                                        small
                                        text
                                    >
                                        <v-icon>mdi-plus-circle</v-icon>
                                    </v-btn>
                                </div>

                            </li>

                        </ul>

                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-row>
    </div>
</template>

<style scoped>
    .panel-expansion{
        width: 13rem;
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
    }),
    methods:{
        groupFilter(id){
            let x = this.tags.filter(function (el) {return el.group_id == id});
            return x;
        }
            
    }
}

</script>