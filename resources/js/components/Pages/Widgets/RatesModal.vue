<template lang="pug">
    div
        button.prolong-btn.btn(@click="show")
            i.fas.fa-credit-card.widget-prolong
            | Продлить
        #rm-overlay(v-show="isModalVisible" @click="close")
        #rates-modal(v-show="isModalVisible")
            .rm-header
                span Тарифы
                button.close(@click="close") ×
            .rm-body
                .card.one
                    .c-body
                        h1 1 месяц
                        h2 300
                            span.fs-13(style="margin-left:3px") руб.
                        h3.fs-13 без скидки
                        .fs-13.c-body-text За абонентскую плату доступен весь расширенный функционал сервиса.
                            ul
                                li Мобильная версия
                                li Ночной охотник
                                li Фирменное оформление
                                li Интеграция с системами аналитики
                    .c-footer
                        a.choose-btn.one-btn Выбрать

                .card.two
                    .c-body
                        h1 3 месяца
                        h2 855
                            span.fs-13(style="margin-left:3px") руб.
                        h3.fs-13 без скидки
                        .fs-13.c-body-text За абонентскую плату доступен весь расширенный функционал сервиса.
                            ul
                                li Мобильная версия
                                li Ночной охотник
                                li Фирменное оформление
                                li Интеграция с системами аналитики
                    .c-footer
                        a.choose-btn.one-btn Выбрать

                .card.three
                    .c-body
                        h1 6 месяцев
                        h2 1620
                            span.fs-13(style="margin-left:3px") руб.
                        h3.fs-13 без скидки
                        .fs-13.c-body-text За абонентскую плату доступен весь расширенный функционал сервиса.
                            ul
                                li Мобильная версия
                                li Ночной охотник
                                li Фирменное оформление
                                li Интеграция с системами аналитики
                    .c-footer
                        a.choose-btn.one-btn Выбрать

                .card.four
                    .c-body
                        h1 12 месяцев
                        h2 2400
                            span.fs-13(style="margin-left:3px") руб.
                        h3.fs-13 без скидки
                        .fs-13.c-body-text За абонентскую плату доступен весь расширенный функционал сервиса.
                            ul
                                li Мобильная версия
                                li Ночной охотник
                                li Фирменное оформление
                                li Интеграция с системами аналитики
                    .c-footer
                        a.choose-btn.one-btn Выбрать

                .card.five
                    .c-body
                        h1 24 месяца
                        h2 4160
                            span.fs-13(style="margin-left:3px") руб.
                        h3.fs-13 без скидки
                        .fs-13.c-body-text За абонентскую плату доступен весь расширенный функционал сервиса.
                            ul
                                li Мобильная версия
                                li Ночной охотник
                                li Фирменное оформление
                                li Интеграция с системами аналитики
                    .c-footer
                        a.choose-btn.one-btn Выбрать

</template>

<script>
    export default {
        props: ["wid"],
        data: function(){
            return {
                isModalVisible: false
            }
        },
        methods: {
            show: function(){
                console.log(this.wid);
                this.isModalVisible = true;
            },
            close: function(){
                this.isModalVisible = false;
            },
            redirect: function(){
                window.location.href = "/";
            }
        }
    }
</script>

<style lang="stylus">
    .prolong-btn
        border: none
        color: white
        padding: 5px 10px
        background: #b31e69
        cursor: pointer
        font-size: 11px
        grid-area: buy
        &:hover
            background: #740A40
            box-shadow: non
    .widget-prolong
        font-size: 11px

    #rm-overlay
        position: fixed
        width: 100%
        height: 100%
        z-index: 1
        background: black
        opacity: 0.5
        top: 0
        left: 0
    #rates-modal
        position: fixed
        z-index: 2
        top: 40px
        left: 50%
        transform: translate(-50%, 0)
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5)
        background: white

    .rm-header
        display: grid
        align-content: center
        grid-template-columns: 1fr 20px
        padding: 15px
        font-size: 14px
        border-bottom: 1px solid #e5e5e5
        font-weight: 500
    button.close
        font-size: 19.5px
        font-weight: bold
        line-height: 1
        color: #000000
        text-shadow: 0 1px 0 #ffffff
        opacity: 0.2
        border: none
        background: transparent
        cursor: pointer
        outline: none
        &:hover
            opacity: 0.5

    .rm-body
        padding: 10px
        display: grid
        grid-template-columns: repeat(5, 200px)
        grid-gap: 10px

    .card
        width: 200px
        border-radius: 2px
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33)
        text-align: center
        color: white

    .c-body
        padding: 40px 20px 20px 20px
        h1
            font-size: 24px
            font-weight: 300
            text-transform: uppercase
        h2
            margin-top: 10px
            font-size: 35px
        ul
            margin-top: 10px
            text-align: left
            padding-left: 15px

    .c-body-text
        margin-top: 20px
        font-style: italic
        opacity: 0.5

    .c-footer
        background: white
        padding: 18px
    .choose-btn
        text-transform: uppercase
        width: 100%
        display: block
        padding: 8px 15px
        font-size: 14px
        font-weight: 400
        cursor: pointer
        transition: box-shadow 0.15s ease-out

    .one
        background: #ff9800
    .two
        background: #622b6b
    .three
        background: #5089e0
    .four
        background: #ab353f
    .five
        background: #19671f

    .one-btn
        background: #ff9800
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33)
        &:hover
            background: #db8300
            box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.38)

    .fs-13
        font-size: 13px
</style>