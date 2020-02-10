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

    <div>
        <v-row justify="center">
            <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
                <v-card>
                    <v-toolbar dark color="primary">
                        <v-btn icon dark @click="dialog = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-toolbar-title>Settings</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn dark text @click="dialog = false">Save</v-btn>
                        </v-toolbar-items>
                    </v-toolbar>
                    <v-list three-line subheader>
                        <v-subheader>User Controls</v-subheader>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Content filtering</v-list-item-title>
                                <v-list-item-subtitle>Set the content filtering level to restrict apps that can be downloaded</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Password</v-list-item-title>
                                <v-list-item-subtitle>Require password for purchase or use password to restrict purchase</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                    <v-divider></v-divider>
                    <v-list three-line subheader>
                        <v-subheader>General</v-subheader>
                        <v-list-item>
                            <v-list-item-action>
                                <v-checkbox ></v-checkbox>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>Notifications</v-list-item-title>
                                <v-list-item-subtitle>Notify me about updates to apps or games that I downloaded</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-action>
                                <v-checkbox ></v-checkbox>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>Sound</v-list-item-title>
                                <v-list-item-subtitle>Auto-update apps at any time. Data charges may apply</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-action>
                                <v-checkbox ></v-checkbox>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>Auto-add widgets</v-list-item-title>
                                <v-list-item-subtitle>Automatically add home screen widgets</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
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
            title: 'Comunidades',
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

            add_propietarios(item){
                this.item_vivienda = item;
                this.dialog = true;
            }
        },
    }
</script>

<style scoped>

</style>
