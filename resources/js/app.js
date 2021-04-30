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

//---Start VForm------
import { Form, HasError, AlertError } from 'vform'

window.Form = Form;

Vue.component(HasError.name, HasError);

Vue.component(AlertError.name, AlertError);

//---End VForm------

//---Start Sweetalert2--------
import Swal from 'sweetalert2';

window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.Toast = Toast;
//---End Sweetalert2--------

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

//----Start CKEditor----
import CKEditor from '@ckeditor/ckeditor5-vue2';

Vue.use( CKEditor );
//----End CKEditor----



Vue.component('example-component', require('./components/ExampleComponent.vue').default);



const app = new Vue({
    el: '#app',
    router,
    store
});
