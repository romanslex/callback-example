<template lang="pug">
    #lmb_btn(:style='positionStyles')
        #lmb_btn-wave(:style='waveColor')
        #lmb_btn-btn(:style='btnColor')
            img#icon(src='../../../../../assets/call.svg', alt='')
</template>

<script>
    export default {
        computed: {
            btn(){
                return this.$store.state.b1;
            },
            btnColor(){
                return { background: this.btn.btnColor };
            },
            waveColor(){
                return { background: this.btn.waveColor }
            },
            positionStyles(){
                return {
                    right: this.btn.xPosition + "%",
                    top: this.btn.yPosition + "%",
                    transform: "translate(" + this.btn.xPosition + "%, -" + this.btn.yPosition + "%)"
                }
            },
        },
    }
</script>

<style scoped lang="stylus">
    #lmb_btn
        position absolute
        width 64px
    #lmb_btn-wave
        position absolute
        top -50%
        left -50%
        height 128px
        width 128px
        border-radius 50%
        background #0194c7
        animation wave 1.8s infinite ease-in-out
    #lmb_btn-btn
        position relative
        width 64px
        height 64px
        background center center no-repeat #2199ff
        box-shadow 0 3px 5px 1px rgba(0, 0, 0, .2)
        background-size 30px
        border-radius 100%
        cursor pointer
        font-size 16px
        line-height 66px
        color #fff
    #icon
        width 35px !important
        color white !important
        top 15px !important
        left 15px !important
        position absolute !important

    @keyframes wave {
        0% {
            -webkit-transform: rotate(0) scale(.5) skew(1deg);
            transform: rotate(0) scale(.5)skew(1deg);
            opacity: .3
        }
        100% {
            -webkit-transform: rotate(0) scale(1) skew(1deg);
            transform: rotate(0) scale(1) skew(1deg);
            opacity: .01
        }
    }
</style>