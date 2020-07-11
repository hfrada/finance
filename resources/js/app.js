/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import VueToastr2 from 'vue-toastr-2';
import Permissions from './Services/mixin/permissions';
import { Store } from './Services/store/state.js';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';
import 'vue-toastr-2/dist/vue-toastr-2.min.css';

window.Vue = require('vue');
window.toastr = require('toastr');

Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.use(VueToastr2);

Vue.mixin(Permissions);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar-component', require('./Components/NavbarComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
	// dashboard
	{ path: '/', name: 'dashboard', component: require('./home.vue').default },
	// category,
 	{ path: '/category', name: 'categoryMain', component: require('./Layout/category/main.vue').default },
 	{ path: '/category/:id', name: 'categoryForm', component: require('./Layout/category/form.vue').default },
 	// financial
 	{ path: '/financial', name: 'financialMain', component: require('./Layout/financial/main.vue').default },
 	{ path: '/financial/:id', name: 'financialForm', component: require('./Layout/financial/form.vue').default },
 	// role
 	{ path: '/role', name: 'roleMain', component: require('./Layout/role/main.vue').default },
 	{ path: '/role/:id', name: 'roleForm', component: require('./Layout/role/form.vue').default },
];

const store = new Vuex.Store(Store);

const router = new VueRouter({
	root: '/',
	routes
});

const app = new Vue({
    el: '#app',
    store,
    router: router,
    vuetify: new Vuetify(),
    async created() {
    	await store.commit('getCategory');
    	await store.commit('getUsersNames');
    	await store.commit('getPermissions');
        await store.commit('getAdminData');
    },
});