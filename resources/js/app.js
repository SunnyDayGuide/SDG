
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.$ = window.jQuery = require('jquery')
require('selectize');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

/**
 * Assign jQuery to the window so that plugins can read it from the global scope. 
 * Then we are assigning the Selectize Plugin to any input with the id of “tags”.
 * https://laravel-news.com/how-to-add-tagging-to-your-laravel-app
 */

$( document ).ready(function() {
    $('#tags').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        valueField: 'tag',
        labelField: 'tag',
        searchField: 'tag',
        options: tags,
        create: function(input) {
            return {
                tag: input,
                value: input,
            }
        }
    });
});

