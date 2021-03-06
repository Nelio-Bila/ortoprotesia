import { createRouter, createWebHistory } from "vue-router";
import axios from "axios";

import pinia from "../stores/store.js";
import { useUserStore } from "../stores/UserStore";

import Welcome from "../pages/Welcome.vue";
import Results from "../pages/Results.vue";

import NotFound from "../pages/Errors/NotFound.vue";

import Register from "../pages/Account/Register.vue";
import Login from "../pages/Account/Login.vue";
import Forgot from "../pages/Account/Forgot.vue";
import Account from "../pages/Account/Account.vue";
import AccountSecurity from "../pages/Account/AccountSecurity.vue";
import AccountPrivacy from "../pages/Account/AccountPrivacy.vue";
import AccountSettings from "../pages/Account/AccountSettings.vue";

import HPHome from "../pages/hp/HPHome.vue";
import HPLogin from "../pages/hp/HPLogin.vue";
import HPRegister from "../pages/hp/HPRegister.vue";
import HPForgot from "../pages/hp/HPRegister.vue";
import HPProfile from "../pages/hp/HPProfile.vue";

import ArticlesIndex from "../pages/hp/Articles/ArticlesIndex.vue";
import ArticlesEdit from "../pages/hp/Articles/ArticlesEdit.vue";
import ArticlesCreate from "../pages/hp/Articles/ArticlesCreate.vue";

import ArticleView from "../pages/Articles/ArticleView.vue";

import UsersIndex from "../pages/Admin/Users/UsersIndex.vue";
import UserDetails from "../pages/Admin/Users/UserDetails.vue";

import CategoriesIndex from "../pages/hp/Categories/CategoriesIndex.vue";
import CategoriesEdit from "../pages/hp/Categories/CategoriesEdit.vue";
import CategoriesCreate from "../pages/hp/Categories/CategoriesCreate.vue";

import ConsultCreate from "../pages/Consult/ConsultCreate.vue";
import ConsultIndex from "../pages/Consult/ConsultIndex.vue";

import ProcessCreate from "../pages/Process/ProcessCreate.vue";
import ProcessDetails from "../pages/Process/ProcessDetails.vue";
import ProcessInfo from "../pages/Process/ProcessInfo.vue";

import ProcessIndex from "../pages/Admin/Processes/ProcessIndex.vue";
import ProcessEdit from "../pages/Admin/Processes/ProcessEdit.vue";

import HProsIndex from "../pages/Admin/Health_pros/HProsIndex.vue";
import HProDetails from "../pages/Admin/Health_pros/HProDetails.vue";

import AdminHome from "../pages/Admin/AdminHome.vue";
import AdminsIndex from "../pages/Admin/AdminsIndex.vue";
import AdminDetails from "../pages/Admin/AdminDetails.vue";
import AdminLogin from "../pages/Admin/AdminLogin.vue";
import AdminCreate from "../pages/Admin/AdminCreate.vue";

import NewsIndex from "../pages/News/NewsIndex.vue";
import Orto from "../pages/News/Orto.vue";
import Guide from "../pages/News/Guide.vue";

const routes = [
    {
        path: "/",
        name: "Welcome",
        component: Welcome,
        meta: {
            layout: "MainLayout",
        },
    },
    {
        path: "/results/:criteria",
        name: "Results",
        component: Results,
        props: true,
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
        meta: {
            hideForAuth: true,
        },
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
        path: "/account/security",
        name: "account.security",
        component: AccountSecurity,
    },
    {
        path: "/account/settings",
        name: "account.settings",
        component: AccountSettings,
    },
    {
        path: "/account/privacy",
        name: "account.privacy",
        component: AccountPrivacy,
    },
    {
        path: "/hp/",
        name: "hp",
        component: HPHome,
        meta: {
            requiresAuth: true,
        },
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
        name: "articles",
        component: ArticlesIndex,
    },
    {
        path: "/hp/articles/create",
        name: "articles.create",
        component: ArticlesCreate,
    },
    {
        path: "/hp/articles/:id/edit",
        name: "articles.edit",
        component: ArticlesEdit,
        props: true,
    },
    {
        path: "/articles/:id",
        name: "articles.view",
        component: ArticleView,
        props: true,
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
        path: "/process/info",
        name: "process.info",
        component: ProcessInfo,
    },
    {
        path: "/processes",
        name: "processes.index",
        component: ProcessIndex,
    },
    {
        path: "/process/edit",
        name: "process.edit",
        component: ProcessEdit,
    },
    {
        path: "/users",
        name: "users.index",
        component: UsersIndex,
        meta: {
            requireAdminAuth: true,
        },
    },
    {
        path: "/user/:id/details",
        name: "user.details",
        component: UserDetails,
        props: true,
    },
    {
        path: "/admins",
        name: "admins.index",
        component: AdminsIndex,
    },
    {
        path: "/admin/home",
        name: "admin.home",
        component: AdminHome,
    },
    {
        path: "/admin/login",
        name: "admin.login",
        component: AdminLogin,
    },
    {
        path: "/admin/create",
        name: "admin.create",
        component: AdminCreate,
    },
    {
        path: "/admin/:id/details",
        name: "admin.details",
        component: AdminDetails,
        props: true,
    },
    {
        path: "/admin/hpros",
        name: "hpros.index",
        component: HProsIndex,
    },
    {
        path: "/admin/hpro/:id/details",
        name: "hpro.details",
        component: HProDetails,
        props: true,
    },
    {
        path: "/news",
        name: "news.index",
        component: NewsIndex,
    },
    {
        path: "/ortoprotesia",
        name: "orto",
        component: Orto,
    },
    {
        path: "/guide",
        name: "guide",
        component: Guide,
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

// router.beforeEach(async (to, from, next) => {
//     let user = null;
//     await axios
//         .get("user")
//         .then((response) => {
//             user = response.data;
//             if (to.meta.requireHPAuth) {
//                 if (user === null) {
//                     if (
//                         // make sure the user is authenticated
//                         user.is_hp === undefined &&
//                         to.name !== "hplogin"
//                     ) {
//                         // redirect the user to the login page
//                         router.push({ name: "hplogin" });
//                     }
//                 }
//             }

//             if (to.meta.hideForAuth) {
//                 if (
//                     to.name.toString() === "login" ||
//                     to.name.toString() === "register"
//                 ) {
//                     router.push("/");
//                 } else if (
//                     user.is_hp !== undefined &&
//                     (to.name === "hplogin" || to.name === "hpregister")
//                 ) {
//                     router.push("/hp");
//                 }
//             }
//         })
//         .catch((ex) => {
//             next();
//         });
//     next();
// });

NProgress.configure({ showSpinner: false });

router.beforeResolve((to, from, next) => {
    // If this isn't an initial page load.
    if (to.name) {
        // Start the route progress bar.
        NProgress.start();
    }
    next();
});

router.afterEach((to, from) => {
    // Complete the animation of the route progress bar.
    NProgress.done();
});

export default router;
