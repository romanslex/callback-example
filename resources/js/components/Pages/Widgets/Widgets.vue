<template lang="pug">
    #widgets-content
        #wt
            .wt-tr
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
                    a.edit-btn-wrap(:href="'/home/widgets/' + widget.id + '/edit'")
                        button.edit-btn.btn
                            i.fal.fa-cog.widget-edit
                            | Настроить
                    delete-site-confirm(:wid="widget.id" :url="widget.url")
        add-site-form
</template>

<script>
    import Sparkline from "./Sparkline.vue"
    import DeleteSiteConfirm from "./DeleteSiteConfirm.vue"
    import RatesModal from './RatesModal.vue'
    import AddSiteForm from "./AddSiteForm.vue"

    import moment from "moment"

    export default {
        components: {
            Sparkline,
            DeleteSiteConfirm,
            RatesModal,
            AddSiteForm,
        },
        props: ["widgets"],
        methods: {
            formatDate(date){
                return moment(date, "DD.MM.YYYY").format("DD MMMM YYYY")
            },
            getWidgets(){
            }
        },
        created: function(){
            moment.locale("ru");
            this.getWidgets();
        }
    }
</script>

<style scoped lang="stylus">
    #widgets-content
        width: 940px
        margin: 0 auto
        padding-top: 20px

    #wt
        margin-top: 10px
    .wt-tr
        font-size: 14px
        display: grid
        grid-template-columns: auto 130px 180px 218px
        grid-template-areas: "name orders expired actions"
        padding: 10px 0
        border-bottom: 1px solid rgba(0,0,0,0.12)
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
</style>
