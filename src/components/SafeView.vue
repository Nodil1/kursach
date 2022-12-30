<template>
    <div class="shadow-block item-list">
        <div class="item-list-info" >
            <p><b>Сейф:</b> </p>
            <div class="icons">
                <i class="fa-solid fa-user-plus" ></i>
                <i class="fa-solid fa-trash"></i>
                <i class="fa-solid fa-up-down" ></i>
            </div>
        </div>
        <transition-expand :duration="400">
            <div class="workers-list" v-show="isWorkerShow">
                <p style="padding-left: 10px; margin-bottom: 10px"><b>Список работников</b></p>
            </div>
        </transition-expand>
    </div>
</template>

<script>
import {TransitionExpand} from "@morev/vue-transitions";

export default {
    name: "SafeView",
    components: {TransitionExpand}
}
</script>

<style scoped>

</style>