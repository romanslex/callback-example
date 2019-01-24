<template lang="pug">
    div
        h3(style="margin-top: 20px; margin-bottom: 10px") Настройки внешнего вида
        div(style="margin-bottom: 5px; width: max-content;")
            a(:href="btnAppearanceLink" target="_blank" style="text-decoration:none;")
                .appearance-settings-btn
                    i.fal.fa-cog(style="font-size:22px")
                    span(style="align-self: center") Настроить кнопку
        div(style="margin-bottom: 5px; width: max-content")
            a(:href="windowAppearanceLink" target="_blank" style="text-decoration:none")
                .appearance-settings-btn
                    i.fal.fa-cog(style="font-size:22px")
                    span(style="align-self: center") Настроить окно
        div(style="width: max-content")
            a(:href="mobileLink" target="_blank" style="text-decoration:none")
                .appearance-settings-btn
                    i.fal.fa-cog(style="font-size:22px")
                    span(style="align-self: center") Настроить мобильную версию
        h3(style="margin-top: 20px; margin-bottom: 10px;") Настройки показа
        .rc-margin
            rml-checkbox(text="Показывать виджет в нерабочее время" v-model="isDisplayedDuringNotWorkingHours")
        .rc-margin(style="grid-template-columns: repeat(2, max-content); grid-gap: 5px;")
            rml-checkbox(text="Ловить посетителя на выходе" v-model="isCatchEnabled")
            helper(:width="400")
                h1 Ловить посетителя на выходе
                p Если включите эту настройку, виджет будет показывать окно посетителю, при попытке покинуть сайт.
        .rc-margin
            div(style="display:grid; grid-template-columns: repeat(4, max-content); grid-gap: 5px")
                rml-checkbox(text="Автоматически показывать окно через" v-model="isAutodisplayEnabled")
                input.rc-number-picker(type="number" min="5" max="60" v-model="autodisplayDelay" @input="inputAutodisaplayDelay")
                span сек.
                helper(:width="400")
                    h1 Автопоказ окна
                    p Задайте интервал, через который посетителю будет показано окно автоматически
        div(style="display: grid; grid-template-columns: repeat(2, max-content); grid-gap: 5px;margin-top: 20px; margin-bottom: 10px;")
            h3 По регионам
            helper(:width="400")
                h1 Фильтр по регионам
                p Геофильтр – это определение географического местоположения интернет-пользователя, он срабатывает по IP-адресу.
                p
                    | Часто бывает так, что реальное местоположение устройства и его IP-адрес не совпадают, особенно с мобильного интернета.
                    |  В связи, что IP-адрес не всегда точно идентифицирует положение посетителя, лучше не включать геофильтр, чтобы не
                    |  «отрезать» целевой трафик от обратного звонка. Включать геофильтр нужно в случаях, если
                    | получаете нецелевые звонки с других регионов.
                p
                    | Вы можете проверить, какое месторасположение определяет Ваше устройство.
                    | Для этого зайдите, пожалуйста, на сайт sypexgeo.net со своего устройства, используя мобильный интернет.
        regions
</template>

<script>
    import Regions from "./Regions.vue"
    import RmlCheckbox from "../../Shared/RmlCheckbox.vue";
    import Helper from "../../Shared/Helper.vue";

    export default {
        components: {
            RmlCheckbox,
            Regions,
            Helper,
        },
        computed: {
            widgetId(){
                return this.$route.params.id;
            },
            widgetData(){
                return this.$store.getters['widgetEditPage/widgetData'](this.widgetId)
            },
            windowAppearanceLink(){
                return "/home/window-appearance/" + this.widgetId;
            },
            btnAppearanceLink(){
                return "/home/btn-appearance/" + this.widgetId;
            },
            mobileLink(){
                return "/home/mobile-appearance/" + this.widgetId
            },
            isDisplayedDuringNotWorkingHours: {
                get: function(){
                    return this.widgetData.is_displayed_during_not_working_hours;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/setIsDisplayedDuringNotWorkingHours", {
                        widgetId: this.widgetId,
                        value: newValue
                    });
                }
            },
            isCatchEnabled: {
                get: function(){
                    return this.widgetData.is_catch_enabled;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/setIsCatchEnabled", {widgetId: this.widgetId, value: newValue});
                }
            },
            isAutodisplayEnabled: {
                get: function(){
                    return this.widgetData.is_autodisplay_enabled;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/setAutodisplayEnabled", {
                        widgetId: this.widgetId,
                        value: newValue
                    });
                }
            },
            autodisplayDelay: {
                get: function(){
                    return this.widgetData.autodisplay_delay;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/setAutodisplayDelay", {widgetId: this.widgetId, value: newValue});
                }
            }
        },
        methods: {
            inputAutodisaplayDelay: function(){
                if(this.autodisplayDelay < 5)
                    this.autodisplayDelay = 5;
                if(this.autodisplayDelay > 60)
                    this.autodisplayDelay = 60;
            }
        }
    }
</script>

<style scoped lang="stylus">
    .appearance-settings-btn
        display: grid
        grid-template-columns: max-content max-content
        grid-gap: 5px
        font-size: 16px
        color: #3497dc
        cursor: pointer
        width: max-content
    .btn
        font-size: 14px
        padding: 5px 15px
    .rc-margin
        display: grid
        margin: 5px 0
        height: 25px
        align-content: center
    .rc-number-picker
        width: 50px
        text-align: right
        outline: none
</style>
