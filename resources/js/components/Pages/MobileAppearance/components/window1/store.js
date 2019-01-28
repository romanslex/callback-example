const store = {
    namespaced: true,
    state: {
        widget: {},
        system: {
            currentState: "general"
        }
    },
    mutations: {
        changeBgColor(state, payload){
            state.widget.bgColor = payload
        },
        changeFontColor(state, payload){
            state.widget.fontColor = payload
        },
        changeCurrentState(state, payload){
            state.system.currentState = payload
        },
        changeGeneralHeader(state, payload){
            state.widget.phrases.general.header = payload
        },
        changeGeneralBtnText(state, payload){
            state.widget.phrases.general.btnText = payload
        },
        changeAfterSendingHeader(state, payload){
            state.widget.phrases.afterSending.header = payload
        },

        changeNotWorkingHoursHeader(state, payload){
            state.widget.phrases.notWorkingHours.header = payload
        },
        changeNotWorkingHoursBtnText(state, payload){
            state.widget.phrases.notWorkingHours.btnText = payload
        },
    }
};
export default store