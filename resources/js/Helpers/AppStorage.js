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


        storeTeamID(current_team_id){
            localStorage.setItem('current_team_id',current_team_id);
    

            
        }
        store(token, user, roles, user_id, current_team_id){
            this.storeToken(token)
            this.storeUser(user)
            this.storeRoles(roles)
            this.storeID(user_id)    
            this.storeTeamID(current_team_id) 
        }

        clear(){

            localStorage.removeItem('token')
            localStorage.removeItem('user')
            localStorage.removeItem('roles')
            localStorage.removeItem('user_id')
            localStorage.removeItem('current_team_id')
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
        getTeamID(){
            localStorage.getItem(current_team_id);
        }

}
export default Appstorage = new Appstorage();