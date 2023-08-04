<template>
    <div class="w-full md:w-96 mx-auto my-10 md:my-20">
        <h1 class="text-center mb-4 font-semibold text-gray-800 text-md "> NEW ACCOUNT REGISTER </h1>
        <form @submit.prevent="signup()" class="register form px-4">
            <div class="form-group">
                <label for="name"> Full Name </label>
                <input type="text" class="form-input" placeholder="Full Name"
                v-model="register.name" :class="{'error':error.name}">
                <p v-if="error.name" class="error-message"> {{ error.name[0] }} </p>
            </div>

            <div class="form-group">
                <label for="email"> Email </label>
                <input type="email" class="form-input" placeholder="Email"
                v-model="register.email" :class="{'error':error.email}">
                <p v-if="error.email" class="error-message"> {{ error.email[0] }} </p>
            </div>
            <div class="form-group">
                <label for="email"> Phone Number </label>
                <input type="tel" class="form-input" placeholder="phone number"
                v-model="register.phone" :class="{'error':error.phone}">
                <p v-if="error.phone" class="error-message"> {{ error.phone[0] }} </p>
            </div>

            <div class="form-group">
                <label for="password"> Password </label>
                <input type="password" class="form-input" placeholder="password"
                v-model="register.password" :class="{'error':register.password}">
                <p v-if="error.password" class="error-message"> {{error.password[0]}}</p>
            </div>

            <div class="form-group">
                <label for="password">Confirm Password </label>
                <input type="password" class="form-input" placeholder="password"
                v-model="register.password_confirmation" :class="{'error':error.password_confirmation}">
                <p v-if="error.password_confirmation" class="error-message"> {{error.password[0]}}</p>
            </div>


            <button type="submit" class="bg-black text-white w-full my-4 py-2
            transition duration-300 hover:bg-gray-600"> Create An Account  </button>

            <router-link :to="{name:'login'}"
                 class="text-md font-semibold text-gray-800 hover:text-orange-500"> Already have an account? Log in here? </router-link>
        </form>
    </div>
</template>
<script>
export default{
    data(){
        return{
            register:{
                name:'admin',
                email:'admin@gmail.com',
                phone:'01343455434',
            },
            error:false,
        }
    },
    methods:{
        signup(){
            axios.post('/api/auth/signup',this.register)
            .then(res => {
                this.$store.dispatch('fetchNotification',{
                    type:'success',
                    message:'Successfully Resiter Account ?',
                })

                User.responseAfterLogin(res);
                window.location = '/verify/email';
            })
            .catch(error =>{
                this.error = error.response.data.errors;
            })
        }
    }
}
</script>