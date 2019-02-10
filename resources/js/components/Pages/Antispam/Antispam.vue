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
    import IpBlackList from "./IpBlackList.vue"
    import PhoneBlackList from "./PhoneBlackList.vue"

    export default {
        components: {
            IpBlackList,
            PhoneBlackList,
        },
        computed: {
            store: {
                get(){
                    return this.$store.state.antispamPage;
                }
            }
        },
        created(){
            if(!this.store.isAlreadyInitialized)
                this.$store.dispatch("antispamPage/loadData");
        },
    }
</script>

<style scoped lang="stylus">
    #antispam-content
        width 100%
        padding-top: 20px
        margin: 0 auto
        @media(min-width: 961px)
            width 940px
        @media(max-width: 960px)
            padding 20px 10px 0 10px
        h5
            font-weight: 300

    #blacklist-block
        margin-top: 10px
        display: grid
        grid-template-columns: max-content 1fr
        grid-gap: 70px
        line-height 1.5
        @media(max-width: 696px)
            font-size 14px
            grid-template-columns 1fr 1fr
            grid-gap 20px
        @media(max-width: 646px)
            grid-template-columns 1fr
            grid-gap 5px
</style>