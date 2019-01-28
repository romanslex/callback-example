<template lang="pug">
    .settings-window-2
        h4 Темы
        .color-themes
            .color-themes-item(v-for='(theme, i) in themes', :key='i', @click='setTheme(theme)')
                .cti-fake
                .cti-real(:style='{background: theme.btnBgColor}')
        h4 Цвет фона
        color-picker(v-model='overlayColor')
        h4 Цвет кнопки
        color-picker(v-model='btnBgColor')
        h4 Произвольная тема
        color-picker(v-model='mainColor')
        h3(style='margin-top: 20px;') Фразы
        .phrase-container
            header(@click="changeCurrentState('general')") Обычное состояние
            .body(:class="{'closed': currentState !== 'general'}", style='height: 268px')
                h4 Заголовок
                textarea(v-model='phrases.general.header', maxlength='50', style='height: 46px')
                h4 Текст
                textarea(v-model='phrases.general.text', maxlength='140', style='height: 115px;')
                h4 Кнопка
                input(type='text', v-model='phrases.general.btnText', maxlength='20')
        .phrase-container
            header(@click="changeCurrentState('on-exit')") Окно на выходе
            .body(:class="{'closed': currentState !=='on-exit'}", style='height: 268px')
                h4 Заголовок
                textarea(v-model='phrases.onExit.header', maxlength='50', style='height: 46px')
                h4 Текст
                textarea(v-model='phrases.onExit.text', maxlength='140', style='height: 115px;')
                h4 Кнопка
                input(type='text', v-model='phrases.onExit.btnText', maxlength='20')
        .phrase-container
            header(@click="changeCurrentState('after-sending')") Сообщение после отправки
            .body(:class="{'closed': currentState !== 'after-sending'}", style='height: 65px')
                h4 Заголовок
                textarea(v-model='phrases.afterSending.header', maxlength='50', style='margin-bottom: 0; height: 46px')
        .phrase-container
            header(@click="changeCurrentState('not-working-hours')") В нерабочее время
            .body(:class="{'closed': currentState !== 'not-working-hours'}", style='height: 268px')
                h4 Заголовок
                textarea(v-model='phrases.notWorkingHours.header', maxlength='50', style='height: 46px')
                h4 Текст
                textarea(v-model='phrases.notWorkingHours.text', maxlength='140', style='height: 115px;')
                h4 Кнопка
                input(type='text', v-model='phrases.notWorkingHours.btnText', maxlength='20')

</template>

<script>
    import ColorPicker from "../../../../Shared/ColorPicker.vue"
    import Color from "color"

    export default {
        components: {
            ColorPicker,
        },
        data: function(){
            return {
                themes: [
                    {
                        btnBgColor: "rgba(59, 175, 218, 1)",
                    },{
                        btnBgColor: "rgba(233,87,63,1)",
                    },{
                        btnBgColor: "rgba(246, 187, 66, 1)",
                    },{
                        btnBgColor: "rgba(0, 144, 199, 1)",
                    },{
                        btnBgColor: "rgba(113, 202, 99, 1)",
                    },{
                        btnBgColor: "rgba(106, 30, 52, 1)",
                    }
                ],
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

            overlayColor: {
                get: function(){
                    return this.widget.overlayColor
                },
                set: function(newValue){
                    this.$store.commit("w2/changeOverlayColor", newValue)
                }
            },
            btnBgColor: {
                get: function(){
                    return this.widget.btnBgColor
                },
                set: function(newValue){
                    this.btnShadowColor = this.$colorDarken(newValue, -30).string();
                    this.$store.commit("w2/changeBtnBgColor", newValue);
                }
            },
            btnShadowColor: {
                get: function(){
                    return this.widget.btnShadowColor
                },
                set: function(newValue){
                    this.$store.commit("w2/changeBtnShadowColor", newValue)
                }
            },
            mainColor: {
                get: function(){
                    return this.widget.btnBgColor
                },
                set: function(newValue){
                    this.setTheme({btnBgColor: newValue})
                }
            },

            phrases(){
                return this.widget.phrases
            },
        },
        methods: {
            setTheme: function(theme){
                this.$store.commit("w2/changeOverlayColor", Color(theme.btnBgColor).alpha(0.4).string());
                this.$store.commit("w2/changeBtnBgColor", theme.btnBgColor);
                this.$store.commit("w2/changeBtnShadowColor", this.$colorDarken(theme.btnBgColor, -30).string());
            },
            changeCurrentState(style){
                this.$store.commit("w2/changeCurrentState", style)
            }
        }
    }
</script>

<style lang="stylus" scoped>
    .color-themes
        display grid
        grid-template-columns repeat(6, 1fr)
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
            transition all 0.3s
            overflow hidden
            &.closed
                height 0 !important
                padding-bottom 0 !important
                padding-top 0 !important
        h4
            font-weight 500
            font-size 12px
</style>