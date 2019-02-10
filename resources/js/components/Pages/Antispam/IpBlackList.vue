<template lang="pug">
    #ipbl
        input(type="text" placeholder="127.0.0.1" v-model="ip")
        .error-block(v-show="errors.length != 0")
            .error-item(v-for="error in errors" :key="error") {{error}}
        .add-ip-btn(@click="addIp")
            i.fal.fa-plus-circle(style="font-size: 20px")
            span Добавить ip

        h4(style="margin-top: 10px; font-weight: 400") Черный список ip
        #ip-list
            .ip-list-item(v-for="(ip, i) in ipBlackList" :key="ip.id")
                span {{ip.ip}}
                i.far.fa-times-circle.del-ip(@click="removeIp(ip, i)")
            div(v-if="ipBlackList.length < 1" style="font-size: 12px")
                | В списке нет ни одного IP адреса
</template>

<script>
    export default {
        data: function(){
            return {
                ip: "",
                errors: [],
                isBtnDisabled: false,
            }
        },
        methods:{
            addIp: function(){
                if(this.isBtnDisabled) return;
                this.isBtnDisabled = true;

                this.errors = [];
                window.axios
                    .post("/data/black-ip", {ip: this.ip})
                    .then(response => {
                        this.isBtnDisabled = false;
                        this.$notifySuccess("IP добавлен в список");
                        this.$store.dispatch("antispamPage/addIp", response.data);
                        this.ip = "";
                    })
                    .catch(error => {
                        this.isBtnDisabled = false;
                        this.$notifyDanger();
                        this.errors = error.response.data.errors.ip;
                    });
            },
            removeIp(ip, i){
                window.axios
                    .delete("/data/black-ip/" + ip.id)
                    .then(response => {
                        this.$store.dispatch("antispamPage/deleteIp", i)
                    })
                    .catch(error => this.$notifyDanger())
            },
            getInitState(){
                window.axios
                    .get("/data/black-ip")
                    .then(response => this.ipBlackList = response.data)
                    .catch(error => console.log(error))
            }
        },
        computed: {
            ipBlackList(){
                return this.$store.state.antispamPage.blackIps;
            }
        }
    }
</script>

<style scoped lang="stylus">
    #ipbl
        margin-top: 5px
    input
        height: 30px
        padding-left: 5px
        padding-right: 5px
        outline: none
        font-size: 16px
        width 100%
        max-width: 385px
        border: solid 1px #a9a9a9
        &:focus
            border: solid 1px #3497dc
    .add-ip-btn
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

    #ip-list
        margin-top: 5px
        padding: 5px
        height:200px
        max-width: 385px
        border: 1px solid #a9a9a9
        overflow-y: auto
        overflow-x: hidden
    .ip-list-item
        margin-bottom: 5px
    .del-ip
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