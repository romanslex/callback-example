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
                img#loader(src="../../assets/loader.gif")
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
                this.isLoaderDisplayed = false;
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
        created: function(){
            this.getData(this.today, 1);
        }
    }
</script>

<style scoped lang="stylus">
    #orders-content
        width: 940px
        margin: 0 auto
        padding-top: 20px

    #filter-block
        margin-top: 10px
        display: grid
        grid-template-columns: repeat(6, max-content)

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

        &.table-bottom-border
            border-bottom: solid 1px #f2f3f3

    .tr-header
        border-bottom: solid 1px #f2f3f3
        font-size: 13px
        font-weight: 400
    .th
        text-align: center
    .tr
        display: grid
        grid-template-columns: 150px 1fr 200px 90px
        padding: 5px 0
    .td
        font-size: 13px

    #loader-block
        display: grid
        justify-content: center
        padding: 20px
    #loader
        width: 50px
</style>