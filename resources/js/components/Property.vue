<template>
    <div class="text-center px-4 d-flex align-items-center flex-column">
        <v-card class="d-flex my-2 justify-space-around" style="width:100%">
            <v-col
                cols="12"
                sm="8"
            >
                <v-carousel :show-arrows="true">
                    <v-carousel-item v-for="(item,i) in items" :key="i" :src="'../'+item.url_image"></v-carousel-item>
                </v-carousel>
            </v-col>
            <v-col
                cols="12"
                sm="4"
            >
                <v-card-text>
                        <div class="text--primary h3 ">
                            {{property.title}}
                        </div>
                        <p class="text--primary">
                            {{property.information}}
                        </p>
                        <v-chip color="#2979FF" text-color="#fff" class="mb-2 mr-3">
                            {{property.dimension}} mt2
                        </v-chip>
                        <v-chip color="#38c172" text-color="#fff" class="mb-2 mr-3">
                            {{property.price}} USD
                        </v-chip>
                        
                        <v-card
                            class="mx-auto"
                            max-width="344"
                            outlined
                        >
                            <v-list-item three-line>
                            <v-list-item-avatar
                                tile
                                size="80"
                                color="grey"
                            ></v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title class="h5 mb-1">
                                <a href="#">Contacto de prueba</a>
                                <div class="overline">
                                OVERLINE
                                </div>
                                </v-list-item-title>
                                <v-list-item-subtitle>Greyhound divisely hello coldly fonwderfully</v-list-item-subtitle>
                                <div text class="primary--text">
                                    <v-icon color="primary accent-4">
                                        mdi-phone-outline
                                    </v-icon>
                                   <span>+11 22 33 456</span> 
                                </div>
                                <div text class="primary--text">
                                    <v-icon color="primary accent-4">
                                        mdi-email-outline
                                    </v-icon>
                                   <span>mail@mail.com</span> 
                                </div>
                            </v-list-item-content>

                            </v-list-item>

                            <v-card-actions>
                            <v-form v-model="valid">
                            <v-container>
                                <v-row>
                                    <v-col
                                        cols=12
                                        class="py-0"
                                    >
                                    <v-text-field
                                        v-model="firstname"
                                        :rules="nameRules"
                                        :counter="10"
                                        label="Nombre y Apellido"
                                        required
                                    ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols=12
                                        class="py-0"
                                    >
                                    <v-text-field
                                        v-model="email"
                                        :rules="emailRules"
                                        label="E-mail"
                                        required
                                    ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols=12
                                        class="py-0"
                                    >
                                    <v-text-field
                                        v-model="phone"
                                        :rules="phoneRules"
                                        :counter="10"
                                        label="Telefono"
                                        required
                                    ></v-text-field>
                                    </v-col>
                                    
                                    <v-col
                                        cols=12
                                        class="py-0"
                                    >
                                    <v-textarea
                                    v-model="message"
                                    label="Mensaje"
                                    color="teal"
                                    ></v-textarea>
                                    </v-col>
                                    
                                    <v-btn
                                        outlined
                                        rounded
                                        text
                                        color="white"
                                        class="success"
                                    >
                                        Enviar
                                    </v-btn>
                                </v-row>
                            </v-container>
                            </v-form>
                            
                            </v-card-actions>
                        </v-card>
                        
                    </v-card-text>
            </v-col>
        </v-card>
    </div>
</template>

<script>
export default {
    props: {
        property: Object,
    },
    data() {
        return {
            items:[],
            valid: false,
            firstname: '',
            message:'',
            lastname: '',
            nameRules: [
                v => !!v || 'Name is required',
                v => v.length <= 10 || 'Name must be less than 10 characters',
            ],
            email: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid',
            ],
            phone: '',
            phoneRules:[
                v=> !!v || 'Telefono es requerido'
            ]
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
