<template>
    <div class="childcategory">
        <div class="breadcrumb">
            <router-link :to="{name:'adminDashboard'}"
            class="text-[#313131] font-[400] text-xl"> Dashboard </router-link>

            <span class="mx-1 text-xl"> / </span>
            <router-link :to="{name:'adminChildcategories'}"
            class="text-[#313131] font-[400] text-xl"> Childcategories  </router-link>
        </div>

        <div class="childcat-header my-6 py-2 bg-white px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <h2 class="text-xl mb-4 font-[400] leading-6 text-[#111]"> All Childcategories </h2>
                <div class="form flex flex-col lg:flex-row items-center">
                    <div class="flex items-center mb-4 lg:mt-7">
                        <div class="form-group mr-4">
                            <select class="select-input">
                                <option value="something"> something </option>
                                <option value="something"> something </option>
                                <option value="something"> something </option>
                            </select>
                        </div>
                        <div class="form-group mr-4">
                            <select class="select-input">
                                <option value="something"> something </option>
                                <option value="something"> something </option>
                                <option value="something"> something </option>
                            </select>
                        </div>
                    </div>
                    <form action="" class="search-form mb-4 lg:mb-0">
                        <div class="search-box">
                            <input type="search" class="search" placeholder="Search"> 
                            <button class="search-btn"> 
                                <i class="fa-solid fa-search"></i>
                            </button>
                            
                        </div>
                        
                    </form>
                </div>

                <div class="mr-4">
                    <button @click="createModalForm" class="px-4 py-2 border-2 border-sky-800 rounded-md transition duration-300 hover:bg-sky-800 hover:text-white"> 
                        <i class="fa-solid fa-plus"></i> 
                    </button>
                </div>
            </div>

        </div>
        <!-- ChildCategories  -->
        <div class="table shadow-sm bg-white py-8 w-full">

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-white">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-lg">
                                Childcatgory Title 
                            </th>
                            <th scope="col" class="px-4 py-3 text-lg">
                                Category
                            </th>
                            <th scope="col" class="px-4 py-3 text-lg">
                                Created At
                            </th>
                            <th scope="col" class="px-2 py-3 text-lg">
                                Action 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(childcat,index) in childcategories" :key="index" class="bg-white border-b ">
                            <td class="px-4 py-4">
                                {{ childcat.childcat_title }}
                            </td>
                            <td class="px-4 py-4">
                                <span v-for="subcat in childcat.subcategories" :key="subcat.id" class="mx-2 my-1 bg-blue-800 inline-block px-2 py-1 text-white rounded-md"> {{ subcat.subcategory_title  }} </span>
                            </td>
                            <td class="px-4 py-4">
                                {{ childcat.created_date }}
                            </td>
                            <!-- <td v-if="selectedFilter == 'trash'" class="flex py-4 px-4 bg-gray-50 dark:bg-gray-800">
                                <button @click="restoreSubategory(child.slug)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-solid fa-rotate-left"></i>
                                </button> 
                                <button @click="forchDelete(child.slug)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                            <td v-else class="py-4 px-2 flex bg-gray-50 dark:bg-gray-800">
                                
                                <button @click="editchildegory(child)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button> 
                                <button @click="deletechildegory(child.slug)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>

        <!-- pagination  -->
        <Pagination/>
    </div>
</template>

<script>
import Pagination from '../../components/Pagination.vue';
import { mapGetters } from 'vuex';
export default{
    components:{Pagination,},
    data(){
        return{
            form:{
                query:'all',
            }
        } 
    },

    computed:{
        ...mapGetters({
            childcategories:'childcategories',
        })
    },

    mounted(){
        this.getItems();
    },

    methods:{
        getItems(page=1,query="all"){
            this.$store.dispatch('fetchChildcategories',{page,query})
        }
    },
    
        

}
</script>