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
        h4 Цвет кнопки
        color-picker(v-model='btnBgColor')
        h4 Цвет текста кнопки
        color-picker(v-model='btnFontColor')
        h3(style='margin-top: 20px;') Фразы
        .phrase-container
            header(@click="changeCurrentState('general')") Обычное состояние
            .body(:class="{'closed': currentState !== 'general'}", style='height: 268px')
                h4 Заголовок
                textarea(v-model='generalHeader', maxlength='50', style='height: 46px')
                h4 Текст
                textarea(v-model='generalText', maxlength='140', style='height: 115px;')
                h4 Кнопка
                input(type='text', v-model='generalBtnText', maxlength='20')
        .phrase-container
            header(@click="changeCurrentState('on-exit')") Окно на выходе
            .body(:class="{'closed': currentState !== 'on-exit'}", style='height: 268px')
                h4 Заголовок
                textarea(v-model='onExitHeader', maxlength='50', style='height: 46px')
                h4 Текст
                textarea(v-model='onExitText', maxlength='140', style='height: 115px;')
                h4 Кнопка
                input(type='text', v-model='onExitBtnText', maxlength='20')
        .phrase-container
            header(@click="changeCurrentState('after-sending')") Сообщение после отправки
            .body(:class="{'closed': currentState !== 'after-sending'}", style='height: 65px')
                h4 Заголовок
                textarea(v-model='afterSendingHeader', maxlength='50', style='margin-bottom: 0; height: 46px')
        .phrase-container
            header(@click="changeCurrentState('not-working-hours')") В нерабочее время
            .body(:class="{'closed': currentState !== 'not-working-hours'}", style='height: 268px')
                h4 Заголовок
                textarea(v-model='notWorkingHoursHeader', maxlength='50', style='height: 46px')
                h4 Текст
                textarea(v-model='notWorkingHoursText', maxlength='140', style='height: 115px;')
                h4 Кнопка
                input(type='text', v-model='notWorkingHoursBtnText', maxlength='20')
</template>

<script>
    import ColorPicker from "../../../../Shared/ColorPicker.vue"

    export default {
        components: {
            ColorPicker,
        },
        data: function () {
            return {
                themes: [
                    {
                        bgColor: "rgba(59, 175, 218, 1)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(19, 108, 142, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    }, {
                        bgColor: "rgba(233, 87, 63, 1)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(151, 38, 20, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    }, {
                        bgColor: "rgba(246, 187, 66, 1)",
                        fontColor: "rgba(0, 0, 0, 1)",
                        btnBgColor: "rgba(160, 115, 21, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    }, {
                        bgColor: "rgba(52, 152, 219, 1)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(17, 93, 142, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    }, {
                        bgColor: "rgba(112, 202, 99, 1)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(46, 131, 32, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    }, {
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
                    }, {
                        bgColor: "rgba(233, 87, 63, 0.8)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(151, 38, 20, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    }, {
                        bgColor: "rgba(246, 187, 66, 0.8)",
                        fontColor: "rgba(0, 0, 0, 1)",
                        btnBgColor: "rgba(160, 115, 21, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    }, {
                        bgColor: "rgba(52, 152, 219, 0.8)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(17, 93, 142, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    }, {
                        bgColor: "rgba(112, 202, 99, 0.8)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(46, 131, 32, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    }, {
                        bgColor: "rgba(0, 0, 0, 0.8)",
                        fontColor: "rgba(255, 255, 255, 1)",
                        btnBgColor: "rgba(0, 144, 199, 1)",
                        btnFontColor: "rgba(255, 255, 255, 1)"
                    },
                ],
            }
        },
        computed: {
            widget() {
                return this.$store.state.w1.widget;
            },
            system() {
                return this.$store.state.w1.system;
            },
            currentState() {
                return this.system.currentState;
            },
            bgColor: {
                get: function () {
                    return this.widget.bgColor;
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeBgColor", newValue)
                }
            },
            fontColor: {
                get: function () {
                    return this.widget.fontColor;
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeFontColor", newValue)
                }
            },
            btnBgColor: {
                get: function () {
                    return this.widget.btnBgColor;
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeBtnBgColor", newValue)
                }
            },
            btnFontColor: {
                get: function () {
                    return this.widget.btnFontColor;
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeBtnFontColor", newValue)
                }
            },

            generalHeader: {
                get: function () {
                    return this.widget.phrases.general.header;
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeGeneralHeader", newValue)
                }
            },
            generalText: {
                get: function () {
                    return this.widget.phrases.general.text;
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeGeneralText", newValue)
                }
            },
            generalBtnText: {
                get: function () {
                    return this.widget.phrases.general.btnText;
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeGeneralBtnText", newValue)
                }
            },

            onExitHeader: {
                get: function () {
                    return this.widget.phrases.onExit.header;
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeOnExitHeader", newValue)
                }
            },
            onExitText: {
                get: function () {
                    return this.widget.phrases.onExit.text;
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeOnExitText", newValue)
                }
            },
            onExitBtnText: {
                get: function () {
                    return this.widget.phrases.onExit.btnText;
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeOnExitBtnText", newValue)
                }
            },

            afterSendingHeader: {
                get: function () {
                    return this.widget.phrases.afterSending.header;
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeAfterSendingHeader", newValue)
                }
            },

            notWorkingHoursHeader: {
                get: function () {
                    return this.widget.phrases.notWorkingHours.header
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeNotWorkingHoursHeader", newValue)
                }
            },
            notWorkingHoursText: {
                get: function () {
                    return this.widget.phrases.notWorkingHours.text
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeNotWorkingHoursText", newValue)
                }
            },
            notWorkingHoursBtnText: {
                get: function () {
                    return this.widget.phrases.notWorkingHours.btnText
                },
                set: function (newValue) {
                    this.$store.commit("w1/changeNotWorkingHoursBtnText", newValue)
                }
            }

        },
        methods: {
            setTheme: function (theme) {
                this.$store.commit("w1/changeBgColor", theme.bgColor);
                this.$store.commit("w1/changeFontColor", theme.fontColor);
                this.$store.commit("w1/changeBtnBgColor", theme.btnBgColor);
                this.$store.commit("w1/changeBtnFontColor", theme.btnFontColor);
            },
            changeCurrentState(style) {
                this.$store.commit("w1/changeCurrentState", style)
            }
        }
    }
</script>

<style scoped lang="stylus">
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
