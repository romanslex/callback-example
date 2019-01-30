<template lang="pug">
    div(style="padding-top:20px")
        div(style="display: grid; grid-template-columns: repeat(2, max-content); grid-gap: 5px;")
            h3 Интеграция с Яндекс.Метрикой
            helper(:width="700")
                h1 Интеграция с Яндекс.Метрикой
                p Для настройки Цели в Яндекс.Метрике Вам нужно выполнить следующие действия:
                p 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                div
                    .helper-li 2. Aenean faucibus dictum ipsum, sed pharetra magna consequat eu. In eget pharetra lectus
                    img.helper-img(src="./img/1.jpg")
                div
                    .helper-li 3. Etiam rutrum, enim et mollis malesuada, nisl turpis congue sem, non vulputate nulla felis ac justo
                    img.helper-img(src="./img/2.jpg")
                div
                    .helper-li 4. Nulla cursus dui ac nulla accumsan volutpat ut et mi.
                    img.helper-img(src="./img/3.jpg")
                div
                    .helper-li
                        | 5. Vestibulum congue cursus dui, quis mattis dui. Etiam posuere ornare pretium.
                        |  Duis vel vestibulum mauris, quis aliquet arcu. Vivamus gravida diam id dui laoreet finibus.
                        |  Sed a risus sed ipsum porta porta. Vestibulum rhoncus hendrerit ante, vitae accumsan velit
                        |  dapibus at. Etiam faucibus magna a eleifend pharetra.
                    img.helper-img(src="./img/4.jpg")
        h4 Наш сервис автоматически отправляет в Яндекс.Метрику цели со следующими именами:
        ul.list
            li <code>CBS_ORDER_BEEN_SENT</code> - когда посетитель отправил заявку
            li <code>CBS_SHOW_ON_BTN</code> - когда посетитель нажал на кнопку виджета
            li <code>CBS_SHOW_AUTO</code> - когда окно виджета показано автоматически
            li <code>CBS_SHOW_ON_EXIT</code> - когда окно виджета показано при выходе посетителя с сайта

        div(style="margin-top: 20px; display: grid; grid-template-columns: repeat(2, max-content); grid-gap: 5px;")
            h3 Интеграция с Google Analytics
            helper(:width="700")
                h1 Интеграция с Goole Analytics
                p Для настройки Цели в Google Analytics Вам нужно выполнить следующие действия:
                    p 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                div
                    .helper-li 2. Aenean faucibus dictum ipsum, sed pharetra magna consequat eu. In eget pharetra lectus
                    img.helper-img(src="./img/1.jpg")
                div
                    .helper-li 3. Etiam rutrum, enim et mollis malesuada, nisl turpis congue sem, non vulputate nulla felis ac justo
                    img.helper-img(src="./img/2.jpg")
                div
                    .helper-li 4. Nulla cursus dui ac nulla accumsan volutpat ut et mi.
                    img.helper-img(src="./img/3.jpg")
                div
                    .helper-li
                        | 5. Vestibulum congue cursus dui, quis mattis dui. Etiam posuere ornare pretium.
                        |  Duis vel vestibulum mauris, quis aliquet arcu. Vivamus gravida diam id dui laoreet finibus.
                        |  Sed a risus sed ipsum porta porta. Vestibulum rhoncus hendrerit ante, vitae accumsan velit
                        |  dapibus at. Etiam faucibus magna a eleifend pharetra.
                    img.helper-img(src="./img/4.jpg")
        h4 Наш сервис автоматически отправляет в Google Analytics цель с категорией <code>CallBackService</code>. Передаются следующие действия:
        ul.list
            li <code>OrderBeenSent</code> - когда посетитель отправил заявку
            li <code>ShowOnBtn</code> - когда посетитель нажал на кнопку виджета
            li <code>ShowAuto</code> - когда окно виджета показано автоматически
            li <code>ShowOnExit</code> - когда окно виджета показано при выходе посетителя с сайта
</template>

<script>
    import Helper from "../../Shared/Helper.vue";

    export default{
        components: {
            Helper,
        }

    }
</script>

<style scoped lang="stylus">
    h3
        margin-bottom: 10px
    h4
        font-size: 14px
        margin-bottom: 10px
        font-weight: 300
    .list
        font-size: 14px
        list-style-type: none
        li
            margin-bottom: 10px
    code
        padding: 2px 4px
        font-size: 90%
        color: #c7254e
        background-color: #f9f2f4
        border-radius: 2px
    .helper-img
        width: 600px
        margin: 5px 10px 15px 0
        -webkit-box-shadow: -1px 4px 7px -3px rgba(0,0,0,0.75)
        -moz-box-shadow: -1px 4px 7px -3px rgba(0,0,0,0.75)
        box-shadow: -1px 4px 7px -3px rgba(0,0,0,0.75)
</style>
