import Vue from "vue"
import Vuex from "vuex"
import w1Store from "./components/window1/store"
import w2Store from "./components/window2/store"

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        currentWindow: "w1",
        site: "",
        wid: ""
    },
    modules: {
        w1: w1Store,
        w2: w2Store,
    },
    mutations: {
        changeCurrentWindow(state, payload){
            state.currentWindow = payload;
        },
        setWindowsSettings(state, payload){
            for(let key in payload)
                if(key.match(/w[1-90].*/))
                    state[key].widget = payload[key];
            console.log({state})
        },
        setSite(state, payload){
            state.site = payload
        },
        setWid(state, payload){
            state.wid = payload
        },
    },
    actions: {
        changeCurrentWindow(context, payload){
            context.commit("changeCurrentWindow", payload)
        },
        initState(context){
            let site = document.getElementById("content").dataset["url"];
            context.commit("setSite", site);

            let settings = JSON.parse(document.getElementById("content").dataset["settings"]);
            context.commit("setWindowsSettings", settings);

            let currentWindow = document.getElementById("content").dataset["currentwindow"];
            context.commit("changeCurrentWindow", currentWindow);

            let wid = document.getElementById("content").dataset["wid"];
            context.commit("setWid", wid);
        }
    }
});
export default store