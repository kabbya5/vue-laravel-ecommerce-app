<template>
    <div class="fixed top-0 right-0 pr-2 z-50"> 
        <div v-if="notifiction.message" id="notification" :class="notifictionBg">
            <div class="error flex items-center bg-white shadow-md pr-4 rounded-md mt-4">
                <div class="icon ml-4  flex items-center justify-center
                    w-6 h-6 rounded-full" :class="notifictionBg">
                    <i class="fa-solid fa-check text-white"></i>
                </div>
                
                <p class="alert-message px-4 py-3 font-semibold text-lg leading-7" :class="notifictionText"> {{notifiction.message}} </p>

                <button @click="hideNotification" class="button flex items-center px-4">
                    <i class="fa-solid fa-x text-black"></i>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters} from 'vuex';
export default{
    data(){
        return{
            notifictionBg : "bg-green-800",
            notifictionText: 'text-black'
        }
    },
    computed:{
        
        ...mapGetters({
            notifiction:'notification'
        })
    },
    methods:{
        hideNotification(){
            this.$store.dispatch('revomeNotification')
        }
    },
    watch:{
        notifiction(old){
            setTimeout(() => this.hideNotification(), 6000);
            if(this.notifiction.type == 'error'){
                this.notifictionBg = 'bg-red-500';
                this.notifictionText = 'text-red-500';
            }else if(this.notifiction.type == 'success'){
                this.notifictionBg = "bg-green-800";
                this.notifictionText = 'text-black';
            }
        }
         
    }
}
</script>