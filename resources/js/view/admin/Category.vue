<template>
    <div class="admin-page px-4 w-full">
        <div class="flex justify-between items-center">
            <a href="" class="page-tile">
                Dashboard > Category 
            </a>
            <div>
                <button v-if="trashCategory" @click="allCatgory" class="restore-btn 
                    mt-4 px-6 py-1 transition duration-300 mr-4
                  hover:text-white  hover:bg-red-800"> 
                  <i class="fa-solid fa-xmark"></i>
                </button>
                <button v-else @click="trashCategories" class="restore-btn 
                    mt-4 px-6 py-1 transition duration-300 mr-4
                  hover:text-white  hover:bg-red-800"> 
                  <i class="fa-solid fa-rotate"></i>
                </button>
                <button @click="createModalForm" class="create-btn 
                mt-4 px-6 py-1 transition duration-300
                hover:text-white  hover:bg-sky-800">
                <i class="fa-solid fa-plus"> </i>
            </button>
            </div>
        </div>
        
        <div class="mt-12 w-ful">  
            <div class="relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class=" text-xs text-gray-700 uppercase bg-gray-5">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #id
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Category Name 
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Image 
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Create At
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr v-for="(cat,index) in categories" :key="index" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ index +1  }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ cat.category_title }}
                            </th>
                            <td class="px-6 py-4">
                               <img class="w-20" :src="cat.category_img" alt="category img">
                            </td>
                            <td class="px-6 py-4">
                                {{ cat.created_date }}
                            </td>
                            <td v-if="trashCategory" class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                                <button @click="restoreCategory(cat.slug)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-solid fa-rotate-left"></i>
                                </button> 
                                <button @click="forchDelete(cat.slug)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                            <td v-else class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                                
                                <button @click="editCategory(cat)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button> 
                                <button @click="deleteCategory(cat.slug)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- modal form  -->

        <div v-if="modalForm" class="fixed bg-slate-600/80 top-20 left-0 w-full h-screen">
            <div class="w-96 p-4 bg-white mx-auto my-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-slate-800 font-[500] text-lg leading-7"> Category Form </h2>
                    <button @click="cancelFormModal" class="cancle-btn px-3 pb-1 border-2 border-black text-2xl rounded-full hover:bg-gray-300"> x </button>
                </div>
                
                <form @submit.prevent="modalForm=='create' ? createCategory() :updateCategory()" class="mt-4 form">
                    <div class="form-group">
                        <label for="title"> Category Title </label>
                        <input type="text" class="w-full form-input" placeholder="Category Title"
                        v-model="category.category_title"
                        :class="{'error':error.category_title}">
                        
                        <p v-if="error.category_title" class="error-message"> {{ error.category_title[0] }} </p>
                    </div>
                    <div class="form-group">
                        <label for="title"> Category Position </label>
                        <input type="text" class="w-full form-input" placeholder="Category Position"
                        v-model="category.category_position"
                        :class="{'error':error.category_position}">
                        
                        <p v-if="error.category_position" class="error-message"> {{ error.category_position[0] }} </p>
                    </div>

                    <div class="form-group">
                        <label for="title"> Category image </label>
                        <div class="flex items-center justify-between">
                            <input type="file" class="w-full form-input" placeholder="Category title"
                            @change="changeCategoyImg"
                            :class="{'error':error.category_img}">
                            <img class="ml-2 max-w-[70px] mt-4" :src="category.category_img ? category.category_img : category.category_old_img" :alt="category.category_title">
                        </div>
                        <p v-if="error.category_img" class="error-message"> {{ error.category_img[0] }} </p>
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
import { mapGetters } from 'vuex';
export default{
    data(){
        return{
            trashCategory:false,
            category:{},
        }
    },

    computed:{
        ...mapGetters({
            categories:'categories',
            error:'error',
            modalForm:'modalForm',
        })
    },
    methods:{
        changeCategoyImg(e){
            let files = e.target.files || e.dataTransfer.files;
            if(!files.length)
                return;
            let reader = new FileReader();
            reader.onload = (e) =>{
                this.category.category_img = e.target.result;
            };
            reader.readAsDataURL(files[0]);
        },
        cancelFormModal(){
            this.$store.dispatch('toggleModalForm',false);
        },

        createModalForm(){
            this.$store.dispatch('toggleModalForm','create');
        },

        createCategory(){
            this.$store.dispatch('storeCategory',this.category);
        },
        editCategory(category){
            this.$store.dispatch('toggleModalForm','edit');
            this.category.category_title = category.category_title;
            this.category.category_position = category.category_position;
            this.category.category_old_img = category.category_img;
            this.category.slug = category.slug;
        },
        updateCategory(){
            this.$store.dispatch('updateCategory',this.category)
        },
        deleteCategory(slug){
            this.$store.dispatch('deleteCategory',slug);
        },
        trashCategories(){
            this.trashCategory = true;
            this.$store.dispatch('fetchTrashCategories');
        },
        allCatgory(){
            this.trashCategory = false;
            this.$store.dispatch('fetchCategories');   
        },
        restoreCategory(slug){
            this.$store.dispatch('restoreCategory',slug);
        },
        forchDelete(slug){
            if(confirm('The Category will be delete permamently !')){
                this.$store.dispatch('forchDeleteCategory',slug);
            }   
        }
    },
    mounted(){
        this.allCatgory();
    }
}
</script>