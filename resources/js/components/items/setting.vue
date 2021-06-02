  

<template>
  
  <div>
 <b-breadcrumb :items="itemize"></b-breadcrumb>
 <hr>
 <div class="row">
   <div class="col-lg-12 mb-4">
   <div>
  <!--Insert Modal-->
      <!--category-->
    <b-modal ref="categoryinsert-modal" hide-footer title="Kategori">
    
            <form class="user" @submit.prevent="categoryInsert">

              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
              <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Sila masukkan kategori" v-model="form.category_name">
              <small class="text-danger" v-if="errors.category_name"> {{ errors.category_name[0] }} </small>          
            </div> 
            </div>
        </div>
        
        
      </form>      
               
          
      </b-modal>


 <!--PKU-->

    <b-modal ref="pku-insert-modal" hide-footer title="PKU">
    
            <form class="user" @submit.prevent="pkuInsert">

              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
              <input type="text" class="form-control" id="Pku" placeholder="Sila masukkan PKU" v-model="formp.pku">
              <small class="text-danger" v-if="errors.pku"> {{ errors.pku[0] }} </small>          
            </div> 
            </div>
        </div>
          <div class="form-group">
          <button type="submit" id="pku-insert-btn" class="btn btn-primary btn-block">Simpan</button>
        </div>
        
      </form>      
               
          
      </b-modal>
 <!--SKU-->

  <b-modal ref="sku-insert-modal" hide-footer title="SKU">
    
            <form class="sku" @submit.prevent="skuInsert">

              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
              <input type="text" class="form-control" id="sku" placeholder="Sila masukkan SKU" v-model="formsku.sku">
              <small class="text-danger" v-if="errors.sku"> {{ errors.sku[0] }} </small>          
            </div> 
            </div>
        </div>
          <div class="form-group">
          <button type="submit" id="sku-insert-btn" class="btn btn-primary btn-block">Simpan</button>
        </div>
        
      </form>      
               
          
      </b-modal>


  </div>
  <!--Update Modal-->
  <div>
  <!--category-->
  <b-modal ref="update-modal" hide-footer title="Kemaskini Kategory">     
           <form class="user" @submit.prevent="categoryUpdate">
         <div class="form-group" hidden>
          <label>Category ID:</label>
          <input type="hidden" class="form-control" id="exampleInputID" placeholder="ID" v-model="forms.id">
          </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-12">
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Masukkan kategori" v-model="forms.category_name">
          <small class="text-danger" v-if="errors.category_name"> {{ errors.category_name[0] }} </small>   
            </div>             
          </div>
        </div> 
        <div class="form-group">
          <button type="submit" id="update-btn"  class="btn btn-primary btn-block">Kemaskini</button>
        </div>        
      </form>
           
   </b-modal>
 <!--PKU-->
  <b-modal ref="pku-update-modal" hide-footer title="Kemaskini">     
           <form class="user" @submit.prevent="PKUUpdate">
         <div class="form-group" hidden>
          <label>PKU ID:</label>
          <input type="hidden" class="form-control" id="pkuID" placeholder="ID" v-model="formps.id">
          </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-12">
         <input type="text" class="form-control" id="updatePKU" placeholder="Masukkan PKU" v-model="formps.pku">
          <small class="text-danger" v-if="errors.pku"> {{ errors.pku[0] }} </small>   
            </div>             
          </div>
        </div> 
        <div class="form-group">
          <button type="submit" id="pku-update-btn"  class="btn btn-primary btn-block">Kemaskini</button>
        </div>        
      </form>
           
   </b-modal>
<!--SkU-->
  <b-modal ref="sku-update-modal" hide-footer title="Kemaskini">     
           <form class="user" @submit.prevent="SKUUpdate">
         <div class="form-group" hidden>
          <label>SKU ID:</label>
          <input type="hidden" class="form-control" id="skuID" placeholder="ID" v-model="formskus.id">
          </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-12">
         <input type="text" class="form-control" id="updateSKU" placeholder="Masukkan SKU" v-model="formskus.sku">
          <small class="text-danger" v-if="errors.sku"> {{ errors.sku[0] }} </small>   
            </div>             
          </div>
        </div> 
        <div class="form-group">
          <button type="submit" id="sku-update-btn"  class="btn btn-primary btn-block">Kemaskini</button>
        </div>        
      </form>
           
   </b-modal>

   </div>



 </div>
 </div>
<!--kategori table-->
<b-container>

<b-row>
    <b-col class="shadow-sm p-4 mb-4 bg-white">
           <caption><h5><b>Kategori</b></h5></caption>  
 
      <b-row>
        <b-col sm="2" class="my-1">
        <b-button size="sm" variant="outline-primary" id="show-btn" @click="showModal">Tambah</b-button>
        </b-col>
        <b-col sm="6" class="my-1">
        <b-form-group
          label=""
          label-for="categoryfilter-input"
          label-cols-sm="0"
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

      <b-col sm="3"  class="my-1">
        <b-form-group
          label=""
          label-for="per-page-select"
          label-cols-sm="3"
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

   
      </b-row>

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
               
                       

                    
                
                   <p class="mt-6" align="center" style="font-size:0.8em;">Current Page: {{ categorycurrentPage }} | Total Data: {{ categoryrows }}</p>
                      <b-pagination
                      v-model="categorycurrentPage"
                      :total-rows="categoryrows"
                      :per-page="categoryperPage"
                      aria-controls="category-table"
                      style="sm"
                      align="center"
                    ></b-pagination>

              </b-col>


              
  
    <b-col>
  <!--pKU table-->
      <b-row class="shadow-sm p-4 mb-4 bg-white">
      <caption><h5><b>PKU</b></h5></caption>

    <b-row>
       
      <b-col sm="2" class="my-1">
        <b-button size="sm" variant="outline-primary" id="show-btn-pku-insert" @click="showModalPKU">Tambah</b-button>
        </b-col>

    
        <b-col sm="6" class="my-1">
        <b-form-group
          label=""
          label-for="filter-input"
          label-cols-sm="0"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              id="filter-input"
              v-model="pkufilter"
              type="search"
              placeholder="Type to Search"
            ></b-form-input>

            <b-input-group-append>
              <b-button :disabled="!pkufilter" @click="pkufilter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
       <b-col sm="5" md="3" class="my-1">
        <b-form-group
          label=""
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
            v-model="pkuperPage"
            :options="pkupageOptions"
            size="sm"
          ></b-form-select>
        </b-form-group>
      </b-col>
 

    </b-row>
   
      

      <b-table head-variant
      :items="pkuitems"
      :fields="pkufields"
      :current-page="pkucurrentPage"
      :per-page="pkuperPage"
      :filter="pkufilter"
      :filter-included-fields="pkufilterOn"
      :sort-by.sync="pkusortBy"
      :sort-desc.sync="pkusortDesc"
      :sort-direction="pkusortDirection"
      stacked="md"
      show-empty
      small
      responsive="sm"
        >
       

        <template #cell(items)="row" >
            {{ row.value.first }} {{ row.value.last }}
        </template>

        <template #cell(actions)="row" style="width: 20rem">
            <b-button size="sm" id="pku-toggle-btn"  @click="toggleModalPKU(row.item.id)" class="mr-1">
            Edit
            </b-button>
            <b-button size="sm" class="btn btn-sm btn-danger" @click="deletePKU(row.item.id)">
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
               
                       

     
                
                   <p class="mt-6" align="center" style="font-size:0.8em;">Current Page: {{ pkucurrentPage }}</p>
                      <b-pagination
                      v-model="pkucurrentPage"
                      :total-rows="pkurows"
                      :per-page="pkuperPage"
                      aria-controls="pku-table"
                      size="sm"
                      align="center"
                    ></b-pagination>


   </b-row>

   <!--SKU table-->
 <b-row class="shadow-sm p-4 mb-4 bg-white">
  <caption><h5><b>SKU</b></h5></caption>
     <b-row>
       
      <b-col sm="2" class="my-1">
        <b-button size="sm" variant="outline-primary" id="show-btn-sku-insert" @click="showModalSKU">Tambah</b-button>
        </b-col>

    
        <b-col sm="6" class="my-1">
        <b-form-group
          label=""
          label-for="filter-input"
          label-cols-sm="0"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              id="filter-input"
              v-model="skufilter"
              type="search"
              placeholder="Type to Search"
            ></b-form-input>

            <b-input-group-append>
              <b-button :disabled="!skufilter" @click="skufilter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
       <b-col sm="5" md="3" class="my-1">
        <b-form-group
          label=""
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
            v-model="skuperPage"
            :options="skupageOptions"
            size="sm"
          ></b-form-select>
        </b-form-group>
      </b-col>
 

    </b-row>
      <b-table head-variant
      :items="skuitems"
      :fields="skufields"
      :current-page="skucurrentPage"
      :per-page="skuperPage"
      :filter="skufilter"
      :filter-included-fields="skufilterOn"
      :sort-by.sync="skusortBy"
      :sort-desc.sync="skusortDesc"
      :sort-direction="skusortDirection"
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
            <b-button size="sm" id="sku-toggle-btn"  @click="toggleModalSKU(row.item.id)" class="mr-1">
            Edit
            </b-button>
            <b-button size="sm" class="btn btn-sm btn-danger" @click="deleteSKU(row.item.id)">
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
               
                   <p class="mt-6" align="center" style="font-size:0.8em;">Current Page: {{ skucurrentPage }}</p>
                      <b-pagination
                      v-model="skucurrentPage"
                      :total-rows="skurows"
                      :per-page="skuperPage"
                      aria-controls="sku-table"
                      size="sm"
                      align="center"
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
            text: 'Items',
            href: '#/items'
          },
           {
            text: 'Tetapan',
            active: true
          },
        ],
          modalShow: false,
//category
        categoryperPage: 15,
        categorycurrentPage: 1,
        categorypageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
        categorysortBy: 'category_name',
        categorysortDesc: false,
        categorysortDirection: 'asc',
        categoryfilter: null,
        categoryfilterOn: [],
        categoryitems: [],
        categoryfields: [
          { key: 'category_name', label: 'Kategori', sortable: true, sortDirection: 'asc' },
          { key: 'actions', label: 'Actions' },

        ],
//PKU
          formp:{
          pku: null,
          
      
        },
          formps:{
          pku: null,
          
      
        },


        pkuperPage: 5,
        pkucurrentPage: 1,
        pkupageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
        pkusortBy: 'pku',
        pkusortDesc: false,
        pkusortDirection: 'asc',
        pkufilter: null,
        pkufilterOn: [],
          pkuitems: [],
          pkufields: [
           { key: 'pku', label: 'PKU', sortable: true, sortDirection: 'asc' },
            { key: 'actions', label: 'Actions' },
           ],



 //SKU    
         formsku:{
          sku: null,
          
      
        },
          formskus:{
          sku: null,
          
      
        },

        skuperPage: 5,
        skucurrentPage: 1,
        skupageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
        skusortBy: 'sku',
        skusortDesc: false,
        skusortDirection: 'asc',
        skufilter: null,
         skufilterOn: [],

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
      },
       pkurows() {
        return this.pkuitems.length
      },
       skurows() {
        return this.skuitems.length
      }
      
    },
 
  methods:{

 //all   
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


//delete

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


       deletePKU(id){
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
                axios.delete('/api/pku/'+id)
               .then(() => {
                this.allPKU();
                         
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
        deleteSKU(id){
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
                axios.delete('/api/sku/'+id)
               .then(() => {
                this.allSKU();
                         
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

// show insert modal

      showModal() {
        this.$refs['insert-modal'].show()
      },

        showModalPKU() {
        this.$refs['pku-insert-modal'].show()
      },

        showModalSKU() {
        this.$refs['sku-insert-modal'].show()
      },



       hideModal() {
        this.$refs['update-modal'].hide()
      },
 // show update modal
       toggleModal(id) {
         axios.get('/api/category/'+id)
  	    .then(({data}) => (this.forms = data))
        this.$refs['update-modal'].toggle('#toggle-btn')       
      },
        toggleModalPKU(id) {
         axios.get('/api/pku/'+id)
  	    .then(({data}) => (this.formps = data))
        this.$refs['pku-update-modal'].toggle('#pku-toggle-btn')       
      },
      toggleModalSKU(id) {
         axios.get('/api/sku/'+id)
  	    .then(({data}) => (this.formskus = data))
        this.$refs['sku-update-modal'].toggle('#sku-toggle-btn')       
      },


 //insert  
       categoryInsert(){
       axios.post('/api/category',this.form)
       .then(() => { 
       this.$refs['insert-modal'].hide('#insert-btn')  
         this.allCategory();
        Notification.success()
       })
          .catch(error=> this.errors = error.response.data.errors)
      
        },
        pkuInsert(){
        axios.post('/api/pku',this.formp)
        .then(() => { 
        this.$refs['pku-insert-modal'].hide('#pku-insert-btn')  
         this.allPKU();
        Notification.success()
       })
          .catch(error=> this.errors = error.response.data.errors)
      
        },
         skuInsert(){
        axios.post('/api/sku',this.formsku)
        .then(() => { 
        this.$refs['sku-insert-modal'].hide('#sku-insert-btn')  
         this.allSKU();
        Notification.success()
       })
          .catch(error=> this.errors = error.response.data.errors)
      
        },


 //update       
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
      PKUUpdate(){
  	  let id = this.formps.id
       axios.patch('/api/pku/'+id,this.formps)
       .then(() => { 
         this.$refs['pku-update-modal'].hide('#pku-update-btn')
        this.allPKU();
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
       
     },
  SKUUpdate(){
  	  let id = this.formskus.id
       axios.patch('/api/sku/'+id,this.formskus)
       .then(() => { 
         this.$refs['sku-update-modal'].hide('#sku-update-btn')
        this.allSKU();
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