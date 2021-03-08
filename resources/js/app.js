require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// Router Imported
import {routes} from './routes';

// Import user class
import User from './Helpers/User';
window.User = User

 // Import Notification Class
 import Notification from './Helpers/Notification';
 window.Notification = Notification

 // vue pagination
 Vue.component('pagination', require('laravel-vue-pagination'));


// Sweet Alert Start

import Swal from 'sweetalert2'
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

// Sweet Alert End
const router = new VueRouter({
    routes // short for `routes: routes`
  })

  const app = new Vue({
    router
  }).$mount('#app')
