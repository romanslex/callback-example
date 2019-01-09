<template>
    <div id="app">
        <header id="header">
            <div id="header_logo_bar">
                <h1 id="header_logo">LeadMe<span style="font-weight: 200">Back</span></h1>
                <h2 id="header_tagline">Виджет обратного звонка</h2>
            </div>
            <div id="header_profile_bar">

            </div>
        </header>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped lang="stylus">
    #app
        width: 1000px
        margin: 0 auto
    h1
        color: red
</style>