let login = require('./components/auth/login.vue').default;


export const routes = [
    { path: '/', component: login, name: newFunction() },
    { path: '/bar', component: Bar }
  ]

function newFunction() {
    return '/';
}
