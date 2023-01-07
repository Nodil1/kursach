<template>
    <div class="top">
        <input placeholder="Паспорт клиента">

        <div class="shadow-block hover-block exit find-button">
            <i class="fa-solid fa-magnifying-glass"></i>
            Найти клиента
        </div>

        <div class="client-info">

        </div>
    </div>


</template>

<script>

export default {
    name: "WorkerPageClientContainer",
    components: {},
    inject: ["apiUrl"],
    data() {
        return {
            safes: [],
            safeSelected: {id: 0},
            isKeyModalShow: false
        }
    },
    mounted() {
        this.loadSafes()
    },
    methods: {
        keyCreateClick(safe) {
            console.log("AS")
            this.safeSelected = safe
            this.isKeyModalShow = true
        },
        loadClients() {
            this.axios.get(
                this.apiUrl + "client",
                {},
                {
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                }
            ).then((response) => {
                console.log(response.data)
                this.safes = response.data.response
            }).catch((error) => {
                this.toast.error(error.response.data.message, 2000)
            })
        }
    }
}
</script>

<style scoped>
    .find-button {
        width: 200px;
    }
    .top {
        display: flex;
    }
    .top input {
        margin-right: 20px;
    }
</style>