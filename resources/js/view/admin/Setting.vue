<template>
    <div class="w-full lg:w-[700px] mx-auto">
        <div class="avatar flex items-center justify-center">
            <div class="wrapper">
                <img :src="img" alt="">
                
                <div class="input-div">
                    <input @change="uploadImage" type="file" class="avater-image">
                </div> 
            </div>
            <p class="name"> User Name </p>
        </div> 

        <div class="account mt-4 py-4 bg-white px-4">
            <h2 class="text-black font-md text-2xl">
                Account Information 
            </h2>

            <form @submit.prevent="formAction =='create' ? createSetting() : updateSetting()" class="form mt-6">
                <div class="flex w-full items-center">
                    <div class="form-group mr-4">
                        <label for="name"> Website Name  </label>
                        <input type="text" class="form-input" :class="error.website_name"
                        placeholder="Enter Company Name" v-model="form.website_name">
                        <p v-if="error.website_name" class="erorr-message"> {{error.website_name[0]}} </p>
                    </div>
                    <div class="ml-4 form-group">
                        <label for="name"> Website Email 1 </label>
                        <input type="text" class="form-input" :class="error.website_email"
                        placeholder="Enter phone number" v-model="form.website_email">
                        <p v-if="error.website_email" class="erorr-message"> {{error.website_email[0]}} </p>
                    </div>
                </div>

                <div class="flex w-full items-center">
                    <div class="mr-4 form-group">
                        <label for="name"> Website Email 2 </label>
                        <input type="text" class="form-input" :class="error.website_email_2"
                        placeholder="Enter phone number" v-model="form.website_email_2">
                        <p v-if="error.website_email_2" class="erorr-message"> {{error.website_email_2[0]}} </p>
                    </div>
                    <div class="ml-4 form-group">
                        <label for="name"> Phone Number  </label>
                        <input type="text" class="form-input" :class="error.phone"
                        placeholder="Enter phone number" v-model="form.phone">
                        <p v-if="phone" class="erorr-message"> {{error.phone[0]}} </p>
                    </div>
                </div>

                <div class="flex w-full items-center">
                    <div class="mr-4 form-group">
                        <label for="name"> Phone Number 2 </label>
                        <input type="text" class="form-input" :class="error.phone_2"
                        placeholder="Enter phone number" v-model="form.phone_2">
                        <p v-if="error.phone_2" class="erorr-message"> {{error.phone_2[0]}} </p>
                    </div>
                    <div class="ml-4 form-group">
                        <label for="name"> Phone Number  </label>
                        <input type="text" class="form-input" :class="error.phone"
                        placeholder="Enter phone number" v-model="form.phone">
                        <p v-if="phone" class="erorr-message"> {{error.phone[0]}} </p>
                    </div>
                </div>

                <button type="submit" class="mt-4 bg-blue-800 text-white font-semibod px-6 py-2 rounded-md"> Save </button>
            </form>
        </div>
        
    </div>
</template>
<script>
export default{
    data(){
        return{
            formAction:'create',
            form:{},
            error:{},
            img :'https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80',
        }
    },
    methods:{
        uploadImage(e){
            let files = e.target.files || e.dataTransfer.files;
            if(!files.length)
                return;
            let reader = new FileReader();
            reader.onload = (e) =>{
                this.img = e.target.result; 
            };
            reader.readAsDataURL(files[0]);
        },
        createSetting(){
            alert('kdhwe');
        }
    }
}
</script>