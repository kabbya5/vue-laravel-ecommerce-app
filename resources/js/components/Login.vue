<template>
    <div class="w-full md:w-96 mx-auto my-10 md:my-20">
        <h1 class="text-center mb-4 font-semibold text-gray-600 text-xl"> Login to your account</h1>
        <form @submit.prevent="login()" class="login form px-4">
            <div class="form-group">
                <label for="email"> Email </label>
                <input type="text" class="form-input" placeholder="Email"
                v-model="login.email">
            </div>

            <div class="form-group">
                <label for="email"> Password </label>
                <input type="password" class="form-input" placeholder="password"
                v-model="login.password">
            </div>

            <div class="mt-4 flex justify-between items-center">
                <div class="flex items-center">
                    <input type="checkbox" id="checkbox" v-model="login.rememberme" />
                    <span class="ml-4 text-sm font-semibold text-gray-600"> Remember me</span>
                </div>
                <router-link to="/forgetpassword"
                 class="text-sm font-semibold text-gray-600"> Forgot Password ? </router-link>
            </div>

            <button type="submit" class="bg-black text-white w-full my-4 py-2
            transition duration-300 hover:bg-gray-600"> log in </button>

            <router-link :to="{name:'signup'}"
                 class="text-md font-semibold text-gray-600 hover:text-orange-500"> No account? Create one here ? </router-link>
        </form>
    </div>
</template>
<script>
export default{
    data(){
        return{
            data:{
                email:'admin@gmail.com',
                password:12345678,
            },
            error:false,
        }
    },

    methods:{
        login(){
            User.login(this.data);
        }
    }
    
}
</script>