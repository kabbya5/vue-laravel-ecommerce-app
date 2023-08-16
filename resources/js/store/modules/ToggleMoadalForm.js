const state = {
    modalForm:false,
}

const getters ={
    modalForm:state=>{
        return state.modalForm;
    }
}

const actions ={
    setToggleModalForm({commit,state},value){
        commit('setModalForm',value);
    }
}

const mutations = {
    setModalForm(state,value){
        state.modalForm = value;
    }
}

export default {state,getters,actions,mutations}