<template>
  <d-card class="card-small mb-4 pt-3">

    <!-- Card Header -->
    <d-card-header class="border-bottom text-center">

      <!-- User Avatar -->
      <div class="mb-3 mx-auto">
        <img class="rounded-circle" :src="userDetails.avatar" :alt="userDetails.name" width="110">
      </div>

      <!-- User Name -->
      <h4 class="mb-0">{{ userDetails.name }}</h4>

      <!-- User Job Title -->
      <span class="text-muted d-block mb-2">{{ userDetails.jobTitle }}</span>

      <!-- User Follow -->
      <d-button pill outline size="sm" class="mb-2"> <i class="material-icons mr-1">person_add</i> Follow</d-button>

    </d-card-header>

    <d-list-group flush>

      <!-- User Performance Report -->
      <d-list-group-item class="px-4">
        <div class="progress-wrapper">
          <strong class="text-muted d-block mb-2">{{ userDetails.performanceReportTitle }}</strong>
          <d-progress class="progress-sm">
            <span class="progress-value">{{ userDetails.performanceReportValue }}%</span>
            <d-progress-bar :max="100" :value="userDetails.performanceReportValue" />
          </d-progress>
        </div>
      </d-list-group-item>

      <!-- User Meta -->
      <d-list-group-item>
        <strong class="text-muted d-block mb-2">{{ userDetails.metaTitle }}</strong>
        <span>{{ userDetails.metaValue }}</span>
      </d-list-group-item>
    </d-list-group>

  </d-card>
</template>

<script>
const defaultUserDetails = {
  name: 'Sierra Brooks',
  avatar: require('@/assets/images/avatars/0.jpg'),
  jobTitle: 'Project Manager',
  performanceReportTitle: 'Workload',
  performanceReportValue: 74,
  metaTitle: 'Description',
  metaValue: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio eaque, quidem, commodi soluta qui quae minima obcaecati quod dolorum sint alias, possimus illum assumenda eligendi cumque?',
};

export default {
  name: 'user-details',
  props: {    created(){
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
    /**
       * The user details.
       */
    userDetails: {
      type: Object,
      default() {
        return defaultUserDetails;
      },
    },
  },
};
</script>
