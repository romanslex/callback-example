<template lang="pug">
    #feedback-content
        h3 Напишите нам письмо
        h4 Тема письма
        div
            select(name="title" v-model="title")
                option(value="Вопрос по настройке виджета") Вопрос по настройке виджета
                option(value="Сообщить о баге") Сообщить о баге
                option(value="Оставить пожелание") Оставить пожелание
                option(value="Другое") Другое
        h4 Ваш вопрос
            span(style="font-size: 11px")  (не более 1000 символов)
        div: textarea(maxlength="1000" name="msg" id="msg" v-model="msg")
        button.btn(@click="send") Отправить
</template>

<script>
    export default {
        data: function(){
            return {
                title: "Вопрос по настройке виджета",
                msg: "",
                disable: false,
            }
        },
        methods: {
            send: function(){
                if(this.disable) return;
                this.disable = true;

                window.axios
                    .post("/data/feedback/send-comment", {title: this.title, msg: this.msg})
                    .then(response => {
                        this.$notifySuccess("Ваше сообщение отправлено");
                        this.disable = false;
                    })
                    .catch(error => {
                        this.$notifyDanger();
                        this.disable = false;
                    })
            }
        }
    }
</script>

<style scoped lang="stylus">
    #feedback-content
        width 100%
        padding-top: 20px
        margin: 0 auto
        @media(min-width: 961px)
            width 940px
        @media(max-width: 960px)
            padding 20px 10px 0 10px
    h4
        margin-top: 10px
        font-size: 15px
        font-weight: 400
        margin-bottom: 5px

    select
        font-size: 14px
        padding: 5px

    .btn
        margin-top: 10px
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

    #msg
        font-size: 14px
        font-family: Roboto
        padding:5px
        width: 100%
        height: 150px
        resize: none

    textarea
        outline: none
</style>