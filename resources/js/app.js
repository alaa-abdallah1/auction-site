import Vue from "vue";
import axios from "axios";
import store from "./store";
import App from "./App.vue";
import router from "./router";
import VueAxios from "vue-axios";
import VueSimpleAlert from "vue-simple-alert";

Vue.use(VueSimpleAlert);
Vue.use(VueAxios, axios);

import Loader from "./components/Loader.vue";
Vue.component("Loader", Loader);

import Pusher from "pusher-js";
import VueEcho from "vue-echo-laravel";

// Enable pusher logging - don't include this in production
Pusher.logToConsole = false;
Vue.use(VueEcho, {
    broadcaster: "pusher",
    key: "c9f47df528464ea65c82",
    cluster: "ap3",
    forceTLS: false,
    encrypted: true,
    auth: {
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token") || null,
        },
    },
});

new Vue({
    store,
    router,
    render(h) {
        return h(App, {});
    },
}).$mount("#app");
