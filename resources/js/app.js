/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

if(localStorage.getItem('api_token')){
    window.axios.defaults.headers.common['Authorization'] ='Bearer ' + localStorage.getItem('api_token');
}

import Vuetify from 'vuetify';
import Router from 'vue-router';
import Vuelidate from 'vuelidate';

Vue.use(Vuelidate);
Vue.use(Router);
Vue.use(Vuetify);

window.VideoBus = new Vue();

Vue.component('calendar', require('./components/Calendar').default);
Vue.component('register', require('./components/Form_reg').default);
Vue.component('showork', require('./components/ShowWork').default);
Vue.component('usersTable', require('./components/UsersTable').default);
Vue.component('comunidades', require('./components/Comunidades').default);
Vue.component('propietarios', require('./components/Propietarios').default);
Vue.component('gastosUser', require('./components/GastosUser').default);
Vue.component('alquiler_menu', require('./components/Alquiler_menu').default);
Vue.component('alquiler_sonido', require('./components/Alquiler_sonido').default);
Vue.component('alquiler_luces', require('./components/Alquiler_luces').default);
Vue.component('alquiler_video', require('./components/Alquiler_video').default);
Vue.component('index_show', require('./components/Index').default);

/**********************rutas*************************************/

let router = new Router({
    routes: [
        {path:'/alquiler', component: require('./views/Index').default},
        {path:'/', component: require('./views/Login').default},
        {path:'/register', component: require('./views/Register').default},
        {path:'/users', component: require('./views/Users').default},
    ]
});

const ignoreWarnMessage = 'The .native modifier for v-on is only valid on components but it was used on <div>.';
Vue.config.warnHandler = function (msg, vm, trace) {
    // `trace` is the component hierarchy trace
    if (msg === ignoreWarnMessage) {
        msg = null;
        vm = null;
        trace = null;
    }
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
vuetify: new Vuetify(),
    router
});
