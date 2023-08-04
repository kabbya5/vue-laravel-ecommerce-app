import { createWebHistory,createRouter } from "vue-router";
import User from './helpers/User';
import store from './store/';

// user
// error page 
import NotFound from './components/error/NotFound.vue';
import Login from './components/Login.vue';
import Signup from './components/Signup.vue';
import VerifyEmail from './components/VerifyEmail.vue';
import Profile from './view/Profile.vue';
import Home from './view/Home.vue';
import CategoryProducts from './view/CategoryProducts.vue';

// Admin 

import AdminDashboard from './view/admin/Dashboard.vue';
import AdminSetting from './view/admin/Setting.vue';
import Category from './view/admin/Category.vue';
 


const routes = [
    //user 
    // error 
    {
        path: '/:catchAll(.*)',
        name:'notFound',
        component:NotFound,
    },
    {path:'/',name:'home',component:Home},

    {
        path:'/login',
        name:'login',
        component:Login,
        beforeEnter:[authGuard],
    },

    {
        path:'/signup',
        name:'signup',
        component:Signup,
        beforeEnter:[authGuard],
    },

    {
        path:'/verify/email',
        name:'verify',
        component:VerifyEmail,
        beforeEnter:[authGuard],
    },

    {
        path:'/profile',
        name:'profile',
        component:Profile,
        beforeEnter:[authGuard,verifyGuard],
    },
    
    {
        path:'/category/:slug',
        name:'categoryProdcts',
        component:CategoryProducts,
    },

    //admin
    {
        path:'/admin/dashboard',
        name:'adminDashboard',component:AdminDashboard,
        beforeEnter:[adminGuard],
    },

    {
        path:'/admin/dashboard/category',
        name:'categories',component:Category,
        beforeEnter:[adminGuard],
    },

    {
       path:'/admin/dashobard/setting',
       name:'adminSetting',
       component:AdminSetting, 
       beforeEnter:[adminGuard],
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

function authGuard(to,from, next){
    let userid = User.id();
    let user_tpye = User.auth.user_tpye;
    if(userid){
        if(to.path == '/signup'){
            return next({name:'profile'}) ;
        }else if(user_tpye === 'user' && to.path =='login'){
            return next({name:'profile'}) ;
        }else{
            next();
        }
       
    }else if(to.path == '/signup' || to.path == '/login'){
        next();
    }else{
        store.dispatch('fetchNotification',{
            type:'error',
            message:'Un excepted erorr,Place login and try again',
        })
        next({name:'login'});   
    }     
}

function adminGuard(to,from,next){
    let user_type = User.auth().user_type;
    
    if(user_type ==='admin'){
        if(to.path == '/signup' || to.path == '/login'){
            return next({name:'adminDashboard'}) ;
        }else{
            return next();
        }
    }else{
        window.location = '/login';
    }
}

function verifyGuard(to,from,next){
    let verify = User.auth().email_verified_at;
    if(verify){
        console.log(verify);
        next();
    }else{
        console.log(verify);
        store.dispatch('fetchNotification',{
            type:'error',
            message:'Places Verify Your Account Here!',
        })
        next({name:'verify'});
    }
}


export default router;