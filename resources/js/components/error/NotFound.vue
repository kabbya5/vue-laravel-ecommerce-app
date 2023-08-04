<template>
    <div class="bg-red-800 py-10 md:py-10 mt-4">
        <div class="h-full flex items-center justify-center">
            <div class="text-center max-w-[600px] px-4">
                <h2 class="text-[150px] font-bold text-white tracking-widest"> 404 </h2>
                <p class="text-[30px] uppercase font-semibold text-white -mt-8"> opps ! page not found  </p>

                <p class="mt-4 text-[22px] font-md text-white"> 
                    Sorry, the page you are looking for could not be found. 
                    It may have been moved, deleted, or never existed in the first place.
                     Please navigate back to the homepage.
                </p>
                
                <router-link :to="{name:'home'}" class="my-6 inline-block
                bg-green-800 text-white px-4 py-2 rounded-md"> Go to Home  </router-link>
            </div>
        </div>
    </div>
</template>