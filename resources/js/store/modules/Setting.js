const state = {
    setting:{},
    loading:false,
}
const getters = {
    loading:state =>{
        return state.loading;
    },
    setting:state =>{
        return state.setting;
    }
};

const actions = {
    fetchSetting({commit,state}){
        commit('setLoading',true);
        axios.get('/api/setting')
        .then(res => {
            commit('setLoading',false);
            commit('setSetting',res.data.setting);
        })
    },
    storeSetting({commit,dispatch},data){
        
    }
};

const mutations = {
    setSetting(state,setting){
        state.setting = setting;
    },
    
};

export default { state, actions, getters, mutations}