<template>
    <div class="modal-container">
        <div class="modal-window">
            <div class="model-header">
                <h1>Добавление работника</h1>
                <i class="fa-solid fa-circle-xmark" @click="$emit('closeModal')"></i>
            </div>
            <input placeholder="ФИО" v-model="fio">
            <input placeholder="Логин" v-model="login">
            <input placeholder="Пароль" v-model="password">
            <select v-model="selected">
                <option disabled value="">Выберите отделение</option>
                <option  v-for="item in departments" :key="item.addressName" :value="item.id" >{{item.address}}</option>
            </select>
            <div class="button" @click="onCreate">Создать</div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['departments', 'defaultDepartment'],
    name: "CreateWorkerModalWindow",
    inject: ["apiUrl"],
    data() {
        return {
            fio: "",
            login: "",
            password: this.randomString(12),
            selected: "",
        }
    },
    mounted() {
        if (this.defaultDepartment !== undefined){
            this.selected = this.defaultDepartment.idDepartment
        }
    },
    methods: {
        onCreate() {

            this.axios.post(
                this.apiUrl + "worker",
                {
                    fio: this.fio,
                    login: this.login,
                    password: this.password,
                    idDepartment: this.selected
                },
                {
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                }
            ).then((response) => {
                console.log(response.data)
                this.toast.success("Новый работник добавлен!", 2000)
                this.$emit('newDepartment')
                this.addressName = ""
            })
            this.$emit('closeModal')
        }
    }
}
</script>

<style scoped>

</style>