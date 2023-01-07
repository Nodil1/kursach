<template>
    <div class="modal-container">
        <div class="modal-window">
            <div class="model-header">
                <h1>Регистрация клиента</h1>
                <i class="fa-solid fa-circle-xmark" @click="$emit('closeModal')"></i>
            </div>
            <p>ФИО</p>
            <input placeholder="ФИО" v-model="fio">
            <p>Серия паспорта</p>
            <input placeholder="1714" v-model="serial">
            <p>Номер паспорта</p>
            <input placeholder="389514" v-model="number">
            <p>Логин</p>
            <input placeholder="Логин" v-model="login">
            <p>Пароль</p>
            <input disabled placeholder="Пароль" v-model="password">
            <div class="button" @click="createSafe">Создать</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "WorkerPageCreateClientModal",
    inject: ["apiUrl"],
    data() {
        return {
            fio: "",
            serial: "",
            number: "",
            login: "",
            password: this.randomString(12),
        }
    },
    methods: {
        validate() {
            return this.fio.length > 3 &&
                this.serial.length === 4 &&
                this.number.length === 6 &&
                this.login.length > 5
        },
        createSafe() {
            if (!this.validate()){
                this.toast.error("Проверьте введеные данные", 2000)
                return
            }
            this.axios.post(
                this.apiUrl + "client",
                {
                    fio: this.fio,
                    passport: this.serial + this.number,
                    login: this.login,
                    password: this.password,
                },
                {
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                }
            ).then((response) => {
                console.log(response.data)
                this.toast.success("Новый клиент создан", 2000)
                this.$emit('newClient')
                this.price = 0
            })
            this.$emit('closeModal')
        }
    }
}
</script>

<style scoped>

</style>