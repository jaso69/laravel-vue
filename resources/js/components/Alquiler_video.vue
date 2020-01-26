<template>
<div>
      <v-list dense>

        <v-list-item link @click="opcion('menu')">
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Inicio</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <div class="container text-center">
          <hr>         
          <h4>Video</h4>
          <hr>
        </div>

            <v-list-item link @click="opcion('completos')">
              <v-list-item-action>
                <v-icon>mdi-television</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Pantallas TV</v-list-item-title>
               </v-list-item-content>            
            </v-list-item>


         <v-list-item link @click="opcion('packs')">
          <v-list-item-action>
            <v-icon>mdi-video-outline</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Proyectores de video</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('array')">
          <v-list-item-action>
            <v-icon>mdi-projector-screen</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Pantallas de proyección</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('mesas')">
          <v-list-item-action>
            <v-icon>mdi-monitor-multiple</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>VideoWall</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('reproductores')">
          <v-list-item-action>
            <v-icon>mdi-call-split</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Splitters/Procesadores</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click="opcion('contacto')">
          <v-list-item-action>
            <v-icon>mdi-contact-mail</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Contacto</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
 </div>      
</template>

<script>
  

  export default {

    data: () => ({
            opcion_m: null,
            op: null,
        }),
   
    methods: {

      opcion(op) {
        console.log(op);
        this.opcion_m = op;
        VideoBus.$emit('opcion_m', this.opcion_m);
      },

   },
  }
</script>