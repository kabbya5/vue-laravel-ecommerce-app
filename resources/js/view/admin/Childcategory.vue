<template>
    <div class="childcategory pr-4">
        <div class="breadcrumb">
            <router-link :to="{name:'adminDashboard'}"
            class="text-[#313131] font-[400] text-xl"> Dashboard </router-link>

            <span class="mx-1 text-xl"> / </span>
            <router-link :to="{name:'adminChildcategories'}"
            class="text-[#313131] font-[400] text-xl"> Childcategories  </router-link>
        </div>

        <div class="childcat-header my-6 py-2 bg-white px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <h2 v-if="childcategories.length > 0" class="text-xl mb-4 font-[400] leading-6 text-[#111]"> All Childcategories </h2>
                <h2 v-else class="text-xl mb-4 font-[400] leading-6 text-orange-500"> No items Found </h2>
                <div class="form flex flex-col lg:flex-row items-center">
                    <div class="flex items-center mb-4 lg:mt-7">
                        <div class="form-group mr-4">
                            <select v-model="selectedFilter" @change="shortBy" class="select-input">
                                <option disabled value="shortby" > Short By </option>
                                <option value="index"> All </option>
                                <option value="asc"> Asc </option>
                                <option value="trash"> Trashed </option>
                            </select>
                        </div>
                        <div class="form-group mr-4">
                            <select @change="showItems" class="select-input">
                                <option value="15" selected> 15 </option>
                                <option value="25"> 25 </option>
                                <option value="40"> 40 </option>
                            </select>
                        </div>
                    </div>
                    <form @submit.prevent="searchChildcat" class="search-form mb-4 lg:mb-0">
                        <div class="search-box">
                            <input type="search" class="search" v-model="search.query" placeholder="Search"> 
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
        <div v-if="childcategories.length > 0" class="table shadow-sm bg-white py-8 w-full">

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-white">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-md">
                                Childcatgory Title 
                            </th>
                            <th scope="col" class="px-4 py-3 text-md">
                                Subcategory
                            </th>
                            <th scope="col" class="px-4 py-3 text-md">
                                Created At
                            </th>
                            <th scope="col" class="px-2 py-3 text-md">
                                Action 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(childcat,index) in childcategories" :key="index" class="bg-white border-b-2 border-gray-300 ">
                            <td class="px-4 py-6 text-md text-slate-700 font-semibold">
                                {{ childcat.childcat_title }}
                            </td>
                            <td class="px-4 py-6 text-md text-slate-700 font-semibold">
                                <span v-for="subcat in childcat.subcategories" :key="subcat.id" class="mx-2 my-1 bg-blue-800 inline-block px-2 py-1 text-white rounded-md"> {{ subcat.subcategory_title  }} </span>
                            </td>
                            <td class="px-4 py-6 text-md text-slate-700 font-semibold">
                                {{ childcat.created_date }}
                            </td>
                            <td v-if="selectedFilter == 'trash'" class="flex py-6 px-4 bg-gray-50 dark:bg-gray-800">
                                <button @click="restoreSubategory(child.slug)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-solid fa-rotate-left"></i>
                                </button> 
                                <button @click="forchDelete(child.slug)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                            <td v-else class="py-6 px-2 flex bg-gray-50 dark:bg-gray-800">
                                
                                <button @click="editChildcat(childcat)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button> 
                                <button @click="deleteChildcat(childcat.slug)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td> 
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal From  -->
       
        <div v-if="modalForm" class="fixed bg-slate-600/80 top-20 left-0 w-full h-screen">
            <div class="w-96 p-4 bg-white mx-auto my-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-slate-800 font-[500] text-lg leading-7"> Childcategory Form </h2>
                    <button @click="cancleModalForm" class="cancle-btn px-3 pb-1 border-2 border-black text-2xl rounded-full hover:bg-gray-300"> x </button>
                </div>
                
                <form @submit.prevent="modalForm=='create' ? createChildcategory() :updateChildcategory()" class="mt-4 form">
                    <div class="form-group">
                        <label for="title"> Childcategory Title </label>
                        <input type="text" class="w-full form-input" placeholder="Category Title"
                        v-model="childcategory.childcat_title"
                        :class="{'error':error.childcat_title}">
                        
                        <p v-if="error.childcat_title" class="error-message"> {{ error.childcat_title[0] }} </p>
                    </div>

                    <div>
                        <label for="subcategory_ids" class="font-[500] text-black text-lg">Subcategory  </label>
                        <div class="mt-3 form-group">
                            <Multiselect
                                v-model="childcategory.subcategory_ids"
                                mode="tags"
                                :options="subcategoryOptions"
                                placeholder="Select Sub Category"
                                label="name"
                                :searchable="true"
                                :resolve-on-load="false"
                                :class="{'error':error.subcategory_ids}"

                            >
                            </Multiselect>

                            <p v-if="error.subcategory_ids" class="error-message"> {{ error.subcategory_ids[0] }} </p>
                        </div>
                    </div>

                    <div class="submit-btn">
                        <button type="submit"> Save </button>
                    </div>
                </form>
            </div>
            
        </div>

        <!-- pagination  -->
        <Pagination/>
    </div>
</template>

<script>
import Pagination from '../../components/Pagination.vue';
import Multiselect from '@vueform/multiselect';
import { mapGetters } from 'vuex';
export default{
    components:{Pagination,Multiselect},
    data(){
        return{
            selectedFilter:'shortby',
            search:{},
            childcategory:{ 
                subcategory_ids:[],
            }
        } 
    },

    computed:{
        ...mapGetters({
            childcategories:'childcategories',
            error:'error', //error.js
            subcategories:'subcategories', //subcategories.js
            subcategoryOptions:'subcategoryOptions',
            modalForm:'modalForm',
            activePage:'activePage', //pagination.js
            query:'query', //pagination.js
        })
    },

    mounted(){
        this.$store.dispatch('fetchSubcategories',{page:1,query:'all'});
        this.getItems();
        
    },

    methods:{
        createModalForm(){
            this.childcategory = {},
            this.$store.dispatch('setToggleModalForm','create');
        },
        cancleModalForm(){
            this.$store.dispatch('setToggleModalForm',false);
        },
        getItems(page=1,query=this.query){
            this.$store.dispatch('fetchChildcategories',{page,query})
        },

        createChildcategory(){
            this.$store.dispatch('storeChildcatgory',this.childcategory);
        },
        editChildcat(childcat){
            this.$store.dispatch('setToggleModalForm','update');
            this.childcategory = childcat;
            this.childcategory.subcategory_ids = [];
            childcat.subcategories.forEach(subcat =>{
                this.childcategory.subcategory_ids.push(subcat.id);
            })
        },
        updateChildcategory(){
            this.$store.dispatch('updatechildcategory',{
                slug:this.childcategory.slug,
                data:this.childcategory,
                page:this.activePage,
                query:this.query
            });
        },
        deleteChildcat(slug){
            this.$store.dispatch('deleteChildcategory',slug);
        },
        shortBy(e){
            let query = e.target.value;
            this.$store.dispatch('setFilterOptionQuery',query);
            this.getItems();
        },
        showItems(e){
            let items = e.target.value;
            this.$store.dispatch('setFilterOptionItems',items);
            this.getItems();
        },
        searchChildcat(){
            let query = this.search.query;
            this.$store.dispatch('setFilterOptionQuery',query);
            this.getItems();
        }
        
    },
}
</script>