const state = {
    pagination:{},
    activePage:1,
    query:{
        query:'index',
        showItems:15,
    },
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
    setFilterOptionQuery({commit,state},query){
        commit('setQuery',query)
    },
    setFilterOptionItems({commit,state},items){
        commit('setShowItems',items)
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
        state.query.query = query;
    },
    setShowItems(state,items){
        state.query.showItems = items;
    }
}

export default{ state,actions,mutations,getters}