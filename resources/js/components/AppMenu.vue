<template lang="pug">
    #menu-block
        #menu
            ul
                li.item: a(href="/home/orders") Заявки
                li.item: a(href="/home/widgets") Виджеты
                li.item: a(href="/home/faq") F.A.Q.
                li.item: a(href="/home/antispam") Антиспам
                li.item: a(href="/home/feedback") Написать мне
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