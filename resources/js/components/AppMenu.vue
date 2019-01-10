<template lang="pug">
    #menu-block
        #menu
            ul
                router-link.item(tag="li" to="/home/orders" exact-active-class="active"): a Заявки
                router-link.item(tag="li" to="/home/widgets" exact-active-class="active"): a Виджеты
                router-link.item(tag="li" to="/home/faq" exact-active-class="active"): a F.A.Q.
                router-link.item(tag="li" to="/home/antispam" exact-active-class="active"): a Антиспам
                router-link.item(tag="li" to="/home/feedback" exact-active-class="active"): a Написать мне
</template>

<script>
    export default {

    }
</script>

<style lang="stylus">
    #menu-block
        background: rgb(17, 93, 142)
    #menu
        width: 940px
        margin: 0 auto

        ul
            list-style-type: none
            display: grid
            grid-template-columns: max-content max-content max-content max-content max-content auto

            li.item
                align-self: center

                &.active, &:hover
                    background: rgb(52, 151, 220)

                a
                    height: 40px
                    display: block
                    color: #fff
                    text-decoration: none
                    padding: 10px 30px 0 30px
                    text-align: center
</style>