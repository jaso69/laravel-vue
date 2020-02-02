<template>
    <v-app id="inspire">
        <v-navigation-drawer
            v-model="drawer"
            app
            clipped
        >
            <v-list dense>
                <v-list-item v-if="empleado" link @click="componentes('calendario')">
                    <v-list-item-action>
                        <v-icon>mdi-account</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title v-text="usuario.name"/>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item v-if="empleado" link @click="componentes('gastos')">
                    <v-list-item-action>
                        <v-icon>mdi-currency-eur</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            Gastos
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item v-if="admin" link @click="componentes('empleados')">
                    <v-list-item-action>
                        <v-icon>mdi-account-group</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            Usuarios
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item link @click="logout">
                    <v-list-item-action>
                        <v-icon>mdi-export</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Logout</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            app
            clipped-left
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
            <v-toolbar-title>Application</v-toolbar-title>
        </v-app-bar>

        <v-content>
            <v-container
                fluid
            >
                <v-row
                    align="center"
                    justify="center"
                >
                    <v-col>
                        <calendar v-if="calendario" />
                        <showork :eventos="eventos" v-if="showork"/>
                        <users-table v-if="admin_user"/>
                        <gastosForm v-if="admin_gastos" />
                    </v-col>
                </v-row>
            </v-container>
        </v-content>

        <v-footer app>
            <span>&copy; 2019</span>
        </v-footer>
    </v-app>
</template>

<script>
    export default {
        props: {
            source: String,
        },
        data: () => ({
            drawer: null,
            users: [],
            usuario: '',
            role: 'admin',
            role2: 'empleado',
            admin: false,
            admin_user: false,
            admin_gastos: false,
            empleado: false,
            calendario: false,
            showork: false,
            eventos: null,
        }),
        created () {
            this.$vuetify.theme.dark = true
        },
        mounted() {
            if(localStorage.getItem('api_token')){
                axios.get('/api/user')
                .then(res => {
                    this.usuario = res.data;
                    if (this.usuario.role === this.role){
                        this.admin = true;
                        this.empleado = true;
                        this.calendario = true;
                    }
                    if (this.usuario.role === this.role2){
                        this.admin = false;
                        this.empleado = true;
                        this.calendario = true;
                    }
                })
                .catch(err => {
                    console.log(err.response.data)
                });
            } else {
                this.$router.replace('/');
            };
            VideoBus.$on('show', events =>{
                this.eventos = events;
                this.componentes('showork');
            });

        },
        methods: {

            logout(){
                localStorage.removeItem('api_token');
                this.users = [];
                this.$router.replace('/');
            },

            componentes(op){
                this.limpiar();
                if (op === 'calendario') {
                    this.calendario = true;
                }
                if (op === 'gastos') {
                    this.admin_gastos = true;
                }
                if (op === 'empleados') {
                    this.admin_user = true;
                }
                if (op === 'showork') {
                    this.showork = true;
                }
            },
            limpiar(){
                this.showork = false;
                this.calendario = false;
                this.admin_gastos = false;
                this.admin_user = false;
            },
        },
    }
</script>
