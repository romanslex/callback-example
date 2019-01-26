const store = {
    namespaced: true,
    state: {
        blackIps: [],
        blackPhones: [],
        isAlreadyInitialized: false
    },
    mutations: {
        initState(state, payload){
            state.blackIps = payload.blackIps;
            state.blackPhones = payload.blackPhones;
            state.isAlreadyInitialized = true;
        },
        deleteIp(state, payload){
            state.blackIps.splice(payload, 1)
        },
        deletePhone(state, payload){
            state.blackPhones.splice(payload, 1)
        },

        addIp(state, payload){
            state.blackIps.push(payload);
        },
        addPhone(state, payload){
            state.blackPhones.push(payload);
        }

    },
    actions: {
        loadData({commit}){
            window.axios
                .get("/data/antispam")
                .then(response => {
                    commit("initState", response.data);
                })
                .catch(error => {})
        },
        deleteIp({commit}, payload){
            commit("deleteIp", payload)
        },
        deletePhone({commit}, payload){
            commit("deletePhone", payload)
        },

        addIp({commit}, payload){
            commit("addIp", payload);
        },
        addPhone({commit}, payload){
            commit("addPhone", payload);
        },
    }
};

export default store