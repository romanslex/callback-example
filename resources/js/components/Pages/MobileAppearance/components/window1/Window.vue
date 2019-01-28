<template lang="pug">
    #lmb_mobile-window(:style="{background: bgColor + '!important'}")
        link(href='https://fonts.googleapis.com/css?family=Roboto:100,300,500,100italic,400,300italic&subset=latin,cyrillic', rel='stylesheet', type='text/css')
        div
            .lmb_close(:style="{color: fontColor + '!important'}") Закрыть
        div
        .lmb_mobile-general.mobile-body(v-show="currentState === 'general'")
            .header(:style="{color: fontColor + '!important'}")
                | {{generalHeader}}
            .input(:style="{color: fontColor + '!important'}")
                | +7
            .keyboard
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 1
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 2
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 3
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 4
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 5
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 6
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 7
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 8
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 9
                div
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 0
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") <
            button.btn(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}")
                | {{generalBtnText}}
        .lmb_mobile-after-sending(v-show="currentState === 'after-sending'", style='overflow: hidden !important')
            .header(:style="{color: fontColor + '!important'}")
                | {{afterSendingText}}
        .lmb_mobile-not-working-hours.mobile-body(v-show="currentState === 'not-working-hours'")
            .header(:style="{color: fontColor + '!important'}")
                | {{notWorkingHoursHeader}}
            .input(:style="{color: fontColor + '!important'}")
                | +7
            .keyboard
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 1
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 2
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 3
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 4
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 5
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 6
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 7
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 8
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 9
                div
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") 0
                .keyboard-item(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}") <
            button.btn(:style="{color: fontColor + '!important', 'border-color': fontColor + '!important'}")
                | {{notWorkingHoursBtnText}}
        div(style='padding-top: 5px !important', v-show="currentState !== 'after-sending'")
            a.lmb_mobile-eula(:style="{color: fontColor + '!important'}", href='#') Нажимая на кнопку, вы даете согласие на обработку персональных данных.

</template>

<script>
    export default {
        computed: {
            widget(){
                return this.$store.state.mw1.widget
            },
            system(){
                return this.$store.state.mw1.system
            },
            currentState(){
                return this.system.currentState
            },

            bgColor(){
                return this.widget.bgColor
            },
            fontColor(){
                return this.widget.fontColor
            },

            generalHeader(){
                return this.widget.phrases.general.header
            },
            generalBtnText(){
                return this.widget.phrases.general.btnText
            },
            afterSendingText(){
                return this.widget.phrases.afterSending.header
            },
            notWorkingHoursHeader(){
                return this.widget.phrases.notWorkingHours.header
            },
            notWorkingHoursBtnText(){
                return this.widget.phrases.notWorkingHours.btnText
            },
        }
    }
</script>

<style lang="stylus" scoped>
    #lmb_mobile-window
        position absolute !important
        display grid
        grid-template-rows max-content 1fr 1fr !important
        top 94px !important
        left 23px !important
        width 292px !important
        height 521px !important
        z-index 2147483647 !important
        padding 10% !important
        align-content end !important
        *
            font-family Roboto !important
        div
            &.mobile-body
                display grid
                grid-template-rows 60px 80px max-content 40px !important
            &.lmb_close
                color white !important
                text-transform uppercase !important
                text-align center !important
            &.header
                display grid
                align-content end !important
                justify-content center !important
                color white !important
                font-size 22px !important
                font-weight 100 !important
                text-align center !important
                overflow hidden !important
            &.input
                height 40px !important
                background rgba(0, 0, 0, 0.4) !important
                color white !important
                display grid !important
                align-self center !important
                align-content center !important
                text-align center !important
                font-size 20px !important
                padding 0 10px !important
            &.keyboard
                display grid !important
                grid-template-columns repeat(3, 1fr) !important
                grid-template-rows repeat(4, 1fr) !important
                grid-gap 5px !important
                padding-bottom 20px !important
            &.keyboard-item
                border 1px solid white !important
                color white !important
                background rgba(0, 0, 0, 0.4) !important
                display grid
                align-content center !important
                justify-content center !important
                user-select none !important
                -webkit-touch-callout none !important
                -webkit-user-select none !important
                -khtml-user-select none !important
                -moz-user-select none !important
                -ms-user-select none !important
                padding 10px 0 !important
        button
            &.btn
                border 1px solid white !important
                text-align center !important
                color white !important
                display grid !important
                background initial
                font-size initial
    .lmb_mobile-eula
        font-size 11px !important
        font-weight 300 !important
        display block !important
        text-decoration underline !important
        line-height 1.2 !important

</style>