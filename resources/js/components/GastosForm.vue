<template>
    <div>
        <v-form>
            <v-container>
                <v-card>
                    <v-card-title>Gastos</v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-col
                                cols="12"
                                md="3"
                            >
                                <v-text-field
                                    v-model="tipo_gasto"
                                    label="Tipo de gasto"
                                    required
                                ></v-text-field>
                            </v-col>

                            <v-col
                                cols="12"
                                md="3"
                            >
                                <v-text-field
                                    v-model="descripcion"
                                    label="Descripcion"
                                ></v-text-field>
                            </v-col>

                            <v-col
                                cols="12"
                                md="3"
                            >
                                <v-text-field
                                    v-model="importe"
                                    label="Importe"
                                    type="numeric"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="12"
                                md="3"
                            >
                                <v-text-field
                                    v-model="fecha"
                                    label="Fecha"
                                    type="date"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn text
                               color="lime accent-3"
                               type="submit"
                               @click.prevent="incluir">
                            <v-icon>mdi-plus-outline</v-icon>
                            Añadir
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-container>
        </v-form>
       <!-- /*******************tabla*******************/ -->
        <v-card>
            <v-card-title>
                Gastos
                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="desserts"
                :search="search"
            ></v-data-table>
        </v-card>
    </div>
</template>

<script>
    export default {
        data: () => ({
            tipo_gasto: null,
            descripcion: null,
            importe: 0,
            fecha: null,
            usuario: null,
            search: '',
            headers: [
                {
                    text: 'Tipo de gasto',
                    align: 'left',
                    sortable: false,
                    value: 'tipo_gasto',
                },
                { text: 'Descripcion', value: 'descripcion' },
                { text: 'Importe', value: 'importe' },
                { text: 'Fecha', value: 'fecha' },
            ],
            desserts: [],
        }),
        mounted() {
            axios.get('/api/user')
                .then(res => {
                    this.usuario = res.data;
                })
                .catch(err => {
                    console.log(err.response.data)
                });
            axios.get('/gasto')
                .then(res => {
                    this.desserts = res.data;
                })
                .catch(err => {
                    console.log(err.response.data)
                });

        },
        methods:{
            incluir() {
                if (this.tipo_gasto === null ||
                    this.importe === null ||
                    this.fecha === null){
                        alert('Debe rellenar todos los campos');
                } else {
                    axios.post('/gasto', {
                        user_id: this.usuario.id,
                        tipo_gasto: this.tipo_gasto,
                        descripcion: this.descripcion,
                        importe: this.importe,
                        fecha: this.fecha,
                    })
                        .then(res => {
                            this.desserts = res.data;
                            this.clear();
                        })
                        .catch(err => {
                            console.log(err.response.data)
                        });
                }
            },
            clear(){
                this.tipo_gasto = null;
                this.descripcion = null;
                this.importe = null;
                this.fecha = null;
            },
        },
    }
</script>

<style scoped>

</style>
