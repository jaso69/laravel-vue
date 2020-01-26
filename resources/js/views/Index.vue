<template>

  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
    >

    <alquiler_menu v-if="menu"></alquiler_menu>

    <alquiler_sonido v-if="sonido"></alquiler_sonido>

    <alquiler_luces v-if="luces"></alquiler_luces>

    </v-navigation-drawer>

    <v-app-bar
      app
      color="indigo"
      dark
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>

    <v-content>
      <v-container
        class="fill-height"
        fluid
      >

           <index_show v-if="menu" />
            
      </v-container>
    </v-content>
    <v-footer
      color="indigo"
      app
    >
      <span class="white--text">&copy; 2019</span>
    </v-footer>
  </v-app>

</template>

<script>
    export default {

        data: () => ({
            opcion_m: 'menu',
            menu: true,
            sonido: false,
            luces: false,
        }),

        mounted(){

            VideoBus.$on('opcion_m', opcion_m =>{
                this.opcion_m = opcion_m;
                this.mostrar();
            })
        },

        methods:{

            video(){
                console.log(this.opcion_m);
            },

            mostrar(){

                if (this.opcion_m == 'menu'){
                    this.sonido = false;
                    this.luces = false;
                    this.menu = true;
                }
                if (this.opcion_m == 'sonido'){
                    this.menu = false;
                    this.luces = false;
                    this.sonido = true;
                }
                if (this.opcion_m == 'luces'){
                    this.menu = false;
                    this.sonido = false;
                    this.luces = true;
                }
            }
        },
        
    }
</script>
