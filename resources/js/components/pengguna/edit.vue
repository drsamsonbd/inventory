<template>


  <div>

 <div class="row">
    <div class="col-sm-12 ">
  <router-link to="/senarai" class="btn-sm btn-primary">Senarai Pengguna </router-link>
    </div>
 </div>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Kemaskini</h1>
                  </div>
               <form class="user" @submit="userUpdate">
                    <div class="form-group">
                      <label>Full Name</label>
                      <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Full Name" v-model="form.name">
                     <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                    </div>            
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address" v-model="form.email">
                         <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                    </div>
                     <div class="form-group">
                      <label>IC Number</label>
                      <input type="text" class="form-control" id="InputIC" aria-describedby="IClHelp"
                        placeholder="IC No" v-model="form.icno">
                         <small class="text-danger" v-if="errors.icno">{{errors.icno[0]}}</small>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" v-model="form.password">
                   <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                    </div>
                    <div class="form-group">
                      <label>Confirm Password</label>
                      <input type="password" class="form-control" id="exampleInputPasswordRepeat"
                        placeholder="Confirm Password" v-model="form.password_confirmation">
                         <small class="text-danger" v-if="errors.password_confirmation">{{errors.password_confirmation[0]}}</small>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Kemaskini</button>
                    </div>
                    <hr>
                 
                  </form>            
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
</template>


<script type="text/javascript">
export default{
  created(){
    if(!User.loggedIn()){
      this.$router.push({name:'home'})
    }
  },

data(){
  return{
        form:{
          name: null,
          email: null,
          icno: null,
          password: null,
          confirm_password: null
        },
        errors:{}
      }
} ,
  created(){
  	let id = this.$route.params.id
  	axios.get('/api/user/'+id)
  	.then(({data}) => (this.form = data))
  	.catch(console.log('error'))
  },

  methods:{
    
 userUpdate(){
  	  let id = this.$route.params.id
       axios.patch('/api/user/'+id,this.form)
       .then(() => {
        this.$router.push({ name: 'senarai'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  } 

  }



</script>

<style type="text/css">

</style>