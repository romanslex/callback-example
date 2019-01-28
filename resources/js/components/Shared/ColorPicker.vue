<template lang="pug">
    .cp-block(v-click-outside='hide')
        .cp-input(@click='isVisible = true')
            div(style='position: relative')
                .color-btn(:style='style')
                .color-btn-fake
            input(type='text', v-model='color', readonly='')
        .colorpicker(v-show='isVisible')
            chrome(v-model='color')
</template>

<script>
    import ClickOutside from 'vue-click-outside'
    import {Chrome, Material} from "vue-color"

    export default {
        props: ["value"],
        components: {
            Chrome,
            Material,
        },
        directives: {
            ClickOutside
        },
        data: function(){
            return {
                isVisible: false,
            };
        },
        computed: {
            color: {
                get: function(){
                    let one = this.value.split("rgba(");
                    let two = one[1].split(")");
                    let three = two[0].split(",").map(i => parseFloat(i));
                    return "rgba("+three[0]+","+three[1]+","+three[2]+","+three[3]+")";
                },
                set: function(newValue){
                    let r = newValue.rgba.r;
                    let g = newValue.rgba.g;
                    let b = newValue.rgba.b;
                    let a = newValue.rgba.a;
                    this.$emit("input", "rgba("+r+","+g+","+b+","+a+")")
                }
            },
            style(){
                return {background: this.color};
            },
        },
        methods: {
            hide: function(){
                this.isVisible = false;
            },
            updateValue: function(){
                this.$emit("input", this.color);
            }
        }
    }
</script>

<style scoped lang="stylus">
    .colorpicker
        position absolute
        z-index 6
    .cp-block
        margin-bottom 10px
        position relative
    .cp-input
        display grid
        grid-template-columns 30px 1fr
        grid-template-rows 30px
        grid-gap 5px
        input
            padding-left 5px
    .color-btn
        width 100%
        height 100%
        border 1px solid black
        box-sizing border-box
        position absolute
        top 0
        left 0
        z-index 2
    .color-btn-fake
        width 100%
        height 100%
        position absolute
        z-index 1
        top 0
        left 0
        background url("data:image/jpg;base64,iVBORw0KGgoAAAANSUhEUgAAAJcAAACYCAMAAADeF4ueAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRFv7+/////mcP/dAAAAJ1JREFUeNrs1rEJADAIRUHdf+k0TpB8hMClSyNX6aua1/Me/6lxxcXFxfWrq7MDY+O4uLi4lveYO8TFxaW/uLi4uPQXFxeX/rLvubh0jr3KxcWlc9whLi4u/cXFxcWlv7i4uPSXO8TFxaW/3CEuLi79xcXFpb/sey4uLv3lDnFxcekvLi4uLv3FxcWlv9whLi4u/eUOcXFx3f+PAAMArO4sqLy5/IwAAAAASUVORK5CYII=")
    .color-circle
        border-radius 13px
        width 100%
        height 100%
</style>