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

        setIsDisplayedDuringNotWorkingHours(state, payload){
            state.settings[payload.widgetId].is_displayed_during_not_working_hours = payload.value;
        },
        setIsCatchEnabled(state, payload){
            state.settings[payload.widgetId].is_catch_enabled = payload.value;
        },
        setAutodisplayEnabled(state, payload){
            state.settings[payload.widgetId].is_autodisplay_enabled = payload.value;
        },
        setAutodisplayDelay(state, payload){
            state.settings[payload.widgetId].autodisplay_delay = payload.value;
        },

        setIsDisplayedInAllRegions(state, payload){
            state.settings[payload.widgetId].is_displayed_in_all_regions = payload.value;
        },

        setRegions(state, payload){
            state.settings[payload.widgetId].regions = payload.value;
        },
        addRegion(state, payload){
            let regions = state.settings[payload.widgetId].regions;
            regions.push(payload.value);
            state.settings[payload.widgetId].regions = regions;
        },
        removeRegion(state, payload){
            let regions = state.settings[payload.widgetId].regions;
            regions.splice(_.findIndex(regions, i => i.uid === payload.value.uid), 1)
        },
    },
    actions: {
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

        setIsDisplayedDuringNotWorkingHours({commit}, payload){
            commit("setIsDisplayedDuringNotWorkingHours", payload)
        },
        setIsCatchEnabled({commit}, payload){
            commit("setIsCatchEnabled", payload)
        },
        setAutodisplayEnabled({commit}, payload){
            commit("setAutodisplayEnabled", payload)
        },
        setAutodisplayDelay({commit}, payload){
            commit("setAutodisplayDelay", payload)
        },

        setIsDisplayedInAllRegions({commit}, payload){
            commit("setIsDisplayedInAllRegions", payload)
        },

        setRegions({commit}, payload){
            commit("setRegions", payload)
        },
        addRegion({commit}, payload){
            commit("addRegion", payload)
        },
        removeRegion({commit}, payload){
            commit("removeRegion", payload)
        },
    },
    getters: {
        widgetData: state => widgetId => state.settings[widgetId],
        isInitStateReady: state => widgetId => widgetId in state.settings
    },
};

export default store