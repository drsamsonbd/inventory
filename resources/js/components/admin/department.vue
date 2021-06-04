  

<template>
  
  <div>
 <b-breadcrumb :items="itemize"></b-breadcrumb>
 
 <div class="row">
   <div class="col-lg-12 mb-4">
   
    <b-modal ref="my-modal" hide-footer title="Tambah Jabatan">
    
           <form class="user" @submit.prevent="registerDept">
                    <div class="form-group">
                      <label>Nama Jabatan</label>
                      <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Nama Jabatan" v-model="form.name_department">
                     <small class="text-danger" v-if="errors.name_department" >{{errors.name_department[0]}}</small>
                    </div>            
               
                     <div class="form-group">
                      <label>Ketua Jabatan</label>
                      <select class="form-control" id="ICnumber" v-model="form.icno_hod" aria-placeholder="Sila pilih nama ketua jabatan">
                        <option v-for="user in users" v-bind:key="user.icno" :value="user.icno"> {{user.name}} </option>
                        
                        </select>
                    </div>
                    <div class="form-group">
                      <button type="submit"  id="newDept-btn" class="btn btn-primary btn-block">Daftar</button>
                    </div>
                    <hr>
                 
                  </form>            
               
          
      </b-modal>
  </div>
  <!--Update Modal-->
  <div>
  <b-modal ref="edit-modal" hide-footer title="Kemaskini Jabatan">     
          <form class="user" @submit.prevent="update"> 
                    <div class="form-group" hidden>
                      <label>User ID:</label>
                      <input type="hidden" class="form-control" id="exampleInputID" placeholder="ID" v-model="forms.id">
                     
                    </div>  
                   <div class="form-group">
                      <label>Nama Jabatan</label>
                      <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Nama Jabatan" v-model="forms.name_department">
                     <small class="text-danger" v-if="errors.name_department" >{{errors.name_department[0]}}</small>
                    </div>            
               
                     <div class="form-group">
                      <label>Ketua Jabatan</label>
                      <select class="form-control" id="ICnumber" v-model="forms.icno_hod" aria-placeholder="Sila pilih nama ketua jabatan">
                        <option v-for="user in users "   v-bind:key="user.icno" :value="user.icno"> {{user.name}}</option>
                        
                        </select>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block" >Kemaskini</button>
               
                    </div>
               
                  </form> 
   </b-modal>
   </div>
<!--Update Modal-->


 </div>
 

   <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Senarai Jabatan</h6>
                </div>



<b-row>
   <b-col sm="2" class="my-1" align="left">
           <b-button size="sm" variant="outline-primary" id="show-btn" @click="showModal">Tambah Jabatan</b-button>
        </b-col>
        <b-col sm="6" class="my-1">
        <b-form-group
          label="Filter"
          label-for="filter-input"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              id="filter-input"
              v-model="filter"
              type="search"
              placeholder="Type to Search"
            ></b-form-input>

            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col sm="5" md="3" class="my-1">
        <b-form-group
          label="Per page"
          label-for="per-page-select"
          label-cols-sm="6"
          label-cols-md="4"
          label-cols-lg="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-form-select
            id="per-page-select"
            v-model="perPage"
            :options="pageOptions"
            size="sm"
          ></b-form-select>
        </b-form-group>
      </b-col>

   
    </b-row>

      <b-table
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :filter-included-fields="filterOn"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      stacked="md"
      show-empty
      small
    >
  
      <template #cell(item)="row">
        {{ row.value.departments.name_department }} {{ row.value.users.name }}
      </template>

      <template #cell(actions)="row">
        <b-button size="sm" id="update-btn"  @click="toggleModal(row.item.id)" class="mr-1">
         <i class="fas fa-edit"></i>
        </b-button>
        <b-button size="sm" id="delete-btn" class="btn btn-sm btn-danger" @click="deleteDept(row.item.id)">
         <i class="fas fa-trash-alt"></i>
        </b-button>
      </template>

      <template #row-details="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
          </ul>
        </b-card>
      </template>
    </b-table>
               
                       

                    
                </div>
               <div class="card-footer">
                   <p class="mt-3"  align="center">Current Page: {{ currentPage }}</p>
                      <b-pagination  align="center"
                      v-model="currentPage"
                      :total-rows="rows"
                      :per-page="perPage"
                      
                       last-number
                      aria-controls="my-table"
                    ></b-pagination>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->


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
      if(roles.includes("admin")-1){
      this.$router.push({name: 'home'})
      Notification.unauthorized() };
      this.allDept();  
      this.allUser(); 
      
    },

    created(){




    

      },
      
     data(){
      return{
      
        departments:[],
        searchTerm:'',
        
          form:{
          name_department: null,
          icno_hod: null,
        
      
        },
          forms:{
          name_department: null,
          icno_hod: null
      
        },
        errors:{},     
        
        itemize: [
          {
            text: 'Dashboard',
            href: '/'
          },
          {
            text: 'Jabatan',
            active: true
          },
        ],
          modalShow: false,

        perPage: 10,
        currentPage: 1,
        pageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
        sortBy: 'name',
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
        filterOn: [],
        items: [],
        fields: [ 
          { key: 'id', label: 'ID', sortable: true, sortDirection: 'asc' },
          { key: 'name_department', label: 'Jabatan', sortable: true, sortDirection: 'asc' },
          { key: 'name', label: 'Ketua Jabatan', sortable: true, sortDirection: 'desc' },
          { key: 'actions', label: 'Actions' },
        ],
      }
 





    },
    computed:{
      filtersearch(){
      return this.departments.filter(department => {
         return department.name.match(this.searchTerm)
      }) 
      },
      rows() {
        return this.items.length
      }
    },
 
  methods:{
    allDept(){
    let self = this;
     axios.get('/api/department/')
      .then(function (response) {
        self.items = response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    },
      deleteDept(id){
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
                    axios.delete('/api/department/'+id)
                  .then(() => {
                   let self = this;
                        axios.get('/api/deparment/')
                      .then(function (response) {
                        self.items = response.data;
                        })
                        Notification.success();
                        this.allDept(); 
                    })
                
                  .catch(() => {
                  
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
       toggleModal(id) {
         axios.get('/api/department/'+id)
  	    .then(({data}) => (this.forms = data))
        this.$refs['edit-modal'].toggle('#update-btn')
       
      },
   
       registerDept(){
          axios.post('/api/department', this.form)
         .then(() => {    
         let register = this;
        axios.get('/department/')
       .then(function (response) {
        register.items = response.data;
        })
        this.$refs['my-modal'].hide(); 
        Notification.success();
        this.allDept(); 
   
       })
        .catch(error=> this.errors = error.response.data.errors)
          
          
        },
      update(){
       let id = this.forms.id
       axios.patch('/api/department/'+id, this.forms)
       .then(() => {
      this.$refs['edit-modal'].hide()      
      this.allDept(); 
      Notification.success();
      
      })
       
     },
     allUser(){
    let self = this;
     axios.get('/api/user/')
      .then(function (response) {
        self.users= response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    }
   
  },

}

   
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>