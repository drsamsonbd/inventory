  

<template>
  
  <div>

 <div class="row">
  <router-link to="/register" class="btn btn-primary">Tambah Pengguna </router-link>
   
 </div>
<br>
   <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">


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
                          <th>ID</th>
                          <th>email</th>
                            <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="user in filtersearch" :key="user.id">
                        <td> {{ user.name }} </td>
                        <td> {{ user.icno }} </td>
                        <td> {{ user.email }} </td>
                       
            <td>
   <router-link :to="{name: 'edit-user', params:{id:user.id}}" class="btn btn-sm btn-primary">Edit</router-link>

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
    data(){
      return{
        user:[],
        searchTerm:''
      }
    },
    computed:{
      filtersearch(){
      return this.users.filter(name => {
         return user.name.match(this.searchTerm)
      }) 
      }
    },
 
  methods:{
    allUser(){
      axios.get('/api/user/')
      .then(({data}) => (this.user = data))
      .catch()
    },
  deleteUser(id){
             Swal.fire({
              title: 'Anda pasti?',
              text: "Tindakan ini tidak boleh dikembalikan!",
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
                this.$router.push({name: 'user'})
               })
                Swal.fire(
                  'Deleted!',
                  'Telah dipadamkan.',
                  'success'
                )
              }
            })

  } 

  },
  created(){
    this.allUser();
  } 
  

  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>