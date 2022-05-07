import { createRouter, createWebHashHistory } from "vue-router";
import Login from "../components/Login.vue";
import Dashboard from "../components/Dashboard.vue";
import store from "../store";

const routes = [
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
        meta: { requiresAuth: true },
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({ name: "Login" });
    } else {
        // router.push("/dashboard");
    }
});

export default router;
