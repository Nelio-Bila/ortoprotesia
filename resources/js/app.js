require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
import { createPinia } from "pinia";
import "./config/axios";
import CKEditor from "@ckeditor/ckeditor5-vue";

// import { BootstrapVue, IconsPlugin } from "bootstrap-vue";

// Import Bootstrap and BootstrapVue CSS files (order is important)
// import "bootstrap/dist/css/bootstrap.css";
// import "bootstrap-vue/dist/bootstrap-vue.css";

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
// Make BootstrapVue available throughout your project
// app.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
// app.use(IconsPlugin);
app.mount("#app");
