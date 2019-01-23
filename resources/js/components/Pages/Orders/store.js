const store = {
    state: {
        state: null
    },
    mutations: {
        setState(state, payload){
            state.state = payload;
        }
    },
};

export default store