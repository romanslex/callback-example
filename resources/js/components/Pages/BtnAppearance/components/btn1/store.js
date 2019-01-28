const store = {
    namespaced: true,
    state: {},
    mutations: {
        changePosition(state, payload){
            state.position = payload
        },
        changeBtnColor(state, payload){
            state.btnColor = payload;
        },
        changeWaveColor(state, payload){
            state.waveColor = payload;
        },
        changeXPosition(state, payload){
            state.xPosition = payload
        },
        changeYPosition(state, payload){
            state.yPosition = payload
        },
    },
};
export default store;