const state ={
    notification:{
        type:false,
        message:false,
    }
}

const getters ={
    notification:state =>{
        return state.notification;
    }
};

const actions = {
    fetchNotification({commit,state},notification){
        commit('setNotification',notification);
    },
    revomeNotification({commit,state}){
        commit('revomeNotification');
    }
};

const mutations = {
    setNotification(state, notification){
        state.notification = notification;
    },
    revomeNotification(state){
        state.notification = false
    }
}

export default {
    state, getters, actions, mutations,
}