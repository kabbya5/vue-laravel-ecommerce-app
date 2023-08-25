import Pagination from "./Pagination";
const state ={
    subcategories:false,
    subcategoryOptions:[],
};

const getters = {
    subcategories:state =>{
        return state.subcategories;
    },
    subcategoryOptions:state =>{
        return state.subcategoryOptions;
    },
};

const actions = {
    fetchSubcategories({commit,dispatch},{page,query}){
        dispatch('setLoading',true);
        axios.post('/api/admin/subcategories?page='+page,{query:query})
        .then(res =>{
            dispatch('setLoading',false);
            commit('setSubcategory',res.data.subcategories);

            dispatch('setPagination',{
                items:res.data.subcategories.length,
                totalPages:res.data.count.lastPage,
                totalItems:res.data.count.total,
            })
        })
        .catch(error =>{
            alert('something wrong !'," try againg");
        })
    },

    storeSubcategory({commit,dispatch},subcategory){
        dispatch('setLoading',true);

        axios.post('/api/admin/subcategories/store',subcategory)
        .then(res => {
            dispatch('setLoading',false);
            commit('unshiftSubcategory',res.data);
            dispatch('fetchNotification',{
                type:'success',
                message:'The subcategory has been created successfully',
            });
        })
        .catch(error => {
            dispatch('setLoading',false);
            dispatch('setError',error);
        })
    },

    updateSubcategory({commit,dispatch},subcategory){
        dispatch('setLoading',true);
        axios.put('/api/admin/subcategories/update/' +subcategory.slug,subcategory)
        .then(res => {
            dispatch('fetchSubcategories',{page:1,query:'all'})
            dispatch('setToggleModalForm',false);
            dispatch('setLoading',false);
            dispatch('fetchNotification',{
                type:'success',
                message:'The subcategory has been created successfully',
            });
            
        })
        .catch(error => {
            dispatch('setLoading',false);
            dispatch('setError',error);
        })
    },

    deleteSubcategores({commit,dispatch},slug){
        dispatch('setLoading',true);
        axios.delete('/api/admin/subcategories/delete/' +slug)
        .then(res =>{
            dispatch('setLoading',false);
            commit('removeSubcategory',slug);
            dispatch('fetchNotification',{
                type:'success',
                message:'The subcategory has been deleted successfully',
            });
        })
    },
    restoreSubcategory({commit,dispatch},slug){
        dispatch('setLoading',true);
        axios.post('/api/admin/subcategories/restore/' + slug)
        .then( res =>{
            dispatch('setLoading',false);
            commit('removeSubcategory',slug);

            dispatch('fetchNotification',{
                type:'success',
                message:'The subcategory has been restored successfully',
            })
        })
    },
    forchDelete({commit,dispatch},slug){
        dispatch('setLoading',true);
        axios.delete('/api/admin/subcategories/forch/delete/' +slug)
        .then(res => {
            dispatch('setLoading',false);
            commit('removeSubcategory',slug);

            dispatch('fetchNotification',{
                type:'success',
                message:'The subcategory has been deleted successfully',
            })
        })
        .catch(error => {
            dispatch('setLoading',false);
            alert('something worng ! try againg');
        })
    }
};

const mutations = {
    setSubcategory(state,subcategories){
        state.subcategories = subcategories;

        subcategories.forEach(subcat => {
            state.subcategoryOptions.push({name:subcat.subcategory_title,value:subcat.id})
        });
    },
    unshiftSubcategory(state,subcategory){
        state.subcategories.unshift(subcategory)
    },
    removeSubcategory(state,slug){
        state.subcategories = state.subcategories.filter(subcat => subcat.slug != slug);
    }
};

export default{ state,actions,mutations,getters}