<template>
<div>


<div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form class="user" @submit.prevent="login">
                    <div class="form-group">
                      <input type="text" class="form-control" id="ICnumber"
                        placeholder="Sila isi nombor kad pengenalan tanpa '-'"  v-model="form.icno">
                        <small class="text-danger" v-if="errors.icno">{{errors.icno[0]}}</small>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword" placeholder="Kata laluan"  v-model="form.password">
                    <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>    
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small">Sila hubungi admin untuk bantuan.</a>
                  </div>                
                
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
    if(User.loggedIn()){
      this.$router.push({name:'home'})
    }
  },

data(){
  return{
        form:{
          icno: null,
          password: null
        },
        errors:{}
      }
} ,
      methods:{
        login(){
          axios.post('/api/auth/login', this.form)
          .then(res=> {
            User.responseAfterLogin(res)
            Toast.fire({
              icon: 'success',
              title: 'Signed in successfully'
})
            this.$router.push({name:'home'})            
               window.location.reload()   
            })
          .catch(error=> this.errors = error.response.data.errors)
          .catch(
            Toast.fire({
              icon: 'warning',
              title: 'Invalid email or password!'
            })
          )
        }
      }
  }



</script>

<style type="text/css">

</style>