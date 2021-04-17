<template>
            <div class="text-center p-4 d-flex align-items-center flex-column">
                <v-card width="100%" class="p-4">
                    <v-card-title class="d-flex flex-column">
                    <v-img src="/images/logo.png"  contain width="400"></v-img>
                    
                        <h3>
                            ¡Bienvenido al Dashboard de Inmobiliaria Daniel Cánepa Propiedades!
                        </h3> 
                    </v-card-title>
                    <v-card-subtitle></v-card-subtitle>
                    <v-card-content class="d-flex">
                        <v-card class="mx-auto text-white mt-3" width="300" max-width="600" color="blue darken-2">
                            <v-card-text>
                                <p class="h3 text-white text-center">
                                    Propiedades
                                </p>
                                <p class="h3 text-white text-center">
                                    {{properties}}
                                </p>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn text dark>
                                    <a href="/admin/properties-user" class="text-white">Ver Propiedades</a>

                                </v-btn>
                            </v-card-actions>
                        </v-card>
                        <v-card class="mx-auto text-white mt-3" width="300" max-width="600" color="red darken-2">
                            <v-card-text>
                                <p class="h3 text-white text-center">
                                    Cambios realizados
                                </p>
                                <p class="h3 text-white text-center">
                                    {{reports}}
                                </p>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn text dark>
                                    <a href="/admin/reports" class="text-white">Ver Reportes</a>

                                </v-btn>
                            </v-card-actions>
                        </v-card>
                        <v-card class="mx-auto text-white mt-3" width="300" max-width="600" color="teal darken-1">
                            <v-card-text>
                                <p class="h3 text-white text-center">
                                    Usuarios
                                </p>
                                <p class="h3 text-white text-center">
                                    {{users}}
                                </p>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn text dark>
                                <a href="/admin/users" class="text-white">Ver Usuarios</a>

                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-card-content>
                </v-card>
            </div>
</template>

<script>

export default {
    data: () => ({
        properties: '',
        users: '',
        reports:''
    }),
    created() {
        axios.get("/admin/api-dashboard").then((response) => {
            this.properties = response.data.property;
            this.users = response.data.users;
            this.reports=response.data.reports;
        });
    }

}
</script>
