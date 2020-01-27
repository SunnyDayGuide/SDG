
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// window.$ = window.jQuery = require('jquery');

require('selectize');

import swal from 'sweetalert';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('nav-weather', require('./components/NavWeatherComponent.vue').default);
Vue.component('show-schedule', require('./components/ShowScheduleComponent.vue').default);
Vue.component('contact-form-modal', require('./components/ContactFormModal.vue').default);

import VModal from 'vue-js-modal';
Vue.use(VModal);

const app = new Vue({
    el: '#app'
});



