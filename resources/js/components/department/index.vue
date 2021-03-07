  

<template>
  
  <div>

 <div class="row">
  <router-link to="/add-department" class="btn btn-primary">Tambah Jabatan</router-link>
   
 </div>
<br>
   <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">


<br>

   <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Senarai Jabatan</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Nama Jabatan</th>
                          <th>Ketua Unit</th>
                          <th>No. KP </th>
                            <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="department in filtersearch" :key="department.id">
                        <td> {{ department.name_department }} </td>
                        <td> {{ department.name_hod }} </td>
                        <td> {{ department.icno_hod }} </td>
                       
            <td>
   <router-link :to="{name: 'edit-department', params:{id:department.id}}" class="btn btn-sm btn-primary">Edit</router-link>

 <a @click="deleteDepartment(department.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
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
        departments:[],
        searchTerm:''
      }
    },
    computed:{
      filtersearch(){
      return this.departments.filter(department => {
         return department.name_department.match(this.searchTerm)
      }) 
      }
    },
 
  methods:{
    allDeparment(){
      axios.get('/api/department/')
      .then(({data}) => (this.departments = data))
      .catch()
    },
  deleteDepartment(id){
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
                axios.delete('/api/department/'+id)
               .then(() => {
                this.users = this.departments.filter(department => {
                  return department.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'department'})
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
    this.allDeparment();
  } 
  

  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>