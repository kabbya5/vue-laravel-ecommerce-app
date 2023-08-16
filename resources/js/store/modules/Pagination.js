const state = {
    pagination:{},
    activePage:1,
    query:'all'
}
const getters = {
    pagination:state =>{
        return state.pagination;
    },
    activePage:state =>{
        return state.activePage;
    },
    query:state =>{
        return state.query;
    }
}

const actions = {
    setPagination({commit,state}, pagination){
        commit('setPagination',pagination);
    },

    setActivePage({commit,state},page){
        commit('setActivePage',page);
    },
    setFilterOption({commit,state},query){
        commit('setQuery',query)
    }
}

const mutations = {
    setPagination(state,pagination){
        state.pagination = pagination;
    },
    setActivePage(state,page){
        state.activePage = page;
    },
    setQuery(state,query){
        state.query = query;
    }
}

export default{ state,actions,mutations,getters}