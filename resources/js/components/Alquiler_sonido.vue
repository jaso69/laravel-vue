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
          <h4>Sonido</h4>
          <hr>
        </div>

            <v-list-item link @click="opcion('completos')">
              <v-list-item-action>
                <v-icon>mdi-speaker</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Equipos completos</v-list-item-title>
               </v-list-item-content>            
            </v-list-item>


         <v-list-item link @click="opcion('packs')">
          <v-list-item-action>
            <v-icon>mdi-volume-high</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Packs de potencia</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('array')">
          <v-list-item-action>
            <v-icon>mdi-speaker-multiple</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Line array</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('mesas')">
          <v-list-item-action>
            <v-icon>mdi-tune-vertical</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Mesas</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('reproductores')">
          <v-list-item-action>
            <v-icon>mdi-disc-player</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Reproductores</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('platos')">
          <v-list-item-action>
            <v-icon>mdi-minidisc</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Platos</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('etapas')">
          <v-list-item-action>
            <v-icon>mdi-amplifier</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Etapas de potencia</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('micros')">
          <v-list-item-action>
            <v-icon>mdi-microphone-variant</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Microfonia</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('procesadores')">
          <v-list-item-action>
            <v-icon>mdi-equalizer-outline</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Procesadores</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item link @click="opcion('cableado')">
          <v-list-item-action>
            <v-icon>mdi-electron-framework</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Cableado</v-list-item-title>
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