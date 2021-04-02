<template>
    <div class="">
        <v-carousel :show-arrows="true">
            <v-carousel-item v-for="(item,i) in items" :key="i" :src="'../'+item.url_image"></v-carousel-item>
        </v-carousel>
        <v-card class="mx-auto">
            <v-card-text>
                <p class="display-1 text--primary">
                    {{property.title}}
                    <v-chip color="#38c172" text-color="#fff" class="mr-3">
                        {{property.name}}
                    </v-chip>

                </p>
                <div class="text--primary">
                    {{property.information}}
                </div>
            </v-card-text>
            <v-card-actions>
                <v-btn text color="primary accent-4">
                    Hablar con el agente
                </v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items:[]
        }
    },
    methods: {
        index() {
            axios.get("/api-images?id=" + this.property.id).then((response) => {
                this.items = response.data.images;
            });
        },
    },
    created(){
        this.index();
    }
}
</script>
