<template>
    <div class="text-center p-4 d-flex align-items-center flex-column">
        <v-card width="100%">
            <v-card-title>
                Mi Empresa
            </v-card-title>
            <v-card-text class="d-flex black--text">
                Este es el componente de configuracion principal.
            </v-card-text>
            
            <v-card-title>Configuraciones principales</v-card-title>
            
            <!-- <v-card-title>Otras Configuraciones</v-card-title> -->
             <v-col
                cols="12"
                sm="11"
             >
                <v-expansion-panels 
                    accordion
                    focusable
                    inset
                    >
                    <v-expansion-panel
                        class="panel-expansion"
                    >
                        <v-expansion-panel-header
                                color="blue darken-4 white--text"
                            >
                            <span class="white--text font-weight-bold">
                                    <v-icon color="white">
                                    mdi-account-multiple
                                </v-icon>
                                Usuarios
                            </span>
                            
                            <template v-slot:actions>
                                <v-icon color="white">
                                $expand
                                </v-icon>
                            </template>
                            </v-expansion-panel-header>


                        <v-expansion-panel-content class="p-3">
                            <users :rol="rol"/>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                    <v-expansion-panel
                        class="panel-expansion"
                    >
                        <v-expansion-panel-header
                                color="blue darken-4 white--text"
                            >
                            <span class="white--text font-weight-bold">
                                    <v-icon color="white">
                                   mdi-home-currency-usd
                                </v-icon>
                                Monedas
                            </span>
                            
                            <template v-slot:actions>
                                <v-icon color="white">
                                $expand
                                </v-icon>
                            </template>
                            </v-expansion-panel-header>


                        <v-expansion-panel-content class="p-3">
                            <currency/>
                        </v-expansion-panel-content>
                    </v-expansion-panel>

                    <v-expansion-panel
                        class="panel-expansion"
                    >
                        <v-expansion-panel-header
                                color="blue darken-4 white--text"
                            >
                            <span class="white--text font-weight-bold">
                                    <v-icon color="white">
                                    mdi-list-status
                                </v-icon>
                                Estados de Propiedades
                            </span>
                            
                            <template v-slot:actions>
                                <v-icon color="white">
                                $expand
                                </v-icon>
                            </template>
                            </v-expansion-panel-header>


                        <v-expansion-panel-content class="p-3">
                            <status/>
                        </v-expansion-panel-content>
                    </v-expansion-panel>

                      <v-expansion-panel
                        class="panel-expansion"
                    >
                        <v-expansion-panel-header
                                color="blue darken-4 white--text"
                            >
                            <span class="white--text font-weight-bold">
                                    <v-icon color="white">
                                    mdi-speedometer
                                </v-icon>
                                Estados de Oportunidades
                            </span>
                            
                            <template v-slot:actions>
                                <v-icon color="white">
                                $expand
                                </v-icon>
                            </template>
                            </v-expansion-panel-header>


                        <v-expansion-panel-content class="p-3">
                            <status-oportunities/>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                      <v-expansion-panel
                        class="panel-expansion"
                    >
                        <v-expansion-panel-header
                                color="blue darken-4 white--text"
                            >
                            <span class="white--text font-weight-bold">
                                    <v-icon color="white">
                                    mdi-calendar
                                </v-icon>
                                Tipos de eventos
                            </span>
                            
                            <template v-slot:actions>
                                <v-icon color="white">
                                $expand
                                </v-icon>
                            </template>
                            </v-expansion-panel-header>


                        <v-expansion-panel-content class="p-3">
                            <event-types/>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                      <v-expansion-panel
                        class="panel-expansion"
                    >
                        <v-expansion-panel-header
                                color="blue darken-4 white--text"
                            >
                            <span class="white--text font-weight-bold">
                                    <v-icon color="white">
                                    mdi-calendar
                                </v-icon>
                                Servicios
                            </span>
                            
                            <template v-slot:actions>
                                <v-icon color="white">
                                $expand
                                </v-icon>
                            </template>
                            </v-expansion-panel-header>


                        <v-expansion-panel-content class="p-3">
                            <services/>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                      <v-expansion-panel
                        class="panel-expansion"
                    >
                        <v-expansion-panel-header
                                color="blue darken-4 white--text"
                            >
                            <span class="white--text font-weight-bold">
                                    <v-icon color="white">
                                    mdi-calendar
                                </v-icon>
                                Ambientes
                            </span>
                            
                            <template v-slot:actions>
                                <v-icon color="white">
                                $expand
                                </v-icon>
                            </template>
                            </v-expansion-panel-header>


                        <v-expansion-panel-content class="p-3">
                             <environments/>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>
             </v-col>
        </v-card>
  </div>
</template>

<script>
export default {
    props:{
        rol: Number,
    }

}
</script>