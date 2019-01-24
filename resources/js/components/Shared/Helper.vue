<template lang="pug">
    .lmb-helper
        div(style="position:relative")
            i.far.fa-question-circle.question-mark(
                @click="isBlockVisible = true"
                @mouseover="isTooltipVisible = true"
                @mouseout="isTooltipVisible = false"
            )
            transition(name="fade")
                .lmb-helper-tooltip(v-show="isTooltipVisible") Нажмите для получения справки
        .lmb-helper-overlay(v-show="isBlockVisible" @click="isBlockVisible = false")
        .help-block(:style="styles")
            .helper
                slot
            div: button.close-helper(@click="isBlockVisible = false"): i.far.fa-times
</template>

<script>
    const ESCAPE = 27;

    export default {
        props: ["width"],
        data: function(){
            return {
                isBlockVisible: false,
                isTooltipVisible: false,
            }
        },
        computed: {
            styles: function () {
                if (this.isBlockVisible) {
                    return {
                        width: this.width + "px",
                        right: 0,
                        "box-shadow": "0 3px 8px 0 rgba(0, 0, 0, 0.38)",
                    }
                } else
                    return {
                        width: this.width + "px",
                        right: "-" + this.width + "px"
                    }
            }
        },
        created: function(){
            let _this = this
            window.addEventListener("keyup", function(e){
                if(e.keyCode === ESCAPE)
                    _this.isBlockVisible = false
            })
        }
    }
</script>

<style scoped lang="stylus">
    i
        color: #3497dc
        cursor: pointer

    .fade-enter-active, .fade-leave-active
        transition: opacity .3s

    .fade-enter, .fade-leave-to
        opacity: 0

    .lmb-helper-tooltip
        background: rgba(0, 0, 0, 0.8)
        color: white
        font-size: 13px
        padding: 7px
        position: absolute
        width: max-content
        width: -moz-max-content
        width: -webkit-max-content
        top: -10px
        left: 20px

    .question-mark
        font-size: 12px

    .lmb-helper-overlay
        position: absolute
        top: 0
        left: 0
        height: 100%
        width: 100%
        z-index: 10
        background: #0000004d

    .help-block
        position: fixed
        top: 0
        height: 100%
        background: white
        z-index: 11
        transition: all 0.3s
        width: 400px
        padding: 10px 10px 10px 15px
        font-size: 14px
        display: grid
        grid-template-columns: 1fr 34px
        box-sizing: border-box
        overflow-y: auto

    .close-helper
        border: none
        background: transparent
        cursor: pointer
        width: 34px
        height: 34px
        display: grid
        justify-self: end
        outline: none
        &:hover
            background: #0c0c0c12
            border-radius: 50%
        i
            color: black


    .helper
        h1
            font-weight: 300
            margin-bottom: 10px
        h2
            margin-bottom: 5px
            font-weight: 300
        p
            margin-bottom: 10px
        b
            font-weight: 500
</style>
