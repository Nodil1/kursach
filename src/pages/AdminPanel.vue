<template>
    <div class="wrapper">
        <h1>Панель админа</h1>
        <div class="panel">
            <div class="left-panel">
                <button @click="isCreateDepartmentShow = true">Новое отделение</button>
                <button>Новый работник</button>
                <p>Отделение</p>
                <select>
                    <option v-for="(item, idx) in departments" :key="idx">{{item.address}}</option>
                </select>
            </div>
            <div class="right-panel">

            </div>
        </div>
        <CreateDepartmentModalWindow v-if="isCreateDepartmentShow"></CreateDepartmentModalWindow>
    </div>
</template>

<script>
import CreateDepartmentModalWindow from "@/components/CreateDepartmentModalWindow";
export default {
    name: "AdminPanel",
    components: {CreateDepartmentModalWindow},
    inject: ["apiUrl"],
    data(){
        return {
            isCreateDepartmentShow: false,
            departments: []
        }
    },
    methods: {
        getAllDepartment(){
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
h1{
    margin-bottom: 20px;
}
</style>