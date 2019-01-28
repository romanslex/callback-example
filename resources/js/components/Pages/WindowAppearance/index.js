import Vue from 'vue'
import App from './components/App.vue'
import store from "./store"
import NotifyPlugin from "../../Shared/NotifyPlugin/NotifyPlugin"
import ColorDarkenPlugin from "../../Shared/ColorDarkenPlugin"

Vue.use(NotifyPlugin);
Vue.use(ColorDarkenPlugin);

new Vue({
    render: h => h(App),
    store,
    created: function(){
        this.$store.dispatch("initState")
    }
}).$mount("#content");