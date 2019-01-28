const store = {
    state: {
        widget: {},
        system: {
            currentState: "general"
        }
    },
    mutations: {
        mw1ChangeBgColor(state, payload){
            state.widget.bgColor = payload
        },
        mw1ChangeFontColor(state, payload){
            state.widget.fontColor = payload
        },
        mw1ChangeCurrentState(state, payload){
            state.system.currentState = payload
        },
        mw1ChangeGeneralHeader(state, payload){
            state.widget.phrases.general.header = payload
        },
        mw1ChangeGeneralBtnText(state, payload){
            state.widget.phrases.general.btnText = payload
        },
        mw1ChangeAfterSendingHeader(state, payload){
            state.widget.phrases.afterSending.header = payload
        },

        mw1ChangeNotWorkingHoursHeader(state, payload){
            state.widget.phrases.notWorkingHours.header = payload
        },
        mw1ChangeNotWorkingHoursBtnText(state, payload){
            state.widget.phrases.notWorkingHours.btnText = payload
        },
    },
    actions: {
        mw1ChangeBgColor(context, payload){
            context.commit("mw1ChangeBgColor", payload)
        },
        mw1ChangeFontColor(context, payload){
            context.commit("mw1ChangeFontColor", payload)
        },
        mw1ChangeCurrentState(context, payload){
            context.commit("mw1ChangeCurrentState", payload)
        },
        mw1ChangeGeneralHeader(context, payload){
            context.commit("mw1ChangeGeneralHeader", payload)
        },
        mw1ChangeGeneralBtnText(context, payload){
            context.commit("mw1ChangeGeneralBtnText", payload)
        },
        mw1ChangeAfterSendingHeader(context, payload){
            context.commit("mw1ChangeAfterSendingHeader", payload)
        },

        mw1ChangeNotWorkingHoursHeader(context, payload){
            context.commit("mw1ChangeNotWorkingHoursHeader", payload)
        },
        mw1ChangeNotWorkingHoursBtnText(context, payload){
            context.commit("mw1ChangeNotWorkingHoursBtnText", payload)
        },
    }
};
export default store