<template lang="pug">
    header#header
        #header_logo_bar
            h1#header_logo
                | CallBack
                span(style="font-weight:200")
                    | Service
            h2#header_tagline
                | Виджет обратного звонка
        profile-dropdown
        mobile-menu(style="grid-area: mobile-menu")
</template>

<script>
    import ProfileDropdown from "./ProfileDropdown.vue"
    import MobileMenu from "./MobileMenu.vue"

    export default {
        components: {
            ProfileDropdown,
            MobileMenu,
        }
    }
</script>

<style scoped lang="stylus">
    #header
        margin: 0 auto
        display: grid
        grid-template-columns 1fr auto
        justify-content space-between
        width 100%
        @media(min-width: 961px)
            width 940px
        @media(max-width: 646px)
            padding 0 10px
            grid-template-columns auto 1fr
            grid-template-areas "mobile-menu logo"
        @media(max-width: 960px)
            padding 0 10px

    #header_tagline
        font-size: 14

    #header_logo_bar
        padding: 5px 0
        @media(max-width: 646px)
            text-align right
            grid-area logo
            h1
                font-size 25px
</style>