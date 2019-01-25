import SuccessNotify from "./SuccessNotify.vue"
import DangerNotify from "./DangerNotify.vue"

const NotifyPlugin = {
    install(Vue, options) {
        let successNotifyCtor = Vue.extend(SuccessNotify);
        let successNotify = new successNotifyCtor();
        let vm = successNotify.$mount();
        document.querySelector('body').appendChild(vm.$el);

        let dnCtor = Vue.extend(DangerNotify);
        let dangerNotify = new dnCtor();
        let dnVM = dangerNotify.$mount();
        document.querySelector("body").appendChild(dnVM.$el);

        Vue.prototype.$notifySuccess = function(text){
            successNotify.notify(text)
        };
        Vue.prototype.$notifyDanger = function(text){
            dangerNotify.notify(text);
        };
    }
};

export default NotifyPlugin;