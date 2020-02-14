
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

import { library } from '@fortawesome/fontawesome-svg-core'
import { faMinusCircle, faPlusCircle } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faMinusCircle, faPlusCircle)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('nav-weather', require('./components/NavWeatherComponent.vue').default);
Vue.component('show-schedule', require('./components/ShowScheduleComponent.vue').default);
Vue.component('contact-form-modal', require('./components/ContactFormModal.vue').default);
Vue.component('bucket-button', require('./components/BucketButtonComponent.vue').default);
Vue.component('bucket-counter', require('./components/BucketCounterComponent.vue').default);
Vue.component('bucket-item', require('./components/BucketItemComponent.vue').default);
Vue.component('font-awesome-icon', FontAwesomeIcon);

import VModal from 'vue-js-modal';
Vue.use(VModal);

import Vue from "vue"
import VueCookies from "vue-cookies-ts"
Vue.use(VueCookies)

const app = new Vue({
    el: '#app',

    methods: {
    	bucketItemAdded() {
    		// alert('bucket item added!');
    	},
    	bucketItemRemoved() {
    		// alert('bucket item removed!');
    	}
    }
});



