import {createApp} from 'vue';
import Vuex from 'vuex';

const Vue = createApp({});
Vue.use(Vuex);

import Category from './modules/category';
import notification from './modules/notification';

export default new Vuex.Store({
    modules:{
        Category,
        notification,
    }
})