<template lang="pug">
    #menu-mobile
        #menu-mobile-btn(@click="isOpen = !isOpen"): i.fal.fa-bars
        ul.mmb-list(:class="{'open': isOpen}" @click="menuClicked")
            router-link.item(tag="li" to="/home/orders" exact-active-class="active"): a Заявки
            router-link.item(tag="li" to="/home/widgets" exact-active-class="active"): a Виджеты
            router-link.item(tag="li" to="/home/faq" exact-active-class="active"): a F.A.Q.
            router-link.item(tag="li" to="/home/antispam" exact-active-class="active"): a Антиспам
            router-link.item(tag="li" to="/home/feedback" exact-active-class="active"): a Написать мне
            li.item(@click="logout"): a Выйти
</template>

<script>
    export default {
        data: function(){
            return {
                isOpen: false
            }
        },
        methods: {
            menuClicked(e){
                if(e.target.tagName.match("A"))
                    this.isOpen = false
            },
            logout(){
                window.axios
                    .post("/logout")
                    .then(response => location.reload())
                    .catch(error => console.log(error))
            }
        }
    }
</script>

<style lang="stylus" scoped>
    #menu-mobile
        display flex
        @media(min-width: 647px)
            display none
    #menu-mobile-btn
        font-size 29px
        padding 10px
        display flex
        align-self center
        i
            display flex
            align-self center
    .mmb-list
        position fixed
        z-index 10
        left 0
        top 57px
        background #115d8e
        list-style-type: none
        height 100%
        width 300px
        transition transform .2s ease-out
        transform translate(calc(-100% - 5px))
        @media(max-width: 375px)
            width 100%
        &.open
            transform translate(0)

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