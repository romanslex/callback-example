<template lang="pug">
    #settings-content
        h3 Настройки профиля

        #settings
            div
                h4 Редактировать информацию
                h5 Ваше имя
                input(type="text" v-model="name")
                .error-block(v-show="profileErrors.name.length != 0")
                    .error-item(v-for="error in profileErrors.name" :key="error") {{error}}
                h5 Ваш телефон
                masked-input(name="phone" placeholder="+7 (___) ___-__-__" v-model="phone" mask="\\+\\7 (111) 111-11-11")
                h5 Ваш email
                input(v-model="email" type="text" disabled=true)
                #en-block
                    rml-checkbox(text="Получать уведомления по Email?" v-model="isEmailNotificationEnabled")
                button.btn(@click="saveProfileData") Сохранить изменения

            div
                div
                    h4 Сменить пароль
                    h5 Введите текущий пароль
                    input(type="password" v-model="currentPassword" placeholder="*********")
                    .error-block(v-show="passErrors.current_password.length != 0")
                        .error-item(v-for="error in passErrors.current_password" :key="error") {{error}}

                    h5 Введите новый пароль
                    input(type="password" v-model="newPassword" placeholder="*********")
                    .error-block(v-show="passErrors.new_password.length != 0")
                        .error-item(v-for="error in passErrors.new_password" :key="error") {{error}}

                    h5 Введите новый пароль еще раз
                    input(type="password" v-model="newPasswordConfirmation" placeholder="*********")
                button.btn(@click="changePassword" style="margin-top: 37px;") Изменить пароль

</template>

<script>
    import RmlCheckbox from "../Shared/RmlCheckbox.vue"
    import MaskedInput from "vue-masked-input"

    export default {
        components: {
            RmlCheckbox,
            MaskedInput,
        },
        data: function(){
            return {
                name: "",
                email: "",
                phone: "",
                isEmailNotificationEnabled: true,

                currentPassword: "",
                newPassword: "",
                newPasswordConfirmation: "",

                profileErrors: {
                    name: []
                },
                passErrors: {
                    current_password: [],
                    new_password: []
                }
            }
        },
        created: function(){
            this.init();
        },
        methods: {
            init: function(){
                this.name = this.user.name;
                this.email = this.user.email;
                this.phone = this.user.phone;
                this.isEmailNotificationEnabled = this.user.take_email_notifications;
            },
            saveProfileData: function(){
                this.profileErrors.name = [];
                axios
                    .put("/home/settings", {
                        name: this.name,
                        phone: this.phone,
                        take_email_notifications: this.isEmailNotificationEnabled
                    })
                    .then(response => this.$notifySuccess())
                    .catch(error => {
                        this.profileErrors = error.response.data.errors;
                        this.$notifyDanger()
                    })
            },
            changePassword: function(){
                this.passErrors.new_password = [];
                this.passErrors.current_password = [];
                axios
                    .put("/data/settings/change-password", {
                        current_password: this.currentPassword,
                        new_password: this.newPassword,
                        new_password_confirmation: this.newPasswordConfirmation
                    })
                    .then(response => this.$notifySuccess())
                    .catch(error => {
                        this.$notifyDanger()
                        this.passErrors.current_password = error.response.data.errors.current_password || [];
                        this.passErrors.new_password = error.response.data.errors.new_password || [];
                    })
            }
        },
        computed: {
            user(){
                return this.$store.state.user
            }
        }
    }
</script>

<style scoped lang="stylus">
    #settings-content
        padding-top: 20px
        width: 940px
        margin: 0 auto
    #settings
        display: grid
        grid-template-columns: max-content max-content
        grid-gap: 80px
    h4
        margin-top: 10px
        font-size: 15px
        font-weight: 400
        margin-bottom: 5px
    h5
        margin-top: 10px
        font-size: 14px
        margin-bottom: 5px
        font-weight: 300
    input
        height: 30px
        padding-left: 5px
        padding-right: 5px
        outline: none
        font-size: 14px
        width: 240px
        border: solid 1px #a9a9a9
        &:focus
            border: solid 1px #3497dc

    #en-block
        margin-top: 10px
        >>>span
            font-size: 14px
            padding-left: 25px
        >>>span.checkbox-text:before
            width: 12px
            height: 12px
        >>>input.checkbox-input:checked ~ .checkbox-text:before
            width: 12px
            height: 8px
    .btn
        margin-top: 10px
        font-size: 12px
        padding: 8px 15px
        background: #49af60
        width: max-content
        border: none
        color: white
        cursor: pointer
        text-transform: uppercase
        outline: none
        transition: box-shadow 0.15s ease-out, background-color .1s ease-out
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33)
        &:hover
            box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.38)
        &:active
            background: darken(#49af60, 15%)

    .error-block
        padding-top: 5px
    .error-item
        font-size: 12px
        color: red
        font-weight: 400
</style>