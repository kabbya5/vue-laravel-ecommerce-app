import axios from "axios";

const state ={
    categories:[],
    modalForm:false,
};
const getters = {
    categories:state =>{
        return state.categories;
    },
    modalForm:state => {
        return state.modalForm;
    }
};

const actions = {
    fetchCategories({commit,dispatch}){
        dispatch('setLoading',true);
        axios.get('/api/admin/categories')
        .then(res => {
            dispatch('setLoading',false);
            commit('setCategories',res.data);
        })
    },

    storeCategory({commit,dispatch},category){
        dispatch('setLoading',true);
        axios.post('/api/admin/categories/store',category)
        .then(res => {
            dispatch('setLoading',false);
            commit('pushCateories',category);
            dispatch('toggleModalForm',false);
            dispatch('fetchNotification',{
                type:'success',
                message:'The category has been created successfully',
            })
        }).catch(error => {
           dispatch('setError', error);
        });
    },

    updateCategory({commit,dispatch}, category){
        dispatch('setLoading',true);
        axios.put('/api/admin/categories/update/'+ category.slug, category)
        .then(res => {
            dispatch('setLoading',false);
            commit('pushCategories', category);
            dispatch('toggleModalForm',false);
            dispatch('fetchNotification',{
                type:'success',
                message:'The Category has been updated successfully',
            })

            this.dispatch('fetchCategories');
        })
        .catch(error => {
            dispatch('setLoading',false);
            dispatch('setError', error);
        });
    },

    deleteCategory({commit,dispatch},slug){
        dispatch('setLoading',true);
        axios.delete('/api/admin/categories/delete/'+slug)
        .then(res =>{
            dispatch('setLoading',false);
            commit('filterCategory',slug);
            dispatch('fetchNotification',{
                type:'success',
                message:'The Category has been deleted successfully',
            })
        })
    },

    fetchTrashCategories({commit,dispatch}){
        dispatch('setLoading',true);
        axios.get('/api/admin/trash/categories')
        .then(res => {
            dispatch('setLoading',false);
            commit('setCategories',res.data);
        })
    },

    restoreCategory({commit,dispatch},slug){
        dispatch('setLoading',true)
        axios.get('/api/admin/restore/categories/'+slug)
        .then(res => {
            dispatch('setLoading',false);
            commit('filterCategory',slug);
            dispatch('fetchNotification',{
                type:'success',
                message:'The Catgory has been restored successfully',
            })
        })
    },

    forchDeleteCategory({commit,dispatch},slug){
        dispatch('setLoading',true);
        axios.delete('/api/admin/forch/delete/categories/'+slug)
        .then(res =>{
            dispatch('setLoading', false);
            commit('filterCategory',slug);
            dispatch('fetchNotification',{
                type:'success',
                message:'The category has been deleted successfully',
            });
        })
    },

    toggleModalForm({commit,state},value){
        commit('toggleModalForm',value);
    },
};

const mutations = {
    setCategories(state,categories){
        state.categories = categories;
    },
    pushCateories(state,category){
        state.categories.unshift(category);
    },
    toggleModalForm(state,value){
        state.modalForm = value;
    },

    filterCategory(state,slug){
        state.categories = state.categories.filter(cat => cat.slug != slug);
    }
};

export default {
    state, getters, actions,mutations,
}