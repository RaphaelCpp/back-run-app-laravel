import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

import { createApp } from "vue";
import router from "./router";
import Login from "./components/Login.vue";
import Dashboard from "./components/Dashboard.vue";
import navBar from "./components/navBar.vue";

createApp({
    components: {
        Login,
        Dashboard,
        navBar,
    },
})
    .use(router)
    .mount("#app");
