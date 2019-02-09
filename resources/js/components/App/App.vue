<template lang="pug">
    #app
        app-header
        app-menu
        router-view
        footer
</template>

<script>
    import AppHeader from "../AppHeader.vue"
    import AppMenu from "../AppMenu.vue"

    export default {
        components: {
            AppHeader,
            AppMenu,
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
    *
        font-weight: 300
</style>

<style lang="less">
    @import "./font-awesome/less/fontawesome.less";
    @import "./font-awesome/less/fa-brands.less";
    @import "./font-awesome/less/fa-light.less";
    @import "./font-awesome/less/fa-regular.less";
    @import "./font-awesome/less/fa-solid.less";
</style>

<style lang="stylus">
    h1, h2, h3
        font-weight: 400
    #app
        display flex
        flex-direction column
    footer
        height 25px
</style>