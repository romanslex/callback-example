const store = {
    state: {
        widget: {},
        system: {
            currentState: "general"
        },
    },
    mutations: {
        w1ChangeBgColor(state, payload){
            state.widget.bgColor = payload
        },
        w1ChangeFontColor(state, payload){
            state.widget.fontColor = payload
        },
        w1ChangeBtnBgColor(state, payload){
            state.widget.btnBgColor = payload
        },
        w1ChangeBtnFontColor(state, payload){
            state.widget.btnFontColor = payload;
        },

        w1ChangeGeneralHeader(state, payload){
            state.widget.phrases.general.header = payload;
        },
        w1ChangeGeneralText(state, payload){
            state.widget.phrases.general.text = payload;
        },
        w1ChangeGeneralBtnText(state, payload){
            state.widget.phrases.general.btnText = payload;
        },

        w1ChangeOnExitHeader(state, payload){
            state.widget.phrases.onExit.header = payload;
        },
        w1ChangeOnExitText(state, payload){
            state.widget.phrases.onExit.text = payload;
        },
        w1ChangeOnExitBtnText(state, payload){
            state.widget.phrases.onExit.btnText = payload;
        },

        w1ChangeAfterSendingHeader(state, payload){
            state.widget.phrases.afterSending.header = payload;
        },

        w1ChangeNotWorkingHoursHeader(state, payload){
            state.widget.phrases.notWorkingHours.header = payload
        },
        w1ChangeNotWorkingHoursText(state, payload){
            state.widget.phrases.notWorkingHours.text = payload
        },
        w1ChangeNotWorkingHoursBtnText(state, payload){
            state.widget.phrases.notWorkingHours.btnText = payload
        },

        w1ChangeCurrentState(state, payload){
            state.system.currentState = payload;
        }
    },
    actions: {
        w1ChangeBgColor(context, payload){
            context.commit("w1ChangeBgColor", payload)
        },
        w1ChangeFontColor(context, payload){
            context.commit("w1ChangeFontColor", payload)
        },
        w1ChangeBtnBgColor(context, payload){
            context.commit("w1ChangeBtnBgColor", payload)
        },
        w1ChangeBtnFontColor(context, payload){
            context.commit("w1ChangeBtnFontColor", payload)
        },

        w1ChangeGeneralHeader(context, payload){
            context.commit("w1ChangeGeneralHeader", payload)
        },
        w1ChangeGeneralText(context, payload){
            context.commit("w1ChangeGeneralText", payload)
        },
        w1ChangeGeneralBtnText(context, payload){
            context.commit("w1ChangeGeneralBtnText", payload)
        },

        w1ChangeOnExitHeader(context, payload){
            context.commit("w1ChangeOnExitHeader", payload)
        },
        w1ChangeOnExitText(context, payload){
            context.commit("w1ChangeOnExitText", payload)
        },
        w1ChangeOnExitBtnText(context, payload){
            context.commit("w1ChangeOnExitBtnText", payload)
        },

        w1ChangeAfterSendingHeader(context, payload){
            context.commit("w1ChangeAfterSendingHeader", payload)
        },

        w1ChangeNotWorkingHoursHeader(context, payload){
            context.commit("w1ChangeNotWorkingHoursHeader", payload)
        },
        w1ChangeNotWorkingHoursText(context, payload){
            context.commit("w1ChangeNotWorkingHoursText", payload)
        },
        w1ChangeNotWorkingHoursBtnText(context, payload){
            context.commit("w1ChangeNotWorkingHoursBtnText", payload)
        },

        w1ChangeCurrentState(context, payload){
            context.commit("w1ChangeCurrentState", payload)
        },
    }
}
export default store