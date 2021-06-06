  

<template v-for="table">
  
  <div>
 <b-breadcrumb :items="itemize"></b-breadcrumb>
 <hr>
 <div class="row">
   <div class="col-lg-12 mb-4">

  <b-container>
    <!--userUpdate Modal-->
    <b-row>
    <b-col  sm="8"  class="shadow-sm- p-4 mb-4 bg-white" ref="edit-modal" hide-footer title="Kemaskini Pengguna">     
            <form class="user" @submit.prevent="userUpdate"> 
                      <div class="form-group" hidden>
                      <label>User ID:</label>
                      <input type="hidden" class="form-control" id="exampleInputID" placeholder="ID" v-model="forms.id">
                     
                    </div>  
                    <div class="form-group">
                      <label>Full Name</label>
                      <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Full Name" v-model="forms.name">
                     <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                    </div>            
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address" v-model="forms.email">
                         <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                    </div>
                     <div class="form-group">
                      <label>IC Number</label>
                      <input type="text" class="form-control" id="InputIC" aria-describedby="IClHelp"
                        placeholder="IC No" v-model="forms.icno">
                         <small class="text-danger" v-if="errors.icno">{{errors.icno[0]}}</small>
                    </div>              
                        <div class="form-group">
                      <button type="submit" id="myBtn" class="btn btn-primary btn-block">Kemaskini</button>
               
                    </div>
               
                  </form> 
  
   
<!--userUpdate Modal-->



  <!--userReset Modal-->
   </b-col>
   
    
    <b-col sm="3"  class="shadow-sm p-4 mb-4 bg-white" ref="reset-modal" hide-footer title="Tetapkan semula kata laluan">     
    <b-row>
    <b-col>   
       <a><h5><b>Kemaskini kata laluan</b></h5></a>  </b-col></b-row>
          <form class="user" @submit.prevent="ResetUser"> 
                                   

                     <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" id="InputPassword"
                        placeholder="IC No" v-model="formr.password">
                         <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                    </div>  
                     <div class="form-group">
                      <label>Confirm Password</label>
                      <input type="password" class="form-control" id="exampleInputPasswordRepeat" placeholder="Confirm Password" v-model="formr.password_confirmation">
                         <small class="text-danger" v-if="errors.password_confirmation">{{errors.password_confirmation[0]}}</small>
                    </div>            
                    
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block" >Tetapkan semula</button>
               
                    </div>
               
                  </form> 
   </b-col>
</b-row>
  </b-container>
   </div>
<!--userReset Modal-->


</div>
</div>


          <!--Row-->


</template>



<script type="text/javascript">
 
  export default {
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
 this.User();
        
      }
  
    },
     mounted(){
     let roles = localStorage.getItem('roles');
      if(roles.includes("admin")-1){
      this.$router.push({name: 'home'})
      Notification.unauthorized()
    }
      },
      
    

   
     data(){
      return{
        users:[],
        searchTerm:'',
        
                forms:{
          name: null,
          email: null,
          icno: null,
          roles: null,
      
        },
        formr:{        
          password: null,
          confirm_password: null,
       
      
        },
        errors:{},     
        
        itemize: [
          {
            text: 'Dashboard',
            href: '/'
          },
          {
            text: 'Pengguna',
            active: true
          },
        ],
          modalShow: false,

        perPage: 20,
        currentPage: 1,
        pageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
        sortBy: 'name',
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
        filterOn: [],
        items: [],
        fields: [
          { key: 'name', label: 'Nama', sortable: true, sortDirection: 'asc' },
          { key: 'icno', label: 'No. Kad Pengenalan', sortable: true, sortDirection: 'desc' },
          { key: 'email', label: 'Email', sortable: true, sortDirection: 'desc' },
          { key: 'roles', label: 'Roles', sortable: true, sortDirection: 'desc' },
          { key: 'actions', label: 'Actions' },
        ],
        table:'',
      }
 





    },
    computed:{
      filtersearch(){
      return this.users.filter(user => {
         return user.name.match(this.searchTerm)
      }) 
      },
      rows() {
        return this.items.length
      }
    },
 
  methods:{
    User(){
    let id = localStorage.getItem('user_id')
  	axios.get('/api/user/'+id)
  	.then(({data}) => (this.forms = data))
  	.catch(console.log('error'))
  
    },
 
     

      userUpdate(){
       let id = this.forms.id
       axios.patch('/api/user/'+id, this.forms)
       .then(() => {    
         let self = this;
        axios.get('/api/user/')
       .then(function (response) {
        self.items = response.data;
        })
        Notification.success();
    
       })
       .catch(error =>this.errors = error.response.data.errors)
       
     },
       ResetUser(){
       let id = localStorage.getItem('user_id')
       axios.post('/api/password/selfupdate/'+id, this.formr)
       .then(() => {

        Notification.success()
        this.$router.push({name: '/'})
       })
       .catch(error =>this.errors = error.response.data.errors)
       
     },
   
  },

      
  mounted: function(){
    this.User();
 
  }
  }


   
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>