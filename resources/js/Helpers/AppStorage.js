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
        store(token, user, roles){
            this.storeToken(token)
            this.storeUser(user)
            this.storeRoles(roles)

        }

        clear(){

            localStorage.removeItem('token')
            localStorage.removeItem('user')
            localStorage.removeItem('roles')
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
}
export default Appstorage = new Appstorage();