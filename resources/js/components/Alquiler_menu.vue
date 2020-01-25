<template>
<div>
      <v-list dense>

        <v-list-item link @click="opcion('home')">
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Inicio</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

            <v-list-item link @click="opcion('sonido')">
              <v-list-item-action>
                <v-icon>mdi-speaker</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Sonido</v-list-item-title>
               </v-list-item-content>            
            </v-list-item>


         <v-list-item link @click="opcion('luces')">
          <v-list-item-action>
            <v-icon>mdi-lightbulb-on-outline</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Iluminacion</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('video')">
          <v-list-item-action>
            <v-icon>mdi-video-outline</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Video</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('escenarios')">
          <v-list-item-action>
            <v-icon>mdi-transmission-tower</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Estructuras</v-list-item-title>
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