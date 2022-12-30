<template>
    <div class="shadow-block item-list">
        <div class="item-list-info" >
            <p><b>Отделение:</b> {{ department.address }}</p>
            <div class="icons">
                <i class="fa-solid fa-user-plus" @click="$emit('addWorker', department)"></i>
                <i class="fa-solid fa-trash"></i>
                <i class="fa-solid fa-up-down" @click="showWorkers()"></i>
            </div>
        </div>
        <transition-expand :duration="400">
            <div class="workers-list" v-show="isWorkerShow">
                <p style="padding-left: 10px; margin-bottom: 10px"><b>Список работников</b></p>
                <DepartmentViewWorkerItem v-for="idx in workers" :key="idx.id" :worker="idx"></DepartmentViewWorkerItem>
            </div>
        </transition-expand>
    </div>
</template>

<script>
import DepartmentViewWorkerItem from "@/components/DepartmentViewWorkerItem";
import {TransitionExpand} from '@morev/vue-transitions';

export default {
    props: ['department'],
    inject: ["apiUrl"],
    name: "DepartmentView",
    components: {DepartmentViewWorkerItem, TransitionExpand},
    data() {
        return {
            isWorkerShow: false,
            workers: []
        }
    },
    methods: {
        loadWorkers() {
            this.axios.get(
                this.apiUrl + "worker",
                {
                    params: {
                        idDepartment: this.department.id
                    }
                },
                {
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                }
            ).then((response) => {
                console.log(response.data)
                this.workers = response.data.response
            }).catch((error) => {
                this.toast.error(error.response.data.message, 2000)
            })

        },
        showWorkers() {
            this.isWorkerShow = !this.isWorkerShow
            this.loadWorkers()
        }
    },
    mounted() {
        this.loadWorkers()
    }
}
</script>

<style scoped>



.workers-list {
    margin-top: 20px;
}
</style>