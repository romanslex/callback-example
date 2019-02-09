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
</template>

<script>
    import ProfileDropdown from "./ProfileDropdown.vue"

    export default {
        components: {
            ProfileDropdown,
        }
    }
</script>

<style scoped lang="stylus">
    #header
        margin: 0 auto
        display: grid
        grid-template-columns: 1fr auto
        @media(min-width: 940px)
            width 940px

    #header_tagline
        font-size: 14

    #header_logo_bar
        padding: 5px 0
</style>