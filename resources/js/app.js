require('./bootstrap');

import { createApp } from "vue"

import index from "./index"
import router from "./router/router";
import vuex from "./store/vuex";


createApp(index)
    .use(router)
    .use(vuex)
    .mount("#app")
