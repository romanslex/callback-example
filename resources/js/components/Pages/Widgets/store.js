const store = {
    namespaced: true,
    state: {
        widgets: [],
        isAlreadyInitialized: false
    },
    mutations: {
        setWidgets(state, payload){
            state.widgets = payload;
            state.isAlreadyInitialized = true;
        },
        addWidget(state, widget){
            state.widgets.push(widget)
        }
    },
    actions: {
        setWidgets({commit}, payload){
            commit("setWidgets", payload)
        },
        addWidget({commit}, widget){
            commit("addWidget", widget)
        }
    }
};

export default store