const store = {
    namespaced: true,
    state: {
        widget: {},
        system: {}
    },
    mutations: {
        changeColor(state, payload){
            state.widget.color = payload
        },
        changeXPosition(state, payload){
            state.widget.xPosition = payload
        },
        changeYPosition(state, payload){
            state.widget.yPosition = payload
        }
    },
};
export default store