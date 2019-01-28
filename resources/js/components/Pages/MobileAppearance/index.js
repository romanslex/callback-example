import Vue from 'vue'
import App from './components/App.vue'
import store from "./store"
import NotifyPlugin from "../../Shared/NotifyPlugin/NotifyPlugin"

Vue.use(NotifyPlugin);

new Vue({
    render: h => h(App),
    store,
    created: function(){
        this.$store.dispatch("initState")
    }
}).$mount("#content");