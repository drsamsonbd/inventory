  

<template>
  
  <div>
 <b-breadcrumb :items="itemize"></b-breadcrumb>
 
 <div class="row">
   <div class="col-lg-12 mb-4">
  
  <!--Insert Modal-->
      <!--category-->
    <b-modal ref="category-insert-modal" hide-footer title="Kategori">
    
            <form class="user" @submit.prevent="categoryInsert">
              <b-row>
                <b-col>
                  <label for=""><b>Kod</b></label>
              <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Sila masukkan kategori" v-model="form.finance_code">
              <small class="text-danger" v-if="errors.finance_code"> {{ errors.finance_code[0] }} </small>   
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                  <label for=""><b>Deskripsi</b></label>        <input type="text" class="form-control" id="descriptions" placeholder="Deskripsi peruntukan" v-model="form.descriptions">
              <small class="text-danger" v-if="errors.descriptions"> {{ errors.descriptions[0] }} </small>   
                </b-col>
            </b-row>
            <br>
            <b-row>
              <b-col>
            <b-button type="submit" id="insert-btn" class="btn-outline btn-primary btn-block">Simpan</b-button>
              </b-col>
            </b-row>
              
        
      </form>      
               
          
      </b-modal>


 <!--kod aktiviti insert-->

    <b-modal ref="aktiviti-insert-modal" hide-footer title="Kod Aktiviti">
    
            <form class="user" @submit.prevent="aktivitiInsert">

              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
              <input type="text" class="form-control" id="aktiviti" placeholder="Sila masukkan Kod Aktiviti" v-model="forma.aktiviti_code">
              <small class="text-danger" v-if="errors.aktiviti_code"> {{ errors.aktiviti_code[0] }} </small>          
            </div> 
            </div>
        </div>
         <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
              <input type="text" class="form-control" id="desc aktiviti" placeholder="Deskripsi" v-model="forma.aktiviti_descriptions">
              <small class="text-danger" v-if="errors.aktiviti_descriptions"> {{ errors.aktiviti_descriptions[0] }} </small>          
            </div> 
            </div>
        </div>
        <br>
            <b-col>
                     <label><b>Kod OS</b></label><br>
                     <select class="form-control" id="ol-code" v-model="forma.ol_code">
                        <option  v-for="ol_code in olitems" v-bind:key="ol_code.ol_code"> {{ol_code.ol_code}}</option>
                        
                        </select>
                         <small class="text-danger" v-if="errors.ol_code">{{errors.ol_code[0]}}</small>
                

                    </b-col> <br>
          <div class="form-group">
          <button type="submit" id="aktiviti-insert-btn" class="btn btn-primary btn-block">Simpan</button>
        </div>
        
      </form>      
               
          
      </b-modal>-->
 <!--ol-->

  <b-modal ref="ol-insert-modal" hide-footer title="OBJEK LANJUT">
    
            <form class="ol" @submit.prevent="olInsert">
                 <b-row>
                <b-col>
                  <label for=""><b>Kod</b></label>
              <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Sila masukkan kategori" v-model="formol.ol_code">
              <small class="text-danger" v-if="errors.ol_code"> {{ errors.ol_code[0] }} </small>   
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                  <label for=""><b>Deskripsi</b></label>       
                   <input type="text" class="form-control" id="descriptions" placeholder="Deskripsi peruntukan" v-model="formol.ol_descriptions">
              <small class="text-danger" v-if="errors.ol_descriptions"> {{ errors.ol_descriptions[0] }} </small>   
                </b-col>
            </b-row>
            <br>
            <b-col>
                     <label><b>Kod OS</b></label><br>
                     <select class="form-control" id="financeID" v-model="formol.finance_code_id">
                        <option  v-for="finance_categories in categoryitems" v-bind:key="finance_categories.id"> {{finance_categories.finance_code}}</option>
                        
                        </select>
                         <small class="text-danger" v-if="errors.sku">{{errors.sku[0]}}</small>
                

                    </b-col>
                    <br>
            <b-row>
              <b-col>
            <b-button type="submit" id="ol-insert-btn" class="btn-outline btn-primary btn-block">Simpan</b-button>
              </b-col>
            </b-row>


      </form>      
               
          
      </b-modal>


 
  <!--Update Modal-->
  <div>
  <!--category-->
  <b-modal ref="update-modal" hide-footer title="Kemaskini Kod Peruntukan">     
           <form class="user" @submit.prevent="categoryUpdate">
                    <b-row>
                <b-col>
                  <label for=""><b>Kod</b></label>
              <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Sila masukkan kategori" v-model="forms.finance_code">
              <small class="text-danger" v-if="errors.finance_code"> {{ errors.finance_code[0] }} </small>   
                </b-col>
            </b-row>
            <br>
            <b-row>
                <b-col>
                  <label for=""><b>Deskripsi</b></label>        <input type="text" class="form-control" id="descriptions" placeholder="Deskripsi peruntukan" v-model="forms.descriptions">
              <small class="text-danger" v-if="errors.descriptions"> {{ errors.descriptions[0] }} </small>   
                </b-col>
            </b-row>
            <br>
            <b-row>
              <b-col>
            <b-button type="submit" id="update-btn" class="btn-outline btn-primary btn-block">Kemaskini</b-button>
              </b-col>
            </b-row>
          
      </form>
           
   </b-modal>
 <!--kod aktivti-->
  <b-modal ref="aktiviti-update-modal" hide-footer title="Kemaskini Kod Aktiviti">     
           <form class="user" @submit.prevent="akltivitiUpdate">
         <div class="form-group" hidden>
          <label>Aktiviti ID:</label>
          <input type="hidden" class="form-control" id="aktivitiID" placeholder="ID" v-model="formas.id">
          </div>
          <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
              <input type="text" class="form-control" id="aktiviti" placeholder="Sila masukkan Kod Aktiviti" v-model="formas.aktiviti_code">
              <small class="text-danger" v-if="errors.aktiviti_code"> {{ errors.aktiviti_code[0] }} </small>          
            </div> 
            </div>
        </div>
         <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
              <input type="text" class="form-control" id="desc aktiviti" placeholder="Deskripsi" v-model="formas.aktiviti_descriptions">
              <small class="text-danger" v-if="errors.aktiviti_descriptions"> {{ errors.aktiviti_descriptions[0] }} </small>          
            </div> 
            </div>
        </div>
        <br>
            <b-col>
                     <label><b>Kod OS</b></label><br>
                     <select class="form-control" id="ol-code" v-model="formas.ol_code">
                        <option  v-for="ol_code in olitems" v-bind:key="ol_code.ol_code"> {{ol_code.ol_code}}</option>
                        
                        </select>
                         <small class="text-danger" v-if="errors.ol_code">{{errors.ol_code[0]}}</small>
                

                    </b-col> <br>
        <div class="form-group">
          <button type="submit" id="aktiviti-update-btn"  class="btn btn-primary btn-block">Kemaskini</button>
        </div>        
      </form>
           
   </b-modal>
<!-- ol -->
  <b-modal ref="ol-update-modal" hide-footer title="Kemaskini">     
           <form class="user" @submit.prevent="olUpdate">
            <b-row>
             <b-col>
                  <label for=""><b>Kod</b></label>
              <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Sila masukkan kategori" v-model="formols.ol_code">
              <small class="text-danger" v-if="errors.ol_code"> {{ errors.ol_code[0] }} </small>   
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                  <label for=""><b>Deskripsi</b></label>       
                   <input type="text" class="form-control" id="descriptions" placeholder="Deskripsi peruntukan" v-model="formols.ol_descriptions">
              <small class="text-danger" v-if="errors.ol_descriptions"> {{ errors.ol_descriptions[0] }} </small>   
                </b-col>
            </b-row>
            <br>
            <b-row>
            <b-col>
                     <label><b>Kod OS</b></label><br>
                     <select class="form-control" id="financeID" v-model="formols.finance_code_id">
                        <option  v-for="finance_categories in categoryitems" v-bind:key="finance_categories.id"> {{finance_categories.finance_code}}</option>
                        
                        </select>
                         <small class="text-danger" v-if="errors.sku">{{errors.sku[0]}}</small>
                

                    </b-col>
                    </b-row>
                    <br>
            <b-row>
              <b-col>
            <b-button type="submit" id="ol-update-btn" class="btn-outline btn-primary btn-block">Kemaskini</b-button>
              </b-col>
            </b-row>
              
      </form>
           
   </b-modal>

   </div>



 
<!--kategori table-->


<b-row>
   <div class="col-lg-6 mb-4">
              <!-- Simple Tables -->
              <div class="card">
    <b-col class="shadow-sm  bg-white">
           <caption><h5><b>Kategori</b></h5></caption>  
 
      <b-row>
       <b-col sm="3" class="my-1">
  
        <b-button pill size="sm" variant="outline-secondary" id="show-btn" @click="showModal"> <i class="fas fa-plus"></i>&nbsp;Tambah</b-button>
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
            <b-button size="sm" id="toggle-btn"  @click="toggleModal(row.item.id)" class="mr-1" v-b-tooltip.hover title="Edit">
           <i class="fas fa-edit"></i>
            </b-button>
            <b-button size="sm" class="btn btn-sm btn-danger" @click="deleteCategory(row.item.id)" v-b-tooltip.hover title="Delete">
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


   <!--ol table-->

      </div>
      </div>
  <div class="col-lg-6 mb-4">
              <!-- Simple Tables -->
              <div class="card">
    <b-col class="shadow-sm  bg-white">
   <b-row>


   <caption><h5><b>Objek Lanjut</b></h5></caption>
    </b-row>
     <b-row>
       
      <b-col sm="3" class="my-1">
  
        <b-button pill size="sm" variant="outline-secondary" id="show-btn" @click="showModalol"> <i class="fas fa-plus"></i>&nbsp;Tambah</b-button>
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
              v-model="olfilter"
              type="search"
              placeholder="Type to Search"
            ></b-form-input>

            <b-input-group-append>
              <b-button :disabled="!olfilter" @click="olfilter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
       <b-col sm="2" class="my-1">
        <b-form-group
          label=""
          label-for="per-page-select"
          label-cols-sm="2"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
        >
          <b-form-select
            id="per-page-select"
            v-model="olperPage"
            :options="olpageOptions"
            size="sm"
          ></b-form-select>
        </b-form-group>
      </b-col>
 

    </b-row>

      <b-table head-variant
      :items="olitems"
      :fields="olfields"
      :current-page="olcurrentPage"
      :per-page="olperPage"
      :filter="olfilter"
      :filter-included-fields="olfilterOn"
      :sort-by.sync="olsortBy"
      :sort-desc.sync="olsortDesc"
      :sort-direction="olsortDirection"
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
            <b-button size="sm" id="ol-toggle-btn"  @click="toggleModalol(row.item.id)" class="mr-1" v-b-tooltip.hover title="Edit">
           <i class="fas fa-edit"></i>
            </b-button>
            <b-button size="sm" class="btn btn-sm btn-danger" @click="deleteol(row.item.id)"  v-b-tooltip.hover title="Delete">
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
               
                   <p class="mt-6" align="center" style="font-size:0.8em;">Current Page: {{ olcurrentPage }}</p>
                      <b-pagination
                      v-model="olcurrentPage"
                      :total-rows="olrows"
                      :per-page="olperPage"
                      aria-controls="ol-table"
                      size="sm"
                      align="center"
                    ></b-pagination>

  </b-col>
              </div>
   </div>
   
  </b-row>
  <!--kOD AKTIVITI TABLE-->

<b-row>
    <div class="col-lg-6 mb-4">
              <!-- Simple Tables -->
              <div class="card">
    <b-col class="shadow-sm  bg-white">
      <b-row>
      <caption><h5><b>Kod Aktiviti</b></h5></caption>
      </b-row>
        <b-row>
          
          <b-col sm="3" class="my-1">
      
            <b-button pill size="sm" variant="outline-secondary" id="show-btn" @click="showModalaktiviti"> <i class="fas fa-plus"></i>&nbsp;Tambah</b-button>
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
                  v-model="olfilter"
                  type="search"
                  placeholder="Type to Search"
                ></b-form-input>

                <b-input-group-append>
                  <b-button :disabled="!olfilter" @click="olfilter = ''">Clear</b-button>
                </b-input-group-append>
              </b-input-group>
            </b-form-group>
          </b-col>
          <b-col sm="2" class="my-1">
            <b-form-group
              label=""
              label-for="per-page-select"
              label-cols-sm="2"
              label-align-sm="right"
              label-size="sm"
              class="mb-0"
            >
              <b-form-select
                id="per-page-select"
                v-model="aktivitiperPage"
                :options="aktivitipageOptions"
                size="sm"
              ></b-form-select>
            </b-form-group>
          </b-col>
    

        </b-row>

          <b-table head-variant
          :items="aktivitiitems"
          :fields="aktivitifields"
          :current-page="aktiviticurrentPage"
          :per-page="aktivitiperPage"
          :filter="aktivitifilter"
          :filter-included-fields="aktivitifilterOn"
          :sort-by.sync="aktivitisortBy"
          :sort-desc.sync="aktivitisortDesc"
          :sort-direction="aktivitisortDirection"
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
                <b-button size="sm" id="ol-toggle-btn"  @click="toggleModalaktiviti(row.item.id)" class="mr-1" v-b-tooltip.hover title="Edit">
              <i class="fas fa-edit"></i>
                </b-button>
                <b-button size="sm" class="btn btn-sm btn-danger" @click="deleteaktiviti(row.item.id)"  v-b-tooltip.hover title="Delete">
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
               
                   <p class="mt-6" align="center" style="font-size:0.8em;">Current Page: {{ olcurrentPage }}</p>
                      <b-pagination
                      v-model="olcurrentPage"
                      :total-rows="olrows"
                      :per-page="olperPage"
                      aria-controls="ol-table"
                      size="sm"
                      align="center"
                    ></b-pagination>

 
 </b-col>
              </div>
              </div>
              </b-row>
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
    this.allCategory();
    this.allaktiviti();
    this.allol();
   
    let $LoggedRoles = localStorage.getItem('roles');
   
    if($LoggedRoles.toLowerCase().indexOf("head")===-1){
      this.$router.push({name: 'home'})
      Notification.unauthorized()
      }
  
    },
  
    
  	
  
   
     data(){
      return{
          form:{
          finance_code: null,
          descriptions: null,
          
      
        },
          forms:{
          
          finance_code: null,
          descriptions: null,
       
      
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
            text: 'Tetapan',
            active: true
          },
        ],
          modalShow: false,
//category
        categoryperPage: 15,
        categorycurrentPage: 1,
        categorypageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
        categorysortBy: 'finance_code',
        categorysortDesc: false,
        categorysortDirection: 'asc',
        categoryfilter: null,
        categoryfilterOn: [],
        categoryitems: [],
        categoryfields: [
          { key: 'finance_code', label: 'Kod', sortable: true, sortDirection: 'asc' },
           { key: 'descriptions', label: 'Deskripsi', sortable: true, sortDirection: 'asc' },
          { key: 'actions', label: 'Actions' },

        ],

        ol_codes:[],
//Aktiviti
         forma:{
       aktiviti_code: null,
       aktiviti_descriptions: null,
       ol_code:null,
   
      },
       formas:{
         aktiviti_code: null,
       aktiviti_descriptions: null,
       ol_code:null,
       
   
     },


     aktivitiperPage: 5,
     aktiviticurrentPage: 1,
     aktivitipageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
     aktivitisortBy: 'aktiviti_code',
     aktivitisortDesc: false,
     aktivitisortDirection: 'asc',
     aktivitifilter: null,
     aktivitifilterOn: [],
       aktivitiitems: [],
       aktivitifields: [
        { key: 'aktiviti_code', label: 'Kod Aktiviti', sortable: true, sortDirection: 'asc' },
        
        { key: 'aktiviti_descriptions', label: 'Deskripsi', sortable: true, sortDirection: 'asc' },
        
        { key: 'lo_code', label: 'Kod Objek Lanjut', sortable: true, sortDirection: 'asc' },
         { key: 'actions', label: 'Actions' },
        ],



 //ol    
         formol:{
          ol_code: null,
          ol_descriptions: null,
          finance_code_id: null,
      
        },
          formols:
            {
              id:null,
          ol_code: null,
          ol_descriptions: null,
          finance_code_id: null,
      
        }
          ,

        olperPage: 5,
        olcurrentPage: 1,
        olpageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
        olsortBy: 'ol_code',
        olsortDesc: false,
        olsortDirection: 'asc',
        olfilter: null,
         olfilterOn: [],

          olitems: [],
          olfields: [
           { key: 'ol_code', label: 'Kod', sortable: true, sortDirection: 'asc' },           
           { key: 'ol_descriptions', label: 'Deskripsi', sortable: true, sortDirection: 'asc' },           
           { key: 'finance_code_id', label: 'Kod OS', sortable: true, sortDirection: 'asc' },
            { key: 'actions', label: 'Actions' },
           ],
      }
 





    },
    computed:{
    
      categoryrows() {
        return this.categoryitems.length
      },
       aktivitirows() {
        return this.aktivitiitems.length
      },
       olrows() {
        return this.olitems.length
      }
      
    },
 
  methods:{

 //all   
    allCategory(){
    let self = this;
     axios.get('/api/finance_category/')
      .then(function (response) {
        self.categoryitems = response.data;
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    },
   allaktiviti(){
  let self = this;
   axios.get('/api/finance/activity')
    .then(function (response) {
      self.aktivitiitems = response.data;
    }).catch(function (error) {
      console.log(error);
      self.$router.push({ path: '/login' });
    });
  },
    allol(){
    let self = this;
     axios.get('/api/ol/')
      .then(function (response) {
        self.olitems = response.data;
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
                axios.delete('/api/finance_category/'+id)
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


     deleteaktiviti(id){
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
              axios.delete('/api/finance/activity/'+id)
             .then(() => {
              this.allaktiviti();
                       
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
      deleteol(id){
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
                axios.delete('/api/ol/'+id)
               .then(() => {
                this.allol();
                         
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
        this.$refs['category-insert-modal'].show()
      },

       showModalaktiviti() {
       this.$refs['aktiviti-insert-modal'].show()
     },

        showModalol() {
        this.$refs['ol-insert-modal'].show()
      },



       hideModal() {
        this.$refs['update-modal'].hide()
      },
 // show update modal
       toggleModal(id) {
         axios.get('/api/finance_category/'+id)
  	    .then(({data}) => (this.forms = data))
        this.$refs['update-modal'].toggle('#toggle-btn')       
      },
      
       toggleModalaktiviti(id) {
        axios.get('/api/finance/activity/'+id)
 	    .then(({data}) => (this.formas = data))
       this.$refs['aktiviti-update-modal'].toggle('#aktiviti-toggle-btn')       
     },
      toggleModalol(id) {
         axios.get('/api/ol/'+id) 
        .then(({data}) => (this.formols = data))
        this.$refs['ol-update-modal'].toggle('#ol-toggle-btn')       
      },


  	    
 //insert  
       categoryInsert(){
       axios.post('/api/finance_category',this.form)
       .then(() => { 
       this.$refs['category-insert-modal'].hide('#insert-btn')  
         this.allCategory();
        Notification.success()
       })
          .catch(error=> this.errors = error.response.data.errors)
      
        },
        aktivitiInsert(){
        axios.post('/api/finance/activity',this.forma)
        .then(() => { 
        this.$refs['aktiviti-insert-modal'].hide('#aktiviti-insert-btn')  
         this.allaktiviti();
        Notification.success()
       })
          .catch(error=> this.errors = error.response.data.errors)

        },
        olInsert(){
        axios.post('/api/ol',this.formol)
        .then(() => { 
        this.$refs['ol-insert-modal'].hide('#ol-insert-btn')  
         this.allol();
        Notification.success()
       })
          .catch(error=> this.errors = error.response.data.errors)
      
        },


 //update       
     categoryUpdate(){
  	  let id = this.forms.id
       axios.patch('/api/finance_category/'+id,this.forms)
       .then(() => { 
         this.$refs['update-modal'].hide('#update-btn')
         this.allCategory();
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
       
     },
      aktivitiUpdate(){
  	  let id = this.formas.id
       axios.patch('/api/finance/activity/'+id,this.formas)
       .then(() => { 
         this.$refs['aktiviti-update-modal'].hide('#aktiviti-update-btn')
        this.allaktiviti();
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
       
     },
  olUpdate(){
  	  let id = this.formols.id
       axios.patch('/api/ol/'+id,this.formols)
       .then(() => { 
         this.$refs['ol-update-modal'].hide('#ol-update-btn')
        this.allol();
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