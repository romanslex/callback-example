import Vue from "Vue"
import VueRouter from "vue-router"
Vue.use(VueRouter);

import Orders from "./components/Pages/Orders.vue"
import Widgets from "./components/Pages/Widgets/Widgets.vue"
import Faq from "./components/Pages/Faq.vue"
import Antispam from "./components/Pages/Antispam/Antispam.vue";
import Feedback from "./components/Pages/Feedback.vue";
import Balance from "./components/Pages/Balance.vue";
import Settings from "./components/Pages/Settings.vue";
import WidgetEdit from "./components/Pages/WidgetEdit/Main.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/home", redirect: "/home/orders" },
        { path: '/home/orders', component: Orders },
        { path: '/home/widgets', component: Widgets },
        { path: '/home/faq', component: Faq },
        { path: '/home/antispam', component: Antispam },
        { path: '/home/feedback', component: Feedback },

        { path: '/home/balance', component: Balance },
        { path: '/home/settings', component: Settings },

        { path: '/home/widgets/:id/edit', component: WidgetEdit },
    ]
});

export default router;