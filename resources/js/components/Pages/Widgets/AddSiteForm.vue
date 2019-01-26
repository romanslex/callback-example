<template lang="pug">
    #cw-form
        input.cw-input(
            @change="change"
            :class="{'cw-error-border': isError}"
            v-model="url" type="text"
            placeholder="example.com"
            autocomplete="off"
        )
        .cw-form-btn(@click="create")
            i.fal.fa-plus-circle.cw-form-ico
            .cw-form-text Добавить сайт
        .cw-error-block(v-show="isError")
            .cw-error-item(v-for="error in errors" :key="error") {{error}}
</template>

<script>
    export default{
        data: function(){
            return {
                url: "",
                isError: false,
                errors: []
            }
        },
        methods: {
            create: function(){
                window.axios
                    .post("/data/widgets", {
                        url: this.url
                    })
                    .then(response => {
                        this.$store.dispatch("widgetsPage/addWidget", response.data);
                        this.$router.push("/home/widgets/" + response.data.id + "/edit");
                    })
                    .catch(error => {
                        console.log(error.response);
                        this.isError = true;
                        switch(error.response.status){
                            case 422:
                                this.errors = error.response.data.errors.url;
                                break;
                            default:
                                this.errors = ["На сервере произошла ошибка. Повторите позже"]
                        }
                    });
            },
            change: function(){
                this.isError = false;
            }
        }
    }
</script>

<style scoped lang="stylus">
    #cw-form
        margin-top: 10px
        display: grid
        grid-template-columns: 300px max-content
        grid-gap: 5px

    .cw-input
        font-size: 14px
        padding: 5px
        outline: none
        height: 30px
        border: solid 1px #a9a9a9
        &:focus
            border: solid 1px #3497dc

    .cw-form-btn
        width: 100%
        cursor: pointer
        display: grid
        grid-template-columns: max-content max-content
        grid-gap: 5px
        border: none
        background: transparent
    .cw-form-ico
        color: #3497dc
        font-size: 25px
        margin-left: 5px
        align-self: center
    .cw-form-text
        align-self: center
        color: #3497dc
    .cw-error-block
        color: red
        font-size: 11px
</style>