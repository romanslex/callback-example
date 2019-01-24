import Vue from "vue"
const store = {
    namespaced: true,
    string: true,
    state: {
        settings: {},
    },
    mutations: {
        initWidgetData(state, payload){
            let newState = Object.assign({}, state.settings);
            newState[payload.id] = payload;
            state.settings = newState;
        },
        toggleEmailNotify(state, payload){
            state.settings[payload.widgetId].is_email_notify_enabled = payload.value;
        },
        toggleSmsNotify(state, payload){
            state.settings[payload.widgetId].is_sms_notify_enabled = payload.value;
        },

        addEmail(state, widgetId){
            state.settings[widgetId].emails.push({value: ""});
        },
        removeEmail(state, payload){
            state.settings[payload.widgetId].emails.splice(payload.value, 1);
        },

        addPhone(state, widgetId){
            state.settings[widgetId].phones.push({value: ""});
        },
        removePhone(state, payload){
            state.settings[payload.widgetId].phones.splice(payload.value, 1);
        },

        setTimezone(state, payload){
            state.settings[payload.widgetId].timezone = payload.value;
        },

        setWeekdaysSameSchedule(state, payload){
            state.settings[payload.widgetId].schedule.is_weekdays_same_schedule = payload.value;
        },
        setWeekdaysWorkdays(state, payload){
            state.settings[payload.widgetId].schedule.weekdays_workdays = payload.value;
        },

        setWeekdaysStart(state, payload){
            state.settings[payload.widgetId].schedule.weekdays_start = payload.value;
        },
        setWeekdaysEnd(state, payload){
            state.settings[payload.widgetId].schedule.weekdays_end = payload.value;
        },
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
        },
        toggleEmailNotify({commit}, payload){
            commit("toggleEmailNotify", payload)
        },
        toggleSmsNotify({commit}, payload){
            commit("toggleSmsNotify", payload)
        },

        addEmail({commit}, widgetId){
            commit("addEmail", widgetId)
        },
        removeEmail({commit}, payload){
            commit("removeEmail", payload)
        },

        addPhone({commit}, widgetId){
            commit("addPhone", widgetId)
        },
        removePhone({commit}, payload){
            commit("removePhone", payload)
        },

        setTimezone({commit}, payload){
            commit("setTimezone", payload)
        },

        setWeekdaysSameSchedule({commit}, payload){
            commit("setWeekdaysSameSchedule", payload)
        },
        setWeekdaysWorkdays({commit}, payload){
            commit("setWeekdaysWorkdays", payload)
        },

        setWeekdaysStart({commit}, payload){
            commit("setWeekdaysStart", payload)
        },
        setWeekdaysEnd({commit}, payload){
            commit("setWeekdaysEnd", payload)
        },
    },
    getters: {
        widgetData: state => widgetId => state.settings[widgetId],
        isInitStateReady: state => widgetId => widgetId in state.settings
    },
};

export default store