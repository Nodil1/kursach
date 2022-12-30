<template>
    <div class="wrapper">
        <div class="top-panel">
            <h1>Панель админа</h1>
            <div class="shadow-block hover-block exit">
                <i class="fa-solid fa-right-from-bracket"></i>
                Выйти
            </div>
        </div>
        <div class="panel">
            <div class="left-panel">
                <div class="admin-block shadow-block ">
                    <div class="text-block-item panel-item with-bottom-line" @click="isCreateDepartmentShow = true">
                        <p>Новое отделение</p>
                        <i class="fa-solid fa-square-plus"></i>
                    </div>
                    <div class="text-block-item panel-item with-bottom-line" @click="isCreateWorkerShow = true">
                        <p>Новый работник</p>
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                </div>

            </div>
            <div class="right-panel">
                <DepartmentView v-for="item in departments" :key="item.name" :department="item"
                                @addWorker="isCreateWorkerShow = !isCreateWorkerShow"></DepartmentView>
            </div>
        </div>
        <CreateDepartmentModalWindow v-show="isCreateDepartmentShow"
                                     @newDepartment="onNewDepartment()"
                                     @closeModal="isCreateDepartmentShow = false"></CreateDepartmentModalWindow>
        <CreateWorkerModalWindow v-show="isCreateWorkerShow" :departments="departments" @closeModal="isCreateWorkerShow = false"></CreateWorkerModalWindow>
    </div>
</template>

<script>
import CreateDepartmentModalWindow from "@/components/CreateDepartmentModalWindow";
import DepartmentView from "@/components/DepartmentView";
import CreateWorkerModalWindow from "@/components/CreateWorkerModalWindow";

export default {
    name: "AdminPanel",
    components: {CreateWorkerModalWindow, DepartmentView, CreateDepartmentModalWindow},
    inject: ["apiUrl"],

    data() {
        return {
            isCreateDepartmentShow: false,
            isCreateWorkerShow: false,
            departments: []
        }
    },
    methods: {
        onNewDepartment() {
            console.log("New!")
            this.getAllDepartment()
        },
        getAllDepartment() {
            console.log("ALL!")
            this.axios.get(this.apiUrl + "department").then((response) => {
                this.departments = response.data.response
                console.log(response.data)
            })
        }
    },
    mounted() {
        this.getAllDepartment()
    }
}
</script>

<style scoped>
.exit {
    padding: 10px 20px;
}

h1 {
}

.admin-block {

}


</style>