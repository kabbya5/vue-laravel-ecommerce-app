<template>
    <div class="admin-page px-4 w-full">
        <div class="flex justify-between items-center">
            <a href="" class="page-tile">
                Dashboard > Category 
            </a>
            <button @click="createModalForm" class="create-btn 
            mt-4 px-6 py-1 transition duration-300
            hover:text-white  hover:bg-sky-800">Create category </button>
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
                            <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                                <button @click="editCategory(cat)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button> 
                                <button @click="deleteBrand(brand.id,brand.name)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- modal form  -->

        <div v-if="modalForm" class="fixed bg-slate-600/80 top-0 left-0 w-full h-screen">
            <div class="w-96 p-4 bg-white mx-auto my-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-slate-800 font-[500] text-lg leading-7"> Category Form </h2>
                    <button @click="cancelFormModal" class="cancle-btn px-3 pb-1 border-2 border-black text-2xl rounded-full hover:bg-gray-300"> x </button>
                </div>
                
                <form @submit.prevent="modalForm=='create' ? createCategory() :updateCategory()" class="mt-4 form">
                    <div class="form-group">
                        <label for="title"> Category Title </label>
                        <input type="text" class="w-full form-input" placeholder="Category title"
                        v-model="category.category_title"
                        :class="{'error':error.category_title}">
                        
                        <p v-if="error.category_title" class="error-meesage"> {{ error.category_title[0] }} </p>
                    </div>
                    <div class="form-group">
                        <label for="title"> Category Short Text </label>
                        <textarea v-model="category.category_text" id="" cols="30" rows="5"
                        class="form-input" :class="{'error':error.category_text}">

                        </textarea>
                        <p v-if="error.category_text" class="error-meesage"> {{ error.category_text[0] }} </p>
                    </div>

                    <div class="form-group">
                        <label for="title"> Category image </label>
                        <div class="flex items-center justify-between">
                            <input type="file" class="w-full form-input" placeholder="Category title"
                            @change="changeCategoyImg"
                            :class="{'error':error.category_title}">
                            <img class="ml-2 max-w-[50px] mt-2" :src="category.category_img ? category.category_img : category.category_oldImg" alt="">
                        </div>
                        <p v-if="error.category_img" class="error-meesage"> {{ error.category_img[0] }} </p>
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
            this.modalForm = 'edit';
            this.category = category;
        },
        updateCategory(){
            this.$store.dispatch('storeCategory');
            this.notification.message = "Successfully Update Catgory";
            this.notificaion.type = 'success';
        }
    },
    mounted(){
        this.$store.dispatch('fetchCategories');
    }
}
</script>