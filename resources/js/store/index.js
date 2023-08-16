import {createApp} from 'vue';
import Vuex from 'vuex';

const Vue = createApp({});
Vue.use(Vuex);

import notification from './modules/notification';
import Category from './modules/category';
import FormError from './modules/Error';
import Loading from './modules/Loading';
import subcategory from './modules/subcategory';
import Pagination from './modules/Pagination';
import ToggleMoadalForm from './modules/ToggleMoadalForm';

export default new Vuex.Store({
    modules:{
        Category,
        subcategory,
        notification,
        Loading,
        FormError,
        Pagination,
        ToggleMoadalForm,
    }
})