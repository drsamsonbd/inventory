let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let home = require('./components/home.vue').default;

let logout = require('./components/auth/logout.vue').default;

//pentadbir
let user= require('./components/admin/user.vue').default;
let department= require('./components/admin/department.vue').default;

 // Supplier Component 
 let storesupplier = require('./components/supplier/create.vue').default;
 let supplier = require('./components/supplier/index.vue').default;
 let editsupplier = require('./components/supplier/edit.vue').default;

//Category component
let storecategory= require('./components/category/create.vue').default;
let category= require('./components/category/index.vue').default;
let editcategory= require('./components/category/edit.vue').default;

//product component
let storeproduct= require('./components/product/create.vue').default;
let product= require('./components/product/index.vue').default;
let editproduct= require('./components/product/edit.vue').default;

//finance component
let allocation = require('./components/finance/index.vue').default;
let code = require('./components/finance/category.vue').default;

//items component
let items = require('./components/items/index.vue').default;

//profile component
let profile = require('./components/user/UserAccountDetails.vue').default;


export const routes = [
    { path: '/', component: login, name: '/' },
    { path: '/register', component: register, name:'register' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/logout', component: logout, name:'logout' },
    { path: '/home', component: home, name:'home' },

    // Admin Routes
    { path: '/user', component: user, name:'user' },
    { path: '/department', component: department, name:'department' },
    // Category
    { path: '/category', component: category, name:'category' },
    { path: '/store-category', component: storecategory, name:'store-category' },
    { path: '/edit-category/:id', component: editcategory, name:'edit-category' },

      // Supplier Routes
  { path: '/store-supplier', component: storesupplier, name:'store-supplier'},
  { path: '/supplier', component: supplier, name:'supplier'},
  { path: '/edit-supplier/:id', component: editsupplier, name:'edit-supplier'},

    //product routes
    { path: '/product', component: product, name:'product' },
    { path: '/store-product', component: storeproduct, name:'store-product' },
    { path: '/edit-product/:id', component: editproduct, name:'edit-product' },


    //finance routes
    { path: '/allocation', component: allocation, name:'allocation' },
    { path: '/code', component: code, name:'code' },

     //item routes
     { path: '/items', component: items, name:'items' },


     //profile routes
     { path: '/profile', component: profile, name:'profile' },

  ]