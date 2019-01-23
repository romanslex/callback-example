import Vue from "vue"
import Vuex from "vuex";
Vue.use(Vuex)

import OrdersPageStore from "./components/Pages/Orders/store"
import WidgetsPageStore from "./components/Pages/Widgets/store"

const store = new Vuex.Store({
    modules: {
        ordersPage: OrdersPageStore,
        widgetsPage: WidgetsPageStore,
    },
    state: {
    },
    mutations: {
    }
});

export default store