<template lang="pug">
    #faq-content
        h3(style="margin-bottom:10px;") F.A.Q.
        .qa-block
            .q-block(@click="toggleAnswerVision('one')")
                p Как создать и установить виджет на сайт?
            .a-block(:class="{'closed': !openStatuses.one}" style="height:101px")
                ol(style="padding-left:20px")
                    li Перейдите на вкладку "Виджеты"
                    li Введите url адрес сайта и нажмите "Добавить сайт"
                    li Перейдите на вкладку "Код виджета" и скопируйте код
                    li Добавьте код на страницы сайта, на котором должен отображаться виджет
                    li Готово!

        .qa-block
            .q-block(@click="toggleAnswerVision('two')")
                p Зачем нужен баланс?
            .a-block(:class="{'closed': !openStatuses.two}" style="height:29px")
                p Средства на балансе можно тратить на продление тарифов и оплату смс уведомлений

        .qa-block
            .q-block(@click="toggleAnswerVision('three')")
                p Каким способом можно пополнить баланс?
            .a-block(:class="{'closed': !openStatuses.three}" style="height: 137px")
                p На данный момент вы можете использовать
                p - Банковскую карту
                p - Яндекс.Деньги
                p - Сбербанк Онлайн
                p - Альфа-Клик
                p - QIWI кошелек
                p - Webmoney

        .qa-block
            .q-block(@click="toggleAnswerVision('four')")
                p Надо ли обновлять код на сайте, если я изменю настройки виджета?
            .a-block(:class="{'closed': !openStatuses.four}" style="height: 29")
                p Нет, новые настройки будут применены автоматически

</template>

<script>
    export default {
        data: function(){
            return {
                openStatuses: {
                    one: false,
                    two: false,
                    three: false,
                    four: false,
                    five: false,
                    six: false,
                    seven: false,
                    eight: false,
                    nine: false,
                },
            };
        },
        methods: {
            toggleAnswerVision: function(i){
                this.openStatuses[i] = !this.openStatuses[i];
                console.log(this.openStatuses);
            }
        }
    }
</script>

<style scoped lang="stylus">
    #faq-content
        padding-top: 20px
        width: 940px
        margin: 0 auto

    .qa-block
        margin-bottom: 10px
    .q-block
        font-size: 18px
        font-weight: 400
        padding: 10px
        border: solid 1px #115d8e
        border-bottom: none
        color: #115d8e
        cursor: pointer
    .a-block
        overflow: hidden
        font-size: 15px
        padding: 0 10px
        padding-bottom: 10px
        border: solid 1px #115d8e
        border-top: none
        transition: all 0.3s
        &.closed
            height: 0 !important
            padding-bottom: 0
</style>