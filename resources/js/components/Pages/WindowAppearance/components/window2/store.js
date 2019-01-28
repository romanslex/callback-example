const store = {
    state: {
        widget: {},
        system: {
            currentState: "general"
        },
    },
    mutations: {
        w2ChangeOverlayColor(state, payload){
            state.widget.overlayColor = payload
        },
        w2ChangeBtnBgColor(state, payload){
            state.widget.btnBgColor = payload
        },
        w2ChangeBtnShadowColor(state, payload){
            state.widget.btnShadowColor = payload
        },

        w2ChangePhrases(state, payload){
            state.widget.phrases = payload
        },

        w2ChangeCurrentState(state, payload){
            state.system.currentState = payload
        }
    },
    actions: {
        w2ChangeOverlayColor(context, payload){
            context.commit("w2ChangeOverlayColor", payload)
        },
        w2ChangeBtnBgColor(context, payload){
            context.commit("w2ChangeBtnBgColor", payload)
        },
        w2ChangeBtnShadowColor(context, payload){
            context.commit("w2ChangeBtnShadowColor", payload)
        },

        w2ChangePhrases(context, payload){
            context.commit("w2ChangePhrases", payload)
        },

        w2ChangeCurrentState(context, payload){
            context.commit("w2ChangeCurrentState", payload)
        }
    }
}
export default store