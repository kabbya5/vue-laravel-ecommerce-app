class AppStorage{
    storeToken(token){
        localStorage.setItem('token',token);
    }
    storeUser(user){
        let newUser = {
            name: user.name,
            email: user.email,
            user_type:user.user_type,
            email_verified_at: user.email_verified_at,
        }
        localStorage.setItem('user',JSON.stringify(newUser));
    }

    store(user,token){
        this.storeToken(token);
        this.storeUser(user);
    }

    clear(){
        localStorage.removeItem('token');
        localStorage.removeItem('user');
    }

    getToken(){
        return localStorage.getItem('token');
    }
    getUser(){
        return JSON.parse(localStorage.getItem('user'));
    }
}

export default AppStorage = new AppStorage();