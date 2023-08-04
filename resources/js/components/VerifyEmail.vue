<template>
    <div class="my-10 md:my-20">
        <div class="w-full px-6 md:px-0 md:w-[600px] mx-auto">
            <div class="flex items-center justify-center">
                <div class="user-icon flex justify-center items-center w-20 h-20 rounded-full
                    border-2 border-sky-800">
                    <i class="fa-solid fa-user fa-3x"></i> 
                </div>
            
                <p class="name ml-4 font-semibold text-[#444] text-[25px]"> {{ user.name }} </p>
            </div>
            <form @submit.prevent="verifyAccount" class="form mt-10">
                <h2 class="font-semibold text-[#444] text-[25px]"> Verify Your Account </h2>
                <div class="form-group my-4">
                    <label for=""> Verification Code </label>
                    <input type="text" class="form-input" :class="{'error':error.verification_code}"
                    placeholder="Verification Code" v-model="form.verification_code" >

                    <p v-if="error.verification_code" class="error-meesage"> {{ error.verification_code }} </p>
                </div>

                <div class="mt-6 flex justify-between">
                    <button class="px-6 py-2 bg-sky-800 text-white font-semibold text-xl rounded-md"> Submite</button>
                    <button @click="regenarateCode" :disabled="isDisable" class="px-6 py-2 text-white font-semibold text-xl rounded-md"
                    :class="disableButtonBg"> Regenarate Code <span v-if="timeCount > 0"> {{ timeCount }} s </span>  </button>
                </div>   
            </form>
        </div>
    </div>
</template>
<script>
import User from '../helpers/User';

export default{
    data(){
        return{
            user:User.auth(),
            id:User.id(),
            form:{},
            error:{
            },
            timeCount:false,
            isDisable:true,
            disableButtonBg:'bg-orange-500',
        }
    },
    methods:{
        verifyAccount(){
            axios.post('/api/auth/verfy/account',this.form)
            .then(res => {
                User.updateAuth('email_verified_at',res.data);
                this.$store.dispatch('fetchNotification',{
                    type:'success',
                    message:'You are now Authticate User',  
                })
                
                window.location = '/';
            }).catch(error =>  {
                if(error.response.data.code == 401){
                    this.error.verification_code = error.response.data.message;
                    this.$store.dispatch('fetchNotification',{
                        type:'error',
                        message:'Invalid verification code, regenarate it and try again',
                    })
                }else{
                    this.error.verification_code = error.response.data.message;
                }
                
            })
        },

        regenarateCode(){
            axios.post('/api/auth/genarate/verification/code/' + this.id)
            .then(res =>{
                this.isDisable = true;
                this.timeCount = 40;
                this.countDownTimer();
            })
        },

        digableButton(){
            setTimeout(() =>{
                this.isDisable = false;
            },40000)
        },
        
        countDownTimer() {
            if (this.timeCount > 0) {
                setTimeout(() => {
                    this.timeCount -= 1
                    this.countDownTimer()
                }, 1000)
            }

            this.digableButton();
            
        },
    },
    created(){
        this.timeCount = 40;
        this.countDownTimer();
    }
}
</script>