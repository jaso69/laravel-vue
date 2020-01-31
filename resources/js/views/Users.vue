<template>
    <v-app id="inspire">
        <v-navigation-drawer
            v-model="drawer"
            app
            clipped
        >
            <v-list dense>
                <v-list-item link @click="cal">
                    <v-list-item-action>
                        <v-icon>mdi-account</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title v-text="usuario.name"/>
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
            calendario: true,
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
                })
                .catch(err => {
                    console.log(err.response.data)
                });
            } else {
                this.$router.replace('/');
            };
            VideoBus.$on('show', events =>{
                this.eventos = events;
                this.mostrar();
            })

        },
        methods: {

            logout(){
                localStorage.removeItem('api_token');
                this.users = [];
                this.$router.replace('/');
            },
            mostrar(){
                this.calendario = false;
                this.showork = true;
            },
            cal(){
              this.showork = false;
              this.calendario = true;
            },
        }
    }
</script>
