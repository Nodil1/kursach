<template>
    <div class="shadow-block item-list">
        <div class="item-list-info">
            <p><b>Сейф:</b> {{safe.id}}</p>
            <div class="icons">
                <i class="fa-solid fa-key" @click="$emit('keyModal')"></i>
                <i class="fa-solid fa-trash"></i>
                <i class="fa-solid fa-up-down" @click="isShown = !isShown"></i>
            </div>
        </div>
        <transition-expand :duration="400">
            <div class="workers-list" v-show="isShown">
                <p style="padding-left: 10px; margin-bottom: 10px"><b>Список ключей</b></p>
                <WorkerPageKeyView v-for="(keyModel, idx) in keys"
                                          :key="idx"
                                          :keyModel="keyModel"
                ></WorkerPageKeyView>
            </div>
        </transition-expand>
    </div>
</template>

<script>
import {TransitionExpand} from "@morev/vue-transitions";
import WorkerPageKeyView from "@/components/WorkerPageKeyView";

export default {
    name: "SafeView",
    props: ['safe'],
    inject: ["apiUrl"],
    data() {
        return {
            isShown: false,
            keys: []
        }
    },
    methods: {
      loadKeys(){
          this.axios.get(
              this.apiUrl + "key",
              {
                  params: {
                      idSafe: this.safe.id
                  }
              },
              {
                  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              }
          ).then((response) => {
              console.log(response.data)
              this.keys = response.data.response
          }).catch((error) => {
              this.toast.error(error.response.data.message, 2000)
          })
      }
    },
    mounted() {
        this.loadKeys()
    },
    components: {WorkerPageKeyView, TransitionExpand}
}
</script>

<style scoped>
.workers-list {
    margin-top: 20px;
}
</style>