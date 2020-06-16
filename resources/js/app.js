/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import Router from 'vue-router'

Vue.use(Vuetify)
Vue.use(Router)



require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


// Admin
Vue.component('welcome-page', require('./components/Welcome.vue').default);
Vue.component('admin-login', require('./components/admins/Login.vue').default);
Vue.component('admin-page', require('./components/admins/Dashboard.vue').default);
Vue.component('user-page', require('./components/admins/User.vue').default);
Vue.component('school-page', require('./components/admins/School.vue').default);
Vue.component('evaluation-page', require('./components/admins/Evaluation.vue').default);


// Faculty
Vue.component('faculty-login', require('./components/faculties/Login.vue').default);
Vue.component('faculty-page', require('./components/faculties/Home.vue').default);
Vue.component('rating-page',require('./components/faculties/Rating.vue').default);

// Student
Vue.component('student-login', require('./components/students/Login.vue').default);
Vue.component('student-page', require('./components/students/Home.vue').default);
Vue.component('student-evaluation-page', require('./components/students/Evaluation.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router: new Router(),
});
