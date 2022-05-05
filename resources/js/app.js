require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
import store from "./vuex";
import "./config/axios";

import Home from "./pages/Home";
import NavBar from "./components/NavBar";
import Welcome from "./components/Welcome";
import Login from "./components/Login";
import Forgot from "./components/Forgot";
import Register from "./components/Register";
import Carousel from "./components/Carousel";
import ArticleCard from "./components/ArticleCard";
import Footer from "./components/Footer";

const app = createApp(Home);

app.component("NavBar", NavBar);
app.component("Welcome", Welcome);
app.component("Login", Login);
app.component("Forgot", Forgot);
app.component("Register", Register);
app.component("Carousel", Carousel);
app.component("ArticleCard", ArticleCard);
app.component("Footer", Footer);

app.use(router);
app.use(store);
app.mount("#app");
