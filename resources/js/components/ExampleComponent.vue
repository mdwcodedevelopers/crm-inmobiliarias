<template>
    <div class="container">
        <v-card
        class="mx-auto"
        max-width="344"
      >
        <v-card-text>
          <div>Word of the Day</div>
          <p class="display-1 text--primary">
            be•nev•o•lent
          </p>
          <p>adjective</p>
          <div class="text--primary">
            well meaning and kindly.<br>
            "a benevolent smile"
          </div>
        </v-card-text>
        <v-card-actions>
          <v-btn
            text
            color="deep-purple accent-4"
          >
            Learn More
          </v-btn>
        </v-card-actions>
      </v-card>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
