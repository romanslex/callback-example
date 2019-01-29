<template lang="pug">
    #header_profile_bar(
        @click="toggleWindow"
        :class="{ hover: isWindowOpen }"
        v-click-outside="hide"
    )
        #profile_bar-avatar
            i.fas.fa-user-circle
        #profile_bar-name
            | {{user.name | truncate(50)}}
        #profile_bar-email
            | {{user.email | truncate(30)}}
        #profile_balance
            | Баланс: {{formattedBalance}} руб.
        #profile_bar-arrow
            i.fas.fa-caret-down
        #profile_dropdown(v-show="isWindowOpen")
            ul
                router-link(to="/home/balance" tag="li"): a
                    i.fas.fa-ruble-sign
                    | Пополнить баланс
                router-link(to="/home/feedback" tag="li"): a
                    i.fas.fa-envelope
                    | Тех. поддержка
                router-link(to="/home/settings" tag="li"): a
                    i.fas.fa-cog
                    | Настройки
                <!--router-link(to="/home/logout" tag="li"): a-->
                li(@click="logout"): a
                    i.fas.fa-power-off
                    | Выйти

</template>

<script>
    import ClickOutside from 'vue-click-outside'

    export default {
        directives: {
            ClickOutside,
        },
        data: function(){
            return {
                isWindowOpen: false
            }
        },
        computed: {
            user(){
                console.log(this.$store.state.user);
                return this.$store.state.user
            },
            formattedBalance(){
                let remainder = this.user.total.length % 3;
                return (this.user.total.substr(0, remainder) + this.user.total.substr(remainder).replace(/(\d{3})/g, ' $1')).trim();
            }
        },
        methods: {
            toggleWindow: function(){
                this.isWindowOpen = !this.isWindowOpen;
            },
            hide: function(){
                this.isWindowOpen = false;
            },
            logout(){
                window.axios
                    .post("/logout")
                    .then(response => location.reload())
                    .catch(error => console.log(error))
            }
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

        &.hover
            background-color: #f5f5f5

    #profile_bar-avatar
        grid-area: img
        i
            position: relative
            top: 50%
            font-size: 33px
            transform: translate(0, -50%)
            color: rgb(17, 93, 142)

    #profile_bar-name
        font-size: 12px
        grid-area: name
        align-self: end

    #profile_bar-email
        grid-area: email
        align-self: center
        font-size: 12px

    #profile_balance
        grid-area: balance
        font-size: 12px

    #profile_bar-arrow
        grid-area: arrow
        i
            position: relative
            top: 50%
            font-size: 15px
            transform: translate(0, -50%)
            color: rgba(0, 0, 0, 0.3)

    #profile_dropdown
        background: white
        position: absolute
        z-index: 2
        top: 65px
        right: 0
        width: 200px
        box-shadow: 0 6px 12px rgba(0,0,0,.175)
        border-radius: 2px
        border-top: solid 4px #3498db

        ul
            list-style: none
            &:after
                content: ""
                position: absolute
                width: 0
                height: 0
                border-color: transparent
                border-style: solid
                right: 11px
                bottom: 100%
                border-width: 0 10px 8px
                border-bottom-color: #3498db

            li
                position: relative
                display: block
                margin-bottom: -1px
                background-color: #ffffff
                border: 1px solid #e7e7e7
                color: #666666

                &:hover
                    background-color: #f5f5f5

                a
                    font-size: 13px
                    clear: both
                    color: #666666
                    font-weight: normal
                    line-height: 1.49
                    white-space: nowrap
                    text-decoration: none
                    padding: 10px 15px
                    display: block

                i
                    color: #666666
                    font-size: 11px
                    margin-right: 5px
</style>
