<template>

<div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Daftar Pengguna</h1>
                  </div>
                  <form class="user" @submit.prevent="register">
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
                      <input type="text" class="form-control" id="ICnumber"
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
                      <label>Role(s):</label>
                     
                        <input type="text" class="form-control" placeholder="Roles: admin, finance, head, user" v-model="form.roles">
                     
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Daftar</button>
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
</template>


<script type="text/javascript">
export default{
  created(){
    if(!User.loggedIn()){
      this.$router.push({name:'/'})
    }
  },

data(){
  return{
        form:{
          name: null,
          email: null,
          icno: null,
          password: null,
          confirm_password: null,
          roles: null,
      
        },
        errors:{}
      }
} ,
      methods:{
        register(){
          axios.post('/api/auth/register', this.form)
          .then(res=> {
            Toast.fire({
              icon: 'success',
              title: 'Successfully registered'
})
            this.$router.push({name:'senarai'})            
        
            })
          .catch(error=> this.errors = error.response.data.errors)
         
        }
      }
  }



</script>

<style type="text/css">

</style>