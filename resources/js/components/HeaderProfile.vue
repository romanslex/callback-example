<template lang="pug">
    #header_profile_bar(@click="toggleWindow")
        #profile_bar-avatar
            i.fas.fa-user-circle
        #profile_bar-name
            | Roman
        #profile_bar-email
            | email@exapmle.com
        #profile_balance
            | Баланс: 15500 руб.
        #profile_bar-arrow
            i.fas.fa-caret-down
</template>

<script>
    export default {
        data: function(){
            return {
                isWindowOpen: false
            }
        },
        methods: {
            toggleWindow: function(){
                this.isWindowOpen = !this.isWindowOpen;
            },
        }
    }
</script>

<style scoped lang="stylus">
    #header_profile_bar
        position: relative
        padding-left: 10px
        padding-right: 10px
        display: grid
        grid-template-columns: auto 10px auto 10px auto
        grid-template-rows: 1fr 1fr 1fr
        grid-template-areas:\
            "img . name . arrow"\
            "img . email . arrow"\
            "img . balance . arrow"
        cursor: pointer
</style>
