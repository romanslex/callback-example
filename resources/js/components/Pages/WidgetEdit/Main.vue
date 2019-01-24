<template lang="pug">
    #edit-widget-content(v-if="isInitStateReady")
        h3  {{url | truncate(60)}}
        .tab-nav
            .wi
                div(v-if="!isRateExpired") Тариф истекает - {{rateExpiredAt}}
                .expired(v-if="isRateExpired") Тариф истек - {{rateExpiredAt}}
            .tab-nav-item(v-bind:class="{active: currentTab.general}" @click="setCurrentTab('general')")
                a Основные
            .tab-nav-item(v-bind:class="{active: currentTab.show}" @click="setCurrentTab('show')")
                a Настройки показа
            .tab-nav-item(v-bind:class="{active: currentTab.integrations}" @click="setCurrentTab('integrations')")
                a Интеграции
            .tab-nav-item(v-bind:class="{active: currentTab.code}" @click="setCurrentTab('code')")
                a Код виджета
        .tab-content
            .tab-content-item(v-show="currentTab.general"): general
            .tab-content-item(v-show="currentTab.show"): show
            .tab-content-item(v-show="currentTab.integrations"): integrations
            <!--.tab-content-item(v-show="currentTab.code"): code-->
        div(style="display: grid; justify-content:end; margin-top: 20px")
            button.btn(@click="save") Сохранить настройки
</template>

<script>
    import General from "./General.vue"
    // import Code from "./Code.vue"
    import Show from "./Show.vue"
    import Integrations from "./Integrations.vue"
    import moment from "moment"
    moment.locale("ru");

    export default {
        components: {
            General,
            // Code,
            Show,
            Integrations,
        },
        data: function(){
            return {
                currentTab: {
                    general: true,
                    show: false,
                    integrations: false,
                    code: false
                }
            }
        },
        methods: {
            setCurrentTab: function(name){
                this.currentTab.general = false;
                this.currentTab.show = false;
                this.currentTab.integrations = false;
                this.currentTab.code = false;
                this.currentTab[name] = true;
            },
            save: function(){
                window.axios
                    .put("/home/widgets/" + this.$store.state.settings.id, this.$store.state.settings)
                    .then(response => this.$notifySuccess())
                    .catch(error => this.$notifyDanger());
            },
        },
        computed: {
            isInitStateReady(){
                return this.$store.getters["widgetEditPage/isInitStateReady"](this.widgetId)
            },
            widgetId(){
                return this.$route.params.id;
            },
            widgetData(){
                return this.$store.getters['widgetEditPage/widgetData'](this.widgetId)
            },
            url(){
                return this.widgetData.url
            },
            rateExpiredAt(){
                return moment(
                    this.widgetData.rate_expired_at
                ).format("D MMM YYYY");
            },
            isRateExpired(){
                return (new Date()).getTime() >= (new Date(this.widgetData.rate_expired_at)).getTime();
            }
        },
        created: function(){
            this.$store.dispatch("widgetEditPage/initWidgetData", this.widgetId);
        }
    }
</script>


<style scoped lang="stylus">
    #edit-widget-content
        width: 940px
        margin: 0 auto
        margin-top: 20px
    .tab-nav
        display: grid
        grid-template-columns: 40% auto auto auto auto
        grid-gap: 5px
        border-bottom: solid 1px #dddddd
    .tab-nav-item
        text-align: center
        text-transform: uppercase
        font-size: 13px
        height: 56px
        cursor: pointer
        display: grid
        &:hover
            background: rgba(52, 151, 220, 0.13)
        a
            align-self: center
        &.active
            color: #3497dc
            border-bottom: solid 2px #3497dc
            &:hover
                background: initial
    .wi
        align-content: center
        font-size: 13px
        display: grid
        justify-content: start
        div
            text-align: right
            padding: 5px 10px
            border: solid 1px #3497dc
            color: #3497dc
            &.expired
                border: solid 1px red
                color: red

    .btn
        padding: 8px 15px
        font-size: 13px
        background: #49af60
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33)
        transition: box-shadow 0.15s ease-out
        &:hover
            box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.38)
</style>