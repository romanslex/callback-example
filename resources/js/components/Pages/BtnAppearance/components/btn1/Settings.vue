<template lang="pug">
    .settings-btn-1
        h4 Темы
        .color-themes
            .color-themes-item(v-for='(theme, i) in themes', :key='i', @click='setTheme(theme)')
                .cti-fake
                .cti-real(:style='{background: theme.btn}')
        h4(style='margin-top: 10px') Цвет кнопки
        color-picker(v-model='btnColor')
        h4(style='margin-top: 10px') Цвет волны
        color-picker(v-model='waveColor')
        h4(style='margin-top: 10px') Положение по горизонтали
        vue-slider(v-model='xPosition', tooltip='hover')
        h4(style='margin-top: 10px') Положение по вертикали
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
                        btn: "rgba(59, 175, 218, 1)",
                        wave: "rgba(59, 175, 218, 1)"
                    },{
                        btn: "rgba(233, 87, 63, 1)",
                        wave: "rgba(233, 87, 63, 1)"
                    },{
                        btn: "rgba(246, 187, 66, 1)",
                        wave: "rgba(246, 187, 66, 1)"
                    },{
                        btn: "rgba(52, 152, 219, 1)",
                        wave: "rgba(52, 152, 219, 1)"
                    },{
                        btn: "rgba(112, 202, 99, 1)",
                        wave: "rgba(112, 202, 99, 1)"
                    },{
                        btn: "rgba(106, 30, 52, 1)",
                        wave: "rgba(106, 30, 52, 1)"
                    },
                ],
            }
        },
        methods: {
            setTheme: function(theme){
                this.btnColor = theme.btn;
                this.waveColor = theme.wave;
            },
        },
        computed: {
            btn(){
                return this.$store.state.b1;
            },
            btnColor: {
                get: function(){
                    return this.btn.btnColor;
                },
                set: function(newValue){
                    this.$store.commit("b1/changeBtnColor", newValue)
                }
            },
            waveColor: {
                get: function(){
                    return this.btn.waveColor;
                },
                set: function(newValue){
                    this.$store.commit("b1/changeWaveColor", newValue)
                }
            },
            xPosition: {
                get: function(){
                    return 100 - this.btn.xPosition
                },
                set: function(newValue){
                    this.$store.commit("b1/changeXPosition", 100 - newValue)
                }
            },
            yPosition: {
                get: function(){
                    return this.btn.yPosition
                },
                set: function(newValue){
                    this.$store.commit("b1/changeYPosition", newValue)
                }
            },
            position: {
                get: function(){
                    return this.btn.position;
                },
                set: function(newValue){
                    this.$store.commit("b1/changePosition", newValue)
                }
            }
        },
        watch: {
            btnColor(newValue){
                this.waveColor = newValue;
            },
        }
    }
</script>

<style lang="stylus" scoped>
    .color-themes
        display grid
        grid-template-columns repeat(6, 1fr)
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