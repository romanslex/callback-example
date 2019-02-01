import Vue from "vue"
import VueRouter from "vue-router"
Vue.use(VueRouter);

import Orders from "./components/Pages/Orders/Orders.vue"
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
        { path: '/home/orders', component: Orders, meta: { title: "Заявки | CallBackService" } },
        { path: '/home/widgets', component: Widgets, meta: { title: "Виджеты | CallBackService" } },
        { path: '/home/faq', component: Faq, meta: { title: "F.A.Q. | CallBackService" } },
        { path: '/home/antispam', component: Antispam, meta: { title: "Антиспам | CallBackService" } },
        { path: '/home/feedback', component: Feedback, meta: { title: "Обратная связь | CallBackService" } },

        { path: '/home/balance', component: Balance, meta: { title: "Баланс | CallBackService" } },
        { path: '/home/settings', component: Settings, meta: { title: "Настройки | CallBackService" } },

        { path: '/home/widgets/:id/edit', component: WidgetEdit, meta: { title: "Редактирование виджета | CallBackService" } },

        { path: "/home/*", redirect: "/home/orders" }
    ]
});

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    next()
});

export default router;