
const state ={
    subcategories:false,
};

const getters = {
    subcategories:state =>{
        return state.subcategories;
    },
};

const actions = {
    fetchSubcategories({commit,dispatch},{page,query}){
        dispatch('setLoading',true);
        axios.get('/api/admin/'+query +'/subcategories?page='+page)
        .then(res =>{
            dispatch('setLoading',false);
            commit('setSubcategory',res.data.subcategories);

            dispatch('setPagination',{
                items:res.data.subcategories.length,
                totalPages:res.data.count.lastPage,
                totalItems:res.data.count.total,
            })
        })
    },

    // filtersubcategories({commit,dispatch},query){
    //     dispatch('setLoading',true);
    //     axios.post('/api/admin/subcatgory/filter',query)
    //     .then(res =>{
    //         dispatch('setLoading',false);
    //     })
    // },
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
            dispatch('setToggleModalForm',false);
            dispatch('setLoading',false);
            dispatch('fetchNotification',{
                type:'success',
                message:'The subcategory has been created successfully',
            });
            dispatch('fetchSubcategories');
        })
        .catch(error => {
            dispatch('setLoading',false);
            dispatch('setError',error);
        })
    },

    setToggleModalForm({commit,state},value){
        commit('setModalForm',value);
    }
};

const mutations = {
    setSubcategory(state,subcategories){
        state.subcategories = subcategories;
    },
    unshiftSubcategory(state,subcategory){
        state.subcategories.unshift(subcategory)
    },
    setCount(state,count){
        state.count = count
    }
};

export default{ state,actions,mutations,getters}