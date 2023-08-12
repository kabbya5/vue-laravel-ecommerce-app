<template>
    <div id="admin-navbar">
        <div>
            <div class="top-nav py-4">
                <nav>
                    <div class="flex justify-between items-center">
                        <a class="brand-logo w-96 px-6">
                            <img  class="w-20" src="https://www.freeiconspng.com/thumbs/logo-design/rainbow-logo-design-transparent-0.png" alt="">
                        </a>
                        <div class="ml-4 mr-20">
                            <h2 class="font-semibold text-3xl text-slate-800 tracking-wide capitalize"> {{ overviewTitle }} </h2>
                        </div>
                        <div class="input w-full flex items-center">
                            <input type="text" class="w-full">
                            <div class="flex mr-4 ml-6 w-96">
                                <i class="fa-regular fa-user fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        
        <div class="sidebar hidden md:block">
            <div class="sidebar px-6">
                <div class="mt-7 user flex items-center bg-white p-4">
                    <img class="w-12 h-12 rounded-full" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8dXNlciUyMHByb2ZpbGV8ZW58MHx8MHx8fDA%3D&w=1000&q=80" alt="">
                    <div class="flex flex-col px-4">
                        <h2 class="user-name text-sky-800 font-semibold capitalize"> Timotheus Bendon</h2>
                        <p class="mt-1 text-slate-400 font-[400] text-sm"> Main admin  </p>
                    </div>
                </div>
                <ul class="sidebar-link mt-10 pl-2">
                    <li class="nav-items" :class="{'active':overviewTitle=='dashboard'}"> 
                        <router-link @click="changeOverview('dashobard')" :to="{name:'home'}" class="link flex items-center">
                            <i class="fa-solid fa-chart-bar mr-5  text-slate-400 font-semibold"></i>
                            <span> dashboard </span>
                        </router-link>
                    </li>
    
                    <li @click="changeOverview('category')" class="nav-items" :class="{'active':overviewTitle=='category'}"> 
                        <button class="link flex items-center">
                            <i class="fa-solid fa-bars-staggered mr-5  text-slate-400 font-semibold"></i>
                            <span> Category  </span>
                        </button>
                    </li>

                    <ul v-if="overviewTitle=='category'" class="mt-4 ml-3">
                        <li class="nav-items" :class="{'active':overviewTitle=='category'}">
                            <router-link @click="changeOverview('category')" :to="{name:'categories'}" class="link chiild-link flex items-center">
                                <i class="fa-solid fa-chart-bar mr-5  text-slate-400 font-semibold"></i>
                                <span> categories </span>
                            </router-link>
                        </li>
                        <li class="nav-items" :class="{'active':overviewTitle=='dashboard'}">
                            <router-link @click="changeOverview('category')" :to="{name:'categories'}" class="link flex items-center">
                                <i class="fa-solid fa-chart-bar mr-5  text-slate-400 font-semibold"></i>
                                <span> categories </span>
                            </router-link>
                        </li>
                        <li class="nav-items" :class="{'active':overviewTitle=='dashboard'}">
                            <router-link @click="changeOverview('category')" :to="{name:'categories'}" class="link flex items-center">
                                <i class="fa-solid fa-chart-bar mr-5  text-slate-400 font-semibold"></i>
                                <span> categories </span>
                            </router-link>
                        </li>
                    </ul>

                    <li class="nav-items" :class="{'active':overviewTitle=='setting'}"> 
                        <router-link @click="changeOverview('setting')" :to="{name:'adminSetting'}" class="link flex items-center">
                            <i class="fa-solid fa-gear mr-5 text-slate-400 font-semibold"></i>
                            <span> Setting </span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content mt-[60px] lg:ml-[350px] py-10">
            <router-view> </router-view>
        </div>

        <Notification />
        <Preloader />
        
    </div>
</template>
<script>
import Notification from '../Notification.vue';
import Preloader from '../Preloader.vue';
export default{
    components:{ Notification,Preloader},
    data(){
        return{
            overviewTitle: 'dashboard',
        }
    },
    methods:{
        changeOverview(title){
            this.overviewTitle = title;
        }
    }

}
</script>
