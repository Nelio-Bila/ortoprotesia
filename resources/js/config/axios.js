import axios from "axios";

axios.defaults.baseURL = process.env.MIX_APP_URL + "/api/";
axios.defaults.headers.common["Authorization"] =
    "Bearer " + localStorage.getItem("op_token");

// before a request is made start the nprogress
// axios.interceptors.request.use((config) => {
//     NProgress.start();
//     return config;
// });

// before a response is returned stop nprogress
// axios.interceptors.response.use((response) => {
//     NProgress.done();
//     return response;
// });
