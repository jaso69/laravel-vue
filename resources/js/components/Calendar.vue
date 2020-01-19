<template>
    <v-row class="fill-height">
        <v-col>
            <v-sheet height="64">
                <v-toolbar flat color="brown darken-3">
                    <v-btn outlined class="mr-4" color="yellow accent-1" @click="setToday">
                        Hoy
                    </v-btn>
                    <v-btn outlined class="mr-4" color="yellow accent-1" @click="dialog = true">
                        Agregar
                    </v-btn>
                    <v-btn fab text small color="yellow accent-1" @click="prev">
                        <v-icon small>mdi-chevron-left</v-icon>
                    </v-btn>
                    <v-btn fab text small color="yellow accent-1" @click="next">
                        <v-icon small>mdi-chevron-right</v-icon>
                    </v-btn>
                    <v-toolbar-title>{{ title }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-menu bottom right>
                      <template v-slot:activator="{ on }">
                            <v-btn
                                outlined
                                color="yellow accent-1"
                                v-on="on"
                            >
                                <span>{{ typeToLabel[type] }}</span>
                                <v-icon right>mdi-menu-down</v-icon>
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item @click="type = 'day'">
                                <v-list-item-title>Dia</v-list-item-title>
                            </v-list-item>
                            <v-list-item @click="type = 'week'">
                                <v-list-item-title>Semana</v-list-item-title>
                            </v-list-item>
                            <v-list-item @click="type = 'month'">
                                <v-list-item-title>Mes</v-list-item-title>
                            </v-list-item>
                            <v-list-item @click="type = '4day'">
                                <v-list-item-title>4 dias</v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </v-toolbar>
            </v-sheet>
            <v-sheet height="600">
                <v-calendar
                    :weekdays="[1, 2, 3, 4, 5, 6, 0]"
                    locale="es"
                    :short-weekdays="false"
                    :now="today"
                    ref="calendar"
                    v-model="focus"
                    color="primary"
                    :events="events"
                    :event-color="getEventColor"
                    :type="type"
                    @click:event="showEvent"
                    @click:more="viewDay"
                    @click:date="viewDay"
                    @click:day="prueba"
                    @change="updateRange"
                ></v-calendar>
                <v-dialog v-model="dialog">
                    <v-card>
                        <v-card-title>
                            <h3>Nuevo apunte</h3>
                            <v-container>
                                <v-form @submit.prevent="addEvents">
                                    <v-text-field label="Emplazamiento"
                                                  type="text"
                                                  v-model="name"
                                                  required>
                                    </v-text-field>
                                    <v-text-field label="Descripcion"
                                                  type="text"
                                                  v-model="details"
                                                  required>
                                    </v-text-field>
                                    <v-row justify="space-around">
                                        <v-text-field label="Inicio"
                                                      type="date"
                                                      v-model="inicio"
                                                      required>
                                                      
                                        </v-text-field>
                                        <v-text-field label="Fin"
                                                      type="date"
                                                      v-model="fin"
                                                      class="mx-2"
                                                      required>
                                        </v-text-field>
                                    </v-row>

                                    <v-text-field label="color"
                                                v-model="color" 
                                                class="ma-2" 
                                                type="color">
                                            Color                                  
                                    </v-text-field>

                                    <v-card-actions>
                                        <v-row justify="space-around">
                                            <v-btn outlined class="mr-4"
                                                   color="lime"
                                                   type="submit"
                                                   @click.stop="dialog = false">
                                                Guardar
                                            </v-btn>

                                            <v-btn outlined class="mr-4"
                                                color="red darken-1"
                                                @click="dialog = false, inicio = null, fin = null">
                                                <v-icon>mdi-close-outline</v-icon>
                                                Cancel
                                            </v-btn>
                                        </v-row>
                                    </v-card-actions>
                                </v-form>
                            </v-container>
                        </v-card-title>

                    </v-card>
                </v-dialog>

                <v-dialog v-model="selectedOpen">
                    <v-card
                        color="grey lighten-4"
                        min-width="350px"
                        flat
                    >
                        <v-toolbar
                            :color="selectedEvent.color"
                            dark
                        >

                            <v-toolbar-title>

                                <span 
                                    v-html="selectedEvent.name" 
                                    class="text-white">
                                </span>

                                
                            </v-toolbar-title>
                            <v-spacer></v-spacer>
                           
                           <v-btn icon @click="deleteEvent(selectedEvent)">
                                <v-icon>mdi-trash-can-outline</v-icon>
                            </v-btn>
                        </v-toolbar>
                        <v-card-text >

                            <v-container  v-if="editing" class="bg-dark">

                            <v-form @submit.prevent="updateEvent(selectedEvent)"> 

                                <v-text-field label="Asunto"
                                        v-model="selectedEvent.name">
                                </v-text-field>

                                <v-text-field label="Detalles"
                                        v-model="selectedEvent.details">
                                </v-text-field>

                                <v-row justify="space-around">
                                        <v-text-field label="Inicio"
                                                      type="date"
                                                      v-model="selectedEvent.start"
                                                      >
                                        </v-text-field>
                                        <v-text-field label="Fin"
                                                      type="date"
                                                      v-model="selectedEvent.end"
                                                      class="mx-2"
                                                      >
                                        </v-text-field>
                                    </v-row>

                                    <v-text-field label="Color"
                                        v-model="selectedEvent.color" 
                                        class="ma-2" 
                                        type="color">                                  
                                    </v-text-field>

                                    <v-btn text
                                       color="success"
                                       type="submit"
                                       @click.stop="selectedOpen = false">
                                        <v-icon>mdi-pencil-outline</v-icon>
                                        Guardar
                                    </v-btn>

                                </v-form>

                            </v-container>

                            <span   v-else
                                    v-html="selectedEvent.details"
                                    class="text-dark"
                            ></span>

                        </v-card-text>
                        <v-card-actions>
                    
                                <v-btn text
                                    v-if="!editing"
                                    color="orange darken-4"
                                    @click.prevent="editEvent(selectedEvent)">
                                        <v-icon>mdi-pencil-outline</v-icon>
                                    Editar
                                </v-btn>

                                <v-btn
                                    text
                                    color="secondary"
                                    @click="selectedOpen = false, editing = false"
                                ><v-icon>mdi-close-outline</v-icon>
                                    Cancel
                                </v-btn>
                        </v-card-actions>
                    </v-card>
              
            </v-dialog>
            </v-sheet>
        </v-col>
    </v-row>
</template>

<script>
    export default {
        data: () => ({
            focus: new Date().toISOString().substr(0,10),
            day: new Date().toISOString().substr(0,10),
            type: 'month',
            typeToLabel: {
                month: 'Mes',
                week: 'Week',
                day: 'Day',
                '4day': '4 Days',
            },
            start: null,
            end: null,
            inicio: null,
            fin: null,
            selectedEvent: {},
            selectedElement: null,
            selectedOpen: false,
            events: [],
            colors: ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'],
            color: 'red',
            names: ['Meeting', 'Holiday', 'PTO', 'Travel', 'Event', 'Birthday', 'Conference', 'Party'],
            name: '',
            details: '',
            dialog: false,
            editing: false,
            usuario: '',
        }),

        computed: {
            title () {
                const { start, end } = this;
                if (!start || !end) {
                    return startMonth;
                }

                const startMonth = this.monthFormatter(start)
                const endMonth = this.monthFormatter(end)
                const suffixMonth = startMonth === endMonth ? '' : endMonth

                const startYear = start.year
                const endYear = end.year
                const suffixYear = startYear === endYear ? '' : endYear

                const startDay = start.day + this.nth(start.day)
                const endDay = end.day + this.nth(end.day)

                switch (this.type) {
                    case 'month':
                        return `${startMonth} ${startYear}`
                    case 'week':
                    case '4day':
                        return `${startMonth} ${startDay} ${startYear} - ${suffixMonth} ${endDay} ${suffixYear}`
                    case 'day':
                        return `${startMonth} ${startDay} ${startYear}`
                }
                return ''
            },
            monthFormatter () {
                return this.$refs.calendar.getFormatter({
                    timeZone: 'UTC', month: 'long',
                })
            },
        },
        mounted () {

            this.$refs.calendar.checkChange();

            axios.get('/api/user')
                .then(res => {
                    this.usuario = res.data;
                })
                .catch(err => {
                    console.log(err.response.data)
                });

            this.getEvent();
        },


        methods: {

            prueba(event){
                this.inicio = event.date;
                this.fin = event.date;
                this.dialog = true;
            },

            updateEvent(selectedEvent){
                axios.post('/notas/update',{
                    id: this.selectedEvent.id,
                    user_id: this.usuario.id,
                    name: this.selectedEvent.name,
                    details: this.selectedEvent.details,
                    start: this.selectedEvent.start,
                    end: this.selectedEvent.end,
                    color: this.selectedEvent.color,
                })
                .then(res => {
                    this.events = res.data;
                })
                .catch(err => {
                    console.log(err.response.data)
                });
                this.clear();
            },

            editEvent(selectedEvent){

                this.editing = true;

            },

            deleteEvent(selectedEvent){

                axios.post('/notas/destroy', {
                   id: this.selectedEvent.id,
                })
                .then(res => {
                    this.events = res.data;
                    this.selectedOpen = false;
                })
                .catch(err => {
                    console.log(err.response.data)
                });

                this.getEvent();

            },

            getEvent(){

                axios.get('/api/notas')
                .then(res => {
                    this.events = res.data;
                })
                .catch(err => {
                    console.log(err.response.data)
                });
            },

            addEvents(){
               
                axios.post('/notas',{
                    user_id: this.usuario.id,
                    name: this.name,
                    details: this.details,
                    start: this.inicio,
                    end: this.fin,
                    color: this.color,
                })
                .then(res => {
                    this.events = res.data;
                })
                .catch(err => {
                    console.log(err.response.data)
                });
                this.clear();
                
            },

            clear(){

                this.name = '';
                this.details = '';
                this.inicio = null;
                this.fin = null;
                this.color = null;

            },

            viewDay ({ date }) {
                this.focus = date
                this.type = 'day'
            },
            getEventColor (event) {
                console.log(event);
                return event.color;
            },
            setToday () {
                this.focus = this.today
            },
            prev () {
                this.$refs.calendar.prev()
            },
            next () {
                this.$refs.calendar.next()
            },
           showEvent ({ nativeEvent, event }) {
                const open = () => {
                    this.selectedEvent = event
                    this.selectedElement = nativeEvent.target
                    setTimeout(() => this.selectedOpen = true, 10)
                };

                if (this.selectedOpen) {
                    this.selectedOpen = false
                    setTimeout(open, 10)
                } else {
                    open()
                }

                nativeEvent.stopPropagation()
            },
            updateRange ({ start, end }) {
                const min = new Date(`${start.date}T00:00:00`)
                const max = new Date(`${end.date}T23:59:59`)
                const allDay = this.rnd(0, 3) === 0
                const firstTimestamp = this.rnd(min.getTime(), max.getTime())
                const first = new Date(firstTimestamp - (firstTimestamp % 900000))
                const secondTimestamp = this.rnd(2, allDay ? 288 : 8) * 900000
                const second = new Date(first.getTime() + secondTimestamp)
                this.start = start
                this.end = end
            },
            nth (d) {
                return d > 3 && d < 21
                    ? 'th'
                    : ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'][d % 10]
            },
            rnd (a, b) {
                return Math.floor((b - a + 1) * Math.random()) + a
            },
            formatDate (a, withTime) {
                return withTime
                    ? `${a.getFullYear()}-${a.getMonth() + 1}-${a.getDate()} ${a.getHours()}:${a.getMinutes()}`
                    : `${a.getFullYear()}-${a.getMonth() + 1}-${a.getDate()}`
            },
        },
    }
</script>
