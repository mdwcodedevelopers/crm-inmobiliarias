/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import '@mdi/font/css/materialdesignicons.css'
window.Vue = require('vue');
import Vuetify from 'vuetify';
import VueCarousel from 'vue-carousel';
Vue.use(VueCarousel);
Vue.use(Vuetify);
import colors from 'vuetify/lib/util/colors'
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('properties', require('./components/Properties.vue').default);
Vue.component('propertie', require('./components/Property.vue').default);
Vue.component('nav-guest', require('./components/Navs/NavGuest.vue').default);
Vue.component('nav-admin', require('./components/Navs/NavAdmin.vue').default);
Vue.component('nav-user', require('./components/Navs/NavUser.vue').default);
Vue.component('nav-agent', require('./components/Navs/NavAgent.vue').default);
Vue.component('status', require('./components/Status.vue').default);
Vue.component('properties-user', require('./components/PropertiesUser.vue').default);
Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('categories', require('./components/Categories.vue').default);
Vue.component('barra-component', require('./components/Barra.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    theme: {
        themes: {
          light: {
            primary: colors.red.darken1,
            secondary: colors.red.lighten4,
            accent: colors.indigo.base,
          },
        },
      },
});
