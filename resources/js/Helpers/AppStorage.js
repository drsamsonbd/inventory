class Appstorage{
        storeToken(token){
            localStorage.setItem('token',token);
        }
        storeToken(user){
            localStorage.setItem('user',user);

        }
        clear(){

            localStorage.removeItem('token')
            localStorage.removeItem('user')
        }
        getToken(){
            localStorage.getItem(token);
        }
        getUser(){
            localStorage.getItem(user);
        }
}
export default Appstorage = new Appstorage();