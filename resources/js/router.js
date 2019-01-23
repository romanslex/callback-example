import Vue from "Vue"
import VueRouter from "vue-router"
Vue.use(VueRouter);

import Orders from "./components/Pages/Orders.vue"
import Widgets from "./components/Pages/Widgets/Widgets.vue"
import Faq from "./components/Pages/Faq.vue"
import Antispam from "./components/Pages/Antispam/Antispam.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/home", redirect: "/home/orders" },
        { path: '/home/orders', component: Orders },
        { path: '/home/widgets', component: Widgets },
        { path: '/home/faq', component: Faq },
        { path: '/home/antispam', component: Antispam },
    ]
});

export default router;