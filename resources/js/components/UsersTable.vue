<template>
    <div>
        <v-simple-table dark>
            <template v-slot:default>
                <thead>
                <tr>
                    <th class="text-left">Nombre</th>
                    <th class="text-left">Email</th>
                    <th class="text-left">Role</th>
                    <th class="text-left">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in usuarios" :key="item.id">
                    <td>{{ item.name }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.role }}</td>
                    <td>
                        <v-btn class="mx-2" fab dark small color="cyan" @click="editar(item)">
                            <v-icon dark>mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn class="mx-4" fab dark small color="red" @click="borrado(item)">
                            <v-icon dark>mdi-trash-can-outline</v-icon>
                        </v-btn>
                    </td>
                </tr>
                </tbody>
            </template>
        </v-simple-table>
        <div v-if="dialog">
            <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
                <v-card-title>
                    <span class="headline">Editar usuario</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field required v-model="user_edit.name"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="user_edit.email"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-select
                                    :items="items"
                                    v-model="user_edit.role"
                                ></v-select>
                            </v-col>
                        </v-row>
                    </v-container>
                    <small>*Roles admitidos admin, empleado, pedndiente</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
                    <v-btn @click.prevent="userUpdate" color="red" text>Guardar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        </div>

        <v-dialog
            v-model="dialogo"
            max-width="390"
        >
            <v-card>
                <v-card-title class="headline">Aviso de borrado de usuario</v-card-title>

                <v-card-text>
                    Seguro deseas borrar este usuario ??.
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
        data () {
            return {
                usuarios: [],
                items: ['admin', 'empleado', 'despedido'],
                dialog: false,
                dialogo: false,
                user_edit: null,
            }
        },
        mounted(){
            axios.get('/api/users')
                .then(res => {
                    this.usuarios = res.data;
                })
                .catch(err => {
                    console.log(err.response.data)
                });
        },
        methods:{
          editar(usuario){
              this.user_edit = usuario;
              this.dialog = true;
          },

            userUpdate(){
                console.log('update');
                axios.post('/users/update',{
                    id: this.user_edit.id,
                    name: this.user_edit.name,
                    email: this.user_edit.email,
                    role: this.user_edit.role,
                })
                    .then(res => {
                        this.usuarios = res.data;
                        this.user_edit = null;
                        this.dialog = false;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });
            },
            borrado(usuario){
                this.user_edit = usuario;
                this.dialogo = true;
            },

            borrar(){
                axios.post('/users/destroy', {
                    id: this.user_edit.id,
                })
                    .then(res => {
                        this.usuarios = res.data;
                        this.user_edit = null;
                        this.dialogo = false;
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    });
            },
        },

    }
</script>
