import { createRouter, createWebHistory, useRouter } from "vue-router";
import { useUserStore } from "../stores/UserStore";

import Welcome from "../pages/Welcome.vue";
import Results from "../pages/Results.vue";

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

import HProsIndex from "../pages/Admin/Health_pros/HProsIndex.vue";
import HProDetails from "../pages/Admin/Health_pros/HProDetails.vue";

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
        meta: {
            hideForAuth: true,
        },
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
        path: "/hp/",
        name: "hp",
        component: HPHome,
        meta: {
            requireHPAuth: true,
        },
        // beforeEnter: (to) => {
        //     const userStore = useUserStore();
        //     if (!userStore.user && to.name !== "hplogin") {
        //         return { name: "hplogin" };
        //     }
        // },
    },
    {
        path: "/hp/login",
        name: "hplogin",
        component: HPLogin,
        meta: {
            hideForAuth: true,
        },
        // beforeEnter: (to) => {
        //     const userStore = useUserStore();
        //     if (userStore.user !== null) {
        //         return { name: "hp" };
        //     }
        // },
    },
    {
        path: "/hp/register",
        name: "hpregister",
        component: HPRegister,
        meta: {
            hideForAuth: true,
        },
        // beforeEnter: (to) => {
        //     const userStore = useUserStore();
        //     if (userStore.user !== null) {
        //         return { name: "hp" };
        //     }
        // },
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
        // beforeEnter: (to) => {
        //     const userStore = useUserStore();
        //     if (!userStore.user && to.name !== "hplogin") {
        //         return { name: "hplogin" };
        //     }
        // },
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
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const userStore = useUserStore();

    // if (to.matched.some((record) => record.meta.requireHPAuth)) {
    if (to.meta.requireHPAuth) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.

        if (!userStore.user && to.name !== "hplogin") {
            if (!userStore.user.is_hp) {
                return { name: "hplogin" };
            }
        } else {
            next(); // go to wherever I'm going
        }
    } else if (to.meta.requireAdminAuth) {
        // if (!userStore.user && to.name !== "adminlogin") {
        //     if (!userStore.user.is_admin) {
        //         return { name: "adminlogin" };
        //     }
        // } else {
        //     next(); // go to wherever I'm going
        // }
    } else if (to.meta.hideForAuth) {
        if (userStore.user && (to.name !== "login" || to.name !== "register")) {
            next({ path: "/" });
        }
        if (
            userStore.user &&
            (to.name !== "hplogin" || to.name !== "hpregister")
        ) {
            next({ path: "/hp" });
        } else {
            next();
        }
    } else {
        next(); // does not require auth, make sure to always call next()!
    }
});

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
