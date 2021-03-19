<template>
    <div class="">
        <v-card>

        </v-card>
        <v-card
        class="align-start overflow-hidden"

      >
      <v-row justify="space-around">
        <v-icon @click="model--">
          mdi-minus
        </v-icon>
        {{ model }}
        <v-icon @click="model++">
          mdi-plus
        </v-icon>
      </v-row>
      <v-carousel v-model="model">
        <v-carousel-item
          v-for="(color, i) in colors"
          :key="color"
        >
          <v-sheet
            :color="color"
            height="100%"
            tile
          >
            <v-row
              class="fill-height"
              align="center"
              justify="center"
            >
              <div class="display-3">
                Slide {{ i + 1 }}
              </div>
            </v-row>
          </v-sheet>
        </v-carousel-item>
      </v-carousel>
        <v-app-bar
          color="#2979FF"
          dark
        >
          <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

          <v-toolbar-title>Propiedades</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn icon>
            <v-icon>mdi-magnify</v-icon>
          </v-btn>
        </v-app-bar>

        <v-navigation-drawer
          v-model="drawer"
          absolute
          bottom
          temporary
        >
          <v-list
            nav
            dense
          >
            <v-list-item-group
              v-model="group"
              active-class="deep-purple--text text--accent-4"
            >
              <v-list-item>
                <v-list-item-title>Dashboard</v-list-item-title>
              </v-list-item>

              <v-list-item>
                <v-list-item-title>Oportunidades</v-list-item-title>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-navigation-drawer>

        <v-card-text>
          <v-list
          two-line
          subheader
        >
          <v-subheader>General</v-subheader>

          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Profile photo</v-list-item-title>
              <v-list-item-subtitle>Change your Google+ profile photo</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>

          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Show your status</v-list-item-title>
              <v-list-item-subtitle>Your status is visible to everyone</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>


        <v-list
          subheader
          two-line
          flat
        >
          <v-subheader>Hangout notifications</v-subheader>

          <v-list-item-group
            v-model="settings"
            multiple
          >
            <v-list-item>
              <template v-slot:default="{ active, }">
                <v-list-item-action>
                  <v-checkbox
                    :input-value="active"
                    color="primary"
                  ></v-checkbox>
                </v-list-item-action>

                <v-list-item-content>
                  <v-list-item-title>Notifications</v-list-item-title>
                  <v-list-item-subtitle>Allow notifications</v-list-item-subtitle>
                </v-list-item-content>
              </template>
            </v-list-item>

            <v-list-item>
              <template v-slot:default="{ active }">
                <v-list-item-action>
                  <v-checkbox
                    :input-value="active"
                    color="primary"
                  ></v-checkbox>
                </v-list-item-action>

                <v-list-item-content>
                  <v-list-item-title>Sound</v-list-item-title>
                  <v-list-item-subtitle>Hangouts message</v-list-item-subtitle>
                </v-list-item-content>
              </template>
            </v-list-item>

            <v-list-item>
              <template v-slot:default="{ active }">
                <v-list-item-action>
                  <v-checkbox
                    :input-value="active"
                    color="primary"
                  ></v-checkbox>
                </v-list-item-action>

                <v-list-item-content>
                  <v-list-item-title>Video sounds</v-list-item-title>
                  <v-list-item-subtitle>Hangouts video call</v-list-item-subtitle>
                </v-list-item-content>
              </template>
            </v-list-item>

            <v-list-item>
              <template v-slot:default="{ active }">
                <v-list-item-action>
                  <v-checkbox
                    :input-value="active"
                    color="primary"
                  ></v-checkbox>
                </v-list-item-action>

                <v-list-item-content>
                  <v-list-item-title>Invites</v-list-item-title>
                  <v-list-item-subtitle>Notify when receiving invites</v-list-item-subtitle>
                </v-list-item-content>
              </template>
            </v-list-item>
          </v-list-item-group>
        </v-list>
        </v-card-text>
      </v-card>
    </div>

  </template>
  <script>
    export default {
      data: () => ({
        drawer: false,
        group: null,
      }),

      watch: {
        group () {
          this.drawer = false
        },
      },
    }
  </script>
