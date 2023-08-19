const state ={
    childcategories:{},
}

const getters = {
    childcategories:state=>{
        return state.childcategories;
    }
}

const actions ={
    fetchChildcategories({commit,dispatch},{page,query}){
        dispatch('setLoading',true);
        axios.post('/api/admin/childcategories?page='+page, {query:query})
        .then(res => {
            dispatch('setLoading',false);
            commit('setChildcategories',res.data.childcategories);
            dispatch('setPagination',{
                items:res.data.childcategories.length,
                totalPages:res.data.count.lastPage,
                totalItems:res.data.count.total,
            })
        })
    }
}

const mutations ={
    setChildcategories(state,childcategories){
        state.childcategories = childcategories;
    }
}

export default {state,getters,actions,mutations}