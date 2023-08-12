<template>
    <div v-if="loading" class="preloader">
        <div class="fixed top-0 z-[200] w-full h-full">
            <div class="bg flex items-center justify-center w-full h-full">
                <div class="container">
                    <div class="wrapper">
                       <div class="loader">
                          <div class="dot"></div>
                       </div>
                       <div class="loader">
                          <div class="dot"></div>
                       </div>
                       <div class="loader">
                          <div class="dot"></div>
                       </div>
                       <div class="loader">
                          <div class="dot"></div>
                       </div>
                       <div class="loader">
                          <div class="dot"></div>
                       </div>
                       <div class="loader">
                          <div class="dot"></div>
                       </div>
                    </div>
                    <div class="text">
                       Please wait
                    </div>
                 </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';
export default{
    computed:{
        ...mapGetters({
            loading:'loading',
        })
    },
}
</script>