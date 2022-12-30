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
                    <worker-switcher></worker-switcher>
                    <div class="text-block-item panel-item with-bottom-line" @click="isCreateDepartmentShow = true">
                        <p>Новый клиент</p>
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div class="text-block-item panel-item with-bottom-line" @click="isCreateWorkerShow = true">
                        <p>Новый сейф</p>
                        <i class="fa-solid fa-vault"></i>
                    </div>
                </div>

            </div>
            <div class="right-panel">
                <WorkerPageSafeContainer/>
            </div>
        </div>

    </div>

</template>

<script>
import WorkerSwitcher from "@/components/WorkerSwitcher";
import WorkerPageSafeContainer from "@/components/WorkerPageSafeContainer";
export default {
    name: "WorkerPage",
    components: {WorkerPageSafeContainer, WorkerSwitcher}
}
</script>

<style scoped>


</style>