<template lang="pug">
    div(style='position: fixed')
        link(href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese', rel='stylesheet', type='text/css')
        .lmb_overlay(:style='overlayBackground')
        .lmb_window
            .lmb_window-close
                img.lmb_window-close-img(src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAACXBIWXMAAAsTAAALEwEAmpwYAAABNmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarY6xSsNQFEDPi6LiUCsEcXB4kygotupgxqQtRRCs1SHJ1qShSmkSXl7VfoSjWwcXd7/AyVFwUPwC/0Bx6uAQIYODCJ7p3MPlcsGo2HWnYZRhEGvVbjrS9Xw5+8QMUwDQCbPUbrUOAOIkjvjB5ysC4HnTrjsN/sZ8mCoNTIDtbpSFICpA/0KnGsQYMIN+qkHcAaY6addAPAClXu4vQCnI/Q0oKdfzQXwAZs/1fDDmADPIfQUwdXSpAWpJOlJnvVMtq5ZlSbubBJE8HmU6GmRyPw4TlSaqo6MukP8HwGK+2G46cq1qWXvr/DOu58vc3o8QgFh6LFpBOFTn3yqMnd/n4sZ4GQ5vYXpStN0ruNmAheuirVahvAX34y/Axk/96FpPYgAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAUggAARVYAAA6lwAAF2/XWh+QAAAAzElEQVR42qyTsRHCMAxFX7xBVoARpFVghKSjhRUyAhmBFVjhMwsDUIgCwwWwA3egOzey35Nt2ZhZa2ariOCbYbdYRAQJOAIHd+/4EO5ueb3cvU3AmOf2c4IJ2AKDpHOSNAIOnLNgWwBXE7CXNAA0EVEyj5L6nO+Affb0uRhPcEkAnGrgG1wQUAMB0mtC0gnYABcggG0J/G/lwpn7uTamGijpXq0qSAVwd29TvoMRWE/ewUPQmFk3147KznaShsbMBNgcWBAALPnlV10HACwiuaGZ5ZweAAAAAElFTkSuQmCC', alt='')
            .lmb_window-container
                .lmb_general(v-show="currentState === 'general'")
                    .lmb_window-header
                        p {{phrases.general.header}}
                    .lmb_window-text
                        p {{phrases.general.text}}
                    .lmb_window-form
                        masked-input.lmb_window-form-input(mask='\\+\\7(111)111-11-11', placeholder='+7(___)___-__-__', v-model='phone')
                        button.lmb_window-form-btn(:style='btnStyles') {{phrases.general.btnText}}
                    .lmb_window-eula
                        input.lmb_window-eula-check(type='checkbox', checked='checked')
                        |                     Согласен с
                        a политикой конфиденциальности
                .lmb_on-exit(v-show="currentState === 'on-exit'")
                    .lmb_window-header
                        p {{phrases.onExit.header}}
                    .lmb_window-text
                        p {{phrases.onExit.text}}
                    .lmb_window-form
                        masked-input.lmb_window-form-input(mask='\\+\\7(111)111-11-11', placeholder='+7(___)___-__-__', v-model='phone')
                        button.lmb_window-form-btn(:style='btnStyles') {{phrases.onExit.btnText}}
                    .lmb_window-eula
                        input.lmb_window-eula-check(type='checkbox', checked='checked')
                        |                     Согласен с
                        a политикой конфиденциальности
                .lmb_after-sending(v-show="currentState === 'after-sending'")
                    .lmb_window-header(style='margin-bottom:0;')
                        p {{phrases.afterSending.header}}
                .lmb_general(v-show="currentState === 'not-working-hours'")
                    .lmb_window-header
                        p {{phrases.notWorkingHours.header}}
                    .lmb_window-text
                        p {{phrases.notWorkingHours.text}}
                    .lmb_window-form
                        masked-input.lmb_window-form-input(mask='\\+\\7(111)111-11-11', placeholder='+7(___)___-__-__', v-model='phone')
                        button.lmb_window-form-btn(:style='btnStyles') {{phrases.notWorkingHours.btnText}}
                    .lmb_window-eula
                        input.lmb_window-eula-check(type='checkbox', checked='checked')
                        |                     Согласен с
                        a политикой конфиденциальности
            .lmb_footer
                p
                    | Виджет предоставлен
                    a(href='#') LeadMeBack.com

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
                return this.$store.state.w2.widget
            },
            system(){
                return this.$store.state.w2.system
            },
            currentState(){
                return this.system.currentState
            },

            overlayBackground(){
                return {
                    background: this.widget.overlayColor
                }
            },
            btnStyles(){
                return {
                    background: this.widget.btnBgColor,
                    "box-shadow": "0px 9px 0px " + this.widget.btnShadowColor + ", 0px 9px 25px rgba(0, 0, 0, 0.7)"
                }
            },
            phrases(){
                return this.widget.phrases
            }
        }
    }
</script>

<style scoped lang="stylus">
    .lmb_window
        position fixed
        width 700px
        z-index 2
        background rgba(255, 255, 255, 0.95)
        top 50%
        left calc(300px + (100% - 300px)/2)
        transform translate(-50%, -50%)
        border-radius 10px
        *
            font-family 'Open Sans', sans-serif !important
    .lmb_overlay
        position fixed
        width calc(100% - 300px)
        top 0
        right 0
        height 100%
        z-index 1
    .lmb_window-close
        padding 15px 15px 0 0
        text-align right
    .lmb_window-container
        padding 50px
    .lmb_window-header
        text-align center
        font-size 29px
        margin-bottom 10px
    .lmb_window-text
        text-align center
        font-size 23px
        font-weight 300
    .lmb_window-form
        display grid
        grid-template-columns 1fr 1fr
        grid-gap 10px
        margin-top 15px
    .lmb_window-form-input
        border 4px solid #ccc !important
        height 58px
        border-radius 8px
        padding 6px 15px
        font-size 18px
    .lmb_window-form-btn
        box-sizing border-box
        color white
        height 50px
        border none
        border-radius 8px
        font-size 24px
    .lmb_window-eula
        color #454545
        font-size 12px
        margin-top 5px
        margin-left 305px
    .lmb_footer
        height 30px
        font-size 11px
        font-weight 300
        text-align right
        padding-right 20px
        display grid
        align-content center
        a
            color black
            text-decoration none

</style>