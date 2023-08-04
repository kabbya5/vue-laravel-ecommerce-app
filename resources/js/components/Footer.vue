<template>
    <div class="pt-10 bg-black ">
        <footer class="container mx-auto">
            <div class="grid grid-cols-2 gap-8 py-8 px-6 md:grid-cols-4">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-white uppercase">Company</h2>
                    <ul class="text-gray-100">
                        <li v-for="page in pages" :key="page.id" class="mb-4 hover:underline">
                            <router-link v-if="page.page_type == 'company'" :to="{name:'page-details',params:{slug:page.slug}}">
                                {{ page.page_title }}
                            </router-link>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-white uppercase">Help center</h2>
                    <ul class="text-gray-100">
                        <li v-for="link in socialLinks" :key="link.id" class="mb-4">
                            <a target="blank" :href="link.link_url" class="hover:underline">
                                <i :class="link.link_icon"></i>
                                <span class="ml-4"> {{link.media_name}}</span>
                            </a>
                        </li>
                    </ul>  
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-white uppercase">Legal</h2>
                    <ul class="text-gray-100">
                        <li v-for="page in pages" :key="page.id" class="mb-4 hover:underline">
                            <router-link v-if="page.page_type == 'legal'" :to="{name:'page-details',params:{slug:page.slug}}">
                                {{ page.page_title }}
                            </router-link>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-white uppercase"> User </h2>
                    <ul class="text-gray-100">
                        <li class="mb-4">
                            <a href="#" class="hover:underline"> Log in </a>
                        </li>
                        <li class="mb-4">
                            <a href="/email/verify" class="hover:underline"> Verify Account </a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline"> Profile  </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="py-6 px-4 bg-black md:flex md:items-center md:justify-between">
                <span class="text-sm text-white dark:text-gray-300 sm:text-center">©{{ new Date().getFullYear() }} {{ company_name }}. All Rights Reserved.
                </span>
                <div class="flex mt-4 space-x-6 sm:justify-center md:mt-0">
                    <a v-for="link in socialLinks" :key="link.id" 
                        :href="link.link_url" target="blank" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <i :class="link.link_icon"></i>
                    </a>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>

export default{
    data(){
        return{
            pages:[],
            socialLinks:[],
            company_name:[],
        }
    },
    created(){
        // axios.get('/footer/content')
        // .then(res => {
        //     this.pages = res.data['pages'];
        //     this.socialLinks = res.data['socialLinks'];
        //     this.company_name = res.data['page_name'];
        // })
    }
}

</script>