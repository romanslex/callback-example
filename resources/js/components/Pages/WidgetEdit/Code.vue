<template lang="pug">
    div(style="padding-top: 20px")
        h3 Осталось только вставить код на сайт {{url | truncate(60)}}
        h3.h-3 Перед закрывающим тегом <code>&lt;/body&gt;</code> вставьте следующий код:

        #code-container
            | &lt;!--START LeadMeBack widget code --&gt;
            br
            | &lt;script src="https://callback-example.mail/js/widget.js?wlmb_code={{widgetId}}" charset="UTF-8" async&gt;&lt;/script&gt;
            br
            | &lt;!--END LeadMeBack widget code --&gt;
        #code-btn-b
            button.code-btn(@click="copy")
                i.fal.fa-copy(style="margin-right:5px")
                | Копировать код
        h3 Или отправьте инструкцию своему программисту
        .send-code
            input(v-model="email" type="text" placeholder="Введите email программиста")
            button.btn(@click="sendToProgrammer") Отправить
        .error(v-for="error in errors" :key="error") {{error}}
</template>

<script>
    export default {
        data: function(){
            return {
                email: "",
                errors: []
            }
        },
        methods: {
            copy: function(){
                this.$copyText(document.getElementById("code-container").innerText);
                this.$notifySuccess("Код скопирован");
            },
            sendToProgrammer: function(){
                this.errors = [];
                window.axios
                    .post("/data/widgets/send-manual/" + this.id, {email: this.email})
                    .then(response => {
                        this.$notifySuccess("Инструкция отправленна");
                        this.email = "";
                    })
                    .catch(error => {
                        this.$notifyDanger();
                        this.errors = error.response.data.errors.email;
                    })
            }
        },
        computed: {
            widgetId(){
                return this.$route.params.id;
            },
            widgetData(){
                return this.$store.getters['widgetEditPage/widgetData'](this.widgetId)
            },
            url(){
                return this.widgetData.url
            },
        }
    }
</script>

<style scoped lang="stylus">
    .h-3
        margin-top: 20px
    code
        padding: 2px 4px
        font-size: 90%
        color: #c7254e
        background-color: #f9f2f4
        border-radius: 2px
    #code-container
        font-family: monospace
        display: block
        padding: 11.5px
        margin-top: 10px
        font-size: 12px
        line-height: 1.846153846
        word-break: break-all
        word-wrap: break-word
        color: #313534
        background-color: #f5f5f5
        border: 1px solid #cccccc
        border-radius: 2px
    #code-btn-b
        margin-top: 10px
        display: grid
        justify-content: end

    .code-btn, .btn
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
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33)
        &:hover
            box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.38)
        &:active
            background: darken(#3497dc, 15%)

    .send-code
        display: grid
        grid-template-columns: max-content max-content
        grid-gap: 5px
        margin-top: 10px
        input
            height: 30px
            padding-left: 5px
            padding-right: 5px
            outline: none
            font-size: 14px
            width: 306px

    .error
        font-size: 12px
        margin-top: 5px
        color: red
        font-weight: 400
</style>
