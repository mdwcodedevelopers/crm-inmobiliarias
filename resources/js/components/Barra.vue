<template>
    <v-card
      class="mx-auto"
      color="grey lighten-4"
      max-width="1000"
    >
      <v-card-title>
        <v-row align="start">
        </v-row>

        <v-spacer></v-spacer>
      </v-card-title>

      <v-sheet color="transparent">
        <v-sparkline
          :key="String(avg)"
          :smooth="16"
          :gradient="['#f72047', '#ffd200', '#1feaea']"
          :line-width="3"
          :value="heartbeats"
          auto-draw
          stroke-linecap="round"
        ></v-sparkline>
      </v-sheet>
    </v-card>
  </template>
  <script>
    const exhale = ms =>
      new Promise(resolve => setTimeout(resolve, ms))

    export default {
      data: () => ({
        checking: false,
        heartbeats: [],
      }),

      computed: {
        avg () {
          const sum = this.heartbeats.reduce((acc, cur) => acc + cur, 0)
          const length = this.heartbeats.length

          if (!sum && !length) return 0

          return Math.ceil(sum / length)
        },
      },

      created () {
        this.takePulse(false)
      },

      methods: {
        heartbeat () {
          return Math.ceil(Math.random() * (120 - 80) + 80)
        },
        async takePulse (inhale = true) {
          this.checking = true

          inhale && await exhale(1000)

          this.heartbeats = Array.from({ length: 20 }, this.heartbeat)

          this.checking = false
        },
      },
    }
  </script>
