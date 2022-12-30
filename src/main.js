import {createApp} from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Toast, {useToast} from "vue-toastification";
import "vue-toastification/dist/index.css";

const myMixin = {
    data() {
        return {
            toast: useToast()
        }
    },
    created() {

    },
    methods: {
        randomString(len) {
            let charSet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let randomString = '';
            for (let i = 0; i < len; i++) {
                let randomPoz = Math.floor(Math.random() * charSet.length);
                randomString += charSet.substring(randomPoz, randomPoz + 1);
            }
            return randomString;
        }
    }
}
createApp(App)
    .use(router)
    .use(VueAxios, axios)
    .use(Toast)
    .mixin(myMixin)
    .provide('apiUrl', "http://kursach/api/")
    .mount('#app')
