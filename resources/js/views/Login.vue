<template>
    <div class="container">
        <v-app id="inspire">
            <v-content>
                <v-container
                    class="fill-height"
                    fluid
                >
                    <v-row
                        align="center"
                        justify="center"
                    >
                        <v-col
                            cols="12"
                            sm="8"
                            md="4"
                        >
                            <v-card class="elevation-12">
                                <v-toolbar
                                    color="primary"
                                    dark
                                    flat
                                >
                                    <v-toolbar-title>Login form</v-toolbar-title>
                                    <v-spacer />
                                    <v-tooltip right>
                                        <template v-slot:activator="{ on }">
                                            <v-btn
                                                icon
                                                large
                                                @click="register"
                                                target="_blank"
                                                v-on="on"
                                            >
                                                <v-icon>mdi-account-plus</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Registrate</span>
                                    </v-tooltip>
                                </v-toolbar>
                                <v-form @submit.prevent="login">
                                    <v-card-text>
                                            <v-text-field
                                                required
                                                label="email"
                                                type="email"
                                                v-model="form.email"
                                            />

                                            <v-text-field
                                                required
                                                label="password"
                                                type="password"
                                                v-model="form.password"
                                            />

                                    </v-card-text>
                                    <v-card-actions>
                                        <v-spacer />
                                        <v-btn color="primary" type="submit">Login</v-btn>
                                    </v-card-actions>
                                </v-form>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>
            </v-content>
        </v-app>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                form: {},
            }
        },
        created () {
            this.$vuetify.theme.dark = false
        },

        methods:{
            login: function () {
                axios.post('/api/login', this.form)
                    .then(res => {
                        localStorage.setItem('api_token', res.data.api_token);
                        window.axios.defaults.headers.common['Authorization'] =
                            'Bearer ' + localStorage.getItem('api_token');
                        this.$router.replace('users');
                    })
                    .catch(err => {
                        alert(err.response.data.message);
                    })
            },

            register: function(){
                this.$router.replace('register');
            },
        },
    }
</script>
