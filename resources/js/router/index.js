import { createRouter, createWebHistory } from "vue-router";

import Welcome from "../components/Welcome.vue";
import NotFound from "../components/NotFound.vue";
import Login from "../components/Login.vue";
import Register from "../components/Register.vue";
import Forgot from "../components/Forgot.vue";

const routes = [
    {
        path: "/",
        name: "Welcome",
        component: Welcome,
    },
    { path: "/:pathMatch(.*)*", name: "NotFound", component: NotFound },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/register",
        name: "register",
        component: Register,
    },
    {
        path: "/forgot",
        name: "forgot",
        component: Forgot,
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;
