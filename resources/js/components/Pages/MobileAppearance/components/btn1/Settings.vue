<template lang="pug">
    .settings-btn-1
        h4 Темы
        .color-themes
            .color-themes-item(v-for='(theme, i) in themes', :key='i', @click='setTheme(theme)')
                .cti-fake
                .cti-real(:style='{background: theme.color}')
        h4 Цвет кнопки
        color-picker(v-model='btnColor')
        h4(style='margin-top: 15px') Положение по горизонтали
        vue-slider(v-model='xPosition', tooltip='hover')
        h4 Положение по вертикали
        vue-slider(v-model='yPosition', tooltip='hover')
</template>

<script>
    import ColorPicker from "../../../../Shared/ColorPicker.vue"
    import VueSlider from "vue-slider-component"

    export default {
        components: {
            ColorPicker,
            VueSlider,
        },
        data: function(){
            return {
                themes: [
                    {
                        color: "rgba(253,0,6,1)"
                    },{
                        color: "rgba(255,92,0,1)"
                    },{
                        color: "rgba(216,0,95,1)"
                    },{
                        color: "rgba(57,20,176,1)"
                    },{
                        color: "rgba(96,12,172,1)"
                    },{
                        color: "rgba(74,96,215,1)"
                    },

                    {
                        color: "rgba(0,204,0,1)"
                    },{
                        color: "rgba(0,166,124,1)"
                    },{
                        color: "rgba(132,233,0,1)"
                    },{
                        color: "rgba(255,182,0,1)"
                    },{
                        color: "rgba(166,118,0,1)"
                    },{
                        color: "rgba(164,0,4,1)"
                    }

                ],
            }
        },
        computed: {
            widget(){
                return this.$store.state.mb1.widget
            },
            btnColor: {
                get: function(){
                    return this.widget.color
                },
                set: function(newValue){
                    this.$store.commit("mb1/changeColor", newValue)
                }
            },
            xPosition: {
                get: function(){
                    return this.widget.xPosition
                },
                set: function(newValue){
                    this.$store.commit("mb1/changeXPosition", newValue)
                }
            },
            yPosition: {
                get: function(){
                    return this.widget.yPosition
                },
                set: function(newValue){
                    this.$store.commit("mb1/changeYPosition", newValue)
                }
            }
        },
        methods: {
            setTheme(theme){
                this.$store.commit("mb1/changeColor", theme.color)
            },
        }
    }
</script>

<style lang="stylus" scoped>
    .color-themes
        display grid
        grid-template-columns repeat(12, 1fr)
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
</style>