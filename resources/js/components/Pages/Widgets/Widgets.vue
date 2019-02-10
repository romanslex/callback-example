<template lang="pug">
    #widgets-content
        #loader-block(v-show="isLoaderDisplayed")
            img#loader(src="../../../assets/loader.gif")
        #wt(v-show="!isLoaderDisplayed")
            .wt-tr.wt-tr-headers
                .wt-td-url Сайт
                .wt-td-orders Заявки
                .wt-td-expired Окончание тарифа
                div
            .wt-tr(v-for="widget in widgets" :key="widget.id")
                .wt-td-url(style="font-size: 15px") {{ widget.url | truncate(50) }}
                .wt-td-orders: sparkline(:items="widget.orders")
                .wt-td-expired
                    .expired-td.is-expired(v-if="widget.isExpired")
                        | Тариф истек
                        br
                        | {{formatDate(widget.rateExpiredAt)}}
                    .expired-td(v-else) {{formatDate(widget.rateExpiredAt)}}
                .wt-td-actions
                    rates-modal(:wid="widget.id")
                    router-link.edit-btn-wrap(:to="'/home/widgets/' + widget.id + '/edit'")
                        button.edit-btn.btn
                            i.fal.fa-cog.widget-edit(style="margin-right: 5px")
                            | Настроить
                    delete-site-confirm(:wid="widget.id" :url="widget.url" @widget-deleted="onWidgetDeleted")
        add-site-form(v-show="!isLoaderDisplayed")
</template>

<script>
    import Sparkline from "./Sparkline.vue"
    import DeleteSiteConfirm from "./DeleteSiteConfirm.vue"
    import RatesModal from './RatesModal.vue'
    import AddSiteForm from "./AddSiteForm.vue"

    import moment from "moment"

    export default {
        data: function(){
            return {
                isLoaderDisplayed: false
            }
        },
        components: {
            Sparkline,
            DeleteSiteConfirm,
            RatesModal,
            AddSiteForm,
        },
        methods: {
            formatDate(date){
                return moment(date, "DD.MM.YYYY").format("DD MMMM YYYY")
            },
            getWidgets(){
                this.isLoaderDisplayed = true;
                window.axios
                    .get("/data/widgets")
                    .then(response => {
                        this.isLoaderDisplayed = false;
                        this.$store.dispatch("widgetsPage/setWidgets", response.data)
                    })
                    .catch(error => {
                        console.log(error);
                        this.isLoaderDisplayed = false;
                    })
            },
            onWidgetDeleted(){
                this.getWidgets()
            }
        },
        computed: {
            store(){
                return this.$store.state.widgetsPage;
            },
            widgets(){
                return this.store.widgets
            }
        },
        created: function(){
            moment.locale("ru");
            if(!this.store.isAlreadyInitialized)
                this.getWidgets()
        },
    }
</script>

<style scoped lang="stylus">
    #widgets-content
        width 100%
        margin: 0 auto
        padding-top: 20px
        @media(min-width: 961px)
            width 940px
        @media(max-width: 960px)
            padding 20px 10px 0 10px
        >>>.btn
            text-transform: uppercase
            outline: none

    #wt
        margin-top: 10px
        overflow-x auto
        overflow-y hidden
    .wt-tr
        font-size: 14px
        display: grid
        grid-template-columns: minmax(340px, auto) 130px 180px max-content
        grid-template-areas: "name orders expired actions"
        padding: 10px 0
        border-bottom: 1px solid rgba(0,0,0,0.12)
    .wt-tr-headers
        grid-template-columns: minmax(340px, auto) 130px 180px 218px
    .wt-td-url
        grid-area: name
        align-self: center
        position: relative
    .wt-td-orders
        grid-area: orders
        align-self: center
    .wt-td-expired
        grid-area: expired
        justify-self: start
        align-self: center
    .wt-td-actions
        grid-area: actions
        justify-self: end
        align-self: center
        display: grid
        grid-template-columns: max-content 5px max-content 5px 14px
        grid-template-areas: "buy . settings . del"
    .expired-td
        font-size: 14px

    .widget-edit
        color: white
        cursor: pointer
    .widget-delete
        color: red
        cursor: pointer
        grid-area: del
        align-self: center

    .edit-btn-wrap
        grid-area: settings
    .edit-btn
        border: none
        color: white
        padding: 5px 10px
        background: #3497dc
        cursor: pointer
        font-size: 11px
        &:hover
            background: #115B8F
            box-shadow: none
    .expired-td.is-expired
        font-size: 11px
        color: red

    #loader-block
        display: grid
        justify-content: center
        padding: 20px
    #loader
        width: 50px
</style>
