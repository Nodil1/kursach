<template>
    <SafeView v-for="(safe, idx) in safes"
              :safe="safe"
              :key="idx"
              @keyModal="keyCreateClick(safe)"></SafeView>
    <WorkerPageCreateKeyModal
        v-if="isKeyModalShow"
        :safe="safeSelected"
        @newKey="loadSafes"
        @closeModal="isKeyModalShow = false"
    />
</template>

<script>
import SafeView from "@/components/WorkerPageSafeView";
import WorkerPageCreateKeyModal from "@/components/WorkerPageCreateKeyModal";

export default {
    name: "WorkerPageSafeContainer",
    components: {WorkerPageCreateKeyModal, SafeView},
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
        loadSafes() {
            this.axios.get(
                this.apiUrl + "safe",
                {},
                {
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                }
            ).then((response) => {
                console.log(response.data)
                this.safes = response.data.response
            }).catch((error) => {
                console.log(error.response.data)

                this.toast.error(error.response.data.message, 2000)
            })
        }
    }
}
</script>

<style scoped>

</style>