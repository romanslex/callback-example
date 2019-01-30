<template lang="pug">
    div
        h3.h3 Оповещения
        #nb
            #nb-eb
                div(style="margin:10px 0")
                    rml-checkbox(text="Использовать email" v-model="useEmailNotify")
                email-block
            #nb-pb
                div(style="margin:10px 0; display: grid; grid-template-columns: repeat(2, max-content); grid-gap: 5px;")
                    rml-checkbox(text="Использовать СМС" v-model="useSmsNotify")
                    helper(:width="400")
                        h1 Оповещения по СМС
                        p Обратите внимание, если у вас нет средств на балансе, смс присылаться
                            b  не будут
                        br
                        p 1 смс стоит 5 единиц баланса
                        p Стоимость смс может менятся в дальнейшем
                sms-block
        h3.h3 Выберите ваш часовой пояс
        #timezones-block
            select(v-model="currentTimezone")
                option(v-for="timezone in timezones" :value="timezone.value" :key="timezone.value") {{timezone.text}}
        div(style="display:grid; grid-template-columns: repeat(2, max-content); grid-gap: 5px; margin-top: 20px; margin-bottom: 5px;")
            h3 График работы
            helper(:width="400")
                h1 График работы
                p Укажите дни и часы, во время которых посетитель будет видеть основной виджет.
                p
                    b Основной виджет
                    |  - этот виджет дает понять клиенту, что ваша организация в данный момент
                    |  работает и он может ожидать звонка прямо сейчас.
                h2 Нерабочее время
                p Вы можете отдельно настроить виджет на показ в нерабочее время, с предупреждением об этом клиента.
                p Для этого перейдите на вкладку "Настройки показа" и поставьте галочку напротив "Показывать виджет в нерабочее время"
                div(style="margin-bottom:10px"): img(src="./img/schedule-help/1.jpg" style="width: 341px")
                p В настройках окна вы можете настроить соответсвующий текст
                div: img(src="./img/schedule-help/2.jpg" style="width: 341px")
        h4.h4 Утвердите график работы вашего отдела продаж
        #sb
            div(style="margin: 16px 0")
                rml-checkbox(text="Будние дни по одному графику" v-model="isWeekdaysSameSchedule")
            .sb-row(v-show="isWeekdaysSameSchedule")
                .sb-row-day
                    rml-checkbox(text="Будни" v-model="weekdaysWorkdays")
                .sb-row-from с
                    select(:disabled="!weekdaysWorkdays" v-model="weekdaysStart" style="margin-left: 5px")
                        option(v-for="time in times" :key="time") {{time}}
                .sb-row-to до
                    select(:disabled="!weekdaysWorkdays" v-model="weekdaysEnd" style="margin-left: 5px;")
                        option(v-for="time in times" :key="time") {{time}}
            #sb-wds(v-show="!isWeekdaysSameSchedule")
                .sb-row
                    .sb-row-day
                        rml-checkbox(text="Понедельник" v-model="workdays[0]")
                    .sb-row-from с
                        select(:disabled="!workdays[0]" v-model="timeStart[0]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                    .sb-row-to до
                        select(:disabled="!workdays[0]" v-model="timeEnd[0]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                .sb-row
                    .sb-row-day
                        rml-checkbox(text="Вторник" v-model="workdays[1]")
                    .sb-row-from с
                        select(:disabled="!workdays[1]" v-model="timeStart[1]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                    .sb-row-to до
                        select(:disabled="!workdays[1]" v-model="timeEnd[1]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                .sb-row
                    .sb-row-day
                        rml-checkbox(text="Среда" v-model="workdays[2]")
                    .sb-row-from с
                        select(:disabled="!workdays[2]" v-model="timeStart[2]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                    .sb-row-to до
                        select(:disabled="!workdays[2]" v-model="timeEnd[2]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                .sb-row
                    .sb-row-day
                        rml-checkbox(text="Четверг" v-model="workdays[3]")
                    .sb-row-from с
                        select(:disabled="!workdays[3]" v-model="timeStart[3]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                    .sb-row-to до
                        select(:disabled="!workdays[3]" v-model="timeEnd[3]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                .sb-row
                    .sb-row-day
                        rml-checkbox(text="Пятница" v-model="workdays[4]")
                    .sb-row-from с
                        select(:disabled="!workdays[4]" v-model="timeStart[4]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                    .sb-row-to до
                        select(:disabled="!workdays[4]" v-model="timeEnd[4]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                .sb-row
                    .sb-row-day
                        rml-checkbox(text="Суббота" v-model="workdays[5]")
                    .sb-row-from с
                        select(:disabled="!workdays[5]" v-model="timeStart[5]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                    .sb-row-to до
                        select(:disabled="!workdays[5]" v-model="timeEnd[5]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                .sb-row
                    .sb-row-day
                        rml-checkbox(text="Воскресение" v-model="workdays[6]")
                    .sb-row-from с
                        select(:disabled="!workdays[6]" v-model="timeStart[6]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
                    .sb-row-to до
                        select(:disabled="!workdays[6]" v-model="timeEnd[6]" style="margin-left: 5px")
                            option(v-for="time in times" :key="time") {{time}}
</template>
<script>
    import RmlCheckbox from "../../Shared/RmlCheckbox.vue";
    import Helper from "../../Shared/Helper.vue";
    import EmailBlock from "./EmailBlock.vue";
    import SmsBlock from "./SmsBlock.vue";

    export default {
        components: {
            RmlCheckbox,
            EmailBlock,
            SmsBlock,
            Helper,
        },
        data: function(){
            return {
                timezones: [
                    {value: "Europe/Kaliningrad", text: "UTC+2 Калининград"},
                    {value: "Europe/Moscow", text: "UTC+3 Москва"},
                    {value: "Europe/Samara", text: "UTC+4 Самара"},
                    {value: "Asia/Yekaterinburg", text: "UTC+5 Екатеринбург"},
                    {value: "Asia/Omsk", text: "UTC+6 Омск"},
                    {value: "Asia/Krasnoyarsk", text: "UTC+7 Красноярск"},
                    {value: "Asia/Irkutsk", text: "UTC+8 Иркутск"},
                    {value: "Asia/Yakutsk", text: "UTC+9 Якутск"},
                    {value: "Asia/Vladivostok", text: "UTC+10 Владивосток"},
                    {value: "Asia/Magadan", text: "UTC+11 Магадан"},
                    {value: "Asia/Kamchatka", text: "UTC+12 Камчатка"},
                ],
                times: [
                    "00:00",
                    "00:30",
                    "01:00",
                    "01:30",
                    "02:00",
                    "02:30",
                    "03:00",
                    "03:30",
                    "04:00",
                    "04:30",
                    "05:00",
                    "05:30",
                    "06:00",
                    "06:30",
                    "07:00",
                    "07:30",
                    "08:00",
                    "08:30",
                    "09:00",
                    "09:30",
                    "10:00",
                    "10:30",
                    "11:00",
                    "11:30",
                    "12:00",
                    "12:30",
                    "13:00",
                    "13:30",
                    "14:00",
                    "14:30",
                    "15:00",
                    "15:30",
                    "16:00",
                    "16:30",
                    "17:00",
                    "17:30",
                    "18:00",
                    "18:30",
                    "19:00",
                    "19:30",
                    "20:00",
                    "20:30",
                    "21:00",
                    "21:30",
                    "22:00",
                    "22:30",
                    "23:00",
                    "23:30",
                ],
            };
        },
        methods: {
            onWorkdaysChange: function(e){
                console.log("workdays checkbox changed own value", e);
            },
        },
        computed: {
            widgetId(){
                return this.$route.params.id
            },
            widgetData(){
                return this.$store.getters['widgetEditPage/widgetData'](this.widgetId)
            },
            useEmailNotify: {
                get: function(){
                    return this.widgetData.is_email_notify_enabled;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/toggleEmailNotify", {widgetId: this.widgetId, value: newValue})
                }
            },
            useSmsNotify: {
                get: function(){
                    return this.widgetData.is_sms_notify_enabled;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/toggleSmsNotify", {widgetId: this.widgetId, value: newValue})
                }
            },
            currentTimezone: {
                get: function(){
                    return this.widgetData.timezone;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/setTimezone", {widgetId: this.widgetId, value: newValue});
                }
            },

            isWeekdaysSameSchedule: {
                get: function(){
                    return this.widgetData.schedule.is_weekdays_same_schedule;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/setWeekdaysSameSchedule", {widgetId: this.widgetId, value: newValue});
                }
            },
            workdays(){
                return this.widgetData.schedule.workdays;
            },
            timeStart(){
                return this.widgetData.schedule.time_start;
            },
            timeEnd(){
                return this.widgetData.schedule.time_end;
            },
            weekdaysWorkdays: {
                get: function(){
                    return this.widgetData.schedule.weekdays_workdays;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/setWeekdaysWorkdays", {widgetId: this.widgetId, value: newValue});
                }
            },
            weekdaysStart: {
                get: function(){
                    return this.widgetData.schedule.weekdays_start;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/setWeekdaysStart", {widgetId: this.widgetId, value: newValue});
                }
            },
            weekdaysEnd: {
                get: function(){
                    return this.widgetData.schedule.weekdays_end;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/setWeekdaysEnd", {widgetId: this.widgetId, value: newValue});
                }
            },
        }
    }
</script>

<style scoped lang="stylus">
    .h3
        margin-top: 20px
        margin-bottom: 5px
    .h4
        font-size: 11px
        font-weight: 300

    #timezones-block select
        width: 400px

    #schedule-block
        margin-top: 10px

    .sb-row
        display: grid
        grid-template-columns: 200px max-content max-content
        grid-gap: 5px
        margin-bottom: 10px

    .sb-row-day
        padding-top: 6px

    #nb
        display: grid
        grid-template-columns: 280px max-content
        grid-gap: 30px

    select
        font-size: 14px
        padding: 5px
        outline: none
</style>