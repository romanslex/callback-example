<template lang="pug">
    #content
        #settings
            h3(style="margin-top: 10px;") Тип окна
            select(v-model="currentWindow")
                option(value="w1") Окно 1
                option(value="w2") Окно 2

            h3(style="margin-top: 10px") Настройки
            settings1(v-show="currentWindow === 'w1'")
            settings2(v-show="currentWindow === 'w2'")

            .btn-wrap
                button.btn(@click="save") Сохранить
        #site
            window1(v-show="currentWindow === 'w1'")
            window2(v-show="currentWindow === 'w2'")
            iframe(scrolling=no :src="site" frameborder="0" style="width:100%;height:100%;background:#fff" width='100%' id='frame')
</template>

<script>
    import Window1 from "./window1/Window.vue"
    import Settings1 from "./window1/Settings.vue"
    import Window2 from "./window2/Window.vue"
    import Settings2 from "./window2/Settings.vue"
    import axios from "axios"

    export default {
        components: {
            Window1,
            Settings1,
            Window2,
            Settings2,
        },
        methods: {
            save: function(){
                let data = {};
                let state = this.$store.state;

                data.currentWindow = this.currentWindow;
                data.windows = {};
                for(let key in state)
                    if(key.match(/w[1-90].*/))
                        data.windows[key] = state[key].widget;

                axios
                    .put("/home/window-appearance/" + this.$store.state.wid, data)
                    .then(response => {
                        this.$notifySuccess();
                    })
                    .catch(error => this.$notifyDanger())
            },
        },
        computed: {
            site: {
                get: function(){
                    return "http://" + this.$store.state.site;
                },
            },
            currentWindow: {
                get: function(){
                    return this.$store.state.currentWindow;
                },
                set: function(newValue){
                    this.$store.dispatch("changeCurrentWindow", newValue)
                }
            }
        },
    }
</script>

<style lang="stylus">
    h3
        font-weight: 400
        margin-bottom: 5px
        text-align: center
        text-transform: uppercase
    h4
        font-weight: 400
        margin-bottom: 5px
    input[type=text]
        outline: none
        height: 30px
        padding-left: 5px
        font-size: 13px
        width: 100%
</style>


<style scoped lang="stylus">
    #content
        display: grid
        grid-template-columns: 300px 1fr
        height:100%
    #settings
        background: white
        padding: 10px
        overflow-y: auto

    select
        width: 100%
        font-size: 13px
        height: 30px
        outline: none
        margin-bottom: 10px

    .btn-wrap
        margin-bottom: 50px
        text-align: right
    .btn
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33)
        transition: box-shadow 0.15s ease-out
        width: 100%
        border: none
        color: white
        background: #3497dc
        font-size: 13px
        padding: 8px 20px
        cursor: pointer
        text-transform: uppercase
        outline: none
        &:hover
            box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.38)
</style>
