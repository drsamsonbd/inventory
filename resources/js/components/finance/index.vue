  

<template>
  
  <div>
 <b-breadcrumb :items="items"></b-breadcrumb>
 <hr>
 <div class="row">
   <div class="col-lg-12 mb-4">
   <div>
    <b-button size="sm" variant="outline-primary" id="show-btn" @click="showModal">Daftar Pengguna</b-button>

    <b-modal ref="my-modal" hide-footer title="Daftar Pengguna">
    
           <form class="user" @submit.prevent="register">
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Nama mengikut kad pengenalan" v-model="form.name">
                     <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                    </div>            
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" v-model="form.email" id="exampleInputEmail" aria-describedby="emailHelp"  placeholder="Alamat email rasmi"> 
                      <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                    </div>
                     <div class="form-group">
                      <label>Nombor K/P</label>
                      <input type="text" class="form-control" id="ICnumber" v-model="form.icno">
                         <small class="text-danger" v-if="errors.icno">{{errors.icno[0]}}</small>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" v-model="form.password">
                   <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                    </div>
                    <div class="form-group">
                      <label>Confirm Password</label>
                      <input type="password" class="form-control" id="exampleInputPasswordRepeat" placeholder="Confirm Password" v-model="form.password_confirmation">
                         <small class="text-danger" v-if="errors.password_confirmation">{{errors.password_confirmation[0]}}</small>
                    </div>
                  
                   <div class="form-group">
                      <label>Role(s):</label>
                     
                        <input type="text" class="form-control" placeholder="Roles: admin, finance, head, user" v-model="form.roles">
                     
                    </div>
                    <div class="form-group">
                      <button type="submit"  class="btn btn-primary btn-block">Daftar</button>
                    </div>
                    <hr>
                 
                  </form>            
               
          
      </b-modal>
  </div>
  <!--userUpdate Modal-->
  <div>
  <b-modal ref="edit-modal" hide-footer title="Kemaskini Pengguna">     
          <form class="user" @submit.prevent="userUpdate"> 
                    <div class="form-group" hidden>
                      <label>User ID:</label>
                      <input type="hidden" class="form-control" id="exampleInputID" placeholder="ID" v-model="forms.id">
                     <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
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
                      <label>Role(s):</label>
                     
                        <input type="text" class="form-control" v-model="forms.roles">
                     
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block" @click="UpdateUser(user.id)">Kemaskini</button>
               
                    </div>
               
                  </form> 
   </b-modal>
   </div>
<!--userUpdate Modal-->


 </div>
 </div>

   <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Carian pengguna">


<br>

   <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Senarai Pengguna</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Nama</th>
                          <th>No. Kad Pengenalan</th>
                          <th>Email</th>
                          <th>Role</th>
                            <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="user in filtersearch" :key="user.id">
                        <td> {{ user.name }} </td>
                        <td> {{ user.icno }} </td>
                        <td> {{ user.email }} </td>
                        <td> {{ user.roles }} </td>
                       
            <td>

<b-button id="toggle-btn" @click="editUser(user.id)">Edit</b-button>

 <a @click="deleteUser(user.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
            </td>
                      </tr>
                    
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->








   
  </div>


</template>



<script type="text/javascript">
  
  export default {
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
  
    },
     mounted(){
     let roles = localStorage.getItem('roles');
    if(roles.includes("finance")-1){
      this.$router.push({name: 'home'})
      Notification.unauthorized()
    }
      },
    
     created(){
  	let id = this.$route.params.id
  	axios.get('/api/user/'+id)
  	.then(({data}) => (this.form = data))
  	.catch(console.log('error'))
  },
   
     data(){
      return{
        users:[],
        searchTerm:'',
        
          form:{
          name: null,
          email: null,
          icno: null,
          password: null,
          confirm_password: null,
          roles: null,
      
        },
          forms:{
          name: null,
          email: null,
          icno: null,
          roles: null,
      
        },
        errors:{},     
        
        items: [
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
      }
 





    },
    computed:{
      filtersearch(){
      return this.users.filter(user => {
         return user.name.match(this.searchTerm)
      }) 
      }
    },
 
  methods:{
    allUser(){
      axios.get('/api/user/')
      .then(({data}) => (this.users = data))
      .catch()
    },
      deleteUser(id){
                Swal.fire({
                  title: 'Anda pasti?',
                  text: "Tindakan ini memadamkan data!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Teruskan'
                }).then((result) => {
                  if (result.value) {
                    axios.delete('/api/user/'+id)
                  .then(() => {
                    this.users = this.users.filter(user => {
                      return user.id != id
                    })
                  })
                  .catch(() => {
                    this.$router.push({name: 'senarai'})
                  })
                    Swal.fire(
                      'Deleted!',
                      'Telah dipadamkan.',
                      'success'
                    )
                  }
                })

      },
      showModal() {
        this.$refs['my-modal'].show()
      },
       hideModal() {
        this.$refs['edit-modal'].hide()
      },
       toggleModal() {
        // We pass the ID of the button that we want to return focus to
        // when the modal has hidden
        this.$refs['edit-modal'].toggle('#toggle-btn')
       
      },
   
       register(){
          axios.post('/api/auth/register', this.form)
          .then(() => {
        window.location.reload()
        Notification.success()
       })
          .catch(error=> this.errors = error.response.data.errors)
          .catch(
            Toast.fire({
              icon: 'warning',
              title: 'Invalid data entry'
            })
          )
        },
        editUser(id){
         
           axios.get('/api/user/'+id)
  	.then(({data}) => (this.forms = data))
  	this.$refs['edit-modal'].toggle('#toggle-btn');
        },

      userUpdate(){
       let id = this.forms.id
       axios.patch('/api/user/'+id, this.forms)
       .then(() => {
        window.location.reload()
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
    

  },
  created(){
    this.allUser();
  },
  }

  
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>