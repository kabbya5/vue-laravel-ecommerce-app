import Token from "./Token";
import AppStorage from "./AppStorage";
class User{
    login(data){
        axios.post('/api/auth/login',data)
        .then(res => {
            this.responseAfterLogin(res);
            window.location = '/';
        })
    }
    responseAfterLogin(res){
        const access_token = res.data.access_token;
        const user = res.data.user;
        if(Token.isValid(access_token)){
            AppStorage.store(user,access_token);
        }
    }

    hasToken(){
        const storedToken = AppStorage.getToken();
        if(storedToken){
            return Token.isValid(storedToken) ? true :false;
        }
    }

    loggedIn(){
        return this.hasToken();
    }

    logout(){
        AppStorage.clear();
        window.location = '/'
    }

    auth(){
        if(this.loggedIn()){
            return AppStorage.getUser()
        }
    }

    updateAuth(keyName,value){
        let user = this.auth();
        user[keyName] = value;
        
        AppStorage.storeUser(user);
       
    }
    
    id(){
        if(this.loggedIn()){
            const payload = Token.payload(AppStorage.getToken());
            return payload.sub
        }
    }
}

export default User = new User();
