/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

export  const  eventEmitter =new Vue()
import VueToastr from "vue-toastr";
import VueTheMask from 'vue-the-mask'
// use plugin
Vue.use(VueToastr, {
    /* OverWrite Plugin Options if you need */
});
Vue.use(VueTheMask);
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
Vue.component('cart', require('./components/Cart').default);
Vue.component('button-add', require('./components/ButtonAdd').default);
Vue.component('orders-table', require('./components/OrdersTable').default);
Vue.component('order-form', require('./components/OrderForm').default);
Vue.component('customer-table', require('./control/CustomerTable').default);
Vue.component('customer-form', require('./control/CustomerForm').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
