/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue';
require('./bootstrap');
// import service
import './assets/select-provider-&-articles-fix';
import Axios from 'axios';

import Swal from 'sweetalert2'
window.Swal = Swal;

import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast;

import AssignmentsComputersComponent from "./components/AssignmentsComputersComponent.vue";
import AssignComputerComponent from "./components/AssignComputerComponent.vue";
import AssignTabletComponent from "./components/AssignTabletComponent.vue";
import AssignmentsTabletsComponent from "./components/AssignmentsTabletsComponent.vue";

const app = new Vue({
    components: {
        'assignments-computers': AssignmentsComputersComponent,
        'assign-computer': AssignComputerComponent,
        'assign-tablet': AssignTabletComponent,
        'assignments-tablets': AssignmentsTabletsComponent
    },

    el: '#app',
    Axios,

});
