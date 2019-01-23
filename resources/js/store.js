import Vue from "vue"
import Vuex from "vuex";
Vue.use(Vuex)

import OrdersPageStore from "./components/Pages/Orders/store"

const store = new Vuex.Store({
    modules: {
        ordersPage: OrdersPageStore
    },
    state: {
    },
    mutations: {
    }
});

export default store