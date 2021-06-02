  

<template>
  
  <div>
 <b-breadcrumb :items="itemize"></b-breadcrumb>
 <hr>
 <div class="row">
   <div class="col-lg-12 mb-4">
   <div>
    <b-button size="sm" variant="outline-primary" id="show-btn" @click="showModal">Kategori Baru</b-button>

    <b-modal ref="insert-modal" hide-footer title="Kategori Baru">
    
            <form class="user" @submit.prevent="categoryInsert">

              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
              <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Sila masukkan kategori" v-model="form.category_name">
              <small class="text-danger" v-if="errors.category_name"> {{ errors.category_name[0] }} </small>          
            </div> 
            </div>
        </div>
          <div class="form-group">
          <button type="submit" id="insert-btn" class="btn btn-primary btn-block">Simpan</button>
        </div>
        
      </form>      
               
          
      </b-modal>
  </div>
  <!--categoryUpdate Modal-->
  <div>
  <b-modal ref="update-modal" hide-footer title="Kemaskini Kategory">     
           <form class="user" @submit.prevent="categoryUpdate">
         <div class="form-group" hidden>
          <label>Category ID:</label>
          <input type="hidden" class="form-control" id="exampleInputID" placeholder="ID" v-model="forms.id">
          </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-12">
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Category Name" v-model="forms.category_name">
          <small class="text-danger" v-if="errors.category_name"> {{ errors.category_name[0] }} </small>   
            </div>             
          </div>
        </div> 
        <div class="form-group">
          <button type="submit" id="update-btn"  class="btn btn-primary btn-block">Kemaskini</button>
        </div>        
      </form>
           
   </b-modal>
   </div>
<!--categoryUpdate Modal-->


 </div>
 </div>
<!--kategori table-->
<b-container>

<b-row>
    <b-col class="shadow-sm p-4 mb-4 bg-white">
           <caption><h5><b>Kategori</b></h5></caption>
      <hr>
        <b-col lg="6" class="my-1">
        <b-form-group
          label="Filter"
          label-for="categoryfilter-input"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              id="categoryfilter-input"
              v-model="categoryfilter"
              type="search"
              placeholder="Type to Search"
            ></b-form-input>

            <b-input-group-append>
              <b-button :disabled="!categoryfilter" @click="categoryfilter = ''">Clear</b-button>
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
            v-model="categoryperPage"
            :options="categorypageOptions"
            size="sm"
          ></b-form-select>
        </b-form-group>
      </b-col>

   
      

      <b-table head-variant
      :items="categoryitems"
      :fields="categoryfields"
      :current-page="categorycurrentPage"
      :per-page="categoryperPage"
      :filter="categoryfilter"
      :filter-included-fields="categoryfilterOn"
      :sort-by.sync="categorysortBy"
      :sort-desc.sync="categorysortDesc"
      :sort-direction="categorysortDirection"
      stacked="md"
      show-empty
      small
    
        >
        <template #cell(index)="data">
            {{ data.index + 1 }}
        </template>
        <template #cell(categoryitems)="row">
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
               
                       

                    
                
                   <p class="mt-3" style="align:center;">Current Page: {{ categorycurrentPage }} | Total Data: {{ categoryrows }}</p>
                      <b-pagination
                      v-model="categorycurrentPage"
                      :total-rows="categoryrows"
                      :per-page="categoryperPage"
                      aria-controls="category-table"
                    ></b-pagination>

              </b-col>


              
  
    <b-col>
  <!--pKU table-->
      <b-row class="shadow-sm p-4 mb-4 bg-white">
      <caption><h5><b>PKU</b></h5></caption>
      <hr>
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

    
   
      

      <b-table head-variant
      :items="pkuitems"
      :fields="pkufields"
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
      responsive="sm"
        >
       

        <template #cell(categoryitems)="row" >
            {{ row.value.first }} {{ row.value.last }}
        </template>

        <template #cell(actions)="row" style="width: 20rem">
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
 
                
                   <p class="mt-3" style="align:center;">Current Page: {{ currentPage }}</p>
                      <b-pagination
                      v-model="currentPage"
                      :total-rows="rows"
                      :per-page="perPage"
                      aria-controls="pku-table"
                    ></b-pagination>


   </b-row>

   <!--SKU table-->
 <b-row class="shadow-sm p-4 mb-4 bg-white">
  <caption><h5><b>SKU</b></h5></caption>
      <hr>
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

    
   
      

      <b-table head-variant
      :items="skuitems"
      :fields="skufields"
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
    responsive="sm"
        >
        <template #cell(index)="data">
            {{ data.index + 1 }}
        </template>
        <template #cell(categoryitems)="row">
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
 
                
                   <p class="mt-3" style="align:center; font-size:0.8em;" >Current Page: {{ currentPage }}</p>
                      <b-pagination
                      v-model="currentPage"
                      :total-rows="rows"
                      :per-page="perPage"
                      aria-controls="sku-table"
                      size="sm"
                    ></b-pagination>
 </b-row>
              </b-col>
            </b-row>
          </b-container>
     </div>
        


</template>



<script type="text/javascript">
 
 


  export default {
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
     let id = this.$route.params.id
  	axios.get('/api/category/'+id)
  	.then(({data}) => (this.form = data))
  	.catch(console.log('error'));

      }
    },
   mounted(){ 
    this.allCategory();
    this.allPKU();
   this.allSKU();
   
    let $LoggedRoles = localStorage.getItem('roles');
   
    if($LoggedRoles.toLowerCase().indexOf("head")===-1){
      this.$router.push({name: 'home'})
      Notification.unauthorized()
      } 
    },
  
    
  	
  
   
     data(){
      return{
        category_name:[],
        searchTerm:'',
        
          form:{
          category_name: null,
          
      
        },
          forms:{
          category_name: null,
       
      
        },
        errors:{},     
        
        itemize: [
          {
            text: 'Dashboard',
            href: '/'
          },
          {
            text: 'Kategori',
            active: true
          },
        ],
          modalShow: false,
//category
        categoryperPage: 15,
        categorycurrentPage: 1,
        categorypageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
        categorysortBy: 'category_name',
        categorysortAsc: true,
        categorysortDirection: 'asc',
        categoryfilter: null,
        categoryfilterOn: [],
        categoryitems: [],
        categoryfields: [
          { key: 'category_name', label: 'Kategori', sortable: true, sortDirection: 'asc' },
          { key: 'actions', label: 'Actions' },

        ],
//PKU
          pkuitems: [],
          pkufields: [
           { key: 'pku', label: 'PKU', sortable: true, sortDirection: 'asc' },
            { key: 'actions', label: 'Actions' },
           ],



 //SKU          
          skuitems: [],
          skufields: [
           { key: 'sku', label: 'SKU', sortable: true, sortDirection: 'asc' },
            { key: 'actions', label: 'Actions' },
           ],
      }
 





    },
    computed:{
    
      categoryrows() {
        return this.categoryitems.length
      }
    },
 
  methods:{
    allCategory(){
    let self = this;
     axios.get('/api/category/')
      .then(function (response) {
        self.categoryitems = response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    },
     allPKU(){
    let self = this;
     axios.get('/api/pku/')
      .then(function (response) {
        self.pkuitems = response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    },
    allSKU(){
    let self = this;
     axios.get('/api/sku/')
      .then(function (response) {
        self.skuitems = response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    },




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
                axios.delete('/api/category/'+id)
               .then(() => {
                this.allCategory();
                this.categories = this.categories.filter(category => {
                  return category.id != id
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
        this.$refs['insert-modal'].show()
      },
       hideModal() {
        this.$refs['update-modal'].hide()
      },
       toggleModal(id) {
         axios.get('/api/category/'+id)
  	    .then(({data}) => (this.forms = data))
        this.$refs['update-modal'].toggle('#toggle-btn')
       
      },
   
       categoryInsert(){
       axios.post('/api/category',this.form)
       .then(() => { 
       this.$refs['insert-modal'].hide('#insert-btn')  
         this.allCategory();
        Notification.success()
       })
          .catch(error=> this.errors = error.response.data.errors)
      
        },
     categoryUpdate(){
  	  let id = this.forms.id
       axios.patch('/api/category/'+id,this.forms)
       .then(() => { 
         this.$refs['update-modal'].hide('#update-btn')
         this.allCategory();
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
       
     },
   
  }
  
  }
   
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>