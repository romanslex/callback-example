<template lang="pug">
    #app
        #header
            #header_logo_bar
                h1#header_logo
                    | Callback
                    span(style="font-weight:200")
                        | Service
            header-profile
</template>

<script>
    import HeaderProfile from "./HeaderProfile.vue"

    export default {
        components: {
            HeaderProfile,
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped lang="stylus">
    #app
        width: 1000px
        margin: 0 auto
</style>