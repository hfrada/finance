/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import VueRouter from 'vue-router';


Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar-component', require('./components/NavbarComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
	// dashboard
	{ path: '/dashboard', name: 'dashboard', component: require('./components/ExampleComponent.vue').default},
	// category
 	{ path: '/category', name: 'categoryMain', component: require('./category/main.vue').default},
 	{ path: '/category/:id', name: 'categoryForm', component: require('./category/form.vue').default},
 	// financial
 	{ path: '/financial', name: 'financialMain', component: require('./financial/main.vue').default},
 	{ path: '/financial/:id', name: 'financialForm', component: require('./financial/form.vue').default},
 	// { path: '/financial/statistic', name: 'financialStatisticMain', component: require('./financial/financialStatistic/main.vue').default},
 	// { path: '/financial/statistic', name: 'financialStatisticForm', component: require('./financial/financialStatistic/form.vue').default},
];

const router = new VueRouter({
	root: '/',
	routes
});

const app = new Vue({
    el: '#app',
    router: router,
});
