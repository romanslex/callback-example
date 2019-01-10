import Vue from "Vue"
import VueRouter from "vue-router"
Vue.use(VueRouter);

import Orders from "./components/Pages/Orders.vue"

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: '/home/orders', component: Orders },
    ]
});

export default router;