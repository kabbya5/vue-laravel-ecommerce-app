<template>
    <div class="">
        <Notification/>
        <Navbar/>
        <router-view :key="$route.fullPath"> </router-view> 
        <Footer/>
    </div>
</template>

<script>
    import Footer from './Footer.vue';
    import Navbar from './Navbar.vue';
    import Notification from './Notification.vue';
 
    export default {
    components: {Footer, Navbar,Notification},
}
</script>
