  

<template>
  
  <div>
 <b-breadcrumb :items="itemize"></b-breadcrumb>
 <hr>
 <div class="row">
   <div class="col-lg-12 mb-4">
   <div>
    <b-button size="sm" variant="outline-primary" id="show-btn" @click="showModal">Kod Baru</b-button>

    <b-modal ref="my-modal" hide-footer title="Kod Peruntukan">
    
            <form class="user" @submit.prevent="categoryInsert">

              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" id="finance_Code" placeholder="Sila masukkan kod peruntukan" v-model="form.finance_code">
                    <small class="text-danger" v-if="errors.finance_code"> {{ errors.finance_code[0] }} </small>          
                    </div> 
                 </div>
               </div>
             
             <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-12">
                    <input type="text" class="form-control" id="descriptions" placeholder="Maklumat peruntukan" v-model="form.descriptions">
                    <small class="text-danger" v-if="errors.descriptions"> {{ errors.descriptions[0] }} </small>          
                   </div> 
                  </div>
                </div>
                
                <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>
               
      </form>      
               
          
      </b-modal>
  </div>
  <!--categoryUpdate Modal-->
  <div>
  <b-modal ref="edit-modal" hide-footer title="Kemaskini Kategory">     
           <form class="user" @submit.prevent="categoryUpdate">
         <div class="form-group" hidden>
          <label>Category ID:</label>
          <input type="hidden" class="form-control" id="exampleInputID" placeholder="ID" v-model="forms.id">
          </div>
         <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" id="finance_Code" placeholder="Sila masukkan kod peruntukan" v-model="forms.finance_code">
                    <small class="text-danger" v-if="errors.finance_code"> {{ errors.finance_code[0] }} </small>          
                    </div> 
                 </div>
               </div>
             
             <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-12">
                    <input type="text" class="form-control" id="descriptions" placeholder="Maklumat peruntukan" v-model="forms.descriptions">
                    <small class="text-danger" v-if="errors.descriptions"> {{ errors.descriptions[0] }} </small>          
                   </div> 
                  </div>
                </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Kemaskini</button>
        </div>        
      </form>
           
   </b-modal>
   </div>
<!--categoryUpdate Modal-->


 </div>
 </div>

   <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Senarai Kategori</h6>
                </div>



<b-row>
        <b-col lg="6" class="my-1">
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
      :sort-asc.sync="sortAsc"
      :sort-direction="sortDirection"
      stacked="md"
      show-empty
      small
    
    >
     <template #cell(index)="data">
        {{ data.index + 1 }}
      </template>
      <template #cell(item)="row">
        {{ row.value.first }} {{ row.value.last }}
      </template>

      <template #cell(actions)="row">
        <b-button size="sm" id="toggle-btn"  @click="toggleModal(row.item.id)" class="mr-1">
         Edit
        </b-button>
        <b-button size="sm" class="btn btn-sm btn-danger" @click="deleteCategory(row.item.id)">
         Delete
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
                   <p class="mt-3">Current Page: {{ currentPage }}</p>
                      <b-pagination
                      v-model="currentPage"
                      :total-rows="rows"
                      :per-page="perPage"
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

        	let id = this.$route.params.id
  	axios.get('/api/finance_category/'+id)
  	.then(({data}) => (this.form = data))
  	.catch(console.log('error'))
      }
  
    },
     mounted(){
    this.allCategory();
     let roles = localStorage.getItem('roles');
      if(roles.includes("finance")-1){
      this.$router.push({name: 'home'})
      Notification.unauthorized()


       
  
    }
    },
    
  
   
     data(){
      return{
        finance_code:[],
        searchTerm:'',
        
          form:{
          finance_code: null,
          descriptions:null,
          
      
        },
          forms:{
           finance_code: null,
            descriptions:null,
          
       
      
        },
        errors:{},     
        
        itemize: [
          {
            text: 'Dashboard',
            href: '/'
          },
          {
            text: 'Kewangan',
            href: '#/allocation'
          },
          {
            text: 'Kod Peruntukan',
            active: true
          },
        ],
          modalShow: false,

        perPage: 10,
        currentPage: 1,
        pageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
        sortBy: 'finance_code',
        sortAsc: true,
        sortDirection: 'asc',
        filter: null,
        filterOn: [],
        items: [],
        fields: [
          { key: 'index', label:'No.'},
          { key: 'finance_code', label: 'Kod Perutuntukan', sortable: true, sortDirection: 'asc' },
          { key: 'descriptions', label: 'Deskripsi', sortable: true, sortDirection: 'asc' },
          { key: 'actions', label: 'Actions' },
        ],
      }
 





    },
    computed:{
      filtersearch(){
      return this.finance_code.filter(finance_category=> {
         return finance_category.finance_code.match(this.searchTerm)
      }) 
      },
      rows() {
        return this.items.length
      }
    },
 
  methods:{
    allCategory(){
    let self = this;
     axios.get('/api/finance_category/')
      .then(function (response) {
        self.items = response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    }
    ,
       deleteCategory(id){
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
                axios.delete('/api/finance_category/'+id)
               .then(() => {
                  window.location.reload()
                this.finance_categories = this.finance_categories.filter(finance_category => {
                  return finance_category.id != id
                })           
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
         axios.get('/api/finance_category/'+id)
  	    .then(({data}) => (this.forms = data))
        this.$refs['edit-modal'].toggle('#toggle-btn')
       
      },
   
       categoryInsert(){
       axios.post('/api/finance_category',this.form)
       .then(() => {
        window.location.reload()
        Notification.success()
       })
          .catch(error=> this.errors = error.response.data.errors)
      
        },
     categoryUpdate(){
  	  let id = this.forms.id
       axios.patch('/api/finance_category/'+id,this.forms)
       .then(() => {
        window.location.reload()
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
       
     },
   
  },
 
}

   
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>