<template lang="pug">
    .widget-delete
        i.far.fa-trash-alt(@click="isVisible = true")
        .del-confirm-overlay(v-if="isVisible" @click="isVisible = false")
        .del-confirm-modal(v-if="isVisible" :class="{'shown-modal': isVisible}")
            .q-block
                div Точно хотите удалить сайт
                div {{url}}?
            .action-block
                button.ok-btn(@click="remove") Удалить
                button.cancel-btn(@click="isVisible = false") Отмена
</template>

<script>
    export default {
        props: ["wid", "url"],
        data: function(){
            return {
                isVisible: false,
            }
        },
        methods: {
            remove: function(){
                window.axios
                    .delete("/data/widgets/" + this.wid)
                    .then(response => this.$emit("widget-deleted"))
                    .catch(error => console.log("error"));
            }
        }
    }
</script>

<style scoped lang="stylus">
    .widget-delete
        position: relative
        i
            color: #ff0000
            cursor: pointer
            grid-area: del
            align-self: center
    .del-confirm-overlay
        position: fixed
        height: 100%
        width: 100%
        top: 0
        left: 0
        background: rgba(0, 0, 0, 0.5)
        z-index: 1

    .del-confirm-modal
        width: 210px
        position: absolute
        top: 0px
        left: -90px
        background: white
        z-index: 2
        transform: translate(-50%, 0)
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5)
        padding: 15px
        transition: transform 0.3s ease-out
    .shown-modal
        transform: translate(-50%, 25%)

    .q-block
        font-size: 14px
        color: black
    .action-block
        display: grid
        grid-template-columns: 1fr 1fr
        grid-gap: 10px
        margin-top: 10px
    button
        text-transform: uppercase
        width: 100%
        display: block
        padding: 6px 15px
        font-size: 14px
        font-weight: 400
        cursor: pointer
        transition: box-shadow 0.15s ease-out
        border: none
        outline: none
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33)
        color: white
    .ok-btn
        font-size: 11px
        background: #ab353f
        &:hover
            background: #ab353f
            box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.38)
    .cancel-btn
        font-size: 11px
        background: #ab353f
        &:hover
            background: #ab353f
            box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.38)
</style>