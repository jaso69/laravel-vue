<template>
<div>
    <v-data-table
        :headers="headers"
        :items="desserts"
        :search="search"
        sort-by= "calle"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-btn class="ma-2"
                   outlined color="red"
                   v-if="data_vivienda"
                   @click="data_comunidades">
                <- Regresar
            </v-btn>
            <v-toolbar-title class="text-center py-2"><h4>{{ title}}</h4></v-toolbar-title>
            <v-toolbar flat color="dark">
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
                <v-divider
                    class="mx-4"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>
            </v-toolbar>
        </template>
        <template v-slot:item.action="{ item }">

            <v-tooltip left v-if="!data_vivienda">
                <template v-slot:activator="{ on }">
                    <v-icon
                        v-on="on"
                        dark
                        class="mr-2"
                        color="cyan"
                        @click="seleccion_comunidad(item)"
                    >
                        mdi-home-import-outline
                    </v-icon>
                </template>
                <span class="cyan p-2">Seleccionar</span>
            </v-tooltip>
            <v-tooltip left v-if="data_vivienda">
                <template v-slot:activator="{ on }">
                    <v-icon
                        v-on="on"
                        dark
                        class="mr-2"
                        color="green"
                        @click="add_propietarios(item)"
                    >
                        mdi-account-plus
                    </v-icon>
                </template>
                <span class="green p-2">Añadir propietarios</span>
            </v-tooltip>
        </template>
        <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">Recargar</v-btn>
        </template>
    </v-data-table>

    <div v-if="dialog">
        <v-row justify="center">
            <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
                <v-card outlined>
                    <v-toolbar dark color="primary">
                        <v-btn icon dark @click="dialog = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-toolbar-title>Vivienda
                            {{item_vivienda.planta}}
                            {{item_vivienda.letra}}
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                 
                        <v-container>
                            <v-card-title>
                                <v-row>
                                    <v-col
                                        cols="12"
                                        md="4"
                                    >
                                        <v-text-field
                                            v-model="nombre"
                                            :rules="nameRules"
                                            :counter="10"
                                            label="Nombre"
                                            required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        md="4"
                                    >
                                        <v-text-field
                                            v-model="Apellido1"
                                            :rules="nameRules"
                                            :counter="10"
                                            label="Primer Apellido"
                                            required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        md="4"
                                    >
                                        <v-text-field
                                            v-model="apellido2"
                                            :rules="namelRules"
                                            label="Segundo Apellido"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-card-title>
                            <v-card-subtitle>
                                <v-row>
                                    <v-col
                                        cols="12"
                                        md="4"
                                    >
                                        <v-text-field
                                            v-model="dni"
                                            :rules="nameRules"
                                            :counter="10"
                                            label="DNI"
                                            required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        md="4"
                                    >
                                        <v-text-field
                                            v-model="telefono"
                                            :rules="nameRules"
                                            :counter="10"
                                            label="Telefono"
                                            required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        md="4"
                                    >
                                        <v-text-field
                                            v-model="movil"
                                            :rules="emailRules"
                                            label="Movil"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-card-subtitle>
                            <v-card-text>
                                <v-row>
                                    <v-col
                                        cols="12"
                                        md="4"
                                    >
                                        <v-text-field
                                            v-model="email"
                                            :rules="emailRules"
                                            :counter="10"
                                            label="Email"
                                            required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        md="4"
                                    >
                                        <v-text-field
                                            v-model="titulo"
                                            :rules="nameRules"
                                            :counter="10"
                                            label="Titulo"
                                            required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        md="4"
                                    >
                                        <v-text-field
                                            v-model="cargo"
                                            :rules="emailRules"
                                            label="Cargo"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-card-text>

                                <v-row>
                                    <v-col
                                        cols="12"
                                        md="4"
                                    >
                                        <v-text-field
                                            v-model="cc"
                                            :rules="emailRules"
                                            :counter="10"
                                            label="Numero de cuenta bancaria"
                                            required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        md="4"
                                    >
                                        <v-text-field
                                            v-model="pago"
                                            :rules="nameRules"
                                            :counter="10"
                                            label="Forma de pago"
                                            required
                                        ></v-text-field>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        md="4"
                                    >
                                        <v-text-field
                                            v-model="notas"
                                            :rules="emailRules"
                                            label="Observaciones"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                </v-row>

                        </v-container>
                </v-card>
            </v-dialog>
        </v-row>
    </div>
</div>
</template>

<script>
    export default {
        data: () => ({
            search: '',
            title: 'Selecciona comunidad',
            item_comunidad: null,
            item_vivienda: null,
            data_vivienda: false,
            dialog: false,
            headers: [
                {
                    text: 'Calle',
                    align: 'left',
                    value: 'calle',
                },
                { text: 'Numero', value: 'numero' },
                { text: 'Municipio', value: 'municipio' },
                { text: 'Provincia', value: 'provincia' },
                { text: 'Codigo postal', value: 'codigo_postal'},
                { text: 'Actions', value: 'action', sortable: false },
            ],
            desserts: [],
        }),

        mounted() {
            axios.get('/comunidades')
                .then(res => {
                    this.desserts = res.data;
                })
                .catch(err => {
                    console.log(err.response.data)
                });
        },
        methods:{
            seleccion_comunidad(item){
                this.item_comunidad = item;
                axios.post('/viviendas', {id: this.item_comunidad.id})
                    .then(res => {
                        this.headers = [
                            {
                                text: 'Tipo vivienda',
                                align: 'left',
                                value: 'tipo',
                            },
                            { text: 'Escalera', value: 'esaclera' },
                            { text: 'Planta', value: 'planta' },
                            { text: 'Letra', value: 'letra' },
                            { text: 'Actions', value: 'action', sortable: false },
                        ];
                        this.desserts = res.data;
                        this.data_vivienda = true;
                        this.title = this.item_comunidad.municipio + ' ' +
                            this.item_comunidad.calle + ',' +
                            this.item_comunidad.numero;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });
            },

            data_comunidades(){
                axios.get('/comunidades')
                    .then(res => {
                        this.headers = [
                            {
                                text: 'Calle',
                                align: 'left',
                                value: 'calle',
                            },
                            { text: 'Numero', value: 'numero' },
                            { text: 'Municipio', value: 'municipio' },
                            { text: 'Provincia', value: 'provincia' },
                            { text: 'Codigo postal', value: 'codigo_postal'},
                            { text: 'Actions', value: 'action', sortable: false },
                        ],
                        this.desserts = res.data;
                        this.data_vivienda = false;
                        this.title = 'Selecciona comunidad';
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });
            },

            add_propietarios(item){
                this.item_vivienda = item;
                this.dialog = true;
            }
        },
    }
</script>

<style scoped>

</style>
