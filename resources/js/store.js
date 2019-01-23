import Vuex from "vuex";

const store = new Vuex.Store({
    state: {
        orders: []
    },
    mutations: {
        increment (state) {
            state.count++
        }
    }
});

export default store