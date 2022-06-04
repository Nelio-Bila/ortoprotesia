require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
import { createMetaManager } from "vue-meta";
import { createPinia } from "pinia";
import "./config/axios";
import CKEditor from "@ckeditor/ckeditor5-vue";
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";
const toastOptions = {
    maxToasts: 1,
};

import VueAnnouncer from "@vue-a11y/announcer";
import "@vue-a11y/announcer/dist/style.css";

import VueSocialSharing from "vue-social-sharing";
import VueApexCharts from "vue3-apexcharts";

const metaManager = createMetaManager();

import Home from "./pages/Home";

const app = createApp(Home);
app.config.warnHandler = function (msg, vm, trace) {
    return null;
};
app.use(createPinia()); // Create the root store
app.use(VueAnnouncer, { router });
app.use(router);
app.use(metaManager);
app.use(CKEditor);
app.use(Toast, toastOptions);
app.use(VueSocialSharing);
app.use(VueApexCharts);
app.mount("#app");
