const store = {
    namespaced: true,
    state: {
        widget: {},
        system: {
            currentState: "general"
        },
    },
    mutations: {
        changeOverlayColor(state, payload){
            state.widget.overlayColor = payload
        },
        changeBtnBgColor(state, payload){
            state.widget.btnBgColor = payload
        },
        changeBtnShadowColor(state, payload){
            state.widget.btnShadowColor = payload
        },

        changeCurrentState(state, payload){
            state.system.currentState = payload
        }
    },
};
export default store