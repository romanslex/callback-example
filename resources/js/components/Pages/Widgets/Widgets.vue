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
                    router-link.edit-btn-wrap(:to="'/home/widgets/' + widget.id + '/edit'")
                        button.edit-btn.btn
                            i.fal.fa-cog.widget-edit(style="margin-right: 5px")
                            | Настроить
                    delete-site-confirm(:wid="widget.id" :url="widget.url")
        add-site-form(@widget-added="addWidget")
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
                widgets: []
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
                window.axios
                    .get("/data/widgets")
                    .then(response => {
                        this.widgets = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                        this.isLoaderDisplayed = false;
                    })
            },
            addWidget(widget){
                console.log(widget)
                this.widgets.push(widget)
            }
        },
        computed: {
            store: {
                get(){
                    return this.$store.state.widgetsPage;
                }
            }
        },
        created: function(){
            moment.locale("ru");
            if(this.store.state != null)
                Object.assign(this.$data, this.store.state);
            else
                this.getWidgets();
        },
        beforeRouteLeave  (to, from, next) {
            this.$store.commit("widgetsPage/setState", this.$data);
            next();
        },
    }
</script>

<style scoped lang="stylus">
    #widgets-content
        width: 940px
        margin: 0 auto
        padding-top: 20px
        >>>.btn
            text-transform: uppercase
            outline: none

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
</style>
