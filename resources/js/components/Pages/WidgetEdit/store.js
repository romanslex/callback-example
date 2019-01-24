const store = {
    namespaced: true,
    state: {
        settings: {},
    },
    mutations: {
        initWidgetData(state, payload){
            let newState = Object.assign({}, state.settings);
            newState[payload.id] = payload;
            state.settings = newState;
        }
    },
    actions: {
        initWidgetData({commit, state}, widgetId){
            if(!(widgetId in state.settings))
                window.axios
                .get("/data/widgets/" + widgetId)
                    .then(response => {
                        commit("initWidgetData", response.data)
                    })
                    .catch(error => console.log(error))
        }
    },
    getters: {
        widgetData: state => widgetId => state.settings[widgetId],
        isInitStateReady: state => widgetId => widgetId in state.settings
    },
};

export default store