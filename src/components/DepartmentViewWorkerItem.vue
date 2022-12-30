<template>
    <div class="worker-item" v-if="isVisible">
        <div class="worker-info">
            <p class="worker-name info"><b>Имя:</b> {{ this.worker.fio }}</p>
            <p class="worker-login"><b>Логин:</b> {{ this.worker.login }}</p>
        </div>
        <i class="fa-solid fa-trash" @click="deleteWorker()"></i>
    </div>
</template>

<script>
export default {
    props: ['worker'],
    inject: ["apiUrl"],
    data() {
        return {
            isVisible: true,
        }
    },
    name: "DepartmentViewWorkerItem",
    methods: {
        deleteWorker() {
            if (!window.confirm("Удалить пользователя?")){
                return
            }
            this.axios.delete(
                this.apiUrl + "worker",{
                    data: {
                        idWorker: this.worker.id,
                        //headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }
                }
            ).then((response) => {
                console.log(response.data)
                this.isVisible = false
            }).catch((error) => {
                this.toast.error(error.response.data.message, 2000)
            })
        }
    }
}
</script>

<style scoped>
.worker-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 10px;
}

.worker-item:hover {
    background-color: white;
}

.worker-info {
    display: flex;
}

.worker-login {
}

.info {
    width: 200px;
    margin-right: 20px;
}
</style>