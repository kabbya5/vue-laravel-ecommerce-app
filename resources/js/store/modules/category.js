const state ={
    categories: {},
    error:{},
    modalForm:false,
};
const getters = {
    categories:state =>{
        return state.categories;
    },
    error:state =>{
        return state.error;
    },
    modalForm:state => {
        return state.modalForm;
    }
};

const actions = {
    fetchCategories({commit,state}){
        axios.get('/admin/categories')
        .then(res => {
            commit('setCategories',res.data);
        })
        .catch(error => {
            commit('setError',error.response.data.error)
        })
    },

    storeCategory({commit,dispatch},category){
        axios.post('/admin/categories/store',category)
        .then(res => {
            dispatch('toggleModalForm',false);
            dispatch('fetchNotification',{
                type:'success',
                message:'The category has been created successfully',
            })
        }).catch(error => {
           commit('setError', error.response.data.errors)
        });
    },

    toggleModalForm({commit,state},value){
        commit('toggleModalForm',value);
    },
};

const mutations = {
    setCategories(state,categories){
        state.categories = categories;
    },
    setError(state,errors){
        state.error = errors;
    },
    pushCateories(state,category){
        state.categories.push(category);
    },
    toggleModalForm(state,value){
        state.modalForm = value;
    }
};

export default {
    state, getters, actions,mutations,
}