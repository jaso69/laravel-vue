<template>
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
              <v-toolbar-title>Registro</v-toolbar-title> 
              <v-spacer />
               <v-tooltip right>
                    <template v-slot:activator="{ on }">
                        <v-btn
                          icon
                          large
                          @click="login"
                          target="_blank"
                          v-on="on">
                          <v-icon>mdi-login</v-icon>
                        </v-btn>
                    </template>
                    <span>Login</span>
                </v-tooltip>
            </v-toolbar>


             <register />

         </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  export default {
    props: {
      source: String,
    },

    methods:{
      login: function(){
        this.$router.replace('/');
      },

    },
  }
</script>
