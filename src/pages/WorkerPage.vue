<template>
    <div class="wrapper">
        <div class="top-panel">
            <h1>Панель работника</h1>
            <div class="shadow-block hover-block exit">
                <i class="fa-solid fa-right-from-bracket"></i>
                Выйти
            </div>
        </div>
        <div class="panel">
            <div class="left-panel">
                <div class="admin-block shadow-block ">
                    <worker-switcher @change="changeState"></worker-switcher>
                    <div class="text-block-item panel-item with-bottom-line" @click="isCreateClientShown = true">
                        <p>Новый клиент</p>
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div class="text-block-item panel-item with-bottom-line" @click="isCreateSafeShown = true">
                        <p>Новый сейф</p>
                        <i class="fa-solid fa-vault"></i>
                    </div>
                </div>

            </div>
            <div class="right-panel">
                <WorkerPageSafeContainer v-if="blockSelected === 0" ref="workerContainer"/>
                <WorkerPageClientContainer v-if="blockSelected === 1" ref="clientContainer"/>
            </div>
        </div>

    </div>
    <WorkerPageCreateSafeModal v-show="isCreateSafeShown"
                               @closeModal="isCreateSafeShown = false"
                               @newSafe="onNewSafe"
    ></WorkerPageCreateSafeModal>
    <WorkerPageCreateClientModal v-show="isCreateClientShown"
                                 @closeModal="isCreateClientShown = false"/>

</template>

<script>
import WorkerSwitcher from "@/components/WorkerSwitcher";
import WorkerPageSafeContainer from "@/components/WorkerPageSafeContainer";
import WorkerPageCreateSafeModal from "@/components/WorkerPageCreateSafeModal";
import WorkerPageClientContainer from "@/components/WorkerPageClientContainer";
import WorkerPageCreateClientModal from "@/components/WorkerPageCreateClientModal";

export default {
    name: "WorkerPage",
    components: {
        WorkerPageCreateClientModal,
        WorkerPageClientContainer, WorkerPageCreateSafeModal, WorkerPageSafeContainer, WorkerSwitcher,
    },
    data() {
        return {
            isCreateSafeShown: false,
            isCreateClientShown: false,

            blockSelected: 0
        }
    },
    methods: {
        onNewSafe() {
            this.$refs.workerContainer.loadSafes();
        },
        changeState(state) {
            this.blockSelected = state
        }

    }
}
</script>

<style scoped>


</style>