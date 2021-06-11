import Token from './Token'
import AppStorage from './AppStorage'


class User{

responseAfterLogin(res){
    const access_token = res.data.access_token
    const username = res.data.name
    const roles= res.data.roles
    const user_id= res.data.user_id
    const current_team_id= res.data.current_team_id
    if(Token.isValid(access_token)){
        AppStorage.store(access_token,username,roles,user_id,current_team_id)

    }
}

hasToken(){
    const storeToken = localStorage.getItem('token');
    if(storeToken){
        return Token.isValid(storeToken)? true : false
    }
    false
}

loggedIn(){
    return this.hasToken()

}
name(){
    if(this.loggedIn()){
        return localStorage.getItem('user');
    }
}
roles(){
    if(this.loggedIn()){
        return localStorage.getItem('roles');
    }
}
user_id(){
    if(this.loggedIn()){
        return localStorage.getItem('user_id');
    }
}
id(){
    if(this.loggedIn()){
        const payload = Token.payload (localStorage.getItem('token')) ;
        return payload.sub
    }
    return false
}
current_team_id(){
    if(this.loggedIn()){
        return localStorage.getItem('current_team_id');
    }

}


}
export default User = new User();