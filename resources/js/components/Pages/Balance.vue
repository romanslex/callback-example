<template lang="pug">
    #payments-content
        h3 Пополнить баланс
        h5(style="font-weight:300") Введите сумму, которую Вы хотите положить на баланс, затем нажмите кнопку "Пополнить". Вы перейдете в настройки оплаты.
        #payment-block(style="margin-top:10px")
            input(type="text")
            button.btn Пополнить

        h3(style="margin-top: 20px") Таблица платежей
        #filter-block
            button.fb-btn(:class="{'active': menu[0]}" @click="getData(0)") Сегодня
            button.fb-btn(:class="{'active': menu[1]}" @click="getData(1)") Вчера
            button.fb-btn(:class="{'active': menu[2]}" @click="getData(2)") Неделя
            button.fb-btn(:class="{'active': menu[3]}" @click="getData(3)") Месяц
            button.fb-btn(:class="{'active': menu[4]}" @click="getData(4)") 3 месяца
            date-picker(v-model="time" :shortcuts="false" range lang="ru" @change="onChange")

        #table
            .tr.tr-header
                .th Дата
                .th Информация
                .th Сайт
                .th Сумма, руб.
            .tr(v-for="payment in resultPayments" :key="payment.id")
                .td {{payment.date}}
                .td(v-if="payment.isReplenishment")
                    i.fas.fa-arrow-up(style="color: green;margin-right: 5px")
                    | {{payment.info}}
                .td(v-if="!payment.isReplenishment")
                    i.fas.fa-arrow-down(style="color: red;margin-right: 5px")
                    | {{payment.info}}
                .td {{payment.site}}
                .td.td-sum {{payment.sum}}
            div(v-if="resultPayments.length == 0 && !isLoaderDisplayed" style="font-size: 13px; padding-top: 5px;")
                | Пока нет ни одного платежа
            #loader-block(v-show="isLoaderDisplayed")
                img#loader(src="../../assets/loader.gif")

</template>

<script>
    import DatePicker from 'vue2-datepicker'
    import moment from "moment"

    export default {
        components:{
            DatePicker,
        },
        data: function(){
            return {
                isLoaderDisplayed: false,
                time: "",
                menu: [true, false, false, false, false],
                resultPayments: [],
                payments: []
            }
        },
        created: function(){
            this.resultPayments = this.transformPayments(this.payments);
            this.getData(0)
        },
        methods: {
            onChange: function(){
                this.getData(5);
            },
            toggleActiveBtn: function(active){
                this.menu = this.menu.map((item, index) => index === active);
            },
            getData: function(val){
                this.toggleActiveBtn(val);
                let date = this.getDate(val);
                this.isLoaderDisplayed = true;
                this.resultPayments = [];
                window.axios
                    .get("/data/payments", {params: date})
                    .then(response => {
                        this.resultPayments = this.transformPayments(response.data);
                        this.isLoaderDisplayed = false;
                    })
                    .catch(error => {
                        console.log(error);
                        this.isLoaderDisplayed = false;
                    });
                console.log(date);
            },
            getDate: function(val){
                switch(val){
                    case 0:
                        return {
                            s: moment().format("DD.MM.YYYY"),
                            e: moment().format("DD.MM.YYYY")
                        };
                    case 1:
                        return {
                            s: moment(new Date()).subtract(1, "days").format("DD.MM.YYYY"),
                            e: moment(new Date()).subtract(1, "days").format("DD.MM.YYYY")
                        };
                    case 2:
                        return {
                            s: moment(new Date()).subtract(7, "days").format("DD.MM.YYYY"),
                            e: moment(new Date()).format("DD.MM.YYYY")
                        };
                    case 3:
                        return {
                            s: moment(new Date()).subtract(1, "month").format("DD.MM.YYYY"),
                            e: moment(new Date()).format("DD.MM.YYYY")
                        };
                    case 4:
                        return {
                            s: moment(new Date()).subtract(3, "month").format("DD.MM.YYYY"),
                            e: moment(new Date()).format("DD.MM.YYYY")
                        };
                    case 5:
                        return {
                            s: moment(this.time[0]).format("DD.MM.YYYY"),
                            e: moment(this.time[1]).format("DD.MM.YYYY")
                        };
                }
            },
            transformPayments(payments){
                return payments.map(payment => ({
                    date: payment.performed_at,
                    info: payment.info,
                    sum: this.formatSum(payment.sum),
                    site: payment.site,
                    isReplenishment: payment.is_replenishment
                }))
            },
            formatSum: function(sum){
                var remainder = sum.length % 3;
                return (sum.substr(0, remainder) + sum.substr(remainder).replace(/(\d{3})/g, ' $1')).trim();
            }
        }
    }
</script>

<style scoped lang="stylus">
    #balance-content
        padding-top: 20px

    #payment-block
        display: grid
        grid-template-columns: max-content max-content
        grid-gap: 5px

    .btn
        font-size: 12px
        padding: 8px 15px
        width: max-content
        border: none
        color: white
        background: #3497dc
        cursor: pointer
        text-transform: uppercase
        outline: none
        transition: box-shadow 0.15s ease-out, background-color .1s ease-out
        &:hover
            box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.38)
        &:active
            background: darken(#3497dc, 15%)
    input
        height: 30px
        padding-left: 5px
        padding-right: 5px
        outline: none
        font-size: 16px
        border: solid 1px #a9a9a9

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

    #table
        margin-top: 20px

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

    .td-sum
        text-align: right

    #loader-block
        display: grid
        justify-content: center
        padding: 20px
    #loader
        width: 50px

    #payments-content
        width: 940px
        margin: 0 auto
        padding-top: 20px
        >>>.mx-input
            border-radius: 0 !important
            height: 36px !important
            border: solid 1px #a9a9a9
            margin-left: 5px
        >>>.mx-datepicker
            width: 100% !important
        >>>.mx-calendar-table .today
            background: #3497dc !important
            color: white !important
        >>>.mx-calendar-month>a.current,
        >>>.mx-calendar-table td.current,
        >>>.mx-calendar-year>a.current
            background: #115d8e !important
    input:focus
        border: solid 1px #3497dc
</style>
