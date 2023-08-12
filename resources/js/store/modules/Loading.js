const state ={
    loading:false,
}

const getters = {
    loading:state => {
        return state.loading;
    }
}

const actions = {
    setLoading({commit,state},status){
        commit('setLoading', status);
    }
}

const mutations = {
    setLoading(state,status){
        state.loading = status;
    }
}

export default {state,getters,actions,mutations}