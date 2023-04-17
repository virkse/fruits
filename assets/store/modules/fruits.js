import axios from "axios";

const state = {
    page: 1,
    filters: {
        name: null,
        family: null,
    },
    fruits: [],
    favorite: [],
    pagination: [],
}

const getters = {
    getPage: state => {
        return state.page
    },
    getFruits: state => {
        return state.fruits
    },
    getFavorite: state => {
        return state.favorite
    },
    getPagination: state => {
        return state.pagination
    }
}

const actions = {
    async loadFruits({commit, dispatch}) {
        var payload = {}
        const fruits = await axios('/index.php/list?page=' + state.page, payload)
        var favorite = []
        fruits.data.data.map(function(v, i) {
            if(v.is_favorite == true) {
                favorite.push(v.id)
            }
        })
        
        console.log("favorite", favorite)

        commit("mutateFruits", fruits)
        commit("mutateFavorite", favorite)
    },
    setPage({commit}, page) {
        commit("mutatePage", page)
    },
    async setFilter({commit, dispatch}, filters) {
        console.log('filters', filters)
        const fruits = await axios.post('/index.php/list?page=1', filters)
        commit("mutateFruits", fruits)
        commit("mutateFilters", filters)
    },
}

const mutations = {
    mutateFruits: (state, fruits) => {
        state.fruits = fruits.data.data
        state.pagination = fruits.data.pagination
    },
    mutatePage: (state, page) => state.page = page,
    mutateFilters: (state, filters) => state.filters = filters,
    mutateFavorite: (state, favorite) => state.favorite = favorite,
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}
