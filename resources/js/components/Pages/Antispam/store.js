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
        }
    }
};

export default store