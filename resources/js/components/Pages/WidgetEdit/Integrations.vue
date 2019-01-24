<template lang="pug">
    div(style="padding-top:20px")
        div(style="display: grid; grid-template-columns: repeat(2, max-content); grid-gap: 5px;")
            h3 Интеграция с Яндекс.Метрикой
            helper(:width="700")
                h1 Интеграция с Яндекс.Метрикой
                p Для настройки Цели в Яндекс.Метрике Вам нужно выполнить следующие действия:
                p 1. Зайти по адресу http://metrika.yandex.ru
                div
                    .helper-li 2. В списке счетчиков находите счетчик Вашего сайта и нажимаете на шестеренку справа
                    img.helper-img(src="./img/ya-metrika/1.jpg")
                div
                    .helper-li 3. В меню слева нажмите Цели
                    img.helper-img(src="./img/ya-metrika/2.jpg")
                div
                    .helper-li 4. Нажмите кнопку Добавить цель
                    img.helper-img(src="./img/ya-metrika/3.jpg")
                div
                    .helper-li
                        | 5. Введите название «Звонок из CallbackKILLER» или «Нажатие на кнопку CallbackKILLER»,
                        | выберите Условие «Событие» и пропишите Идентификатор цели «CBK_CALL» для отслеживания
                        | заказа звонка или «CBK_SHOW_ON_BTN» для отслеживания нажатия на кнопку
                    img.helper-img(src="./img/ya-metrika/4.jpg")
        h4 Наш сервис автоматически отправляет в Яндекс.Метрику цели со следующими именами:
        ul.list
            li <code>LMB_ORDER_BEEN_SENT</code> - когда посетитель отправил заявку
            li <code>LMB_SHOW_ON_BTN</code> - когда посетитель нажал на кнопку виджета
            li <code>LMB_SHOW_AUTO</code> - когда окно виджета показано автоматически
            li <code>LMB_SHOW_ON_EXIT</code> - когда окно виджета показано при выходе посетителя с сайта

        div(style="margin-top: 20px; display: grid; grid-template-columns: repeat(2, max-content); grid-gap: 5px;")
            h3 Интеграция с Google Analytics
            helper(:width="700")
                h1 Интеграция с Goole Analytics
                p Для настройки Цели в Google Analytics Вам нужно выполнить следующие действия:
                div
                    .helper-li 1. Зайти по адресу https://www.google.com/analytics/
                    img.helper-img(src="./img/ga/1.png")
                div
                    .helper-li 2. Выберите Аккаунт, на который Вы хотите настроить интеграцию и зайдите в Цели
                    img.helper-img(src="./img/ga/2.png")
                div
                    .helper-li 3. Нажмите на кнопку Цель
                    img.helper-img(src="./img/ga/3.png")
                div
                    .helper-li 4. У Вас откроется Описание цели, нужно дать Название цели-Обратный звонок, выбрать Тип цели Событие и нажать на кнопку Далее
                    img.helper-img(src="./img/ga/4.png")
                div
                    .helper-li 5.Теперь нужно настроить Подробные сведения о цели, пропишите значение Категории — CallbackKILLER и Действия-NewCall и нажмите на кнопку Сохранить
                    img.helper-img(src="./img/ga/5.png")
                    img.helper-img(src="./img/ga/6.png")
                    p После этого интеграция с Google Analytics у Вас будет настроена
                    img.helper-img(src="./img/ga/7.png")
                    p Далее по этим же шагам, настройте остальные цели
                    p
                        | Так же обращаем Ваше внимание, на то, что данные могут приходить с небольшой задержкой в
                        |  google analytics и при проверке мы всегда рекомендуем в разделе конверсии проверять дату за
                        |  которую отображаются конверсии, по умолчанию указывается период от предыдущей даты за неделю
        h4 Наш сервис автоматически отправляет в Google Analytics цель с категорией <code>LeadMeBack</code>. Передаются следующие действия:
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
