<template>
    <div class="w-full lg:w-[700px] mx-auto">
        <div class="avatar flex items-center justify-center">
            <div class="wrapper flex items-center justify-center">
                <img v-if="form.webiste_logo" :src="form.img" alt="">
                <i v-else class="fa-solid fa-user fa-3x text-gray-400"> </i>
                <div class="input-div">
                    <input @change="uploadImage" type="file" class="avater-image">
                </div> 
            </div>
            <p class="name"> {{form.website_name}}</p>
        </div> 

        <div class="account mt-4 py-4 bg-white px-4 shadow-md">
            <h2 class="text-black font-md text-2xl">
                Account Information 
            </h2>

            <form @submit.prevent="createForm == true  ? createSetting() : updateSetting()" class="form mt-6">
                <div class="flex w-full items-center">
                    <div class="form-group mr-4">
                        <label for="name"> Website Name  </label>
                        <input type="text" class="form-input" :class="{'error':error.website_name}"
                        placeholder="Enter Company Name" v-model="form.website_name">
                        <p v-if="error.website_name" class="error-message"> {{error.website_name[0]}} </p>
                    </div>
                    <div class="ml-4 form-group">
                        <label for="email"> Website Email 1 </label>
                        <input type="text" class="form-input" :class="{'error':error.website_name}"
                        placeholder="Enter Contact Email" v-model="form.website_email">
                        <p v-if="error.website_email" class="error-message"> {{error.website_email[0]}} </p>
                    </div>
                </div>

                <div class="flex w-full items-center">
                    <div class="mr-4 form-group">
                        <label for="name"> Website Email 2 </label>
                        <input type="text" class="form-input" :class="{'error' :error.website_email_2}"
                        placeholder="Enter Contact Email 2" v-model="form.website_email_2">
                        <p v-if="error.website_email_2" class="error-message"> {{error.website_email_2[0]}} </p>
                    </div>
                    <div class="ml-4 form-group">
                        <label for="name"> Phone Number  </label>
                        <input type="text" class="form-input" :class="{'error' :error.phone}"
                        placeholder="Enter phone number" v-model="form.phone">
                        <p v-if="error.phone" class="error-message"> {{error.phone[0]}} </p>
                    </div>
                </div>

                <div class="flex w-full items-center">
                    <div class="mr-4 form-group">
                        <label for="name"> Phone Number 2 </label>
                        <input type="text" class="form-input" :class="{'error' :error.phone_2}"
                        placeholder="Enter phone number" v-model="form.phone_2">
                        <p v-if="error.phone_2" class="error-message"> {{error.phone_2[0]}} </p>
                    </div>
                </div>

                <button type="submit" class="mt-4 bg-blue-800 text-white font-semibod px-6 py-2 rounded-md"> Save </button>
            </form>
        </div>
        
    </div>
</template>
<script>
import { mapGetters } from 'vuex';
export default{
    data(){
        return{
            createForm:true,
            form:{},

        }
    },
    computed:{
        ...mapGetters({
            error:'error',
        })
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
            this.$store.dispatch('setLoading',true);

            axios.post('/api/admin/setting/store',this.form)
            .then(res => {
                this.$store.dispatch('setLoading',ture);
                this.form = res.data;
                this.$store.dispatch('fetchNotification',{
                    type:'success',
                    message:'Successfull created Setting',
                })  
            })
            .catch(error =>{
                this.$store.dispatch('setLoading',false);
                this.$store.dispatch("setError", error)
            })
        },
        updateSetting(){
            this.$store.dispatch('setLoading',true);
            axios.put('/api/admin/setting/update/' +this.form.id,this.form)
            .then(res => {
                this.$store.dispatch('setLoading',false);
                this.$store.dispatch('fetchNotification',{
                    type:'success',
                    message:'Setting has been Updated Successfully',
                });
                this.form = res.data;
            })
            .catch(error =>{
                this.$store.dispatch('setLoading',false);
                this.$store.dispatch("setError", error)
            })
        }   

    },
    created(){
        axios.get('/api/setting')
        .then(res => {
            this.form = res.data.setting;
            this.createForm = false;
        })
    }
}
</script>