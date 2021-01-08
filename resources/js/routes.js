let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let home = require('./components/home.vue').default;

let logout = require('./components/auth/logout.vue').default;
//pengguna
let adduser= require('./components/pengguna/create.vue').default;
let senarai= require('./components/pengguna/index.vue').default;
export const routes = [
    { path: '/', component: login, name: '/' },
    { path: '/register', component: register, name:'register' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/logout', component: logout, name:'logout' },
    { path: '/home', component: home, name:'home' },
    { path: '/add-user', component: adduser, name:'add-user' },
    { path: '/senarai', component: senarai, name:'senarai' },
  ]