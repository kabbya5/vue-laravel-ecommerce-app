<template>
    <div>
        <header class="header">
            <div class="top-nav px-2 bg-black text-gray-300">
                <div class="container mx-auto flex flex-col md:flex-row justify-between py-2 items-center">
                    <div class="flex flex-col md:flex-row items-center">
                        <a href="mailto:kabbya44@gmail.com" class="text-sm font-semibold"> <span class="text-gray-500"> Email </span>  : kabbya44@gmail.com </a>
                        <p class="my-1 md:my-0  md:mx-4 text-sm font-semibold">  Free Shipping for all Order of $99 </p>
                    </div>
                    <div class="flex flex-col md:flex-row items-center">
                        <a href="#" class="my-1 md:my-0 text-sm font-semibold capitalize transition duration-300 hover:text-green-800"> My account 
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                        <a href="#" class="md:ml-6  text-sm font-semibold capitalize transition duration-300 hover:text-green-800"> Language 
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mid-nav pl-2 container mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <a href="#" class="hidden md:block brand-imgae -ml-12">
                        <img class="h-[120px]" src="https://cdn.logojoy.com/wp-content/uploads/2018/08/23141702/3_big1.png" alt="">
                    </a>
                    <!-- mobail-nav  -->
                    <div class="md:hidden flex justify-between items-center mt-6 md:mt-0 md:ml-4 w-full">
                        <a href="#" class="brand-imgae -ml-12">
                            <img class="h-[120px]" src="https://cdn.logojoy.com/wp-content/uploads/2018/08/23141702/3_big1.png" alt="">
                        </a>
                        <div class="flex">
                            <button @click="showAccountNav =! showAccountNav" class="relative mr-10 text-gray-500 text-sm"> 
                                <i class="fa-regular fa-user fa-2x"></i>
                                <span class="absolute bg-red-500 w-5 h-5 text-white -top-2 left-4 rounded-full flex items-center justify-center">3 </span>
    
                                <div v-if="showAccountNav" class="account-nav absolute top-9 right-0">
                                    <div class="p-4 bg-green-50 shadow-md z-100" >
                                        <div class="nav-item flex justify-between items-center w-64">
                                            <router-link class="link" v-if="!userid" :to="{name:'login'}">  login </router-link>
                                            <router-link class="link" v-if="!userid" :to="{name:'signup'}">  signup </router-link>
                                            <router-link class="link" v-if="userid" :to="{name:'login'}">  logout </router-link>
                                            <button @click="logout" class="link" v-if="userid" :to="{name:'login'}">  logout </button>
                                        </div>
                                    </div>
                                </div>
                            </button>
                            <a href="" class="relative mr-10 text-gray-500 text-sm"> 
                                <i class="fa-regular fa-heart fa-2x"></i>
                                <span class="absolute bg-red-500 w-5 h-5 text-white -top-2 left-4 rounded-full flex items-center justify-center">3 </span>
                            </a>
                            <a href="" class="relative  text-gray-500 text-sm"> 
                                <i class="fa-solid fa-cart-shopping fa-2x"></i>
                                <span class="absolute bg-red-500 w-5 h-5 text-white -top-2 left-4 rounded-full flex items-center justify-center">3 </span>
                            </a>
                        </div>
                        
                    </div>

                    <div class="flex w-full md:w-[40%] lg:w-[50%]">
                        <input type="text" placeholder="search here" class="w-full py-2 md:px-4 border-2 border-gray-200 focus:outline-none">
                        <button type="submit" class="py-2 bg-sky-700 px-6 text-white rounded-r-lg transition duration-300 hover:bg-blue-500"> Search </button>
                    </div>

                    <!-- desktop nav  -->
                    <div class="hidden md:flex items-center mt-6 md:mt-0 md:ml-4">
                        <button @click="showAccountNav =! showAccountNav" class="relative mr-10 text-gray-500 text-sm"> 
                            <i class="fa-regular fa-user fa-2x"></i>
                            <span class="absolute bg-red-500 w-5 h-5 text-white -top-2 left-4 rounded-full flex items-center justify-center">3 </span>

                            <div v-if="showAccountNav" class="account-nav absolute top-9 right-0">
                                <div class="p-4 bg-green-50 shadow-md z-100" >
                                    <div class="nav-item flex justify-between items-center w-96">
                                        <router-link class="link" v-if="!userid" :to="{name:'login'}">  login </router-link>
                                        <router-link class="link" v-if="!userid" :to="{name:'signup'}">  signup </router-link>
                                        <router-link class="link" v-if="userid" :to="{name:'profile'}">  Profile </router-link>
                                        <button @click="logout" class="link" v-if="userid" :to="{name:'login'}">  logout </button>
                                    </div>

                                    <div class="notification mt-5 border-t-2 border-gray-200">
                                        <DatabaseNotify/>
                                    </div>
                                </div>
                            </div>
                        </button>

                        <a href="" class="relative mr-10 text-gray-500 text-sm"> 
                            <i class="fa-regular fa-heart fa-2x"></i>
                            <span class="absolute bg-red-500 w-5 h-5 text-white -top-2 left-4 rounded-full flex items-center justify-center">3 </span>
                        </a>

                        <a href="" class="relative  text-gray-500 text-sm"> 
                            <i class="fa-solid fa-cart-shopping fa-2x"></i>
                            <span class="absolute bg-red-500 w-5 h-5 text-white -top-2 left-4 rounded-full flex items-center justify-center">3 </span>
                        </a>
                    </div>
                </div>
            </div>
    
            <div class="bottom-nav bg-gray-100 mt-4 md:mt-0">
                <div class="container mx-auto">
                    <div class="flex justify-between">
                        <div class="bg-sky-600 px-4 py-2 flex items-center w-[300px]">
                            <i class="fa-solid fa-search text-[#fff]">
    
                            </i>
                            <button class="ml-3 text-[#fff] font-[600px] capitalize text-[16px]"> browse itemsegory </button>
                            <i class="ml-3 fa-solid fa-chevron-down text-[#fff]"></i>
                        </div>
                        
                        <div class="nav ml-10 flex items-center justify-between w-full">
                            <router-link v-for="(item,index) in navItems" :key="index" 
                                :to="item.to" class="text-sky-700 font-semibold ml-4 
                                transition duration-300 hover:text-black text-sm">
                                {{ item.title }}
                            </router-link> 
                            <router-link :to="{name:'profile'}" class="text-sky-700 font-semibold ml-4 
                                transition duration-300 hover:text-black text-sm">
                                Profile
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</template>
<script>
import { mapGetters } from "vuex"
import DatabaseNotify from './DatabaseNotify.vue';
export default{
    components:{DatabaseNotify,},
    data(){
        return{
            showAccountNav:false,
            navItems:[
                {title:'Home', to:{name:'home'}, show:true}
            ],
            userid:User.id(),
        }
    },
    methods:{
        logout(){
            User.logout();
        }
    }
}
</script>