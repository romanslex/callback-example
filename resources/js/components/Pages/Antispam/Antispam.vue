<template lang="pug">
    #antispam-content
        h3  Антиспам
        #blacklist-block
            div
                h5  Добавить телефон в черный список
                phone-black-list(:phones="[]")
            div
                h5 Добавить IP в черный список
                ip-black-list(:ips="[]")
</template>

<script>
    import IpBlackList from "./IpBlackListt.vue"
    import PhoneBlackList from "./PhoneBlackList.vue"

    export default {
        components: {
            IpBlackList,
            PhoneBlackList,
        }
    }
</script>

<style scoped lang="stylus">
    #antispam-content
        padding-top: 20px
        width: 940px
        margin: 0 auto
        h5
            font-weight: 300

    #blacklist-block
        margin-top: 10px
        display: grid
        grid-template-columns: max-content 1fr
        grid-gap: 70px
</style>