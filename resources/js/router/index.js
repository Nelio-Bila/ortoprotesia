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

import Articles from "../pages/hp/Articles/Articles.vue";

import UsersIndex from "../pages/Admin/Users/UsersIndex.vue";
import UsersEdit from "../pages/Admin/Users/UsersEdit.vue";
import UsersCreate from "../pages/Admin/Users/UsersEdit.vue";

import HealthProsIndex from "../pages/Admin/Health_pros/HealthProsIndex.vue";

import CategoriesIndex from "../pages/hp/Categories/CategoriesIndex.vue";
import CategoriesEdit from "../pages/hp/Categories/CategoriesEdit.vue";
import CategoriesCreate from "../pages/hp/Categories/CategoriesCreate.vue";

import ConsultCreate from "../pages/Consult/ConsultCreate.vue";
import ConsultIndex from "../pages/Consult/ConsultIndex.vue";

import ProcessCreate from "../pages/Process/ProcessCreate.vue";
import ProcessDetails from "../pages/Process/ProcessDetails.vue";

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
        path: "/consult/create",
        name: "consult.create",
        component: ConsultCreate,
    },
    {
        path: "/consults",
        name: "consult.index",
        component: ConsultIndex,
    },
    {
        path: "/process/create",
        name: "process.create",
        component: ProcessCreate,
    },
    {
        path: "/process",
        name: "process.show",
        component: ProcessDetails,
    },

    {
        path: "/users",
        name: "users.index",
        component: UsersIndex,
    },
    {
        path: "/users/create",
        name: "users.create",
        component: UsersCreate,
    },
    {
        path: "/users/:id/edit",
        name: "users.edit",
        component: UsersEdit,
        props: true,
    },
    {
        path: "/admin/hpros",
        name: "hpros.index",
        component: HealthProsIndex,
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;
