<template>
    <div class="modal-container">
        <div class="modal-window">
            <h1>Добвление отделения</h1>
            <input placeholder="Адрес" v-model="addressName">
            <button @click="onCreate">Создать</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "CreateDepartmentModalWindow",
    inject: ["apiUrl"],
    data() {
        return {
            addressName: ""
        }
    },
    methods: {
        onCreate() {
            this.axios.post(
                this.apiUrl + "department",

                {
                    addressName: this.addressName
                },
                {
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                }
            ).then((response) => {
                console.log(response.data)
            })
            this.$emit('closeModal')
        }
    }
}
</script>

<style scoped>

</style>