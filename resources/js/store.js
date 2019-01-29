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
        user: {
            name: "",
            email: "",
            total: "",
            phone: "",
            isEmailNotificationEnabled: ""
        }
    },
    mutations: {
        initUser(state, user){
            state.user.name = user.name;
            state.user.email = user.email;
            state.user.total = user.total;
            state.user.phone = user.phone;
            state.user.isEmailNotificationEnabled = user.isEmailNotificationEnabled;
        },
        updateUserSettings(state, user){
            state.user.name = user.name;
            state.user.email = user.email;
            state.user.phone = user.phone;
            state.user.isEmailNotificationEnabled = user.isEmailNotificationEnabled;
        },
        updateTotal(state, amount){
            state.user.total = amount;
        }
    },
    actions: {
        initUser({commit}){
            let user = JSON.parse(document.getElementById("app").dataset["user"]);
            commit("initUser", user)
        }
    }
});

export default store