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
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Vue from 'vue'
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueSweetalert2);
Vue.use(VueCarousel);
Vue.use(Vuetify);
import colors from 'vuetify/lib/util/colors'

Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyBoFWJlPXeJQH1lIQAITtZQEqRVhmET6mI',
    libraries: 'places',
    v: '3.26',
  },
})
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('analytics', require('./components/Analytics.vue').default);
Vue.component('aside-terms', require('./components/Front-aside.vue').default);
Vue.component('sliders', require('./components/Sliders.vue').default);
Vue.component('calendar', require('./components/Events/Calendar.vue').default);
Vue.component('events-invite', require('./components/Events/Events-invite.vue').default);
Vue.component('events', require('./components/Events/Events.vue').default);
Vue.component('event-types', require('./components/Events/Events-types.vue').default);
Vue.component('front-footer', require('./components/Front-footer.vue').default);
Vue.component('front-page', require('./components/FrontPage.vue').default);
Vue.component('contacts', require('./components/Contacts.vue').default);
Vue.component('configuration', require('./components/Configuration.vue').default);
Vue.component('tags', require('./components/Tags.vue').default);
Vue.component('property-ops-card', require('./components/Oportunities/Property-ops-card.vue').default);
Vue.component('note-action', require('./components/Oportunities/Note-actions.vue').default);
Vue.component('status-oportunities', require('./components/Oportunities/Status-oportunities.vue').default);
Vue.component('new-oportunity', require('./components/Oportunities/New-oportunity.vue').default);
Vue.component('contact-card', require('./components/Oportunities/Contact-card.vue').default);
Vue.component('oportunities', require('./components/Oportunities/Oportunities.vue').default);
Vue.component('oportunities-table', require('./components/Oportunities/Oportunities-table.vue').default);
Vue.component('properties', require('./components/Properties.vue').default);
Vue.component('property', require('./components/Property.vue').default);
Vue.component('properties-recomended', require('./components/Properties-recomended.vue').default);
Vue.component('properties-card', require('./components/Properties-cards.vue').default);
Vue.component('property-card', require('./components/Property-card.vue').default);
Vue.component('profile', require('./components/Profile.vue').default);
Vue.component('users', require('./components/Users.vue').default);
Vue.component('users-form', require('./components/Users-form.vue').default);
Vue.component('company', require('./components/Company.vue').default);
Vue.component('image-propertie', require('./components/ImagesProperty.vue').default);
Vue.component('nav-guest', require('./components/Navs/NavGuest.vue').default);
Vue.component('nav-admin', require('./components/Navs/NavAdmin.vue').default);
Vue.component('nav-aside', require('./components/Navs/NavAside.vue').default);
Vue.component('nav-user', require('./components/Navs/NavUser.vue').default);
Vue.component('nav-agent', require('./components/Navs/NavAgent.vue').default);
Vue.component('status', require('./components/Status.vue').default);
Vue.component('currency', require('./components/Currency.vue').default);
Vue.component('properties-user', require('./components/PropertiesUser.vue').default);
Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('categories', require('./components/Categories.vue').default);
Vue.component('reports', require('./components/Reports.vue').default);
Vue.component('historical', require('./components/Historical.vue').default);
Vue.component('services', require('./components/Services.vue').default);
Vue.component('environments', require('./components/Environments.vue').default);
Vue.component('properties-web', require('./components/Properties-web.vue').default);
Vue.component('properties-fav', require('./components/Properties-fav.vue').default);
Vue.component('contacts-import', require('./components/Contacts-import.vue').default);
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
