<template>
    <div class="modal-container">
        <div class="modal-window">
            <div class="model-header">
                <h2>Добавить ключ к сейфу {{safe.id}}?</h2>
                <i class="fa-solid fa-circle-xmark" @click="$emit('closeModal')"></i>
            </div>

            <div class="button" @click="createSafe">Добавить</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "WorkerPageCreateKeyModal",
    inject: ["apiUrl"],
    props: ["safe"],
    data() {
        return {
          price: 0
        }
    },
    methods: {
        createSafe(){
            this.axios.post(
                this.apiUrl + "key",
                {
                    idSafe: this.safe.id
                },
                {
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                }
            ).then((response) => {
                console.log(response.data)
                this.toast.success("Новый ключ добавлен!", 2000)
                this.$emit('newKey')
                this.price = 0
            })
            this.$emit('closeModal')
        }
    }
}
</script>

<style scoped>

</style>