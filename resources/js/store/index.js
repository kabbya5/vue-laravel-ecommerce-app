import {createApp} from 'vue';
import Vuex from 'vuex';

const Vue = createApp({});
Vue.use(Vuex);

import notification from './modules/notification';
import Category from './modules/category';
import FormError from './modules/Error';
import Loading from './modules/Loading';

export default new Vuex.Store({
    modules:{
        Category,
        notification,
        Loading,
        FormError,
    }
})