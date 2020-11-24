/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from "vue";
require("./bootstrap");
// import service
import "./assets/select-provider-&-articles-fix";
import Axios from "axios";

import Swal from "sweetalert2";
window.Swal = Swal;

import { Form, HasError, AlertError } from "vform";
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});
window.Toast = Toast;

Vue.component("pagination", require("laravel-vue-pagination"));

import AssignmentsComputersComponent from "./components/assignments/AssignmentsComputersComponent.vue";
import AssignComputerComponent from "./components/AssignComputerComponent.vue";
import AssignTabletComponent from "./components/AssignTabletComponent.vue";
import AssignmentsTabletsComponent from "./components/assignments/AssignmentsTabletsComponent.vue";
import AssignMonitorComponent from "./components/AssignMonitorComponent.vue";
import AssignmentsMonitorsComponent from "./components/assignments/AssignmentsMonitorsComponent.vue";
import AssignOtherPeripheralsComponent from "./components/AssignOtherPeripheralsComponent.vue";
import AssignmentsPeripheralsComponent from "./components/assignments/AssignmentsPeripheralsComponent.vue";

const app = new Vue({
    components: {
        "assignments-computers": AssignmentsComputersComponent,
        "assign-computer": AssignComputerComponent,
        "assign-tablet": AssignTabletComponent,
        "assignments-tablets": AssignmentsTabletsComponent,
        "assign-monitor": AssignMonitorComponent,
        "assignments-monitors": AssignmentsMonitorsComponent,
        "assign-peripheral": AssignOtherPeripheralsComponent,
        "assignments-peripherals": AssignmentsPeripheralsComponent
    },

    el: "#app",
    Axios
});
