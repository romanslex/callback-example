<template lang="pug">
    #orders-content
        h3 Заявки
        #filter-block
            button.fb-btn(@click="getData(today, 1)" :class="{'active': menu[today]}") Сегодня
            button.fb-btn(@click="getData(yesterday, 1)" :class="{'active': menu[yesterday]}") Вчера
            button.fb-btn(@click="getData(week, 1)" :class="{'active': menu[week]}") Неделя
            button.fb-btn(@click="getData(month, 1)" :class="{'active': menu[month]}") Месяц
            button.fb-btn(@click="getData(threeMonth, 1)" :class="{'active': menu[threeMonth]}") 3 месяца
            date-picker(v-model="customPeriod" :shortcuts="false" range lang="ru" @change="onCustomPeriodChange")

        #table(:class="{'table-bottom-border': meta.last_page > 1}")
            .tr.tr-header
                .th Дата
                .th Сайт
                .th Номер клиента
            .tr(v-for="order in orders" :key="order.id")
                .td {{order.created_at}}
                .td {{order.site}}
                .td {{order.phone}}
            div(v-show="orders.length == 0 && !isLoaderDisplayed" style="font-size:13px; padding:5px 0")
                | Пока нет ни одной заявки
            #loader-block(v-show="isLoaderDisplayed")
                img#loader(src="../../../assets/loader.gif")

        .pagination(v-if="meta.last_page > 1")
            .pagination-item(@click="getData(currnetMenuItem, meta.current_page - 1)")
                i.fal.fa-angle-left

            .pagination-middle-block(v-if="meta.last_page < 6" :style="{'grid-template-columns': 'repeat(' + meta.last_page + ', 35px)'}")
                .pagination-item(
                    v-for="page in meta.last_page"
                    :key="page"
                    :class="{'current': meta.current_page == page}"
                    @click="getData(currentMenuItem, page)") {{page}}

            .pagination-middle-block(v-if="meta.last_page >= 6 && meta.current_page <= 2" :style="{'grid-template-columns': 'repeat(5, 35px)'}")
                .pagination-item(
                    v-for="page in 3"
                    :key="page"
                    :class="{'current': meta.current_page == page}"
                    @click="getData(currentMenuItem, page)"
                ) {{page}}
                .pagination-item.ellipsis ...
                .pagination-item(
                    @click="getData(currentMenuItem, meta.last_page)"
                    :class="{'current': meta.current_page == meta.last_page}"
                ) {{meta.last_page}}

            .pagination-middle-block(
                v-if="meta.last_page >= 6 && meta.current_page >= meta.last_page - 1"
                :style="{'grid-template-columns': 'repeat(5, 35px)'}"
            )
                .pagination-item(
                    @click="getData(currentMenuItem, 1)"
                    :class="{'current': meta.current_page == 1}"
                ) 1
                .pagination-item.ellipsis ...
                .pagination-item(
                    v-for="page in 3"
                    :key="page"
                    :class="{'current': meta.current_page ==  meta.last_page - 3 + page}"
                    @click="getData(currentMenuItem, meta.last_page - 3 + page)"
                ) {{meta.last_page - 3 + page}}

            .pagination-middle-block(v-if="meta.last_page >= 6 && meta.current_page == 3" :style="{'grid-template-columns': 'repeat(6, 35px)'}")
                .pagination-item(
                    v-for="page in 4"
                    :key="page"
                    :class="{'current': meta.current_page == page}"
                    @click="getData(currentMenuItem, page)"
                ) {{page}}
                .pagination-item.ellipsis ...
                .pagination-item(
                     @click="getData(currentMenuItem, meta.last_page)"
                    :class="{'current': meta.current_page == meta.last_page}"
                ) {{meta.last_page}}

            .pagination-middle-block(v-if="meta.last_page >= 6 && meta.current_page == meta.last_page - 2" :style="{'grid-template-columns': 'repeat(6, 35px)'}")
                .pagination-item(@click="getData(currentMenuItem, 1)" :class="{'current': meta.current_page == 1}") 1
                .pagination-item.ellipsis ...
                .pagination-item(
                    v-for="page in 4"
                    :key="meta.last_page - 4 + page"
                    :class="{'current': meta.current_page == meta.last_page - 4 + page}"
                    @click="getData(currentMenuItem, meta.last_page - 4 + page)"
                ) {{meta.last_page - 4 + page}}

            .pagination-middle-block(
                v-if="meta.last_page > 6 && meta.current_page > 3 && meta.current_page < meta.last_page - 2"
                :style="{'grid-template-columns': 'repeat(7, 35px)'}"
            )
                .pagination-item( @click="getData(currentMenuItem, 1)" :class="{'current': meta.current_page == 1}") 1
                .pagination-item.ellipsis ...
                .pagination-item(
                    v-for="page in [meta.current_page - 1, meta.current_page, meta.current_page + 1]"
                    :key="page"
                    :class="{'current': meta.current_page == page}"
                    @click="getData(currentMenuItem, page)"
                ) {{page}}
                .pagination-item.ellipsis ...
                .pagination-item(
                    @click="getData(currentMenuItem, meta.last_page)"
                    :class="{'current': meta.current_page == meta.last_page}"
                ) {{meta.last_page}}

            .pagination-item(@click="getData(currentMenuItem, meta.current_page + 1)")
                i.fal.fa-angle-right
</template>

<script>
    import DatePicker from 'vue2-datepicker'
    import moment from "moment"

    export default {
        components: {
            DatePicker,
        },
        data: function(){
            return {
                today: 0,
                yesterday: 1,
                week: 2,
                month: 3,
                threeMonth: 4,
                custom: 5,

                menu: [true, false, false, false, false],
                currentMenuItem: 0,
                customPeriod: "",
                isLoaderDisplayed: false,

                orders: [],
                meta: {},
                links: [],
            }
        },
        methods: {
            toggleActiveBtn: function(active){
                this.currentMenuItem = active;
                this.menu = this.menu.map((item, index) => index === active);
            },
            getData: function(val, page){
                if(page > this.meta.last_page || page < 1) return;

                this.toggleActiveBtn(val);
                let date = this.getDate(val);
                console.log(date);

                this.isLoaderDisplayed = true;
                this.orders = [];

                window.axios
                    .get("/data/orders/get-orders", {params: {
                            s: date.s,
                            e: date.e,
                            page: page
                        }})
                    .then(response => {
                        this.orders = response.data.data;
                        this.meta = response.data.meta;
                        this.links = response.data.links;
                        this.isLoaderDisplayed = false;
                    })
                    .catch(error => {
                        console.log(error);
                        this.isLoaderDisplayed = false;
                    })
            },
            getDate: function(val){
                switch(val){
                    case this.today:
                        return {
                            s: moment().format("DD.MM.YYYY"),
                            e: moment().format("DD.MM.YYYY")
                        };
                    case this.yesterday:
                        return {
                            s: moment(new Date()).subtract(1, "days").format("DD.MM.YYYY"),
                            e: moment(new Date()).subtract(1, "days").format("DD.MM.YYYY")
                        };
                    case this.week:
                        return {
                            s: moment(new Date()).subtract(7, "days").format("DD.MM.YYYY"),
                            e: moment(new Date()).format("DD.MM.YYYY")
                        };
                    case this.month:
                        return {
                            s: moment(new Date()).subtract(1, "month").format("DD.MM.YYYY"),
                            e: moment(new Date()).format("DD.MM.YYYY")
                        };
                    case this.threeMonth:
                        return {
                            s: moment(new Date()).subtract(3, "month").format("DD.MM.YYYY"),
                            e: moment(new Date()).format("DD.MM.YYYY")
                        };
                    case this.custom:
                        return {
                            s: moment(this.customPeriod[0]).format("DD.MM.YYYY"),
                            e: moment(this.customPeriod[1]).format("DD.MM.YYYY")
                        };
                }
            },
            onCustomPeriodChange: function(){
                this.getData(this.custom, 1)
            }
        },
        computed: {
            store: {
                get(){
                    return this.$store.state.ordersPage;
                }
            }
        },
        created: function(){
            if(this.store.state != null)
                Object.assign(this.$data, this.store.state);
            else
                this.getData(this.today, 1);
        },
        beforeRouteLeave  (to, from, next) {
            this.$store.commit("ordersPage/setState", this.$data);
            next();
        },
    }
</script>

<style scoped lang="stylus">
    #orders-content
        width 100%
        margin: 0 auto
        padding-top: 20px
        @media(min-width: 961px)
            width 940px
        @media(max-width: 960px)
            padding 20px 10px 0 10px

    #filter-block
        margin-top: 10px
        display: grid
        grid-template-columns: repeat(6, max-content)

        @media(max-width: 646px)
            grid-template-columns 1fr
            grid-gap 5px

    .fb-btn
        border: none
        padding: 10px 14px
        background: #f2f3f3
        outline: none
        cursor: pointer
        font-size: 14px
        &:hover
            background: #dfe1e1
        &.active
            background: #3497dc
            color: white

    #orders-content
        >>> .mx-input
            border-radius: 0 !important
            height: 36px !important
            border: solid 1px #a9a9a9
            @media(min-width: 640px)
                margin-left: 5px

        >>> .mx-datepicker
            width: 100% !important

        >>> .mx-calendar .today
            background: #3497dc !important
            color: white !important

        >>> td.actived
            background: #115d8e !important

        >>> input:focus
            border: solid 1px #3497dc

    #table
        margin-top: 20px
        margin-bottom: 5px
        height: 527px
        overflow-x auto
        overflow-y hidden

        &.table-bottom-border
            border-bottom: solid 1px #f2f3f3

    .tr-header
        border-bottom: solid 1px #f2f3f3
        font-size: 13px
        font-weight: 400
    .th
        text-align left
    .tr
        display: grid
        grid-template-columns: 150px minmax(150px, 1fr) 200px 90px
        padding: 5px 0
    .td
        font-size: 13px

    #loader-block
        display: grid
        justify-content: center
        padding: 20px
    #loader
        width: 50px

    .pagination
        display: grid
        grid-template-columns: 35px max-content 35px
        grid-template-rows: 35px
        justify-content: center
    .pagination-middle-block
        display: grid
    .pagination-item
        align-content: center
        display: grid
        font-size: 12px
        cursor: pointer
        text-align: center
    .pagination-item.current
        border: solid 1px #3497dc
        border-radius: 50%
        cursor: default
    .pagination-item.ellipsis
        cursor: default
</style>