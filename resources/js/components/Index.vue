<template>
<div class="d-flex flex-wrap justify-content-between align-items-start">
       <v-card
                class="mx-auto my-2"
                max-width="400"
              >
                <v-img
                  class="white--text align-end"
                  height="200px"
                  src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                >
                  <v-card-title>Top 10 Australian beaches</v-card-title>
                </v-img>

                <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

                <v-card-text class="text--primary">
                  <div>Whitehaven Beach</div>

                  <div>Whitsunday Island, Whitsunday Islands</div>
                </v-card-text>

                <v-card-actions>
                  <v-btn
                    color="orange"
                    text
                  >
                    Share
                  </v-btn>

                  <v-btn
                    color="orange"
                    text
                  >
                    Explore
                  </v-btn>
                </v-card-actions>
            </v-card>

            <v-card
                class="mx-auto my-2"
                max-width="400"
              >
                <v-img
                  class="white--text align-end"
                  height="200px"
                  src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                >
                  <v-card-title>Top 10 Australian beaches</v-card-title>
                </v-img>

                <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

                <v-card-text class="text--primary">
                  <div>Whitehaven Beach</div>

                  <div>Whitsunday Island, Whitsunday Islands</div>
                </v-card-text>

                <v-card-actions>
                  <v-btn
                    color="orange"
                    text
                  >
                    Share
                  </v-btn>

                  <v-btn
                    color="orange"
                    text
                  >
                    Explore
                  </v-btn>
                </v-card-actions>
            </v-card>

         <v-card
                class="mx-auto my-2"
                max-width="400"
              >
                <v-img
                  class="white--text align-end"
                  height="200px"
                  src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                >
                  <v-card-title>Top 10 Australian beaches</v-card-title>
                </v-img>

                <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

                <v-card-text class="text--primary">
                  <div>Whitehaven Beach</div>

                  <div>Whitsunday Island, Whitsunday Islands</div>
                </v-card-text>

                <v-card-actions>
                  <v-btn
                    color="orange"
                    text
                  >
                    Share
                  </v-btn>

                  <v-btn
                    color="orange"
                    text
                  >
                    Explore
                  </v-btn>
                </v-card-actions>
            </v-card>

            <v-card
                class="mx-auto my-2"
                max-width="400"
              >
                <v-img
                  class="white--text align-end"
                  height="200px"
                  src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                >
                  <v-card-title>Top 10 Australian beaches</v-card-title>
                </v-img>

                <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

                <v-card-text class="text--primary">
                  <div>Whitehaven Beach</div>

                  <div>Whitsunday Island, Whitsunday Islands</div>
                </v-card-text>

                <v-card-actions>
                  <v-btn
                    color="orange"
                    text
                  >
                    Share
                  </v-btn>

                  <v-btn
                    color="orange"
                    text
                  >
                    Explore
                  </v-btn>
                </v-card-actions>
            </v-card>
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