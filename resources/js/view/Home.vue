<template> 
    <div>
        <div class="slider">
            <Slider/>
        </div>
        <div class="category-area bg-white py-10">
            <div class="container mx-auto">
                <div class="section-title">
                    <h3> 
                        <span> Feature  </span> 
                        product   
                    </h3>
                </div>
    
                <div class="grid grid-cols-12 gap-4 mt-6">
                    <div v-for="(cat,index) in categories" :key="index" class="col-span-4 lg:col-span-3 transition duration-300 border-2 border-gray-200 hover:border-sky-800">
                        <div class="category flex flex-col-reverse md:flex-row justify-between items-center p-4">
                            <div class="category-title mt-3 md:mt-0 text-center md:text-left ">
                                <h2 class="category-name"> 
                                    <a href="#"> {{ cat.category_title }} </a>
                                </h2>
                                <p class="total-items"> 6 proudcts </p>
    
                                <router-link :to="{name:'categoryProdcts',params:{slug:cat.slug}}" class="shop-btn">
                                    + Shop now 
                                </router-link>
                            </div>
    
                            <div class="category-right-section">
                                <router-link :to="{name:'categoryProdcts',params:{slug:cat.slug}}">
                                    <img :src="cat.category_img" alt="">
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</template>
<script>
import { mapGetters } from 'vuex';
import Slider from '../components/Slider.vue';
export default{
    components:{Slider,},
    computed: {
        ...mapGetters({
            categories: 'categories',
        })
    },
    mounted() {
        this.$store.dispatch('fetchCategories');
    },
}
</script>