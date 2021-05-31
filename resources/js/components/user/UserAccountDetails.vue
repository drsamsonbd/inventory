<template>
  <d-card class="card-small mb-4">

    <!-- Card Header -->
    <d-card-header class="border-bottom">
      <h6 class="m-0">{{ title }}</h6>
    </d-card-header>

    <d-list-group flush>
      <d-list-group-item class="p-3">
        <d-row>
          <d-col>
            <d-form>
              <d-form-row>

                <!-- First Name -->
                <d-col md="6" class="form-group">
                  <label for="feFirstName">First Name</label>
                  <d-form-input type="text" id="feFirstName" placeholder="First Name" value="Sierra" />
                </d-col>

                <!-- Last Name -->
                <d-col md="6" class="form-group">
                  <label for="feLastName">Last Name</label>
                  <d-form-input type="text" id="feLastName" placeholder="Last Name" value="Brooks" />
                </d-col>

              </d-form-row>

              <d-form-row>

                <!-- Email -->
                <d-col md="6" class="form-group">
                  <label for="feEmail">Email</label>
                  <d-form-input type="email" id="feEmail" placeholder="Email Address" value="sierra@example.com" />
                </d-col>

                <!-- Password -->
                <d-col md="6" class="form-group">
                  <label for="fePassword">Password</label>
                  <d-form-input type="password" id="fePassword" placeholder="Last Name" value="EX@MPL#P@$$w0RD" />
                </d-col>

              </d-form-row>

              <!-- Address -->
              <div class="form-group">
                <label for="feInputAddress">Address</label>
                <d-form-input type="text" id="feInputAddress" placeholder="1234 Main St" />
              </div>

              <d-form-row>
                <!-- City -->
                <d-col md="6" class="form-group">
                  <label for="feInputCity">City</label>
                  <d-form-input type="text" id="feInputCity" />
                </d-col>

                <!-- State -->
                <d-col md="4" class="form-group">
                  <label for="feInputState">State</label>
                  <d-select :value="null" id="feInputState">
                    <option :value="null" selected>Choose...</option>
                    <option>...</option>
                  </d-select>
                </d-col>

                <!-- Zip Code -->
                <d-col md="2"  class="form-group">
                  <label for="inputZip">Zip</label>
                  <input type="text" class="form-control" id="inputZip">
                </d-col>

              </d-form-row>

              <d-form-row>

                <!-- Description -->
                <d-col md="12" class="form-group">
                  <label for="feDescription">Description</label>
                  <d-textarea name="feDescription" rows="5"></d-textarea>
                </d-col>
              </d-form-row>

              <d-button type="submit" class="btn-accent">Update Account</d-button>

            </d-form>
          </d-col>
        </d-row>
      </d-list-group-item>
    </d-list-group>
  </d-card>
</template>

<script>
export default {
  name: 'user-account-details',
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

        perPage: 10,
        currentPage: 1,
        pageOptions: [5, 10, 15, 25, { value: 100, text: "Show a lot" }],
        sortBy: 'category_name',
        sortAsc: true,
        sortDirection: 'asc',
        filter: null,
        filterOn: [],
        items: [],
        fields: [
           { key: 'index', label:'No.'},
          { key: 'category_name', label: 'Kategori', sortable: true, sortDirection: 'asc' },
          { key: 'actions', label: 'Actions' },
        ],
      }
 





    },
    computed:{
      filtersearch(){
      return this. category_name.filter(category=> {
         return category.category_name.match(this.searchTerm)
      }) 
      },
      rows() {
        return this.items.length
      }
    },
 
  methods:{
    allCategory(){
    let self = this;
     axios.get('/api/category/')
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
                axios.delete('/api/category/'+id)
               .then(() => {
                  window.location.reload()
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
        this.$refs['my-modal'].show()
      },
       hideModal() {
        this.$refs['edit-modal'].hide()
      },
       toggleModal(id) {
         axios.get('/api/category/'+id)
  	    .then(({data}) => (this.forms = data))
        this.$refs['edit-modal'].toggle('#toggle-btn')
       
      },
   
       categoryInsert(){
       axios.post('/api/category',this.form)
       .then(() => {
        window.location.reload()
        Notification.success()
       })
          .catch(error=> this.errors = error.response.data.errors)
      
        },
     categoryUpdate(){
  	  let id = this.forms.id
       axios.patch('/api/category/'+id,this.forms)
       .then(() => {
        window.location.reload()
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
       
     },
   
  }
  
  }

</script>
