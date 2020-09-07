require('./bootstrap')

import Vue from 'vue'

/**
 * Import and setup Inertia.js
 **/
import { InertiaApp } from '@inertiajs/inertia-vue'

import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(InertiaApp)

const router = new VueRouter({
    mode: 'history',
    routes: routes
});
 
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
