class Appstorage{
        storeToken(token){
            localStorage.setItem('token',token);
        }
        storeUser(user){
            localStorage.setItem('user',user);

            
        }
        storeRoles(roles){
            localStorage.setItem('roles',roles);

            
        }
        storeID(user_id){
            localStorage.setItem('user_id',user_id);

            
        }
        store(token, user, roles, user_id){
            this.storeToken(token)
            this.storeUser(user)
            this.storeRoles(roles)
            this.storeID(user_id)    
        }

        clear(){

            localStorage.removeItem('token')
            localStorage.removeItem('user')
            localStorage.removeItem('roles')
            localStorage.removeItem('user_id')
        }

        getToken(){
            localStorage.getItem(token);
        }
        getUser(){
            localStorage.getItem(user);
        }
        getRoles(){
            localStorage.getItem(roles);
        }
        getID(){
            localStorage.getItem(user_id);
        }
}
export default Appstorage = new Appstorage();