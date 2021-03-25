<template>
    <div class="">
        <v-carousel :show-arrows="false">
            <v-carousel-item v-for="(item,i) in items" :key="i" :src="item.src"></v-carousel-item>
        </v-carousel>
        <v-card
    class="mx-auto"
  >
    <v-card-text>
      <p class="display-1 text--primary">
        {{property.title}}   <v-chip color="#38c172" text-color="#fff" class="mr-3">
            {{property.name}}
        </v-chip>

      </p>
      <div class="text--primary">
          {{property.information}}
      </div>
    </v-card-text>
    <v-card-actions>
      <v-btn
        text
        color="primary accent-4"
      >
        Hablar con el agente
      </v-btn>
    </v-card-actions>

    <v-expand-transition>
      <v-card
        v-if="reveal"
        class="transition-fast-in-fast-out v-card--reveal"
        style="height: 100%;"
      >
        <v-card-text class="pb-0">
          <p class="display-1 text--primary">
            Origin
          </p>
          <p>late 16th century (as a noun denoting a place where alms were distributed): from medieval Latin eleemosynarius, from late Latin eleemosyna ‘alms’, from Greek eleēmosunē ‘compassion’ </p>
        </v-card-text>
        <v-card-actions class="pt-0">
          <v-btn
            text
            color="teal accent-4"
            @click="reveal = false"
          >
            Close
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-expand-transition>
  </v-card>
    </div>
</template>
<script>
export default {
    props:{
        property:Object,
    },
    data() {
        return {
            items: [{
                    src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
                },
                {
                    src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
                },
                {
                    src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
                },
                {
                    src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
                },
            ],
        }
    },
    created(){
    }
}
</script>
