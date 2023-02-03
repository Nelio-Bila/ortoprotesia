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

import NewsIndex from "../pages/Admin/News/NewsIndex.vue";
import NewsCreate from "../pages/Admin/News/NewsCreate.vue";
import NewsView from "../pages/News/NewsView.vue";
import NewsEdit from "../pages/Admin/News/NewsEdit.vue";

import ForumIndex from "../pages/Forum/ForumIndex.vue";

import CategoriesIndex from "../pages/hp/Categories/CategoriesIndex.vue";
import CategoriesEdit from "../pages/hp/Categories/CategoriesEdit.vue";
import CategoriesCreate from "../pages/hp/Categories/CategoriesCreate.vue";

import ConsultCreate from "../pages/Consult/ConsultCreate.vue";
import ConsultIndex from "../pages/Consult/ConsultIndex.vue";

import ProcessCreate from "../pages/Process/ProcessCreate.vue";
import ProcessEdit from "../pages/Process/ProcessEdit.vue";
import ProcessDetails from "../pages/Process/ProcessDetails.vue";
import ProcessInfo from "../pages/Process/ProcessInfo.vue";

import ProcessIndex from "../pages/Admin/Processes/ProcessIndex.vue";

import HProsIndex from "../pages/Admin/Health_pros/HProsIndex.vue";
import HProDetails from "../pages/Admin/Health_pros/HProDetails.vue";

import AdminHome from "../pages/Admin/AdminHome.vue";
import AdminsIndex from "../pages/Admin/AdminsIndex.vue";
import AdminDetails from "../pages/Admin/AdminDetails.vue";
import AdminLogin from "../pages/Admin/AdminLogin.vue";
import AdminCreate from "../pages/Admin/AdminCreate.vue";

import News from "../pages/News/Index.vue";
import Orto from "../pages/News/Orto.vue";
import Guide from "../pages/News/Guide.vue";

import TermsConditions from "../pages/legal/TermsConditions.vue";
import PrivacyPolicy from "../pages/legal/PrivacyPolicy.vue";

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
        meta: { requiresAuth: true },
    },
    {
        path: "/account/security",
        name: "account.security",
        component: AccountSecurity,
        meta: { requiresAuth: true },
    },
    {
        path: "/account/settings",
        name: "account.settings",
        component: AccountSettings,
        meta: { requiresAuth: true },
    },
    {
        path: "/account/privacy",
        name: "account.privacy",
        component: AccountPrivacy,
        meta: { requiresAuth: true },
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
        meta: { requiresHPAuth: true },
    },
    {
        path: "/hp/articles/create",
        name: "articles.create",
        component: ArticlesCreate,
        meta: { requiresHPAuth: true },
    },
    {
        path: "/hp/articles/:id/edit",
        name: "articles.edit",
        component: ArticlesEdit,
        props: true,
        meta: { requiresHPAuth: true },
    },
    {
        path: "/articles/:article_id",
        name: "articles.view",
        component: ArticleView,
        props: true,
    },
    {
        path: "/admin/news",
        name: "news",
        component: NewsIndex,
        meta: { requiresAdminAuth: true },
    },
    {
        path: "/admin/news/create",
        name: "news.create",
        component: NewsCreate,
        meta: { requiresAdminAuth: true },
    },
    {
        path: "/admin/news/:notice_id/edit",
        name: "news.edit",
        component: NewsEdit,
        props: true,
        meta: { requiresAdminAuth: true },
    },
    {
        path: "/news/:notice_id",
        name: "news.view",
        component: NewsView,
        props: true,
    },
    {
        path: "/categories",
        name: "categories.index",
        component: CategoriesIndex,
        meta: { requiresAdminAuth: true, requiresHPAuth: true },
    },
    {
        path: "/categories/create",
        name: "categories.create",
        component: CategoriesCreate,
        meta: { requiresAdminAuth: true, requiresHPAuth: true },
    },
    {
        path: "/categories/:id/edit",
        name: "categories.edit",
        component: CategoriesEdit,
        props: true,
        meta: { requiresAdminAuth: true, requiresHPAuth: true },
    },
    {
        path: "/consult/create",
        name: "consult.create",
        component: ConsultCreate,
        meta: { requiresAdminAuth: true },
    },
    {
        path: "/consults",
        name: "consult.index",
        component: ConsultIndex,
        meta: { requiresAdminAuth: true },
    },
    {
        path: "/process/create",
        name: "process.create",
        component: ProcessCreate,
        meta: { requiresAuth: true },
    },
    {
        path: "/process/edit",
        name: "process.edit",
        component: ProcessEdit,
        meta: { requiresAuth: true },
    },
    {
        path: "/process",
        name: "process.show",
        component: ProcessDetails,
        meta: { requiresAuth: true },
    },
    {
        path: "/process/info",
        name: "process.info",
        component: ProcessInfo,
        meta: { requiresAuth: true },
    },
    {
        path: "/processes",
        name: "processes.index",
        component: ProcessIndex,
        meta: { requiresAdminAuth: true },
    },
    {
        path: "/users",
        name: "users.index",
        component: UsersIndex,
        meta: {
            requiresAdminAuth: true,
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
        meta: { requiresAdminAuth: true },
    },
    {
        path: "/admin/home",
        name: "admin.home",
        component: AdminHome,
        meta: { requiresAdminAuth: true },
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
        meta: { requiresAdminAuth: true },
    },
    {
        path: "/admin/hpros",
        name: "hpros.index",
        component: HProsIndex,
        meta: { requiresAdminAuth: true },
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
        component: News,
    },
    {
        path: "/ortoprotesia",
        name: "orto",
        component: Orto,
    },
    {
        path: "/forum",
        name: "forum.index",
        component: ForumIndex,
    },
    {
        path: "/guide",
        name: "guide",
        component: Guide,
    },
    {
        path: "/terms-and-conditions",
        name: "termsAndConditions",
        component: TermsConditions,
    },
    {
        path: "/privacy-policy",
        name: "privacyPolicy",
        component: PrivacyPolicy,
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
//             if (to.meta.requiresHPAuth) {
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

// router.beforeEach(async (to) => {
//     // redirect to login page if not logged in and trying to access a restricted page
//     const publicPages = ["/login"];
//     const authRequired = !publicPages.includes(to.path);
//     const userStore = useUserStore();

//     if (authRequired && !userStore?.user) {
//         userStore.returnUrl = to.fullPath;
//         return "/login";
//     }
// });

export default router;
