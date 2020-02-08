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
                            @click="viviendas(item)"
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
                <v-card-title class="headline">Aviso de borrado de datos</v-card-title>

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
       <div>
           <v-row justify="center">
               <v-dialog v-model="dialog_viviendas" fullscreen hide-overlay transition="dialog-bottom-transition">
                   <v-card>
                       <v-toolbar dark color="primary">
                           <v-btn icon dark @click="dialog_viviendas = false">
                               <v-icon>mdi-close</v-icon>
                           </v-btn>
                           <v-toolbar-title>Viviendas</v-toolbar-title>
                           <v-spacer></v-spacer>
                           <v-toolbar-items>
                               <v-btn dark text @click="dialog_viviendas = false">Save</v-btn>
                           </v-toolbar-items>
                       </v-toolbar>
                       <v-list subheader>
                           <v-subheader>Generador de viviendas</v-subheader>
                           <v-list-item>
                               <v-list-item-content>
                                   <v-list-item-title>Introduzca escalera</v-list-item-title>
                                   <v-col class="d-flex" cols="12" sm="6">
                                       <v-text-field
                                           v-model="escalera"
                                           label="Escalera">

                                       </v-text-field>
                                   </v-col>
                               </v-list-item-content>

                                   <v-list-item-content>
                                       <v-list-item-title>Introduzca tipo de vivienda</v-list-item-title>
                                       <v-col class="d-flex" cols="12" sm="6">
                                           <v-select
                                               :items="tipo_vivienda"
                                               v-model="tipo"
                                               label="Tipo de vivienda"
                                               outlined
                                           ></v-select>
                                       </v-col>
                                   </v-list-item-content>

                                   <v-list-item-content>
                                       <v-list-item-title>Numero de plantas</v-list-item-title>
                                       <v-col class="d-flex" cols="12" sm="6">
                                           <v-select
                                               :items="plantas"
                                               v-model="planta"
                                               label="Numero de plantas"
                                               outlined
                                           ></v-select>
                                       </v-col>
                                   </v-list-item-content>

                               <v-list-item-content>
                                   <v-list-item-title>Rango de letras</v-list-item-title>
                                   <v-col class="d-flex" cols="12" sm="6">
                                       <v-select
                                           :items="letras"
                                           v-model="letra"
                                           label="Rango de letras"
                                           outlined
                                       ></v-select>
                                   </v-col>
                               </v-list-item-content>
                           </v-list-item>
                           <v-list-item-action>
                               <v-btn outlined class="mr-4"
                                      color="lime"
                                      @click="generador">
                                   Generar
                               </v-btn>
                           </v-list-item-action>
                       </v-list>
                       <v-divider></v-divider>
                       <v-simple-table fixed-header>
                           <template v-slot:default>
                               <thead>
                               <tr>
                                   <th class="text-left">Tipo</th>
                                   <th class="text-left">Escalera</th>
                                   <th class="text-left">Planta</th>
                                   <th class="text-left">Letra</th>
                               </tr>
                               </thead>
                               <tbody>
                               <tr v-for="item in viviendass" :key="item.id">
                                   <td>{{ item.tipo }}</td>
                                   <td>{{ item.escalera }}</td>
                                   <td>{{ item.planta }}</td>
                                   <td>{{ item.letra }}</td>
                               </tr>
                               </tbody>
                           </template>
                       </v-simple-table>
                   </v-card>
               </v-dialog>
           </v-row>
       </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            dialog: false,
            dialog_viviendas: false,
            search: '',
            eliminar: null,
            dialogo: false,
            planta: null,
            tipo: null,
            letra: null,
            escalera: null,
            viviendass: [],
            tipo_vivienda: ['unipersonal', 'vivienda', 'garaje', 'trastero'],
            plantas: [
                1,2,3,4,5,6,7,8,9,10,
                11,12,13,14,15,16,17,18,19,20,
                21,22,23,24,25,26,27,28,29,30,
                31,32,33,34,35,36,37,38,39,40,
                41,42,43,44,45,46,47,48,49,50,
                51,52,53,54,55,56,57,58,59,60,
            ],
            letras:[
                'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','W','X','Y','Z',
            ],
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

            viviendas(item){
                this.editedItem = Object.assign({}, item);
                axios.post('/viviendas', {id: this.editedItem.id})
                    .then(res => {
                        this.viviendass = res.data;
                        this.dialog_viviendas = true;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });

            },

            generador(){
                axios.post('/vivienda', {
                    id: this.editedItem.id,
                    escalera: this.escalera,
                    planta: this.planta,
                    tipo: this.tipo,
                    letra: this.letra,
                })
                    .then(res => {
                        this.viviendass = res.data;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });
            },

            editItem (item) {
                this.editedIndex = this.desserts.indexOf(item);
                this.editedItem = Object.assign({}, item);
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
