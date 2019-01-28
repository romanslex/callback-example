<template lang="pug">
    .btn-wrap(:style='{left: xPosition, top: yPosition}')
        #lmb_btn-btn(:style="{background: btnColor + '!important'}")
            img#icon(src='../../../../../assets/call.svg', alt='')
</template>

<script>
    export default {
        computed: {
            widget(){
                return this.$store.state.mb1.widget
            },
            btnColor(){
                return this.widget.color
            },
            xPosition(){
                let x = this.widget.xPosition;

                if(x < 50)
                    return x + 0.33 * (50 - x) + "%";
                else if(x > 50)
                    return x - 0.33 * (x - 50) + "%";
                return x + "%"
            },
            yPosition(){
                let y = this.widget.yPosition;

                if(y < 50)
                    return y + 0.36 * (50 - y) + "%";
                else if(y > 50)
                    return y - 0.32 * (y - 50) + "%";
                return y + "%"
            }
        }
    }
</script>

<style scoped lang="stylus">
    .btn-wrap
        position absolute
        transform translate(-50%, -50%)
    #lmb_btn-btn
        position relative
        width 64px
        height 64px
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
</style>