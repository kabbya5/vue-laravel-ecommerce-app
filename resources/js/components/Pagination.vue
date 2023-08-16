<template>
    <div class="my-10 bg-gray-100 shadow-sm py-2 border-2 border-gray-200">
        <div class="flex items-center justify-between">
            <p class="text-[#313131] font-[500] text-lg"> Showing {{pagination.items}} of {{ pagination.totalItems}} </p>
            <div class="flex ">
                <ul class="flex">
                    <li> 
                        <button class="w-10 h-10 rounded-full mx-2
                        flex items-center justify-center"
                        :disabled="activePage==1"
                        @click="getItems(1)">
                        <i class="fa-solid fa-backward"></i>
                        </button>  
                    </li>
                    <li> 
                        <button class="w-10 h-10 rounded-full mx-2
                        flex items-center justify-center"
                        :disabled="activePage==1"
                        @click="getItems(activePage-1)">
                        <i class="fa-solid fa-chevron-left"></i>
                        </button>  
                    </li>
                    <li v-for="i in pagination.totalPages" :key="i"> 
                        <button class="w-10 h-10 rounded-full mx-2
                        flex items-center justify-center"
                        :class="{'bg-green-800 text-white':activePage==i}"
                        @click="getItems(i)"> 
                            {{  i }}
                        </button>  
                    </li>
                    <li> 
                        <button class="w-10 h-10 rounded-full mx-2
                        flex items-center justify-center"
                        :class="{'bg-green-800 text-white':activePage==i}"
                        :disabled="activePage==pagination.totalPages"
                        @click="getItems(activePage+1)">
                        <i class="fa-solid fa-chevron-right"></i>
                        </button>  
                    </li>
                    <li> 
                        <button class="w-10 h-10 rounded-full mx-2
                        flex items-center justify-center"
                        :class="{'bg-green-800 text-white':activePage==i}"
                        :disabled="activePage==pagination.totalPages"
                        @click="getItems(pagination.totalPages)"> 
                        <i class="fa-solid fa-forward"></i>
                        </button>  
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
    
</template>
<script>
import { mapGetters } from 'vuex'
export default{
    computed:{
        ...mapGetters({
            pagination:'pagination',
            activePage:'activePage',
            query:'query',
        })

    },

    methods:{
        getItems(page){
            let query = this.query;
            this.$store.dispatch('setActivePage',page);         
            this.$parent.getItems(page,query);
        }
    },
}
</script>