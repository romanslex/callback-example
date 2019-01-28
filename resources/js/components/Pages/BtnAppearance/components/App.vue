<template lang="pug">
    #content
        #settings
            h3(style='margin-top: 10px') НАстройки
            settings1(v-show="currentBtn === 'b1'")
            .btn-wrap
                button.btn(@click='save') Сохранить
        #site
            btn1(v-show="currentBtn === 'b1'")
            iframe#frame(scrolling='no', :src='site', frameborder='0', style='width:100%;height:100%;background:#fff', width='100%')
</template>

<script>
    import Settings1 from "./btn1/Settings.vue"
    import Btn1 from "./btn1/Btn.vue"
    import axios from "axios"

    export default {
        components: {
            Settings1,
            Btn1,
        },
        computed: {
            site(){
                return "http://" + this.$store.state.site;
            },
            currentBtn: {
                get: function(){
                    return this.$store.state.currentBtn;
                },
                set: function(newValue){
                    this.$store.dispatch("changeCurrentBtn", newValue)
                }
            }
        },
        methods: {
            save: function(){
                let state = this.$store.state;
                let data = {};

                data.currentBtn = this.currentBtn;
                data.buttons = {};
                for(let key in state)
                    if(key.match(/b[1-90].*/))
                        data.buttons[key] = state[key];

                axios
                    .put("/home/btn-appearance/" + this.$store.state.wid, data)
                    .then(response => {
                        this.$notifySuccess();
                    })
                    .catch(error => this.$notifyDanger())
            }
        }
    }
</script>

<style lang="stylus">
    h3
        font-weight 400
        margin-bottom 5px
        text-align center
        text-transform uppercase
    h4
        font-weight 400
        margin-bottom 5px
    input
        outline none
        height 30px
        padding-left 5px
        font-size 13px
        width 100%
    select
        width 100%
        font-size 13px
        height 30px
        outline none
        margin-bottom 10px
</style>

<style scoped lang="stylus">
    #content
        display grid
        grid-template-columns 300px 1fr
        height 100%
    #settings
        background white
        padding 10px
        overflow-y auto
        position relative
        z-index 9
    #site
        position relative
    .btn-wrap
        margin-top 10px
        margin-bottom 50px
        text-align right
    .btn
        box-shadow 0 1px 3px 0 rgba(0, 0, 0, 0.33)
        transition box-shadow 0.15s ease-out
        width 100%
        border none
        color white
        background #3497dc
        font-size 13px
        padding 8px 20px
        cursor pointer
        text-transform uppercase
        outline none
        &:hover
            box-shadow 0 3px 8px 0 rgba(0, 0, 0, 0.38)
</style>