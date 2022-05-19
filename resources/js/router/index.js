import { createRouter, createWebHistory } from "vue-router";

import Welcome from "../pages/Welcome.vue";

import NotFound from "../pages/Errors/NotFound.vue";

import Register from "../pages/Account/Register.vue";
import Login from "../pages/Account/Login.vue";
import Forgot from "../pages/Account/Forgot.vue";
import Account from "../pages/Account/Account.vue";

import HPHome from "../pages/hp/HPHome.vue";
import HPLogin from "../pages/hp/HPLogin.vue";
import HPRegister from "../pages/hp/HPRegister.vue";
import HPForgot from "../pages/hp/HPRegister.vue";
import HPProfile from "../pages/hp/HPProfile.vue";

import Users from "../pages/Admin/Users/Users.vue";

import Health_pros from "../pages/Admin/Health_pros/health_pros.vue";

import Articles from "../pages/hp/Articles/Articles.vue";

import CategoriesIndex from "../pages/hp/Categories/CategoriesIndex.vue";
import CategoriesEdit from "../pages/hp/Categories/CategoriesEdit.vue";
import CategoriesCreate from "../pages/hp/Categories/CategoriesCreate.vue";

import AppointmentCreate from "../pages/Appointment/AppointmentCreate.vue";

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
    {
        path: "/account",
        name: "account",
        component: Account,
    },
    {
        path: "/hp/",
        name: "hp",
        component: HPHome,
    },
    {
        path: "/hp/login",
        name: "hplogin",
        component: HPLogin,
    },
    {
        path: "/hp/register",
        name: "hpregister",
        component: HPRegister,
    },
    {
        path: "/hp/forgot",
        name: "hpforgot",
        component: HPForgot,
    },
    {
        path: "/hp/profile",
        name: "hpprofile",
        component: HPProfile,
    },
    {
        path: "/hp/articles",
        name: "hparticles",
        component: Articles,
    },
    {
        path: "/admin/users",
        name: "users",
        component: Users,
    },
    {
        path: "/admin/health_pros",
        name: "health_pros",
        component: Health_pros,
    },
    {
        path: "/categories",
        name: "categories.index",
        component: CategoriesIndex,
    },
    {
        path: "/categories/create",
        name: "categories.create",
        component: CategoriesCreate,
    },
    {
        path: "/categories/:id/edit",
        name: "categories.edit",
        component: CategoriesEdit,
        props: true,
    },
    {
        path: "/appointment",
        name: "appointment.create",
        component: AppointmentCreate,
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;
