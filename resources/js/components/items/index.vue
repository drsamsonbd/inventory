  

<template>
  
  <div>
 <b-breadcrumb :items="itemize"></b-breadcrumb>

 <div class="row">
   <div class="col-lg-12 mb-4">
   
   
  <!--Insert Modal-->
    <b-modal ref="insert-modal" size="lg" hide-footer title="Daftar Item Baru">
    
           <form class="user" @submit.prevent="insert">
                 <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Kod Item</label>
                      <input type="text" class="form-control" id="ItemCode" placeholder="Kod Item" v-model="form.item_code">
                     <small class="text-danger" v-if="errors.item_code">{{errors.item_code[0]}}</small>
                    </div>  
                        <div class="form-group col-md-6">
                      <label>Kategori Item</label>
                   <select class="form-control" id="CategoryID" v-model="form.category_id">
                        <option v-for="category in categories "   v-bind:key="category.id" :value="category.id"> {{category.category_name}}</option>
                        
                        </select>
                   <small class="text-danger" v-if="errors.category_name">{{errors.category_name[0]}}</small>
                    </div> 
                    </div>
                   <div class="form-row">           
                    <div class="form-group col-md-12">
                      <label>Deskripsi</label>
                      <textarea type="text" class="form-control" v-model="form.descriptions" id="ItemDescriptions" placeholder="Deskripsi Item: Nama, Saiz dsb.."></textarea> 
                      <small class="text-danger" v-if="errors.descriptions">{{errors.descriptions[0]}}</small>
                    </div>
                    </div>
                     <div class="form-row">
                     <div class="form-group col-md-2" >
                      <label>SKU</label>
                      <select class="form-control" id="skuID" v-model="form.sku">
                        <option v-for="sku in skus "   v-bind:key="sku.id" :value="sku.id"> {{sku.sku}}</option>
                        
                        </select>
                         <small class="text-danger" v-if="errors.sku">{{errors.sku[0]}}</small>
                    </div>
                    <div class="form-group col-md-3">
                      <label>PKU</label>
                          <input type="number" step="1" min="1" class="form-control" id="avpu" placeholder="" v-model="form.pku">
                   
                   <!--   <select class="form-control" id="pkuID" v-model="form.pku">
                        <option v-for="pku in pkus "   v-bind:key="pku.id" :value="pku.id"> {{pku.pku}}</option>
                        
                        </select>-->
                         <small class="text-danger" v-if="errors.pku">{{errors.pku[0]}}</small>
                    </div>
                 <div class="form-group col-md-4">
                      <label>Kuantiti Minimum</label>
                      <input type="number" step="1" min="1" class="form-control" id="minimumOrder" placeholder="Kuantiti Minimum Pembelian" v-model="form.dku">
                         <small class="text-danger" v-if="errors.dku">{{errors.dku[0]}}</small>
                    </div>
                     <div class="form-group col-md-3">
                      <label>Purata Harga/PKU</label>
                      <input type="number" step=".0001" min=".0001" class="form-control" id="avpu" placeholder="RM" v-model="form.avpu">
                         <small class="text-danger" v-if="errors.avpu">{{errors.avpu[0]}}</small>
                    </div>
                  </div>
                    <div class="form-row">
                  
                    <div class="form-group col-md-6">        
                      
                                   
                      <input type="file" class="custom-file-input" id="customFile"  @change="onFileSelected" placeholder="Muat naik imej">

                       <label class="custom-file-label" for="customFile" >Pilih Imej</label>
                        
                    </div>
                     <div class="form-group col-md-3">                     
                    <img :src="form.image" alt="" style="height:120px; width:120px;">
                  
                    </div>


                  </div>
                    <div class="form-group">
                      <button type="submit"  class="btn btn-primary btn-block">Simpan</button>
                    </div>
                    <hr>
                 
                  </form>            
               
          
      </b-modal>
  </div>
  <!--Update Modal-->
  <div>
  <b-modal ref="update-modal" size="lg" hide-footer title="Kemaskini Item">     
          <form @submit.prevent="update"> 
                    <div class="form-group" hidden>
                      <label>User ID:</label>
                      <input type="hidden" class="form-control" id="exampleInputID" placeholder="ID" v-model="forms.id">
                    </div>
                   <div class="form-row">    
                     <div class="form-group col-md-6">
                      <label>Kod Item</label>
                      <input type="text" class="form-control" id="ItemCode" placeholder="Kod Item" v-model="forms.item_code">
                     <small class="text-danger" v-if="errors.item_code">{{errors.item_code[0]}}</small>
                    </div>  
                        <div class="form-group col-md-6">
                      <label>Kategori Item</label>
                   <select class="form-control" id="CategoryID" v-model="forms.category_id">
                        <option v-for="category in categories "   v-bind:key="category.id" :value="category.id"> {{category.category_name}}</option>
                        
                        </select>
                   <small class="text-danger" v-if="errors.category_name">{{errors.category_name[0]}}</small>
                    </div> 
                    </div>
                   <div class="form-row">           
                    <div class="form-group col-md-12">
                      <label>Deskripsi</label>
                      <textarea type="text" class="form-control" v-model="forms.descriptions" id="ItemDescriptions" placeholder="Deskripsi Item: Nama, Saiz dsb.."></textarea> 
                      <small class="text-danger" v-if="errors.descriptions">{{errors.descriptions[0]}}</small>
                    </div>
                    </div>
                     <div class="form-row">
                     <div class="form-group col-md-2" >
                      <label>SKU</label>
                      <select class="form-control" id="skuID" v-model="forms.sku">
                        <option v-for="sku in skus "   v-bind:key="sku.id" :value="sku.id"> {{sku.sku}}</option>
                        
                        </select>
                         <small class="text-danger" v-if="errors.sku">{{errors.sku[0]}}</small>
                    </div>
                    <div class="form-group col-md-3">
                      <label>PKU</label>
                      <input type="number" step="1" min="1" class="form-control" id="avpu" placeholder="" v-model="forms.pku">
                  
                  <!--    <select class="form-control" id="pkuID" v-model="forms.pku">
                        <option v-for="pku in pkus "   v-bind:key="pku.id" :value="pku.id"> {{pku.pku}}</option>
                        
                        </select>-->
                         <small class="text-danger" v-if="errors.pku">{{errors.pku[0]}}</small>
                    </div>
                 <div class="form-group col-md-4">
                      <label>Kuantiti Minimum</label>
                      <input type="number" step="1" min="1" class="form-control" id="minimumOrder" placeholder="Kuantiti Minimum Pembelian" v-model="forms.dku">
                         <small class="text-danger" v-if="errors.dku">{{errors.dku[0]}}</small>
                    </div>
                     <div class="form-group col-md-3">
                      <label>Purata Harga/PKU</label>
                      <input type="number" step=".0001" min="0.0001" class="form-control" id="avpu" placeholder="RM" v-model="forms.avpu">
                         <small class="text-danger" v-if="errors.avpu">{{errors.avpu[0]}}</small>
                    </div>
                  </div>
                    <div class="form-row">
                  
                    <div class="form-group col-md-6">        
                      
                                   
                      <input type="file" class="custom-file-input" id="customFile"  @change="onImageSelected" placeholder="Muat naik imej">

                       <label class="custom-file-label" for="customFile" >Pilih Imej</label>
                        
                    </div>
                     <div class="form-group col-md-3">                     
                    <img :src="forms.image" alt="" style="height:120px; width:120px;">
                  
                    </div>
                     </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Kemaskini</button>
               
                    </div>
              
                  </form> 
   </b-modal>
   </div>
<!--Update Modal-->



 <!--View Modal-->
    <b-modal ref="view-modal" size="lg" hide-footer title="Item Details">     
       <b-row>    
            <b-col align="center">
             
             <div class="form-group col-md-3">                     
                    <img v-for="view in views"  v-bind:key="view.id" :src="view.image" alt="" style="height:240px; width:240px;">
                  
                    </div>
             
      </b-col>



       </b-row>            
              <b-row>      
                 <b-col>
                  <label><b>Item ID:</b></label><br>
                  <p v-for="view in views"  v-bind:key="view.id" > {{view.id}} </p>
                 </b-col>
                      
                  <b-col>
                    
                    <label><b>Kod Item</b></label><br>  <p v-for="view in views" v-bind:key="view.id" > {{view.item_code}}</p>
                     </b-col> 

                    <b-col>
                     <label><b>Kategori Item</b></label><br>
                     <p v-for="view in views" v-bind:key="view.id"> {{view.category_name}} </p>

                    </b-col>
               </b-row>

              <b-row>

              <b-col>
          <label><b>Deskripsi</b></label><br> <p v-for="view in views" v-bind:key="view.id"> {{view.descriptions}}</p>

              </b-col>
              </b-row>
              <b-row>
                <b-col>

                  <label for=""><b>SKU</b></label><br> <p v-for="view in views" v-bind:key="view.id" > {{view.sku}}</p>


                </b-col>

              <b-col>

                  <label for=""><b>PKU</b></label><br> <p v-for="view in views" v-bind:key="view.id" > {{view.pku}}</p>


                </b-col>
              <b-col>

                  <label for=""><b>Kuantiti Minimum</b></label><br> <p v-for="view in views" v-bind:key="view.id"> {{view.dku}}</p>


                </b-col>
                <b-col>

                  <label for=""><b>Harga</b></label><br> <p v-for="view in views" v-bind:key="view.id"> {{view.avpu}}</p>


                </b-col>


              </b-row>          
    
    
   </b-modal>
 
<!--end View Modal-->
 </div>

   <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Senarai Items</h6>
                </div>



      <b-row>



         
         </b-row>
 <b-row>
    <b-col sm="1" class="my-1" align="right">
        <b-button pill size="sm" variant="outline-secondary" id="show-btn" @click="showModal"> <i class="fas fa-plus"></i>&nbsp;Tambah</b-button>
        </b-col>
        <b-col sm="6" class="my-1">
        <b-form-group
          label=""
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
              <b-button variant="outline-secondary" :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col sm="3" md="3" class="my-1">
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
        <b-col sm="1" class="my-1" align="right">
           <b-button size="sm" variant="outline-primary" ><router-link to="/itemsetting"><i class="fas fa-cogs"></i></router-link></b-button>
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
      responsive 
      flex 
      striped 
      hover
      @row-clicked="viewModal"
    >
    
      <template #cell(item)="row">
        {{ row.value.first }} {{ row.value.last }}
      </template>

      <template #cell(actions)="row">
        <b-button size="sm" id="toggle-btn"  @click="toggleModal(row.item.id)" class="mr-1" v-b-tooltip.hover title="Edit Item">
             <i class="fas fa-edit"></i>
        </b-button>
        <b-button size="sm" class="btn btn-sm btn-danger" @click="deleteUser(row.item.id)" v-b-tooltip.hover title="Delete Item">
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
                   <p class="mt-3"  align="center">Current Page: {{ currentPage }} | Showing {{perPage}} of {{rows}} data.</p>
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

         let $LoggedRoles = localStorage.getItem('roles');
   
    if($LoggedRoles.toLowerCase().indexOf("head")===-1){
      this.$router.push({name: 'home'})
      Notification.unauthorized()
      }
      }
  
    }, 
 
   
     data(){
      return{
       skus:[],
       categories:[],
        views:[],      
          form:{
          id: null,  
          item_code: null,
          descriptions: null,
          sku: null,
          pku: null,
          dku: null,
          avpu: null,
          image: null,
          category_id:null,
      
      },
          forms:{
            id: null,
          item_code: null,
          descriptions: null,
          sku: null,
          pku: null,
          dku: null,
          avpu: null,
          image: null,
          newimage: null,
          category_id:null,
      
        },
         
        errors:{},     
        
        itemize: [
          {
            text: 'Dashboard',
            href: '/'
          },
          {
            text: 'Item',
            active: true
          },
        ],
          modalShow: false,

        perPage: 15,
        currentPage: 1,
        pageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
        sortBy: 'descriptions',
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
        filterOn: [],
        items: [],
        fields: [ 
          { key: 'item_code', label: 'Kod ', sortable: true, sortDirection: 'desc' },
          { key: 'descriptions', label: 'Item ', sortable: true, sortDirection: 'asc' },
          { key: 'avpu', label: 'Harga/Pack', sortable: true, sortDirection: 'desc' },
          { key: 'actions', label: 'Actions' },
        ],
      }
 





    },
    computed:{
      filtersearch(){
      return this.users.filter(user => {
         return user.name.match(this.searchTerm)
      }) 
      },
      rows() {
        return this.items.length
      }
    },
 
  methods:{

 
    allItem(){
    let self = this;
     axios.get('/api/items/')
      .then(function (response) {
        self.items = response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    },

    allCategories(){
    let self = this;
     axios.get('/api/category/')
      .then(function (response) {
        self.categories = response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    },
 allSKU(){
    let self = this;
     axios.get('/api/sku/')
      .then(function (response) {
        self.skus = response.data;
      }).catch(function (error) {
        console.log(error);
        Notification.wrong();
      });
    },
 allPKU(){
    let self = this;
     axios.get('/api/pku/')
      .then(function (response) {
        self.pkus = response.data;
      }).catch(function (error) {
        console.log(error);
        Notification.wrong();
      });
    },



    onFileSelected(event){
      let file = event.target.files[0];
      if (file.size > 1048770){
          Notification.image_validation()
      } else {
        let read = new FileReader();
        read.onload = event => {
            this.form.image = event.target.result
            console.log(event.target.result);

        };
        read.readAsDataURL(file);
      }

    },
        onImageSelected(event){
      let file = event.target.files[0];
      if (file.size > 1048770){
          Notification.image_validation()
      } else {
        let reader = new FileReader();
        reader.onload = event => {
            this.forms.newimage = event.target.result
            console.log(event.target.result);
            Notification.Imagesuccess()

        };
        reader.readAsDataURL(file);
      }
      
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
                    axios.delete('/api/items/'+id)
                  .then(() => {
                this.allItem()
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
       toggleModal(id) {
         axios.get('/api/items/'+id)
  	    .then(({data}) => (this.forms = data))
        this.$refs['update-modal'].toggle('#toggle-btn')
       
      },
      
       viewModal(record) {
          let self = this;
            axios.get('/api/items/view/'+record.id)
  	     .then(function (response) {
        self.views = response.data;
        })
        this.$refs['view-modal'].toggle('#toggle-btn')
       
      },
   
       insert(){
          axios.post('/api/items', this.form)
          .then(() => {            
        this.$refs['insert-modal'].hide(); 
        this.allItem();
        Notification.success()
       })
          .catch(error=> this.errors = error.response.data.errors)
       
        },
     update(){
       let id = this.forms.id
       axios.patch('/api/items/'+id, this.forms)
       .then(() => {
        this.$refs['update-modal'].hide(); 
        this.allItem()
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
       
     },
   
  },

  mounted: function(){

    
    this.allItem();
    this.allCategories();
    this.allSKU();
    this.allPKU();

     this.viewModal();
  




  }
}

   
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>