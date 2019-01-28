<template lang="pug">
    .settings-window-1
        h4 Темы
        .color-themes
            .color-themes-item(v-for='(theme, i) in themes', :key='i', @click='setTheme(theme)')
                .cti-fake
                .cti-real(:style='{background: theme.bgColor}')
        h4 Цвет фона
        color-picker(v-model='bgColor')
        h4 Цвет текста
        color-picker(v-model='fontColor')
        h4(style='margin-top: 15px') Фразы
        .phrase-container
            header(@click="changeCurrentState('general')") Обычное состояние
            .body(:class="{'closed': currentState !== 'general'}", style='height: 113px')
                h4(style='margin-top: 0') Заголовок
                input(type='text', v-model='generalHeader', maxlength='35')
                h4 Кнопка
                input(type='text', v-model='generalBtnText', maxlength='20')
        .phrase-container
            header(@click="changeCurrentState('after-sending')") Сообщение после отправки заявки
            .body(:class="{'closed': currentState !== 'after-sending'}", style='height: 59px;')
                h4(style='margin-top: 0') Заголовок
                input(type='text', v-model='afterSendingHeader', maxlength='50')
        .phrase-container
            header(@click="changeCurrentState('not-working-hours')") В нерабочее время
            .body(:class="{'closed': currentState !== 'not-working-hours'}", style='height: 113px')
                h4(style='margin-top: 0') Заголовок
                input(type='text', v-model='notWorkingHoursHeader', maxlength='35')
                h4 Кнопка
                input(type='text', v-model='notWorkingHoursBtnText', maxlength='20')

</template>

<script>
    import ColorPicker from "../../../../Shared/ColorPicker.vue"

    export default {
        components: {
            ColorPicker,
        },
        data: function(){
            return {
                themes: [
                    {
                        bgColor: "rgba(59, 175, 218, 1)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(19, 108, 142, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },{
                        bgColor: "rgba(233, 87, 63, 1)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(151, 38, 20, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },{
                        bgColor: "rgba(234,162,14,1)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(234,162,14,1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },{
                        bgColor: "rgba(52, 152, 219, 1)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(17, 93, 142, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },{
                        bgColor: "rgba(112, 202, 99, 1)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(46, 131, 32, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },{
                        bgColor: "rgba(106, 30, 52, 1)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(69, 9, 26, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },

                    {
                        bgColor: "rgba(59, 175, 218, 0.8)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(19, 108, 142, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },{
                        bgColor: "rgba(233, 87, 63, 0.8)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(151, 38, 20, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },{
                        bgColor: "rgba(234,162,14,0.8)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(234,162,14,1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },{
                        bgColor: "rgba(52, 152, 219, 0.8)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(17, 93, 142, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },{
                        bgColor: "rgba(112, 202, 99, 0.8)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(46, 131, 32, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },{
                        bgColor: "rgba(35, 36, 36, 0.96)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(69, 9, 26, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },
                ],
            }
        },
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
            bgColor: {
                get: function(){
                    return this.widget.bgColor
                },
                set: function(newValue){
                    this.$store.commit("mw1/changeBgColor", newValue)
                }
            },
            fontColor: {
                get: function(){
                    return this.widget.fontColor
                },
                set: function(newValue){
                    this.$store.commit("mw1/changeFontColor", newValue)
                }
            },
            generalHeader: {
                get: function(){
                    return this.widget.phrases.general.header
                },
                set: function(newValue){
                    this.$store.commit("mw1/changeGeneralHeader", newValue)
                }
            },
            generalBtnText: {
                get: function(){
                    return this.widget.phrases.general.btnText
                },
                set: function(newValue){
                    this.$store.commit("mw1/changeGeneralBtnText", newValue)
                }
            },
            afterSendingHeader: {
                get: function(){
                    return this.widget.phrases.afterSending.header
                },
                set: function(newValue){
                    this.$store.commit("mw1/changeAfterSendingHeader", newValue)
                }
            },

            notWorkingHoursHeader: {
                get: function(){
                    return this.widget.phrases.notWorkingHours.header
                },
                set: function(newValue){
                    this.$store.commit("mw1/changeNotWorkingHoursHeader", newValue)
                }
            },
            notWorkingHoursBtnText: {
                get: function(){
                    return this.widget.phrases.notWorkingHours.btnText
                },
                set: function(newValue){
                    this.$store.commit("mw1/changeNotWorkingHoursBtnText", newValue)
                }
            }
        },
        methods: {
            setTheme(theme){
                this.$store.commit("mw1/changeBgColor", theme.bgColor)
                this.$store.commit("mw1/changeFontColor", theme.fontColor)
            },
            changeCurrentState(state){
                this.$store.commit("mw1/changeCurrentState", state)
            }
        }
    }
</script>

<style lang="stylus" scoped>
    .color-themes
        display grid
        grid-template-columns repeat(12, 1fr)
        grid-column-gap 10px
        grid-row-gap 10px
        margin-bottom 10px
    .color-themes-item
        border-radius 15px
        cursor pointer
        height 30px
        position relative
    .cti-fake
        width 100%
        height 100%
        position absolute
        top 0
        left 0
        background url("data:image/jpg;base64,iVBORw0KGgoAAAANSUhEUgAAAJcAAACYCAMAAADeF4ueAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRFv7+/////mcP/dAAAAJ1JREFUeNrs1rEJADAIRUHdf+k0TpB8hMClSyNX6aua1/Me/6lxxcXFxfWrq7MDY+O4uLi4lveYO8TFxaW/uLi4uPQXFxeX/rLvubh0jr3KxcWlc9whLi4u/cXFxcWlv7i4uPSXO8TFxaW/3CEuLi79xcXFpb/sey4uLv3lDnFxcekvLi4uLv3FxcWlv9whLi4u/eUOcXFx3f+PAAMArO4sqLy5/IwAAAAASUVORK5CYII=")
    .cti-real
        width 100%
        height 100%
        top 0
        left 0
        position absolute
    .phrase-container
        border 1px solid darkgray
        margin-bottom 10px
        header
            font-size 20px
            font-weight 300
            padding 10px
            cursor pointer
        textarea
            width 100%
            resize none
            padding 5px
            font-family Roboto
            font-size 14px
            outline none
            margin-bottom 10px
        .body
            padding 10px
            padding-top 0
            transition all 0.3s
            overflow hidden
            &.closed
                height 0 !important
                padding-bottom 0 !important
                padding-top 0 !important
        h4
            font-weight 500 !important
            font-size 12px !important

</style>