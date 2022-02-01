require('./bootstrap');

import { createApp } from "vue"

import index from "./index"
import router from "./router/router";
import vuex from "./store/vuex";

import VueTelInput from 'vue3-tel-input'
import 'vue3-tel-input/dist/vue3-tel-input.css'

createApp(index)
    .use(router)
    .use(vuex)
    .use(VueTelInput)
    .mount("#app")
