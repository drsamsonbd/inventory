<template>

</template>


<script type="text/javascript">
export default {
    created(){        
            localStorage.removeItem('token')
            localStorage.removeItem('user')
            localStorage.removeItem('roles')
              Toast.fire({
              icon: 'warning',
              title: 'You have logged out!'
            })
               this.$router.push({name:'/'})
               window.location.reload()   
        }

    }

</script>

<style type="text/css">

</style>