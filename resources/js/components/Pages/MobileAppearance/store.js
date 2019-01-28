import Vue from "vue"
import Vuex from "vuex"
import w1Store from "./components/window1/store"
import b1Store from "./components/btn1/store"

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        currentWindow: "mw1",
        currentBtn: "mb1",
        wid: ""
    },
    modules: {
        mw1: w1Store,
        mb1: b1Store,
    },
    mutations: {
        changeCurrentWindow(state, payload){
            state.currentWindow = payload
        },
        changeCurrentBtn(state, payload){
            state.currentBtn = payload
        },
        setWid(state, payload){
            state.wid = payload
        },
        setBtnState(state, payload){
            for(let key in payload)
                if(key.match(/mb[1-90].*/))
                    state[key].widget = payload[key]
        },
        setWindowState(state, payload){
            for(let key in payload)
                if(key.match(/mw[1-90].*/))
                    state[key].widget = payload[key]
        }
    },
    actions: {
        initState(context){
            let doc = document.getElementById("content");

            let wid = doc.dataset["wid"];
            context.commit("setWid", wid);

            let btnState = JSON.parse(doc.dataset["btnsettings"]);
            context.commit("setBtnState", btnState);

            let windowState = JSON.parse(doc.dataset["windowsettings"]);
            context.commit("setWindowState", windowState);

            let currentBtn = doc.dataset["currentbtn"];
            context.commit("changeCurrentBtn", currentBtn);

            let currentWindow = doc.dataset["currentwindow"];
            context.commit("changeCurrentWindow", currentWindow);
        },
        changeCurrentWindow(context, payload){
            context.commit("changeCurrentWindow", payload)
        },
        changeCurrentBtn(context, payload){
            context.commit("changeCurrentBtn", payload)
        }
    }
});
export default store;