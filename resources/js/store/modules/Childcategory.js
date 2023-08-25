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
        axios.post('/api/admin/childcategories?page='+page, query)
        .then(res => {
            dispatch('setLoading',false);
            commit('setChildcategories',res.data.childcategories);
            dispatch('setPagination',{
                items:res.data.childcategories.length,
                totalPages:res.data.count.lastPage,
                totalItems:res.data.count.total,
            })
        })
        .catch(error =>{
            dispatch('setLoading',false);
            alert('someting worng! try again');
        })
    },

    storeChildcatgory({commit,dispatch},data){
        dispatch('setLoading',true);
        axios.post('/api/admin/childcategories/store',data)
        .then(res => {
            dispatch('setLoading',false);
            dispatch('setToggleModalForm',false);
            dispatch('fetchNotification',{
                type:'success',
                message:'The childcategory has been created successfully',
            });
            commit('unshiftChildcategory',res.data);
        })
        .catch(error =>{
            dispatch('setLoading',false);
            dispatch('setError',error);
        })
    },
    updatechildcategory({commit,dispatch},{slug,data,page,query}){
        axios.put('/api/admin/childcategories/update/'+slug,data)
        .then(res =>{
            this.dispatch('setToggleModalForm',false);
            dispatch('fetchChildcategories',{page,query});
            dispatch('fetchNotification',{
                type:'success',
                message:'The childcategory has been updated successfully',
            });
        })
        .catch(error => {
            alert('something worng ! try agian later');
        })
    },
    deleteChildcategory({commit,dispatch},slug){
        axios.delete('/api/admin/childcategories/delete/'+slug)
        .then(res => { 
            commit('removeChildcategory', slug);
            dispatch('fetchNotification',{
                type:'success',
                message:'The childcategory has been updated successfully',
            });
        })
        .catch(error =>{
            alert('something worng! logout and login again');
        })
    }
    
}

const mutations ={
    setChildcategories(state,childcategories){
        state.childcategories = childcategories;
    },
    unshiftChildcategory(state,childcategory){
        state.childcategories.unshift(childcategory);
    },
    removeChildcategory(state,slug){
      state.childcategories = state.childcategories.filter(childcat => childcat.slug != slug);
    }
}

export default {state,getters,actions,mutations}