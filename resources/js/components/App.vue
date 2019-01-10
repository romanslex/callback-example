<template lang="pug">
    #app
        app-header
        #menu
        #content
        footer
</template>

<script>
    import AppHeader from "./AppHeader.vue"

    export default {
        components: {
            AppHeader,
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped lang="stylus">
    @import url(https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese);
    #app
        font-family: 'Roboto', sans-serif;
</style>

<style lang="stylus">
    h1
        font-weight: 400
</style>