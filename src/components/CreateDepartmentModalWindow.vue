<template>
    <div class="modal-container">
        <div class="modal-window">
            <div class="model-header">
                <h1>Добавление отделения</h1>
                <i class="fa-solid fa-circle-xmark" @click="$emit('closeModal')"></i>
            </div>
            <input placeholder="Адрес" v-model="addressName">
            <div class="button" @click="onCreate">Создать</div>
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
                this.toast.success("Новое отделение создано!", 2000)
                this.$emit('newDepartment')
                this.addressName = ""

            }).catch((error) => {
                this.toast.error(error.response.data.message, 2000)
            })
            this.$emit('closeModal')
        }
    }
}
</script>

<style scoped>

</style>