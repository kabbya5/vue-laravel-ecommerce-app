<template>
    <div class="subcategory pr-4">
        <div class="breadcrumb">
            <router-link :to="{name:'adminDashboard'}"
            class="text-[#313131] font-[400] text-xl"> Dashboard </router-link>

            <span class="mx-1 text-xl"> / </span>
            <router-link :to="{name:'adminSubcategories'}"
            class="text-[#313131] font-[400] text-xl"> Subcategories  </router-link>
        </div>

        <div class="header py-5 my-5 bg-white flex justify-between items-center">
            <h2 class="ml-4 text-[#111] font-[400] text-[24px] tracking-wide">All Subcategory </h2>
            <div class="flex items-center ml-4">
                <div class="">
                    <select v-model="selectedFilter" @change="filterCategories" class="py-2 px-4 text-lg text-[#313131] font-semibold focus:outline-none border-2 border-gray-300">
                        <option value="filterBy" disabled> Filter By </option>
                        <option v-for="option in filterOptions" :key="option" :value="option.value"> {{ option.option }} </option>
                    </select>
                </div>
                <div class="ml-4 flex items-center">
                    <form @submit.prevent="serchCategories()">
                        <div class="flex items-center">
                            <input v-model="search.categories" type="search" class="py-2 px-4 text-lg focus:outline-none border-2 border-gray-200" placeholder="serach subcategory">
                            <button type="submit" class="bg-green-800 px-2 h-[46px] rounded-sm text-white text-lg "> search </button>
                        </div>
                    </form>
                    
                </div>
            </div>

            <div class="mr-4">
                <button @click="createModalForm" class="px-4 py-2 border-2 border-sky-800 rounded-md transition duration-300 hover:bg-sky-800 hover:text-white"> 
                    <i class="fa-solid fa-plus"></i> 
                </button>
            </div>
        </div>

        <div class="table shadow-sm bg-white py-8 w-full">

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-white">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-lg">
                                Subcatgory Title 
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
                        <tr v-for="(subcat,index) in subcategories" :key="index" class="bg-white border-b ">
                            <td class="px-4 py-4">
                                {{ subcat.subcategory_title }}
                            </td>
                            <td class="px-4 py-4">
                                <span v-for="cat in subcat.categories" :key="cat.id" class="mx-2 my-1 bg-blue-800 inline-block px-2 py-1 text-white rounded-md"> {{ cat.category_title  }} </span>
                            </td>
                            <td class="px-4 py-4">
                                {{ subcat.created_date }}
                            </td>
                            <td v-if="selectedFilter == 'trash'" class="flex py-4 px-4 bg-gray-50 dark:bg-gray-800">
                                <button @click="restoreSubategory(subcat.slug)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-solid fa-rotate-left"></i>
                                </button> 
                                <button @click="forchDelete(subcat.slug)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                            <td v-else class="py-4 px-2 flex bg-gray-50 dark:bg-gray-800">
                                
                                <button @click="editSubcategory(subcat)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button> 
                                <button @click="deleteSubcategory(subcat.slug)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>

        <!-- pagination  -->
        <Pagination/>



        <!-- modal form  -->

        <div v-if="modalForm" class="fixed bg-slate-600/80 top-20 left-0 w-full h-screen">
            <div class="w-96 p-4 bg-white mx-auto my-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-slate-800 font-[500] text-lg leading-7"> Category Form </h2>
                    <button @click="cancelFormModal" class="cancle-btn px-3 pb-1 border-2 border-black text-2xl rounded-full hover:bg-gray-300"> x </button>
                </div>
                
                <form @submit.prevent="modalForm=='create' ? createSubcategory() :updateSubcategory()" class="mt-4 form">
                    <div class="form-group">
                        <label for="title"> Subcategory Title </label>
                        <input type="text" class="w-full form-input" placeholder="Category Title"
                        v-model="subcategory.subcategory_title"
                        :class="{'error':error.subcategory_title}">
                        
                        <p v-if="error.subcategory_title" class="error-message"> {{ error.subcategory_title[0] }} </p>
                    </div>

                    <div>
                        <label for="category" class="font-[500] text-black text-lg"> Category </label>
                        <div class="mt-3 form-group">
                            <Multiselect
                                v-model="subcategory.category_ids"
                                mode="tags"
                                :options="categoryOption"
                                placeholder="Select Category"
                                label="name"
                                :searchable="true"
                                :resolve-on-load="false"
                                :class="{'error':error.category_idscategory_ids}"

                            >
                            </Multiselect>

                            <p v-if="error.category_ids" class="error-message"> {{ error.category_ids[0] }} </p>
                          </div>
                    </div>

                    <div class="submit-btn">
                        <button type="submit"> Save </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</template>

<script>
import Pagination from '../../components/Pagination.vue';
import { mapGetters } from 'vuex';
import Multiselect from '@vueform/multiselect';
export default{
    
    components:{Multiselect,Pagination},
    data(){
        return{
            page:1,
            subcategory:{
                category_ids:[],
            },
            
            selectedFilter:'filterBy',

            search:{},

            filterOptions:[
                {option:'All',value:'all'},
                {option:'Trash Items',value:'trash'},
                {option:'Short',value:'short'},
            ]
        }   
    },
    computed:{
        ...mapGetters({
            subcategories:'subcategories',
            error:'error',
            categories:'categories', //category.js
            categoryOption:"categoryOption",
            modalForm:'modalForm', //toggleModalForm.js
            query:'query', //pagination.js
        }),
    },
    mounted(){
        this.getItems();
        this.$store.dispatch('fetchCategories');
    },
    methods:{
        getItems(page=1,query='all'){
            this.$store.dispatch('fetchSubcategories',{page,query});
        },

        createModalForm(){
            this.subcategory = {},
            this.$store.dispatch('setToggleModalForm','create');
        },
        cancelFormModal(){
            this.$store.dispatch('setToggleModalForm',false);
        },
        createSubcategory(){
            this.$store.dispatch('storeSubcategory',this.subcategory);
        },
        editSubcategory(subcat){
            this.$store.dispatch('setToggleModalForm','update');
            this.subcategory = subcat;
            this.subcategory.category_ids = [];
            subcat.categories.forEach(cat =>{
                this.subcategory.category_ids.push(cat.id);
            });
        },

        updateSubcategory(){
            this.$store.dispatch('updateSubcategory',this.subcategory)
        },
        deleteSubcategory(slug){
            this.$store.dispatch('deleteSubcategores',slug);
        },
        restoreSubategory(slug){
            this.$store.dispatch('restoreSubcategory',slug);
        },

        forchDelete(slug){
            if(confirm('The category will be deleted permametly')){
                this.$store.dispatch('forchDelete',slug);
            }
            
        },


        filterCategories(e){
            let query = e.target.value;
            this.storePaginationItem(query);
            this.getItems(1,query); 
        },
        serchCategories(){
            let query = this.search.categories;
            this.storePaginationItem(query)
            this.getItems(1,query);
        },

        storePaginationItem(query){
            this.$store.dispatch('setFilterOption',query);
            this.$store.dispatch('setActivePage',1);
        }
    },
    
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>