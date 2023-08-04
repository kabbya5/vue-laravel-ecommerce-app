<template>
    <div class="profile py-10 md:py-20">
        <div class="w-full lg:w-[700px] mx-auto">
            <div class="flex items-center justify-center">
                <div class="profile-image w-[130px] h-[130px]">
                    <img class="w-full h-full rounded-full" :src="img" alt="">
                </div>
                <div class="user-name pl-6">
                    <p class="capitalize name"> {{ user.name }} </p>
                    <p class="email"> {{user.email}} </p>
                </div>
            </div>
            <div class="profile-nav mt-10 flex flex-wrap items-center justify-center">
                <a :class="{'active':show=='order'}"> <i class="fa-solid fa-list"> </i> Orders </a>
                <a :class="{'active':show=='edit-profile'}"> Edit Profile </a>
                <a :class="{'active':show=='change-password'}"> Change Password  </a>
                <a :class="{'active':show=='wishlist'}"> Wish list  </a>
            </div>

            <div v-if="show=='order'" class="order-list mt-6">
                <h2 class="title px-6"> order list </h2>

                <div class="order-items mt-6">                
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="w-[70%] px-6 py-3">
                                        Product name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        price 
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                    status 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Apple MacBook Pro 17"
                                    </th>
                                    <td class="px-6 py-4">
                                        $2999
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    data(){
        return{
            show:false,
            user:User.auth(),
            img:"https://d2v5dzhdg4zhx3.cloudfront.net/web-assets/images/storypages/short/linkedin-profile-picture-maker/dummy_image/thumb/004.webp",
        }
    },
    created(){
        this.show = 'order';
    }
}
</script>