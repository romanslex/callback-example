<template lang="pug">
    label
        input.checkbox-input(@change="onChange" type="checkbox" name="workdays_same" :checked="checked")
        span.checkbox-text {{text}}
</template>

<script>
    export default {
        model: {
            prop: "checked",
            event: "changed"
        },
        props: [
            "text",
            "checked"
        ],
        methods: {
            onChange: function(e){
                this.$emit("changed", e.target.checked);
            }
        }
    }
</script>

<style scoped lang="stylus">
    label
        width: max-content
        width: -moz-fit-content
    .checkbox-input
        position: absolute
        z-index: -1
        opacity: 0
    .checkbox-text
        position: relative
        padding-left: 30px
        display: inline-block
        cursor: pointer
        vertical-align: text-top
        &:before
            content: ""
            position: absolute
            left: 0
            z-index: 1
            width: 15px
            height: 15px
            border: 2px solid #535858
            -webkit-transition: all 0.2s ease-in-out
            -o-transition: all 0.2s ease-in-out
            transition: all 0.2s ease-in-out
    .checkbox-input:checked ~ .checkbox-text:before
        -webkit-transform: rotate(-45deg)
        -ms-transform: rotate(-45deg)
        -o-transform: rotate(-45deg)
        transform: rotate(-45deg)
        height: 10px
        border-color: #3497dc
        border-top-style: none
        border-right-style: none
</style>