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
                        mdi-account
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
                    <v-toolbar dark color="dark">
                        <v-btn icon dark @click="dialog = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-toolbar-title>Vivienda
                            {{item_vivienda.planta}}
                            {{item_vivienda.letra}}
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn @click="cancelar"
                                   color="red"
                                   class="mx-6"
                                   v-if="!paso1">
                                <v-icon>mdi-cancel</v-icon>
                                Cancelar
                            </v-btn>
                            <v-btn @click="guardar"
                                   color="green" v-if="!paso1">
                                <v-icon>mdi-content-save</v-icon>
                                Guardar
                            </v-btn>
                            <v-btn @click="paso1 = false"
                                   color="primary" v-if="paso1">
                                <v-icon>mdi-content-save</v-icon>
                                Nuevo
                            </v-btn>
                        </v-toolbar-items>
                    </v-toolbar>

                        <v-container v-if="!paso1">
                           <v-card class="my-2">
                               <v-card-title>Nombre</v-card-title>
                               <v-card-text>
                                    <v-row>
                                        <v-col
                                            cols="12"
                                            md="4"
                                        >
                                            <v-text-field
                                                outlined
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
                                                outlined
                                                v-model="apellido1"
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
                                                outlined
                                                v-model="apellido2"
                                                :rules="namelRules"
                                                label="Segundo Apellido"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                               </v-card-text>
                           </v-card>

                            <v-card class="my-2">
                                <v-card-title>DNI y contacto</v-card-title>
                                <v-card-text>
                                    <v-row>
                                        <v-col
                                            cols="12"
                                            md="4"
                                        >
                                            <v-text-field
                                                outlined
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
                                                outlined
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
                                                outlined
                                                v-model="movil"
                                                :rules="emailRules"
                                                label="Movil"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-card>

                            <v-card class="my-2">
                                <v-card-title>Email y cargo</v-card-title>
                                <v-card-text>
                                    <v-row>
                                        <v-col
                                            cols="12"
                                            md="4"
                                        >
                                            <v-text-field
                                                outlined
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
                                            <v-select
                                                :items="select_relacion"
                                                v-model="titulo"
                                                label="Relacion"
                                                outlined
                                            ></v-select>

                                        </v-col>

                                        <v-col
                                            cols="12"
                                            md="4"
                                        >
                                            <v-select
                                                :items="select_cargo"
                                                v-model="cargo"
                                                label="Cargo"
                                                outlined
                                            ></v-select>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-card>

                            <v-card class="my-2">
                                <v-card-title>Datos bancarios y observaciones</v-card-title>
                                <v-card-text>
                                    <v-row>
                                        <v-col
                                            cols="12"
                                            md="4"
                                        >
                                            <v-text-field
                                                outlined
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
                                                outlined
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
                                                outlined
                                                v-model="notas"
                                                :rules="emailRules"
                                                label="Observaciones"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-card>

                        </v-container>

                        <v-simple-table v-if="paso1">
                            <template v-slot:default>
                                <thead>
                                <tr>
                                    <th class="text-left">Nombre</th>
                                    <th class="text-left">1º Apellido</th>
                                    <th class="text-left">2º Apellido</th>
                                    <th class="text-left">DNI</th>
                                    <th class="text-left">Telefono</th>
                                    <th class="text-left">Movil</th>
                                    <th class="text-left">Email</th>
                                    <th class="text-left">Cargo</th>
                                    <th class="text-left">Relacion</th>
                                    <th class="text-left">Cuenta banco</th>
                                    <th class="text-left">Forma de pago</th>
                                    <th class="text-left">Observaciones</th>
                                    <th class="text-left">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in propietarios" :key="item.id">
                                    <td>{{ item.nombre }}</td>
                                    <td>{{ item.apellido1 }}</td>
                                    <td>{{ item.apellido2 }}</td>
                                    <td>{{ item.dni }}</td>
                                    <td>{{ item.telefono }}</td>
                                    <td>{{ item.movil }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>{{ item.cargo }}</td>
                                    <td>{{ item.titulo }}</td>
                                    <td>{{ item.cc }}</td>
                                    <td>{{ item.pago }}</td>
                                    <td>{{ item.notas }}</td>
                                    <td>
                                        <v-icon
                                            v-on="on"
                                            dark
                                            class="mr-2"
                                            color="cyan"
                                            @click="editando(item)"
                                        >
                                            mdi-pencil
                                        </v-icon>
                                        <v-icon
                                            v-on="on"
                                            dark
                                            class="mr-2"
                                            color="red"
                                            @click="borrar(item)"
                                        >
                                            mdi-delete
                                        </v-icon>
                                    </td>
                                </tr>
                                </tbody>
                            </template>
                        </v-simple-table>

                </v-card>
            </v-dialog>
        </v-row>
    </div>
    <v-dialog
        v-model="dialog_edit"
        max-width="390"
    >
        <v-card>
            <v-card-title class="headline">Aviso de borrado de propietario</v-card-title>

            <v-card-text>
                Seguro deseas borrar este propietario ??.
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn
                    color="green darken-1"
                    text
                    @click="dialog_edit = false"
                >
                    Cancelar
                </v-btn>

                <v-btn
                    color="red"
                    text
                    @click="borrado"
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
            search: '',
            title: 'Selecciona comunidad',
            paso1: true,
            editar: false,
            dialog_edit: false,
            id: null,
            item_comunidad: null,
            item_vivienda: null,
            data_vivienda: false,
            nombre: null,
            apellido1: null,
            apellido2: null,
            dni: null,
            telefono: null,
            movil: null,
            email: null,
            cargo: null,
            select_relacion: ['Propietario','Familiar','Inquilino','otros'],
            select_cargo: ['Vecino','Presidente', 'Vicepresidente', 'Vocal', 'otros'],
            titulo: null,
            cc: null,
            pago: null,
            notas: null,
            dialog: false,
            propietario: [],
            propietarios: [],
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
            editando(item){
                this.propietario = item;
                this.editar = true;
                this.nombre = item.nombre;
                this.apellido1 = item.apellido1;
                this.apellido2 = item.apellido2;
                this.dni = item.dni;
                this.telefono = item.telefono;
                this.movil = item.movil;
                this.email = item.email;
                this.cargo = item.cargo;
                this.titulo = item.titulo;
                this.cc = item.cc;
                this.pago = item.pago;
                this.notas = item.notas;
                this.paso1 = false;
            },

            borrar(item){
                this.propietario = item;
                this.dialog_edit = true
            },

            borrado(){
                axios.post('/propietarios/destroy', {
                    id: this.propietario.id,
                    vivienda_id: this.propietario.vivienda_id,
                })
                    .then(res => {
                        this.propietarios = res.data;
                        this.id = null;
                        this.dialog_edit = false;
                    })
                    .catch(err =>{
                        console.log(err.response.data);
                    })
            },
            guardar(){
                if(this.editar){
                    axios.post('/propietarios/update', {
                        id: this.propietario.id,
                        vivienda_id: this.propietario.vivienda_id,
                        nombre: this.nombre,
                        apellido1: this.apellido1,
                        apellido2: this.apellido2,
                        dni: this.dni,
                        telefono: this.telefono,
                        movil: this.movil,
                        email: this.email,
                        cargo: this.cargo,
                        titulo: this.titulo,
                        cc: this.cc,
                        pago: this.pago,
                        notas: this.notas,
                    })
                        .then(res => {
                            this.propietarios = res.data;
                            this.propietario = null;
                            this.paso1 = true;
                            this.limpiar();
                        })
                        .catch(err => {
                            console.log(err.response.data)
                        });
                } else {
                    axios.post('/propietarios/store', {
                        vivienda_id: this.item_vivienda.id,
                        nombre: this.nombre,
                        apellido1: this.apellido1,
                        apellido2: this.apellido2,
                        dni: this.dni,
                        telefono: this.telefono,
                        movil: this.movil,
                        email: this.email,
                        cargo: this.cargo,
                        titulo: this.titulo,
                        cc: this.cc,
                        pago: this.pago,
                        notas: this.notas,
                    })
                        .then(res => {
                            this.propietarios = res.data;
                            this.paso1 = true;
                            this.limpiar();
                        })
                        .catch(err => {
                            console.log(err.response.data)
                        });
                }
            },

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
                axios.post('/propietarios/', {
                    vivienda_id: this.item_vivienda.id,
                })
                    .then(res => {
                        this.propietarios = res.data;
                        console.log(res.data);
                        this.dialog = true;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });
            },

            limpiar(){
                this.editar = false;
                this.nombre = null;
                this.apellido1 = null;
                this.apellido2 = null;
                this.dni = null;
                this.telefono = null;
                this.movil = null;
                this.email = null;
                this.cargo = null;
                this.titulo = null;
                this.cc = null;
                this.pago = null;
                this.notas = null;
            },

            cancelar(){
                this.limpiar();
                this.paso1 = true
            },
        },
    }
</script>

<style scoped>

</style>
