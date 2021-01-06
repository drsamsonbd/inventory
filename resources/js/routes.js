let login = require('./components/auth/login.vue').default;
let forget = require('./components/auth/forget.vue').default;

export const routes = [
    { path: '/', component: login, name: '/' },
    { path: '/forget', component: forget, name:'/forget' }
  ]