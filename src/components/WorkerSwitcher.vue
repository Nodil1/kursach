<template>
    <div class="switcher">
        <div class="first" :class="{'active': isSafeActive, 'not-active': !isSafeActive}" @click="changeState(0)">
            Сейфы
        </div>
        <div class="second" :class="{'active': !isSafeActive, 'not-active': isSafeActive}" @click="changeState(1)">
            Клиенты
        </div>
    </div>
</template>

<script>
export default {
    name: "WorkerSwitcher",
    data() {
        return {
            isSafeActive: true
        }
    },

    methods: {
        changeState(state) {
            this.isSafeActive = !this.isSafeActive
            this.$emit('change', state)
        }
    }
}
</script>

<style scoped>
.switcher {
    display: flex;
    margin: 0 10px 10px 7px;
    cursor: pointer;

}

.switcher div {
    border: 1px solid var(--red);
    padding: 10px;
    width: 50%;
    text-align: center;
    transition-duration: 100ms;
}

.first {
    border-radius: 10px 0 0 10px;
}

.second {
    border: 1px solid var(--red);
    border-radius: 0 10px 10px 0;
}

.active {
    background-color: #e8200d;
    color: white;
}

.not-active {
    background-color: white;
    color: var(--red);
}
</style>