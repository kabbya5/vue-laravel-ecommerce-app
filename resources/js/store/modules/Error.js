const state = {
    error:'false',
}

const getters ={
    error:state =>{
        return state.error;
    }
}

const actions ={
    setError({commit,state},error){
        commit('setError',error);
    }
}

const mutations ={
    setError(state,error){
        state.error = error.response.data.errors;
    }
}

export default {
    state,getters,actions,mutations,
}