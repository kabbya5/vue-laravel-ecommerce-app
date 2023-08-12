<template>
    <div class="container mx-auto mt-3">
        <div class="header mt-10"> 
            <router-link to="/" class="capitalize text-gray-700">
                home
            </router-link>
            <i class="fa solid fa-chevron-right"></i>
            <button  class="capitalize mx-4 text-gray-700">
                contact
            </button>
        
        </div>

        <div class="location-map  my-4 :lg-mx-0 h-[400px] md:h-[600px]">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29207.26543556152!2d90.4089126280074!3d23.786283833309515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7b71894d7cb%3A0x725a1e9ba77a8744!2sBadda%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1691518676897!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        
        <div class="contact-body my-10 w-full  md:w-[700px] mx-auto">
            <h2 class="text-[#313131]  font-[600] text-[35px] leading-[30px] "> Merul Baddda, Kacha bazar goli,  </h2>
            
            <div class="my-10">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-6">
                        <div class="flex items-center">
                            <div class="w-24 h-24 rounded-full border-2 border-sky-800 flex items-center justify-center">
                                <i class="fa-solid fa-phone fa-3x text-sky-800"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sky-800 font-semibold text-xl"> 01721597157 </p>
                                <p class="text-sky-800 font-semibold text-xl mt-2"> 01721 597157 </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6">
                        <div class="flex items-center">
                            <div class="w-24 h-24 rounded-full border-2 border-sky-800 flex items-center justify-center">
                                <i class="fa-solid fa-phone fa-3x text-sky-800"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sky-800 font-semibold text-xl"> Kabbya@gmail.com</p>
                                <p class="text-sky-800 font-semibold text-xl mt-2"> Kabbya@gmail.com </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form @submit.prevent="sendMessage" class="form">
                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full">
                        <label for="name" class="text-slate-800 font-semibold my-3 capitalize text-lg"> name </label>
                        <input type="text" v-model="contact.contact_name"
                        class="border-2 border-gray-300 px-2 py-2 focus:outline-none"
                        :class="{'border-red-500':errors.contact_name}">

                        <p v-if="errors.contact_name" class="text-red-500"> {{errors.contact_name[0]}} </p>
                    </div>
                    <div class="flex flex-col w-full">
                        <label for="phone" class="text-slate-800 font-semibold my-3 capitalize text-lg"> phone </label>
                        <input type="text" v-model="contact.contact_phone"
                        class="border-2 border-gray-300 px-2 py-2 focus:outline-none"
                        :class="{'border-red-500':errors.contact_phone}">

                        <p v-if="errors.contact_phone" class="text-red-500"> {{errors.contact_phone[0]}} </p>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full">
                        <label for="email" class="text-slate-800 font-semibold my-3 text-lg capitalize"> email </label>
                        <input type="text" v-model="contact.contact_email"
                        class="border-2 border-gray-300 px-2 py-2 focus:outline-none"
                        :class="{'border-red-500':errors.contact_email}">

                        <p v-if="errors.contact_email" class="text-red-500"> {{errors.contact_email[0]}} </p>
                    </div>
                    <div class="flex flex-col w-full">
                        <label for="subject" class="text-slate-800 font-semibold text-lg my-3 capitalize"> subject </label>
                        <input type="text" v-model="contact.contact_subject"
                        class="border-2 border-gray-300 px-2 py-2 focus:outline-none"
                        :class="{'border-red-500':errors.contact_subject}">
    
                        <p v-if="errors.contact_subject" class="text-red-500"> {{errors.contact_subject[0]}} </p>
                    </div>
                </div>
                <div class="flex flex-col w-full">
                    <label for="" class="text-slate-800 font-semibold my-3 text-lg capitalize"> desciption </label>
                    <textarea name="" id="" cols="30" rows="10" v-model="contact.contact_description"
                    class="border-2 border-gray-300 px-2 py-2 focus:outline-none"
                    :class="{'border-red-500':errors.contact_description}">
                    
                    </textarea>
                    <p v-if="errors.contact_description" class="text-red-500"> {{errors.contact_description[0]}} </p>
                </div>
                
                <button class="my-10 py-2 px-8 capitalize bg-blue-600 text-white rounded-lg text-xl"> {{ buttonText }} </button>
            </form>
        </div>
 
    </div>
    
</template>
<script>

export default{
    data(){
        return{
            buttonText:'send message',
            contact:{},
            errors:{},
            contactSetting:[],
        }
    },
    methods:{
        sendMessage(){
            this.loading = 'sending message ...';
            axios.post('/contact/message/sent',this.contact)
            .then(res =>{
                this.notification.message= 'the contact message has been send';
                this.notification.type= 'success';
                this.contact = {};
                this.loading = false;
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;
                this.loading = false;
            })
        }
    },
    mounted(){
        // axios.get()
    },
}
</script>
<style scoped>
iframe{
    width: 100%;
    height: 100%;
}
</style>