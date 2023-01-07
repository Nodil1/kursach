<template>
    <div class="modal-container">
        <div class="modal-window">
            <div class="model-header">
                <h1>Добавление сейфа</h1>
                <i class="fa-solid fa-circle-xmark" @click="$emit('closeModal')"></i>
            </div>
            <p>Цена</p>
            <input placeholder="Цена" v-model="price">

            <div class="button" @click="createSafe">Создать</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "WorkerPageCreateSafeModal",
    inject: ["apiUrl"],
    data() {
        return {
          price: 0
        }
    },
    methods: {
        createSafe(){
            this.axios.post(
                this.apiUrl + "safe",
                {
                    price: this.price
                },
                {
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                }
            ).then((response) => {
                console.log(response.data)
                this.toast.success("Новый сейф добавлен!", 2000)
                this.$emit('newSafe')
                this.price = 0
            })
            this.$emit('closeModal')
        }
    }
}
</script>

<style scoped>

</style>