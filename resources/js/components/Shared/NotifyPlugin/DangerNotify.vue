<template lang="pug">
    transition(name="fade")
        .notify(v-show="isShown")
            i.fal.fa-exclamation-circle(style="font-size: 28px")
            span(style="display: grid; align-content: center") {{text}}
</template>

<script>
    export default {
        data: function(){
            return {
                isShown: false,
                text: "Произошла ошибка"
            }
        },
        methods: {
            notify: function(text){
                this.text = text || this.text;
                this.isShown = true;
                setTimeout(() => this.isShown = false, 2000);
            }
        }
    }
</script>

<style scoped lang="stylus">
    .notify
        font-weight: 300
        font-family: Roboto
        position: fixed
        top: 110px
        right: 0
        color: white
        background: #A60000
        padding: 15px
        width: 350px
        font-size: 17px
        border-left: 3px solid #6C0000
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33)
        display: grid
        grid-template-columns: max-content max-content
        grid-gap: 10px
    .fade-enter-active, .fade-leave-active
        transition: opacity .5s
    .fade-enter, .fade-leave-to
        opacity: 0
</style>