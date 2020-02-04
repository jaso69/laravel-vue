<template>
    <div>

        <v-data-table
            :headers="headers"
            :items="desserts"
            :search="search"
            sort-by= "fecha"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar-title>Gastos</v-toolbar-title>
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
                            <v-btn color="primary" dark class="mb-2" v-on="on">Nuevo gasto</v-btn>
                        </template>
                        <v-card>
                            <v-card-title>

                               <span class="headline">{{ formTitle }}</span>
                            </v-card-title>
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.tipo_gasto" label="Tipo de gasto"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.descripcion" label="Descripcion"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.importe" label="Importe" type="numeric"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editedItem.fecha" label="Fecha" type="date"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.action="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
            <template v-slot:no-data>
                <v-btn color="primary" @click="initialize">Reset</v-btn>
            </template>
        </v-data-table>
</div>
</template>

<script>
    export default {
        data: () => ({
            dialog: false,
            search: '',
            usuario: null,
            headers: [
                {
                    text: 'Tipo de Gasto',
                    align: 'left',
                    sortable: false,
                    value: 'tipo_gasto',
                },
                { text: 'Descripcion', value: 'descripcion' },
                { text: 'Importe', value: 'importe' },
                { text: 'Fecha', value: 'fecha' },
                { text: 'Actions', value: 'action', sortable: false },
            ],
            desserts: [],
            editedIndex: -1,
            editedItem: {
                tipo_gasto: '',
                descripcion: '',
                importe: '',
                fecha: null,
            },
            defaultItem: {
                tipo_gasto: '',
                descripcion: '',
                importe: '',
                fecha: null,
            },
        }),

        mounted: function () {
            axios.get('/api/user')
                .then(res => {
                    this.usuario = res.data;
                })
                .catch(err => {
                    console.log(err.response.data)
                });
        },

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
                axios.get('/gasto')
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
                const index = this.desserts.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
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
                    Object.assign(this.desserts[this.editedIndex], this.editedItem)
                } else {
                    this.desserts.push(this.editedItem);
                    axios.post('/gasto', {
                        user_id: this.usuario.id,
                        tipo_gasto: this.editedItem.tipo_gasto,
                        descripcion: this.editedItem.descripcion,
                        importe: this.editedItem.importe,
                        fecha: this.editedItem.fecha,
                    })
                        .then(res => {
                            this.desserts = res.data;
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
