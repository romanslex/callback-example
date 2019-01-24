<template lang="pug">
    div
        .add-phone(v-for="(phone, index) in phones" :key="index")
            masked-input(
                placeholder="+7 (___) ___-__-__"
                v-model="phone.value"
                :disabled="!isSmsNotifyEnabled"
                mask="\\+\\7 (111) 111-11-11"
            )
            i.far.fa-times-circle.del-phone(@click="remove(index)" :class="{'disabled': !isSmsNotifyEnabled}" v-if="index != 0")
            .fake-del-phone(v-if="index === 0")
        .add-phone-btn(@click="addPhone" :class="{'disabled': !isSmsNotifyEnabled}")
            i.fal.fa-plus-circle(style="font-size: 20px")
            span Добавить телефон
</template>

<script>
    import MaskedInput from "vue-masked-input"

    export default {
        components: {MaskedInput},
        methods: {
            addPhone: function(){
                if(!this.isSmsNotifyEnabled) return;
                this.$store.dispatch("widgetEditPage/addPhone", this.widgetId);
            },
            remove: function(index){
                if(!this.isSmsNotifyEnabled) return;
                this.$store.dispatch("widgetEditPage/removePhone", {widgetId: this.widgetId, value: index});
            }
        },
        computed: {
            widgetId: {
                get(){
                    return this.$route.params.id
                }
            },
            widgetData: {
                get(){
                    return this.$store.getters['widgetEditPage/widgetData'](this.widgetId)
                }
            },
            phones: {
                get(){
                    return this.widgetData.phones;
                }
            },
            isSmsNotifyEnabled: {
                get(){
                    return this.widgetData.is_sms_notify_enabled;
                }
            }
        },
        created: function(){
            if(this.phones.length === 0)
                this.$store.dispatch("widgetEditPage/addPhone", this.widgetId);
        }
    }
</script>

<style scoped lang="stylus">
    input
        height: 30px
        padding-left: 5px
        padding-right: 5px
        outline: none
        font-size: 14px
        width: 250px
    .add-phone-btn
        display: grid
        grid-template-columns: max-content max-content
        grid-gap: 5px
        color: #3497dc
        margin-top: 10px
        cursor: pointer
        width: max-content
        span
            align-self: center
            font-size: 14px

    .add-phone
        display: grid
        grid-template-columns: max-content max-content
        grid-column-gap: 5px
        margin-top: 10px
    .del-phone
        font-size: 21px
        align-self: center
        color: red
        cursor: pointer
    input:disabled
        opacity: 0.3
        cursor: not-allowed
    .disabled
        opacity: .3
        cursor: not-allowed
</style>