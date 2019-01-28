<template lang="pug">
    #content
        .phone-block
            img(src='../../../../assets/outline.png', alt='', style='width: 340px')
            window1(v-show="currentTab.window && currentWindow === 'mw1'")
            btn1(v-show="currentTab.btn && currentBtn === 'mb1'")
        div
            .tab-nav
                .tab-nav-item(v-bind:class='{active: currentTab.btn}', @click="setCurrentTab('btn')")
                    a Настройка кнопки
                .tab-nav-item(v-bind:class='{active: currentTab.window}', @click="setCurrentTab('window')")
                    a Настройка окна
            .tab-content
                .tab-content-item(v-show='currentTab.btn')
                    h3 Настройки кнопки
                    settings-b1(v-show="currentBtn === 'mb1'")
                    button.btn(@click='saveBtn') Сохранить
                .tab-content-item(v-show='currentTab.window')
                    h3 Настройки окна
                    settings-w1(v-show="currentWindow === 'mw1'")
                    button.btn(@click='saveWindow') Сохранить
</template>

<script>
    import axios from "axios"

    import ColorPicker from "../../../Shared/ColorPicker.vue"
    import VueSlider from "vue-slider-component"

    import Window1 from "./window1/Window.vue"
    import SettingsW1 from "./window1/Settings.vue"

    import Btn1 from "./btn1/Btn.vue"
    import SettingsB1 from "./btn1/Settings.vue"

    export default {
        components: {
            ColorPicker,
            VueSlider,

            Window1,
            SettingsW1,

            Btn1,
            SettingsB1,
        },
        data: function(){
            return {
                btnColor: "rgba(39, 132, 221, 0.95)",
                x: 50,
                y: 94,
                currentTab: {
                    btn: true,
                    window: false,
                },
            }
        },
        computed: {
            currentWindow: {
                get: function(){
                    return this.$store.state.currentWindow
                },
                set: function(newValue){
                    this.$store.dispatch("changeCurrentWindow", newValue)
                }
            },
            currentBtn: {
                get: function(){
                    return this.$store.state.currentBtn
                },
                set: function(newValue){
                    this.$store.dispatch("changeCurrentBtn", newValue)
                }
            },
            xPosition(){
                if(this.x < 50)
                    return this.x + 0.33 * (50 - this.x) + "%"
                else if(this.x > 50)
                    return this.x - 0.33 * (this.x - 50) + "%"
                return this.x + "%"
            },
            yPosition(){
                if(this.y < 50)
                    return this.y + 0.36 * (50 - this.y) + "%"
                else if(this.y > 50)
                    return this.y - 0.32 * (this.y - 50) + "%"
                return this.y + "%"
            }
        },
        methods: {
            setCurrentTab: function(type){
                this.currentTab.btn = false
                this.currentTab.window = false
                this.currentTab[type] = true
            },
            saveBtn: function(){
                let data = {}
                let state = this.$store.state

                data.currentBtn = this.currentBtn
                data.buttons = {}
                for(let key in state)
                    if(key.match(/mb[1-90].*/))
                        data.buttons[key] = state[key].widget

                axios
                    .put("/home/mobile-appearance/btn/" + this.$store.state.wid, data)
                    .then(response => this.$notifySuccess())
                    .catch(error => this.$notifyDanger())
            },
            saveWindow: function(){
                let data = {}
                let state = this.$store.state

                data.currentWindow = this.currentWindow
                data.windows = {}
                for(let key in state)
                    if(key.match(/mw[1-90].*/))
                        data.windows[key] = state[key].widget

                axios
                    .put("/home/mobile-appearance/window/" + this.$store.state.wid, data)
                    .then(response => this.$notifySuccess())
                    .catch(error => this.$notifyDanger())
            }
        }
    }
</script>

<style lang="stylus">
    h3
        font-weight 400
        margin-bottom 5px
        text-transform uppercase
    h4
        font-weight 400
        margin-top 5px
        margin-bottom 5px
    select
        width 100%
        font-size 13px
        height 30px
        outline none
        margin-bottom 10px
    input
        outline none
        height 30px
        padding-left 5px
        font-size 13px
        width 100%
</style>

<style lang="stylus" scoped>
    #content, #content *, #content >>> *
        box-sizing border-box
    .btn
        box-shadow 0 1px 3px 0 rgba(0, 0, 0, 0.33)
        transition box-shadow 0.15s ease-out
        border none
        color white
        background #49af60
        margin-top 30px
        font-size 13px
        padding 8px 40px
        cursor pointer
        text-transform uppercase
        outline none
        &:hover
            box-shadow 0 3px 8px 0 rgba(0, 0, 0, 0.38)
    #content
        width 940px
        font-family Roboto
        margin 0 auto
        display grid
        grid-template-columns max-content 1fr
        grid-gap 30px
    .tab-nav
        display grid
        grid-template-columns 1fr 1fr
        grid-gap 5px
        border-bottom solid 1px #dddddd
    .tab-nav-item
        text-align center
        text-transform uppercase
        font-size 13px
        height 56px
        cursor pointer
        display grid
        &:hover
            background rgba(52, 151, 220, 0.13)
        a
            align-self center
        &.active
            color #3497dc
            border-bottom solid 2px #3497dc
            &:hover
                background initial
    .btn-settings
        display grid
        grid-template-columns 1fr 1fr
        grid-gap 15px
    div
        &.phone-block
            display grid
            justify-content center
            position relative
    .window-settings
        display grid
        grid-template-columns 1fr 1fr
        grid-gap 15px

</style>