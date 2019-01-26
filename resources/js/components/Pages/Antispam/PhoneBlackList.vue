<template lang="pug">
    #pbl
        masked-input(v-model="phone" placeholder="+7 (___) ___-__-__" mask="\\+\\7 (111) 111-11-11")
        .error-block(v-show="errors.length != 0")
            .error-item(v-for="error in errors" :key="error") {{error}}
        .add-phone-btn(@click="addPhone")
            i.fal.fa-plus-circle(style="font-size: 20px")
            span Добавить телефон

        h4(style="margin-top: 10px; font-weight: 400;") Черный список номеров
        #phone-list
            .phone-list-item(v-for="(blPhone, i) in blacklistPhones" :key="i")
                span {{blPhone.number}}
                i.far.fa-times-circle.del-phone(@click="removePhone(blPhone, i)")
            div(v-if="blacklistPhones.length < 1" style="font-size: 12px")
                | В списке нет ни одного телефона
</template>

<script>
    import MaskedInput from "vue-masked-input"

    export default {
        props: ["phones"],
        components: {
            MaskedInput
        },
        data: function(){
            return {
                phone: "",
                blacklistPhones: [],
                isBtnDisabled: false,
                errors: []
            }
        },
        created: function(){
            this.blacklistPhones = this.phones;
            console.log("created", this.blacklistPhones);
        },
        methods: {
            addPhone: function(){
                if(this.isBtnDisabled) return;
                this.isBtnDisabled = true;

                window.axios
                    .post("/data/black-phones", {number: this.phone})
                    .then(response => {
                        this.isBtnDisabled = false;
                        this.$notifySuccess("Телефон добавлен в список");
                        this.blacklistPhones.push(response.data);
                        this.phone = "";
                    })
                    .catch(error => {
                        this.$notifyDanger();
                        this.isBtnDisabled = false;
                        this.errors = error.response.data.errors.number;
                    })
            },
            removePhone: function(phone, i){
                axios
                    .delete("/data/black-phones/" + phone.id)
                    .then(response => {
                        this.blacklistPhones.splice(i, 1);
                    })
                    .catch(error => this.$notifyDanger())
            }
        }
    }
</script>

<style scoped lang="stylus">
    #pbl
        margin-top: 5px
    input
        height: 30px
        padding-left: 5px
        padding-right: 5px
        outline: none
        font-size: 16px
        width: 100%
        border: solid 1px #a9a9a9
        &:focus
            border: solid 1px #3497dc

    .add-phone-btn
        display: grid
        grid-template-columns: max-content max-content
        grid-gap: 5px
        color: #3497dc
        cursor: pointer
        width: max-content
        margin-top: 5px
        span
            align-self: center
            font-size: 14px

    #phone-list
        margin-top: 5px
        padding: 5px
        height:200px
        width: 100%
        border: 1px solid #a9a9a9
        overflow-y: auto
        overflow-x: hidden
    .phone-list-item
        margin-bottom: 5px
    .del-phone
        color: red
        cursor: pointer
        margin-left: 10px

    .error-block
        padding-top: 5px
    .error-item
        font-size: 12px
        color: red
        font-weight: 400
</style>