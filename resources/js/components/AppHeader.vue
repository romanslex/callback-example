<template lang="pug">
    header#header
        #header_logo_bar
            h1#header_logo
                | CallBack
                span(style="font-weight:200")
                    | Service
        header-profile
</template>

<script>
    import HeaderProfile from "./HeaderProfile.vue"

    export default {
        components: {
            HeaderProfile,
        }
    }
</script>

<style scoped lang="stylus">
    #header
        width: 940px
        margin: 0 auto
</style>