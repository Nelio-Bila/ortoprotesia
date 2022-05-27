require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
import { createPinia } from "pinia";
import "./config/axios";
import CKEditor from "@ckeditor/ckeditor5-vue";

import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

const toastOptions = {
    maxToasts: 1,
};

import Home from "./pages/Home";

const app = createApp(Home);
app.config.warnHandler = function (msg, vm, trace) {
    return null;
};
app.use(createPinia()); // Create the root store
app.use(router);
app.use(CKEditor);
app.use(Toast, toastOptions);
app.mount("#app");
