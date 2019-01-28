import Vue from "vue"
import Vuex from "vuex"
import btn1Store from "./components/btn1/store"

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        currentBtn: "b1",
        site: "",
        wid: ""
    },
    modules: {
        b1: btn1Store,
    },
    mutations: {
        initSite(state, payload){
            state.site = payload
        },
        changeCurrentBtn(state, payload){
            state.currentBtn = payload
        },
        setBState(state, payload){
            for(let key in payload)
                if(key.match(/b[1-90].*/))
                    state[key] = payload[key]
        },
        setWid(state, payload){
            state.wid = payload
        },
    },
    actions: {
        initState(context){
            let doc = document.getElementById("content");

            let site = doc.dataset["url"];
            context.commit("initSite", site);

            let settings = JSON.parse(doc.dataset["settings"]);
            context.commit("setBState", settings);

            let currentBtn = doc.dataset["currentbtn"];
            context.commit("changeCurrentBtn", currentBtn);

            let wid = doc.dataset["wid"];
            context.commit("setWid", wid);
        },
        changeCurrentBtn(context, payload){
            context.commit("changeCurrentBtn", payload)
        }
    }
});
export default store