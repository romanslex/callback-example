<template lang="pug">
    div
        .add-email(v-for="(email, index) in emails" :key="email.value")
            input.email(v-model="email.value" type="text" placeholder="email@example.com" :disabled="!isEmailNotifyEnabled")
            i.far.fa-times-circle.del-email(@click="remove(index)" :class="{'disabled': !isEmailNotifyEnabled}" v-if="index != 0")
            .fake-del-email(v-if="index == 0")
        .add-email-btn(@click="addEmail" :class="{'disabled': !isEmailNotifyEnabled}")
            i.fal.fa-plus-circle(style="font-size: 20px")
            span Добавить email
</template>

<script>
    export default {
        data: function(){
            return {
            };
        },
        methods: {
            addEmail: function(){
                if(!this.isEmailNotifyEnabled) return;
                this.$store.dispatch("addEmail");
            },
            remove: function(index){
                if(!this.isEmailNotifyEnabled) return;
                this.$store.dispatch("removeEmail", index);
            }
        },
        computed: {
            widgetId: {
                get(){
                    return this.$route.params.id;
                }
            },
            widgetData: {
                get(){
                    return this.$store.getters['widgetEditPage/widgetData'](this.widgetId)
                }
            },
            emails: {
                get(){
                    return this.widgetData.emails;
                }
            },
            isEmailNotifyEnabled: {
                get(){
                    return this.widgetData.is_email_notify_enabled;
                }
            }
        },
        created: function(){
            if(this.emails.length === 0)
                this.$store.dispatch("addEmail");
        }
    }
</script>

<style scoped lang="stylus">
    .email
        height: 30px
        padding-left: 5px
        padding-right: 5px
        outline: none
        font-size: 14px
        width: 250px
    .add-email-btn
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

    .add-email
        display: grid
        grid-template-columns: max-content max-content
        grid-column-gap: 5px
        margin-top: 10px

    .del-email
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
