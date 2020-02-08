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
                <v-toolbar-title class="text-center py-2"><h4>Comunidades</h4></v-toolbar-title>
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
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary" dark class="mb-2" v-on="on">
                                <v-icon>mdi-plus-thick</v-icon>
                                Nueva
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>

                                <span class="headline">Comunidad</span>
                            </v-card-title>
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.calle" label="Calle"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.numero" label="Numero"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.municipio" label="Municipio"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.provincia" label="Provincia"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.codigo_postal" label="Codigo postal"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions justify="space-around">
                                <v-spacer></v-spacer>
                                <v-btn color="red" text @click="close">
                                    <v-icon>mdi-close-outline</v-icon>
                                    Cancel
                                </v-btn>
                                <v-btn color="cyan" text @click="save">
                                    <v-icon>mdi-pencil-outline</v-icon>
                                    Save
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.action="{ item }">

                <v-tooltip left>
                    <template v-slot:activator="{ on }">
                        <v-icon
                            v-on="on"
                            dark
                            class="mr-2"
                            color="success"
                            @click="editItem(item)"
                        >
                            mdi-door-closed
                        </v-icon>
                    </template>
                    <span class="success p-2">Viviendas</span>
                </v-tooltip>

                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-icon
                            v-on="on"
                            dark
                            class="mr-2"
                            color="cyan"
                            @click="editItem(item)"
                        >
                            mdi-pencil
                        </v-icon>
                    </template>
                    <span class="cyan p-2">Editar</span>
                </v-tooltip>

                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-icon
                            v-on="on"
                            dark
                            class="mr-2"
                            color="red"
                            @click="deleteItem(item)"
                        >
                            mdi-delete
                        </v-icon>
                    </template>
                    <span class="red p-2">Borrar</span>
                </v-tooltip>
            </template>
            <template v-slot:no-data>
                <v-btn color="primary" @click="initialize">Recargar</v-btn>
            </template>
        </v-data-table>
        <v-dialog
            v-model="dialogo"
            max-width="390"
        >
            <v-card>
                <v-card-title class="headline">Aviso de borrado de Comunidad</v-card-title>

                <v-card-text>
                    Seguro deseas borrar esta Comunidad ??.
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn
                        color="green darken-1"
                        text
                        @click="dialogo = false"
                    >
                        Cancelar
                    </v-btn>

                    <v-btn
                        color="red"
                        text
                        @click="borrar"
                    >
                        Borrar
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    export default {
        data: () => ({
            dialog: false,
            search: '',
            eliminar: null,
            dialogo: false,
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
            editedIndex: -1,
            editedItem: {
                calle: '',
                numero: '',
                municipio: '',
                provincia: '',
                codigo_postal: '',
            },
            defaultItem: {
                calle: '',
                numero: '',
                municipio: '',
                provincia: '',
                codigo_postal: '',
            },
        }),

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            },
        },

        watch: {
            dialog (val) {
                val || this.close()
            },
        },

        created () {
            this.initialize()
        },

        methods: {
            initialize () {
               axios.get('/comunidades')
                    .then(res => {
                        this.desserts = res.data;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });
            },

            editItem (item) {
                this.editedIndex = this.desserts.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem (item) {
                this.editedIndex = this.desserts.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.eliminar = this.editedItem;
                this.dialogo = true;
            },

            borrar(){
                axios.post('/comunidades/destroy', {
                    id: this.eliminar.id,
                })
                    .then(res => {
                        this.initialize();
                        this.eliminar = null;
                        this.dialogo = false;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });
            },

            close () {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },

            save () {
                if (this.editedIndex > -1) {
                    axios.post('/comunidades/update', {
                        id: this.editedItem.id,
                        calle: this.editedItem.calle,
                        numero: this.editedItem.numero,
                        municipio: this.editedItem.municipio,
                        provincia: this.editedItem.provincia,
                        codigo_postal: this.editedItem.codigo_postal,
                    })
                        .then(res => {
                            this.initialize();
                        })
                        .catch(err => {
                            console.log(err.response.data)
                        });
                    //Object.assign(this.desserts[this.editedIndex], this.editedItem)
                } else {
                    this.desserts.push(this.editedItem);
                    axios.post('/comunidades', {
                        calle: this.editedItem.calle,
                        numero: this.editedItem.numero,
                        municipio: this.editedItem.municipio,
                        provincia: this.editedItem.provincia,
                        codigo_postal: this.editedItem.codigo_postal,
                    })
                        .then(res => {
                            this.initialize();
                        })
                        .catch(err => {
                            console.log(err.response.data)
                        });
                }
                this.close()
            },
        },
    }
</script>
