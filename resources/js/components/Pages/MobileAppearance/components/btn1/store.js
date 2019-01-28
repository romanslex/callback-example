const store = {
    state: {
        widget: {},
        system: {}
    },
    mutations: {
        mb1ChangeColor(state, payload){
            state.widget.color = payload
        },
        mb1ChangeXPosition(state, payload){
            state.widget.xPosition = payload
        },
        mb1ChangeYPosition(state, payload){
            state.widget.yPosition = payload
        }
    },
    actions: {
        mb1ChangeColor(context, payload){
            context.commit("mb1ChangeColor", payload)
        },
        mb1ChangeXPosition(context, payload){
            context.commit("mb1ChangeXPosition", payload)
        },
        mb1ChangeYPosition(context, payload){
            context.commit("mb1ChangeYPosition", payload)
        }
    }
};
export default store