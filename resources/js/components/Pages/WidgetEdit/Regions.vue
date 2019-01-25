<template lang="pug">
    div(v-click-outside="clearInputAndCloseResult")
        div(style="margin-bottom: 10px")
            rml-checkbox(text="Показывать во всех регионах" v-model="isDisplayedInAllRegions")
        #autocomplete
            input.autocomplete-input(
                type="text"
                placeholder="Введите регион"
                :disabled="isDisplayedInAllRegions === true"
                v-model="search"
                @input="onInput"
                @keyup.down="onArrowDown"
                @keyup.up="onArrowUp"
                @keyup.enter="onEnterUp"
                @keyup.esc="clearInputAndCloseResult"
            )
            .autocomplete-results(v-show="isOpened")
                .autocomplete-results-item(v-show="results.length === 0") Ничего не найдено
                .autocomplete-results-item(
                    v-for="(item, i) in results"
                    :key="item.uid"
                    :class="{'selected': i === arrowCounter}"
                    @click="onSelected(item)"
                ) {{item.name}}
        #region-block
            .region-block-item(
                v-for="region in selectedRegions"
                :key="region.id"
                :class="{'disabled': isDisplayedInAllRegions}"
                @click="remove(region)"
            )
                .rbi-city {{region.name}}
                .rbi-city
                    i.fal.fa-times-circle
</template>

<script>
    import ClickOutside from "vue-click-outside";
    import RmlCheckbox from "../../Shared/RmlCheckbox.vue";

    export default {
        components: {
            RmlCheckbox,
        },
        directives: {
            ClickOutside,
        },
        created: function(){
            this.initSelectedRegions();
        },
        data: function(){
            return {
                search: "",
                isOpened: false,
                arrowCounter: -1,

                regions: [
                    {uid: 1, name: 'Адыгея', 'code': 'AD'},
                    {uid: 2, name: 'Башкортостан','code': 'BA'},
                    {uid: 3, name: 'Бурятия','code': 'BU'},
                    {uid: 4, name: 'Алтай','code': 'AL'},
                    {uid: 5, name: 'Дагестан','code': 'DA'},
                    {uid: 6, name: 'Ингушетия','code': 'IN'},
                    {uid: 7, name: 'Кабардино-Балкария','code': 'KB'},
                    {uid: 8, name: 'Карачаево-Черкесия','code': 'KC'},
                    {uid: 9, name: 'Карелия','code': 'KR'},
                    {uid: 10, name: 'Коми','code': 'KO'},
                    {uid: 11, name: 'Марий Эл','code': 'ME'},
                    {uid: 12, name: 'Мордовия','code': 'MO'},
                    {uid: 13, name: 'Республика Саха (Якутия)','code': 'SA'},
                    {uid: 14, name: 'Северная Осетия','code': 'SE'},
                    {uid: 15, name: 'Татарстан','code': 'TA'},
                    {uid: 16, name: 'Тыва','code': 'AD'},
                    {uid: 17, name: 'Удмуртия','code': 'UD'},
                    {uid: 18, name: 'Хакасия','code': 'KK'},
                    {uid: 19, name: 'Чечня','code': 'CE'},
                    {uid: 20, name: 'Чувашия','code': 'CU'},
                    {uid: 21, name: 'Алтайский край','code': 'ALT'},
                    {uid: 22, name: 'Краснодарский край','code': 'KDA'},
                    {uid: 23, name: 'Красноярский край','code': 'KYA'},
                    {uid: 24, name: 'Приморский край','code': 'PRI'},
                    {uid: 25, name: 'Ставропольский край','code': 'STA'},
                    {uid: 26, name: 'Хабаровский край','code': 'KHA'},
                    {uid: 27, name: 'Амурская область','code': 'AMU'},
                    {uid: 28, name: 'Архангельская область','code': 'ARK'},
                    {uid: 29, name: 'Астраханская область','code': 'AST'},
                    {uid: 30, name: 'Белгородская область','code': 'BEL'},
                    {uid: 31, name: 'Брянская область','code': 'BRY'},
                    {uid: 32, name: 'Владимирская область','code': 'VLA'},
                    {uid: 33, name: 'Волгоградская область','code': 'VGG'},
                    {uid: 34, name: 'Вологодская область','code': 'VLG'},
                    {uid: 35, name: 'Воронежская область','code': 'VOR'},
                    {uid: 36, name: 'Ивановская область','code': 'IVA'},
                    {uid: 37, name: 'Иркутская область','code': 'IRK'},
                    {uid: 38, name: 'Калининградская область','code': 'KGD'},
                    {uid: 39, name: 'Калужская область','code': 'KLU'},
                    {uid: 40, name: 'Камчатский край','code': 'KAM'},
                    {uid: 41, name: 'Кемеровская область','code': 'KEM'},
                    {uid: 42, name: 'Кировская область','code': 'KIR'},
                    {uid: 43, name: 'Костромская область','code': 'KOS'},
                    {uid: 44, name: 'Курганская область','code': 'KGN'},
                    {uid: 45, name: 'Курская область','code': 'KRS'},
                    {uid: 46, name: 'Ленинградская область','code': 'LEN'},
                    {uid: 47, name: 'Липецкая область','code': 'LIP'},
                    {uid: 48, name: 'Магаданская область','code': 'MAG'},
                    {uid: 49, name: 'Московская область','code': 'MOW'},
                    {uid: 50, name: 'Мурманская область','code': 'MUR'},
                    {uid: 51, name: 'Нижегородская область','code': 'NIZ'},
                    {uid: 52, name: 'Новгородская область','code': 'NGR'},
                    {uid: 53, name: 'Новосибирская область','code': 'NVS'},
                    {uid: 54, name: 'Омская область','code': 'OMS'},
                    {uid: 55, name: 'Оренбургская область','code': 'ORE'},
                    {uid: 56, name: 'Орловская область','code': 'ORL'},
                    {uid: 57, name: 'Пензенская область','code': 'PNZ'},
                    {uid: 58, name: 'Пермский край','code': 'PER'},
                    {uid: 59, name: 'Псковская область','code': 'PSK'},
                    {uid: 60, name: 'Ростовская область','code': 'ROS'},
                    {uid: 61, name: 'Рязанская область','code': 'RYA'},
                    {uid: 62, name: 'Самарская область','code': 'SAM'},
                    {uid: 63, name: 'Саратовская область','code': 'SAR'},
                    {uid: 64, name: 'Сахалинская область','code': 'SAK'},
                    {uid: 65, name: 'Свердловская область','code': 'SVE'},
                    {uid: 66, name: 'Смоленская область','code': 'SMO'},
                    {uid: 67, name: 'Тамбовская область','code': 'TAM'},
                    {uid: 68, name: 'Тверская область','code': 'TVE'},
                    {uid: 69, name: 'Томская область','code': 'TOM'},
                    {uid: 70, name: 'Тульская область','code': 'TUL'},
                    {uid: 71, name: 'Тюменская область','code': 'TYU'},
                    {uid: 72, name: 'Ульяновская область','code': 'ULY'},
                    {uid: 73, name: 'Челябинская область','code': 'CHE'},
                    {uid: 74, name: 'Забайкальский край','code': 'ZAB'},
                    {uid: 75, name: 'Ярославская область','code': 'YAR'},
                    {uid: 76, name: 'Москва','code': 'MOW'},
                    {uid: 77, name: 'Санкт-Петербург','code': 'SPE'},
                    {uid: 78, name: 'Еврейская автономная область','code': 'YEV'},
                    {uid: 79, name: 'Ненецкий автономный округ','code': 'NEN'},
                    {uid: 80, name: 'Ханты-Мансийский автономный округ - Югра','code': 'KHM'},
                    {uid: 81, name: 'Ямало-Ненецкий автономный округ','code': 'YAN'},
                    {uid: 82, name: 'Республика Крым','code': 'AD'},
                    {uid: 83, name: 'Севастополь','code': 'AD'}
                ],
                results: []
            };
        },
        computed: {
            widgetId(){
                return this.$route.params.id;
            },
            widgetData(){
                return this.$store.getters['widgetEditPage/widgetData'](this.widgetId)
            },
            isDisplayedInAllRegions: {
                get: function(){
                    return this.widgetData.is_displayed_in_all_regions;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/setIsDisplayedInAllRegions", {
                        widgetId: this.widgetId,
                        value: newValue
                    });
                }
            },
            selectedRegions: {
                get: function(){
                    return this.widgetData.regions;
                },
                set: function(newValue){
                    this.$store.dispatch("widgetEditPage/setRegions", {widgetId: this.widgetId, value: newValue});
                }
            }
        },
        methods: {
            initSelectedRegions: function(){
                let oldSelectRegions = this.selectedRegions;
                this.selectedRegions = this.regions.filter(region => oldSelectRegions.find(i => i.name === region.name));
                this.selectedRegions.forEach(region => {
                    let oldItem = oldSelectRegions.find(i => i.name === region.name);
                    region.id = oldItem.id;
                    region.selected = true;
                });
            },
            onInput: function(){
                if(this.search.length === 0)
                    this.isOpened = false;
                else{
                    this.isOpened = true;
                    this.filterResults();
                }
            },
            filterResults: function(){
                this.results = this.regions
                    .filter(item => !item.selected)
                    .filter(item => item.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1);
            },
            onSelected: function(item){
                this.clearInputAndCloseResult();
                item.selected = true;
                this.$store.dispatch("widgetEditPage/addRegion", {widgetId: this.widgetId, value: item})
            },
            remove: function(item){
                if(this.isDisplayedInAllRegions) return;
                this.$store.dispatch("widgetEditPage/removeRegion", {widgetId: this.widgetId, value: item});
                item.selected = false;
            },
            clearInputAndCloseResult: function(){
                this.search = "";
                this.isOpened = false;
                this.arrowCounter = -1;
            },
            onArrowDown: function(){
                if(this.arrowCounter < this.results.length && this.isOpened)
                    this.arrowCounter = this.arrowCounter + 1;
            },
            onArrowUp: function(){
                if(this.arrowCounter > 0 && this.isOpened)
                    this.arrowCounter = this.arrowCounter - 1;
            },
            onEnterUp: function(){
                try{
                    this.results[this.arrowCounter].selected = true;
                    this.$store.dispatch("widgetEditPage/addRegion", {
                        widgetId: this.widgetId,
                        value: this.results[this.arrowCounter]
                    });
                    this.clearInputAndCloseResult();
                }catch(e){}
            },
        }
    }
</script>

<style scoped lang="stylus">
    #autocomplete
        position: relative

    .autocomplete-input
        border: 1px solid darkgray
        outline: none
        height: 30px
        font-size: 14p
        padding: 0 5px
        width: 400px
        &:disabled
            opacity: 0.3
            cursor: not-allowed

    .autocomplete-results
        position: absolute
        border: 1px solid darkgray
        border-top: none
        background: white
        width: 400px
        max-height: 300px
        overflow-y: auto
        overflow-x: hidden
    .autocomplete-results-item
        font-size: 14px
        padding: 3px 5px
        cursor: pointer
        &:hover, &.selected
            background: #3497dc
            color: white

    #region-block
        padding-top: 5px
        &:after
            content: ""
            display: block
            clear: both

    .region-block-item
        background: #105d8d
        padding: 5px
        width: max-content
        color: white
        font-size: 13px
        margin-right: 5px
        margin-bottom: 5px
        float: left
        display: grid
        grid-template-columns: max-content max-content
        grid-gap: 5px
        cursor: pointer
        &:hover
            background: #3497dc
        &.disabled
            cursor: not-allowed
    .rbi-reset
        padding-top: 1px
</style>
