require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
import { createPinia } from "pinia";
import "./config/axios";
import CKEditor from "@ckeditor/ckeditor5-vue";

import Home from "./pages/Home";

const app = createApp(Home);
app.config.warnHandler = function (msg, vm, trace) {
    return null;
};
app.use(createPinia()); // Create the root store
app.use(router);
app.use(CKEditor);
app.mount("#app");
