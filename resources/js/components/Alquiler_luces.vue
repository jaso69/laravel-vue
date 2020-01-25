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
          <h4>Iluminación</h4>
          <hr>
        </div>

            <v-list-item link @click="opcion('completos')">
              <v-list-item-action>
                <v-icon>mdi-lightbulb-multiple-outline</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Packs iluminación</v-list-item-title>
               </v-list-item-content>            
            </v-list-item>


         <v-list-item link @click="opcion('packs')">
          <v-list-item-action>
            <v-icon>mdi-track-light</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Efectos discoteca</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('array')">
          <v-list-item-action>
            <v-icon>mdi-flash</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Flash</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('mesas')">
          <v-list-item-action>
            <v-icon>mdi-led-on</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Led</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('reproductores')">
          <v-list-item-action>
            <v-icon>mdi-gamepad-circle-down</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Robótica DMX</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('platos')">
          <v-list-item-action>
            <v-icon>mdi-floor-lamp-variant</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Focos teatro</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('etapas')">
          <v-list-item-action>
            <v-icon>mdi-spotlight</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Focos panorama</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('micros')">
          <v-list-item-action>
            <v-icon>mdi-wall-sconce-flat</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Laser</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('procesadores')">
          <v-list-item-action>
            <v-icon>mdi-weather-cloudy-arrow-right</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Maquinas de humo</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('cableado')">
          <v-list-item-action>
            <v-icon>mdi-vanity-light</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Cegadoras</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('cableado')">
          <v-list-item-action>
            <v-icon>mdi-lighthouse-on</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Cañones de seguimiento</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('cableado')">
          <v-list-item-action>
            <v-icon>mdi-tune-vertical</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Regulación / Dimmers</v-list-item-title>
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