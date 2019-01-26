import Vue from "vue"
import Vuex from "vuex";
Vue.use(Vuex)

import OrdersPageStore from "./components/Pages/Orders/store"
import WidgetsPageStore from "./components/Pages/Widgets/store"
import WidgetEditPageStore from "./components/Pages/WidgetEdit/store"
import AntispamPageStore from "./components/Pages/Antispam/store"

const store = new Vuex.Store({
    strict: true,
    modules: {
        ordersPage: OrdersPageStore,
        widgetsPage: WidgetsPageStore,
        widgetEditPage: WidgetEditPageStore,
        antispamPage: AntispamPageStore,
    },
    state: {
    },
    mutations: {
    }
});

export default store