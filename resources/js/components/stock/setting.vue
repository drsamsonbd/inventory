  

<template>
  
<div>
 <b-breadcrumb :items="itemize"></b-breadcrumb>
 
 <div class="row">
   <div class="col-lg-12 mb-4">
  
  <!--Insert Modal-->
    
    <b-modal ref="insert-modal" hide-footer title="Tetapan Kuantiti Menokok Item">
    
            <form class="user" @submit.prevent="departmentItemInsert">

              <div class="form-group col-md-12" >
                      <label>Item</label>
                      <v-select  v-model="form.selected"
                        label="descriptions"
                        
                        :options="item_descriptions"
                        :create-option="({descriptions}) "
                        :reduce="descriptions =>descriptions.id"
                       >                       
                        </v-select>
              </div>
               <div class="form-group col-md-12" >
                      <label>Kuantiti Optimum</label>
              <input type="number" step="1" min="1" class="form-control" id="Optimum Level" placeholder="Kuantiti Optimum (3 bulan)" v-model="form.optimum_level"
              
              >
                
              
                         <small class="text-danger" v-if="errors.optimum_level">{{errors.optimum_level[0]}}</small>
              </div>
                   <div class="form-group col-md-12" >
                      <label>Kuantiti Minimum</label>
              <input type="number" step="1" min="1" class="form-control" id="Minimum Level" placeholder="Kuantiti Minimum (1 bulan)" v-model="form.minimum_level">
                
              
                         <small class="text-danger" v-if="errors.minimum_level">{{errors.minimum_level[0]}}</small>
              </div>
               <div class="form-group col-md-12" hidden >
                      <label>Department ID</label>
              <input type="text" class="form-control" id="Dept" v-model="form.current_team_id">
                        
              
              </div>
              <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Simpan</button>
               
                    </div>
        
      </form>      
               
          
      </b-modal>

  <!--Update Modal-->
  <div>
  <!-- -->
  <b-modal ref="update-modal" hide-footer title="Kemaskini Kategory">     
           <form class="user" @submit.prevent="Update">
        <div class="form-group col-md-12" >
                 
                <input type="text" class="form-control" id="formID"  v-model="forms.id" hidden>
                <label>Item</label>
               <select class="form-control" id="CategoryID" v-model="forms.item_id" disabled>
                        <option v-for="description in item_descriptions "   v-bind:key="description.id"  :value="description.id"> {{description.descriptions}}</option>
                        
                        </select>
                
              
                         <small class="text-danger" v-if="errors.descriptions">{{errors.descriptions[0]}}</small>
              </div>
               <div class="form-group col-md-12" >
                      <label>Kuantiti Optimum</label>
              <input type="number" step="1" min="1" class="form-control" id="Optimum Level" placeholder="Kuantiti Optimum"  v-model="forms.optimum_level" >
                
              
                         <small class="text-danger" v-if="errors.optimum_level">{{errors.optimum_level[0]}}</small>
              </div>
                 <div class="form-group col-md-12" >
                      <label>Kuantiti Minimum</label>
              <input type="number" step="1" min="1" class="form-control" id="Minimum Level" placeholder="Kuantiti Minimum" 
               v-model="forms.minimum_level" >
                
              
                         <small class="text-danger" v-if="errors.minimum_level">{{errors.minimum_level[0]}}</small>
              </div>
       
              <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Kemaskini</button>
               
                    </div>       
      </form>
           
   </b-modal>
 

 
<!--table-->


<div class="row">
    <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tetapan Item</h6>
                </div> 
 
      <b-row>
        <b-col sm="2" class="my-1">
         <b-button pill size="sm" variant="outline-secondary" id="show-btn" @click="showModal"> <i class="fas fa-plus"></i>&nbsp;Tambah</b-button>
        </b-col>
        <b-col sm="6" class="my-1">
        <b-form-group
          label=""
          label-for=" filter-input"
          label-cols-sm="0"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              id=" filter-input"
              v-model=" filter"
              type="search"
              placeholder="Type to Search"
            ></b-form-input>

            <b-input-group-append>
              <b-button :disabled="! filter" @click=" filter = ''">Clear</b-button>
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
            v-model=" perPage"
            :options=" pageOptions"
            size="sm"
          ></b-form-select>
        </b-form-group>
      </b-col>

   
      </b-row>

      <b-table head-variant
      :items=" items"
      :fields=" fields"
      :current-page=" currentPage"
      :per-page=" perPage"
      :filter=" filter"
      :filter-included-fields=" filterOn"
      :sort-by.sync=" sortBy"
      :sort-desc.sync=" sortDesc"
      :sort-direction=" sortDirection"
      stacked="md"
      show-empty
      small
    
        >

        <template #cell( items)="row">
            {{ row.value.first }} {{ row.value.last }}
        </template>

 <template #cell(image)="row">
    
       <img     
            class="d-block img-fluid w-60"
            width="60"
            height="60"
            :src="row.item.image"
            alt="image slot"
        >     
    
</template>

        
        <template #cell(actions)="row">
            <b-button size="sm" id="toggle-btn"  @click="toggleModal(row.item.id)" class="mr-1" v-b-tooltip.hover title="Edit Item">
             <i class="fas fa-edit"></i>
            </b-button>
            <b-button size="sm" class="btn btn-sm btn-danger" @click="delete (row.item.id)" v-b-tooltip.hover title="Delete Item">
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
               
                       

                    
                
                   <p class="mt-6" align="center" style="font-size:0.8em;">Current Page: {{  currentPage }} | Total Data: {{  rows }}</p>
                      <b-pagination
                      v-model=" currentPage"
                      :total-rows=" rows"
                      :per-page=" perPage"
                      aria-controls=" -table"
                      style="sm"
                      align="center"
                    ></b-pagination>

            

       </div>
    </div>
   </div>
                
             
              


          </div>
 </div>
     </div>
        
</div>

</template>



<script type="text/javascript">
 
 


  export default {
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'});

   

      }
    },
   mounted(){ 
    this.Optimum();
    this.getDepartment();
    this.getItem();
   
    let $LoggedRoles = localStorage.getItem('roles');
   
    if($LoggedRoles.toLowerCase().indexOf("head")===-1){
      this.$router.push({name: 'home'})
      Notification.unauthorized()
      }

  
    this.form.item_id = getItem(); 
  
    },
  
    
  	
  
   
     data(){
      return{
     
          item_descriptions:[{id:'', descriptions:''}
          ],


          form:{
          selected: null,
          current_team_id:null,
          optimum_level:null,          
          },
          
         
         forms:{
          id: null,
          minimum_level:null,
          optimum_level:null,  
          descriptions: null,
          item_id:null,        
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
//Items
         perPage: 15,
         currentPage: 1,
         pageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
         sortBy: ' _name',
         sortDesc: false,
         sortDirection: 'asc',
         filter: null,
         filterOn: [],
         items: [],
         fields: [
          { key: 'image', label: 'Imej', sortable:false, sortDirection: 'asc', image: true },  
          { key: 'descriptions', label: 'Item', sortable: true, sortDirection: 'asc' },          
          { key: 'optimum_level', label: 'Kuantiti Optimum', sortable: true, sortDirection: 'asc' },
          { key: 'minimum_level', label: 'Kuantiti Minimum', sortable: true, sortDirection: 'asc' },
          { key: 'actions', label: 'Actions' },

        ],
      }
      },

    computed:{
    
       rows() {
        return this. items.length
      },
 
      
    },
 
  methods:{


    
    getDepartment(){ // get  user department
      let self = this;
     let user_id= localStorage.getItem('user_id');

     axios.get('/api/user/'+user_id)
      .then(function (response) {
        self.form = response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    },

 //all   
    Optimum(){
     let team_id= localStorage.getItem('current_team_id');
      let self = this;
     axios.get('/api/optimum/view/'+team_id)
      .then(function (response) {
        self. items = response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    },

    getItem(){ // get Item Detail
    let self = this;
     axios.get('/api/items/')
      .then(function (response) {
        self.item_descriptions = response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    },


//delete

       delete (id){
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
                axios.delete('/api/optimum/'+id)
               .then(() => {
                this.Optimum();
                      
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

       hideModal() {
        this.$refs['update-modal'].hide()
      },
 // show update modal
       toggleModal(id) {
         axios.get('/api/optimum/'+id)
  	    .then(({data}) => (this.forms = data))
        this.$refs['update-modal'].toggle('#toggle-btn')      
      },



 //insert  
      departmentItemInsert(){
       axios.post('/api/optimum',this.form)
       .then(() => { 
       this.$refs['insert-modal'].hide('#insert-btn')  
         this.Optimum();
        Notification.success()
       })
          .catch(error=> this.errors = error.response.data.errors)
      
        },


 //update       
      Update(){
  	  let id = this.forms.id
       axios.patch('/api/optimum/'+id,this.forms)
       .then(() => { 
         this.$refs['update-modal'].hide('#update-btn')
         this.Optimum();
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
       
     }
  },

  
      
  }
  
  
   
</script>


<style type="text/css" scoped>
  #em_photo{
    height: 60px;
    width: 60px;
  }
</style>