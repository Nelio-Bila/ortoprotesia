require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
import store from "./vuex";
import "./config/axios";

import NavBar from "./components/NavBar";
import Hero from "./components/Hero";
import ArticlesWrapper from "./components/ArticlesWrapper";
import Carousel from "./components/Carousel";
import ArticleCard from "./components/ArticleCard";
import Footer from "./components/Footer";
import HPSideBar from "./components/HPSideBar";
import HPNavBar from "./components/HPNavBar";

import Home from "./pages/Home";
import Welcome from "./pages/Welcome";
import Login from "./pages/Login";
import Forgot from "./pages/Forgot";
import Register from "./pages/Register";

import HPHome from "./pages/hp/HPHome";
import HPLogin from "./pages/hp/HPLogin";
import HPRegister from "./pages/hp/HPRegister";
import HPForgot from "./pages/hp/HPForgot";
import HPProfile from "./pages/hp/HPProfile";

const app = createApp(Home);

app.component("NavBar", NavBar);
app.component("Hero", Hero);
app.component("ArticlesWrapper", ArticlesWrapper);
app.component("Welcome", Welcome);
app.component("Login", Login);
app.component("Forgot", Forgot);
app.component("Register", Register);
app.component("Carousel", Carousel);
app.component("ArticleCard", ArticleCard);
app.component("Footer", Footer);
app.component("HPSideBar", HPSideBar);
app.component("HPNavBar", HPNavBar);

app.component("HPHome", HPHome);
app.component("HPLogin", HPLogin);
app.component("HPRegister", HPRegister);
app.component("HPForgot", HPForgot);
app.component("HPProfile", HPProfile);

app.use(router);
app.use(store);
app.mount("#app");
