
<template>
  
  <div>
       <b-breadcrumb :items="itemize"></b-breadcrumb>
   <div class="container-fluid" id="container-wrapper">
 

          <div class="row mb-3">
            

            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
         <a class="btn btn-sm btn-info"><font color="#ffffff">Add user</font></a>         
                  
                </div>
                


 
                
                <div class="table-responsive" style="font-size: 12px;">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

          <tr v-for="cart in carts" :key="cart.id">
            <td>{{ cart.pro_name }}</td>
            <td><input type="text" readonly="" style="width: 15px;" :value="cart.pro_quantity">
       <button @click.prevent="increment(cart.id)" class="btn btn-sm btn-success">+</button>
   <button  @click.prevent="decrement(cart.id)" class="btn btn-sm btn-danger" v-if="cart.pro_quantity >= 2">-</button>
   <button class="btn btn-sm btn-danger" v-else="" disabled="">-</button>

            </td>
            <td>{{ cart.item_price  }}</td>
            <td>{{ cart.sub_total }}</td>
   <td><a @click="removeItem(cart.id)" class="btn btn-sm btn-primary"><font color="#ffffff">X</font></a></td>
          </tr>
                      
                       
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
            <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
  <strong>{{ qty }}</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
  <strong>{{ subtotal }} $</strong>
   </li>

     <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
  <strong>{{ vats.vat }} %</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Total :
  <strong>{{ subtotal*vats.vat /100 + subtotal}} $</strong>
   </li> 
              
            </ul>   
            <br> 

        <form @submit.prevent="orderdone">
          <label>user Name</label>
          <select class="form-control" v-model="user_id">
         <option :value="user.id" v-for="user in users">{{user.name }} </option>
                 
           </select>

           <label>Pay</label>
           <input type="text" class="form-control" required="" v-model="pay">

           <label>Due</label>
           <input type="text" class="form-control" required="" v-model="due">

          <label>Pay By</label>
          <select class="form-control" v-model="payby">
                 <option value="HandCash">Hand Cash </option>
                 <option value="Cheaque">Cheaque </option>
                 <option value="GiftCard">Gift Card </option>
           </select>

           <br>
           <button type="submit" class="btn btn-success">Submit</button>

        </form>    



                </div>
             






              </div>
            </div>
            <!-- Pie Chart -->



            <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Item</h6>
                  </div>

   <!--  Category Wise item -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All item </a>
  </li>
  

  <li class="nav-item" v-for="category in categories" :key="category.id" >
    
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="subitem(category.id)" >{{ category.category_name }}</a>
  </li>


   
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

<div class="card-body">
  <div class="row">
<div class="col-sm-12 col-12">   
 <input type="text" v-model="searchTerm" class="form-control"  placeholder="Search item">
</div></div> <br>
     <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-6 overflow-auto" v-for="item in items" :key="item.id"
      >

             <button class="btn btn-sm" @click.prevent="AddToCart(item.id)">
             <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
              <img v-for="item in items"  v-bind:key="item.id" :src="item.image" id="em_photo" class="card-img-top">
    <div class="card-body" v-for="item in items"  v-bind:key="item.id">
    <h6 class="card-title" v-for="item in items"  v-bind:key="item.id" >{{ item.descriptions}}</h6>
    <span class="badge badge-success" v-if="item.item_quantity  >= 1 ">Available {{ item.item_quantity }}  </span> 
    <span class="badge badge-danger" v-else=" ">Stock Out </span> 
                
              </div>
          
            </div>
            
            </button>
         
        </div>   
          
      </div>
      <div class="row">
            <div class="col-md-6">
                <nav>
                    <ul class="pagination">
                       <li v-bind:class="{disabled:!pagination.first_link}" class="page-item"><a href="#" @click="viewItem(pagination.first_link)" class="page-link">&laquo;</a></li>
                        <li v-bind:class="{disabled:!pagination.prev_link}" class="page-item"><a href="#" @click="viewItem(pagination.prev_link)" class="page-link">&lt;</a></li>
                        <li v-for="n in pagination.last_page" v-bind:key="n" v-bind:class="{active:!pagination.current_page == n}" class="page-item"><a href="#" @click="viewItem(pagination.path_page + n)" class="page-link">{{n}}</a></li>
                        <li v-bind:class="{disabled:!pagination.next_link}" class="page-item"><a href="#" @click="viewItem(pagination.next_link)" class="page-link">&gt;</a></li>                   
                        <li v-bind:class="{disabled:!pagination.last_link}" class="page-item"><a href="#" @click="viewItem(pagination.last_link)" class="page-link">&raquo;</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4">
                Page:{{pagination.from_page}}-{{pagination.to_page}}
                Total: {{pagination.total_page}}
            </div>
      </div>

     </div>


  </div>  <!--  End TBAS HOME -->



 

  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


<input type="text" v-model="getsearchTerm" class="form-control" style="width: 560px;" placeholder="Search item">

     <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getitem in getfiltersearch" :key="getitem.id"
      
      >
            <button class="btn btn-sm" @click.prevent="AddToCart(getitem.id)">
             <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
              <img :src="getitem.image" id="em_photo" class="card-img-top">
              <div class="card-body">
                <h6 class="card-title">{{ getitem.item_name }}</h6>
       <span class="badge badge-success" v-if="getitem.item_quantity  >= 1 ">Available {{ getitem.item_quantity }}  </span> 
    <span class="badge badge-danger" v-else=" ">Stock Out </span> 
                
              </div>
            </div></button>
          
        </div>        
      </div>




  </div>
  
</div>
<!-- End Category Wise item -->


                



                </div>
                 
              </div>
            </div>


           
          </div>
          <!--Row-->

           

        </div> 
  </div>


</template>



<script type="text/javascript">
  
  export default {
    
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
    },

    created(){
    this.allitem();
    this.allCategory();
    this.alluser();
    this.cartitem();
    this.vat();
    Reload.$on('AfterAdd',() =>{
      this.cartitem();
       this.viewItem();
    })

   }, 
 data(){
      return{
       user_id:'',
       pay:'',
       due:'',
       payby:'',

        items:[],
        item:{
            id:'',
            descriptions:'',
            image:''
        },
        categories:'',

        
       
        pagination:'',
        getitems:[],
        searchTerm:'',
        getsearchTerm:'',
        users:'',
        errors:'',
        carts:[],
        vats:'',


              itemize: [
          {
            text: 'Dashboard',
            href: '/'
          },
          {
            text: 'Items',
            href: '#/items'
          },
           {
            text: 'Pengeluaran',
            active: true
          },
        ],
      }
      
    },
    computed:{
      filtersearch(){
      return this.items.filter(item => {
         return item.descriptions.match(this.searchTerm)
      }) 
      },
       getfiltersearch(){
      return this.getitems.filter(getitem => {
         return getitem.descriptions.match(this.getsearchTerm)
       }) 
      },
   qty(){
    let sum = 0;
    for(let i = 0; i < this.carts.length; i++){
          sum += (parseFloat(this.carts[i].pro_quantity));      
        }
        return sum;
   },
   subtotal(){
    let sum = 0;
    for(let i = 0; i < this.carts.length; i++){
    sum += (parseFloat(this.carts[i].pro_quantity) * parseFloat(this.carts[i].item_price));      
        }
       return sum;

      },
      rows() {
        return this.items.length
      }

    },
 
  methods:{
    // Cart Methods Here
  AddToCart(id){
   axios.get('/api/addToCart/'+id)
      .then(() => {
        Reload.$emit('AfterAdd');
        Notification.cart_success()
      })
      .catch()
  },
  cartitem(){
      axios.get('/api/cart/item/')
      .then(({data}) => (this.carts = data))
      .catch()
  },
  removeItem(id){
   axios.get('/api/remove/cart/'+id)
      .then(() => {
        Reload.$emit('AfterAdd');
        Notification.cart_delete()
      })
      .catch()
  },
  increment(id){
  axios.get('/api/increment/'+id)
      .then(() => {
        Reload.$emit('AfterAdd');
        Notification.success()
      })
      .catch()
  },
   decrement(id){
    axios.get('/api/decrement/'+id)
      .then(() => {
        Reload.$emit('AfterAdd');
        Notification.success()
      })
      .catch() 
  }, 
  vat(){
       axios.get('/api/vats/')
      .then(({data}) => (this.vats = data))
      .catch()
  },
  orderdone(){
    let total = this.subtotal*this.vats.vat /100 + this.subtotal;
    var data = {qty:this.qty, subtotal:this.subtotal, user_id:this.user_id, payby:this.payby, pay:this.pay, due:this.due, vat:this.vats.vat, total:total }

    axios.post('/api/orderdone',data)
       .then(() => {
          Notification.success()
         this.$router.push({name: 'home'})
       }) 

  },
   
    // End Cart Methods 
    allitem(){

     let self = this;  
     let team_id= localStorage.getItem('current_team_id');
     axios.get('/api/stock/out/'+team_id)
      .then(function (response) {
        self.items = response.data;
        }) 
    },

    viewItem(pagi) {
       let team_id= localStorage.getItem('current_team_id'); 
        pagi = pagi ||'/api/stock/out/'+team_id;
        fetch(pagi)
        .then(res =>{
            this.items = res.data;
            this.pagination = {
                current_page: res.meta.current_page,
                last_page: res.meta.last_page,
                from_page: res.meta.from_page,
                to_page: res.meta.to_page,
                total_page: res.meta.total_page,
                path_page: res.meta.path+"?page=",
                fist_link: res.links.first,
                last_link: res.links.prev,
                next_link: res.links.next

            }

        })
              axios.get('api/items?page=' + page)
                .then(response => {
                  this.items = response.data;
              });
        },

     allCategory(){
      axios.get('/api/category/')
      .then(({data}) => (this.categories = data))
      .catch()
    },

    alluser(){
      axios.get('/api/user/')
      .then(({data}) => (this.users = data))
      .catch(console.log('error'))
    },
    subitem(id){
        let self= this;
      axios.get('/api/items/out/'+id)
         .then(function (response) {
        self.getitems = response.data;
         
 
});
    } 
   

    }  

  } 

</script>


<style type="text/css" scoped>
  #em_photo{
    height: 100px;
    width: 135px;
  }
</style>