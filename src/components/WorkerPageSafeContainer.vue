<template>
    <SafeView v-for="idx in 10" :key="idx"></SafeView>
</template>

<script>
import SafeView from "@/components/SafeView";
export default {
    name: "WorkerPageSafeContainer",
    components: {SafeView}
}
</script>

<style scoped>

</style>