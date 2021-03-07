<template>

<div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Tambah Jabatan/ Unit</h1>
                  </div>
                  <form class="dept" @submit.prevent="DeptInsert">
                    <div class="form-group">
                      <div class="form-row"> 
                         <div class="col">
                               <label>Nama Jabatan/ Unit</label>
                      <input type="text" class="form-control" id="deptName" placeholder="Sila masukkan nama jabatan atau unit" v-model="form.name_department">
                     <small class="text-danger" v-if="errors.name_department">{{errors.name_department[0]}}</small></div> 

                      </div>
                  
                    </div>            
          <div class="form-group">

          <div class="form-row">
            <div class="col">
            <label for="exampleFormControlSelect1">Nama Ketua Jabatan atau Unit</label>
             <select class="form-control" id="exampleFormControlSelect1" v-model="form.name_hod">
            <option :value="user.name" v-for="user in users" >{{ user.name }}</option>
                            
                            </select>   
        
                </div>
            </div>
             </div>

  <div class="form-group">

          <div class="form-row">
            <div class="col">
            <label for="exampleFormControlSelect2">Nombor KP Ketua Jabatan atau Unit</label>
             <select class="form-control" id="exampleFormControlSelect2" v-model="form.icno_hod">
            <option :value="user.icno" v-for="user in users" >{{ user.icno }}</option>
                            
                            </select>   
        
                </div>
            </div>
             </div>

 <div class="form-group">

          <div class="form-row">
            <div class="col">
            <label for="exampleFormControlSelect3">Nama Pengarah/ Penyelia</label>
             <select class="form-control" id="exampleFormControlSelect3" v-model="form.icno_director">
            <option :value="user.name" v-for="user in users" >{{ user.name }}</option>
                            
                            </select>   
        
                </div>
            </div>
             </div>


                  
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Hantar</button>
                    </div>
                    <hr>
                 
                  </form>
            
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
        name_department: null,
        name_hod: null,
        icno_hod: null,
        icno_director: null
      },
      errors:{},
      users:{},
      
    }
  },

  methods:{
 
  DeptInsert(){
       axios.post('/api/department',this.form)
       .then(() => {
        this.$router.push({ name: 'department'})
        Notification.success()  
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  },
  created(){
    axios.get('/api/user/')
    .then(({data}) => (this.users = data))

  } 


  }
   
</script>


<style type="text/css">
  
</style>