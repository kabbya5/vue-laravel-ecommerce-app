import './bootstrap';
import {createApp} from 'vue';
import router from './router';
import store from './store/';
import User from './helpers/User';
window.User = User;

import App from './components/App.vue';
import Admin from './components/admin/AdminApp.vue';

const app = createApp({});
app.component('App',App);
app.component('Admin',Admin);
app.use(router);
app.use(store);
app.use(User);
app.mount('#app');