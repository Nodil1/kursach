<template>
    <div class="worker-item">
        <div class="worker-info">
            <p class="worker-name info"><b>№ ключа:</b> {{ keyModel.id }}</p>
            <p class="worker-name info"><b>Ключ находится:</b>
                <span v-if="keyModel.isInBank === 1"> В банке</span>
                <span v-if="keyModel.isInBank === 0"> У клиента</span>
            </p>
        </div>
        <i class="fa-solid fa-trash"></i>
    </div>
</template>

<script>
export default {
    name: "WorkerPageKeyView",
    props: ["keyModel"],
    mounted() {
        console.log("ASASAs")

    }

}
</script>

<style scoped>
.worker-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 30px 10px 10px;
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
    width: 270px;
    margin-right: 20px;
}
</style>