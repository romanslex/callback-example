const store = {
    namespaced: true,
    state: {
        widget: {},
        system: {
            currentState: "general"
        },
    },
    mutations: {
        changeBgColor(state, payload){
            state.widget.bgColor = payload
        },
        changeFontColor(state, payload){
            state.widget.fontColor = payload
        },
        changeBtnBgColor(state, payload){
            state.widget.btnBgColor = payload
        },
        changeBtnFontColor(state, payload){
            state.widget.btnFontColor = payload;
        },

        changeGeneralHeader(state, payload){
            state.widget.phrases.general.header = payload;
        },
        changeGeneralText(state, payload){
            state.widget.phrases.general.text = payload;
        },
        changeGeneralBtnText(state, payload){
            state.widget.phrases.general.btnText = payload;
        },

        changeOnExitHeader(state, payload){
            state.widget.phrases.onExit.header = payload;
        },
        changeOnExitText(state, payload){
            state.widget.phrases.onExit.text = payload;
        },
        changeOnExitBtnText(state, payload){
            state.widget.phrases.onExit.btnText = payload;
        },

        changeAfterSendingHeader(state, payload){
            state.widget.phrases.afterSending.header = payload;
        },

        changeNotWorkingHoursHeader(state, payload){
            state.widget.phrases.notWorkingHours.header = payload
        },
        changeNotWorkingHoursText(state, payload){
            state.widget.phrases.notWorkingHours.text = payload
        },
        changeNotWorkingHoursBtnText(state, payload){
            state.widget.phrases.notWorkingHours.btnText = payload
        },

        changeCurrentState(state, payload){
            state.system.currentState = payload;
        }
    },
};
export default store