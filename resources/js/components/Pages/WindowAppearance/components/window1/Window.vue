<template lang="pug">
    #lmb_window(:style="windowStyles")
        link(
            href="https://fonts.googleapis.com/css?family=Roboto:100,300,500,100italic,400,300italic&amp;subset=latin,cyrillic"
            rel="stylesheet" type="text/css"
        )
        #lmb_window-close
            img#lmb_window-close-img(src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoJIHdpZHRoPSI1MnB4IiBoZWlnaHQ9IjUycHgiIHZpZXdCb3g9IjAgMCA1MiA1MiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNTIgNTIiIHhtbDpzcGFjZT0icHJlc2VydmUiPgo8Zz4KCTxjaXJjbGUgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjRkZGRkZGIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1taXRlcmxpbWl0PSIxMCIgY3g9IjI2IiBjeT0iMjYiIHI9IjI1Ii8+Cgk8Zz4KCQk8bGluZSBmaWxsPSJub25lIiBzdHJva2U9IiNGRkZGRkYiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiB4MT0iMzMuNTcxIiB5MT0iMzQuMjc4IiB4Mj0iMTguNzIyIiB5Mj0iMTkuNDI5Ii8+CgkJPGxpbmUgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjRkZGRkZGIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1taXRlcmxpbWl0PSIxMCIgeDE9IjMzLjU3MSIgeTE9IjE4LjcyMiIgeDI9IjE4LjcyMiIgeTI9IjMzLjU3MSIvPgoJPC9nPgo8L2c+Cjwvc3ZnPgo=" title="Закрыть окно")
        .lmb_general(v-show="currentState === 'general'")
            .lmb_window-header {{generalHeader}}
            .lmb_window-text {{generalText}}
            .lmb_window-form
                masked-input(placeholder="+7(___)___-__-__" v-model="phone" mask="\\+\\7(111)111-11-11" )
                button.lmb_window-form-btn(:style="btnStyles") {{generalBtnText}}
                .lmb_window-eula
                    input.lmb_window-eula-check(checked="checked")
                    |  Согласен с <a>политикой конфиденциальности</a>
        .lmb_on-exit(v-show="currentState === 'on-exit'")
            .lmb_window-header {{onExitHeader}}
            .lmb_window-text {{onExitText}}
            .lmb_window-form
                masked-input(placeholder="+7(___)___-__-__" v-model="phone" mask="\\+\\7(111)111-11-11" )
                button.lmb_window-form-btn(:style="btnStyles") {{onExitBtnText}}
                .lmb_window-eula
                    input.lmb_window-eula-check(checked="checked")
                    |  Согласен с <a>политикой конфиденциальности</a>
        .lmb_after-sending(v-show="currentState === 'after-sending'")
            .lmb_window-header {{afterSendingHeader}}
        .lmb_not-working-hours(v-show="currentState === 'not-working-hours'")
            .lmb_window-header {{notWorkingHoursHeader}}
            .lmb_window-text {{notWorkingHoursText}}
            .lmb_window-form
                masked-input(placeholder="+7(___)___-__-__" v-model="phone" mask="\\+\\7(111)111-11-11" )
                button.lmb_window-form-btn(:style="btnStyles") {{notWorkingHoursBtnText}}
                .lmb_window-eula
                    input.lmb_window-eula-check(checked="checked")
                    |  Согласен с <a>политикой конфиденциальности</a>
</template>

<script>
    import MaskedInput from "vue-masked-input"

    export default {
        components: {
            MaskedInput,
        },
        data: function(){
            return {
                phone: ""
            }
        },
        computed: {
            widget(){
                return this.$store.state.w1.widget;
            },
            system(){
                return this.$store.state.w1.system;
            },
            currentState(){
                return this.system.currentState;
            },
            windowStyles(){
                return {
                    background: this.widget.bgColor,
                    color: this.widget.fontColor
                }
            },
            btnStyles(){
                return {
                    background: this.widget.btnBgColor,
                    color: this.widget.btnFontColor
                }
            },
            generalHeader(){
                return this.widget.phrases.general.header;
            },
            generalText(){
                return this.widget.phrases.general.text;
            },
            generalBtnText(){
                return this.widget.phrases.general.btnText;
            },

            onExitHeader(){
                return this.widget.phrases.onExit.header;
            },
            onExitText(){
                return this.widget.phrases.onExit.text;
            },
            onExitBtnText(){
                return this.widget.phrases.onExit.btnText;
            },

            afterSendingHeader(){
                return this.widget.phrases.afterSending.header;
            },

            notWorkingHoursHeader(){
                return this.widget.phrases.notWorkingHours.header
            },
            notWorkingHoursText(){
                return this.widget.phrases.notWorkingHours.text
            },
            notWorkingHoursBtnText(){
                return this.widget.phrases.notWorkingHours.btnText
            },
        }
    }
</script>

<style scoped lang="stylus">
    #lmb_window
        position: fixed
        width: calc(100% - 300px)
        height: 100%
        top: 0
        right: 0
        font-family: Roboto
        animation-duration: 0.6s
    #lmb_window-close
        margin-top: 40px
        text-align: center
    #lmb_window-close-img:hover
        transform: rotate(90deg)
    #lmb_window-header
        font-size: 60px
        text-align: center
        margin-top: 70px
        font-weight: 100
    #lmb_window-text
        font-size: 20px
        font-weight: 300
        text-align: center
        margin-top: 10px
        padding: 0 70px
        line-height: 30px
    #lmb_window-form
        text-align: center
        margin-top: 20px
        display: grid
        grid-template-columns: max-content max-content
        grid-template-rows: 53px
        justify-content: center
    .lmb_window-eula
        margin-top: 5px !important
        text-align: initial
        a
            text-decoration: underline !important
            cursor: pointer !important
    .lmb_window-eula, .lmb_window-eula a
        color: white !important
        font-weight: 300 !important
        font-size: 13px !important

    #lmb_window-form input
        font-size: 30px
        font-family: Roboto
        font-weight: 300
        padding: 6px 20px
        outline: none

        border-radius: 4px
        border: solid 1px white
    #lmb_window-form-btn
        border: none
        border-radius: 4px
        font-size: 18px
        padding: 16px 25px
        margin-left: 5px
        cursor: pointer

    .lightSpeedIn
        animation-name: lightSpeedIn
        animation-timing-function: ease-out
        animation-fill-mode: both
    .bounceOutDown
        animation-name: bounceOutDown
        animation-fill-mode: both
</style>
