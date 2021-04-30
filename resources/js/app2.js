require('./bootstrap');
//Vue Js
window.Vue = require('vue');

//---Start Vue Router----
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import {routes} from "./routes/routes";

const router = new VueRouter({
    routes,
    // mode : 'history'
});

//---End Vue Router----


//----Start Vuex

import Vuex from 'vuex';

Vue.use(Vuex);
import storeData from "./store/store";
const store = new Vuex.Store(
    storeData
);

//----End Vuex

//----Filter
import {moment} from './filter/filter';
//---End Filter

Vue.component('public', require('./components/frontend/PublicMaster').default);
Vue.component('top_header', require('./components/frontend/Top_Header').default);

const app = new Vue({
    el: '#content',
    router,
    store
});
