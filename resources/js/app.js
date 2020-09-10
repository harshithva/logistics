/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Fragment from 'vue-fragment'
import VueRouter from 'vue-router'
import { store } from './store/store'


import router from './router/router.js';
import BootstrapVue from 'bootstrap-vue'
const axios = require('axios').default;


axios.defaults.baseURL = '/';
axios.defaults.withCredentials = true;

import VueQrcode from '@chenfengyuan/vue-qrcode';
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

import Vue from 'vue'
import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'



import 'bootstrap-vue/dist/bootstrap-vue.css';


import moment from 'moment';
Vue.prototype.moment = moment
window.moment = moment

import Swal from 'sweetalert2'
window.Swal = Swal;

import { v4 as uuidv4 } from 'uuid';
window.uuidv4 = uuidv4;

// helpers
import Form from './Helpers/Form'
window.Form = Form

import VueBarcode from "vue-barcode";


import excel from 'vue-excel-export'
Vue.use(excel)



import VueGoodTablePlugin from 'vue-good-table';
// import the styles
import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTablePlugin);


import Print from 'vue-print-nb'
Vue.use(Print);


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Dashboard', require('./components/Dashboard.vue').default);
Vue.component('CustomerDashboard', require('./components/CustomerDashboard.vue').default);
Vue.component('TrackingComponent', require('./components/customer-components/TrackingComponent.vue').default);
Vue.component('FeedBackComponent', require('./components/customer-components/FeedBackComponent.vue').default);
Vue.component('Login', require('./components/auth/Login').default);
Vue.component('Docket', require('./components/globals/Docket.vue').default);

Vue.component(VueQrcode.name, VueQrcode);
Vue.component('barcode', VueBarcode);
Vue.use(BootstrapVue);
Vue.component("vSelect", vSelect);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(Chartkick.use(Chart))


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 * 
 */



Vue.use(Fragment.Plugin);

const app = new Vue({
    el: '#wrapper',
    router,
    store,
    created() {
        const userInfo = localStorage.getItem('user')
        if (userInfo) {
            const userData = JSON.parse(userInfo)
            this.$store.commit('setUserData', userData)
        }
        axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response.status === 401) {
                    this.$store.dispatch('logout')
                }
                return Promise.reject(error)
            }
        )
    },
});
