import { reactive, ref, toRefs } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const state = reactive({
    auth: {},
});
export default function useAuth() {
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);
    const validationErrors = ref([]);
    const errors_exist = ref(false);
    const invalid_credentials = ref([]);
    const isLoginInvalid = ref(false);

    const getUser = async () => {
        processing.value = true;

        await axios
            .get(
                "user",
                {},
                {
                    Authorization: "Bearer " + localStorage.getItem("op_token"),
                }
            )
            .then((response) => {
                state.auth = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                console.log("Sem autorização");
                processing.value = false;
            });

        return state.auth;
    };

    const login = async (data) => {
        processing.value = true;
        await axios
            .post("login", data, { headers: { Accept: "application/json" } })
            .then((response) => {
                localStorage.setItem("op_token", response.data.token);
                state.auth = response.data.user;
                processing.value = false;
                router.push("/");
            })
            .catch((ex) => {
                processing.value = false;
                localStorage.removeItem("op_token");
                switch (ex.response.status) {
                    case 422:
                        errors.value = ex.response.data.errors;
                        errors_exist.value = true;
                        break;
                    case 401:
                        invalid_credentials.value = ex.response.data.message;
                        isLoginInvalid.value = true;
                        break;
                }
            });
    };

    const adminLogin = async (data) => {
        processing.value = true;
        await axios
            .post("admin/login", data, {
                headers: { Accept: "application/json" },
            })
            .then((response) => {
                localStorage.setItem("op_token", response.data.token);
                state.auth = response.data.user;
                processing.value = false;
                router.push("/hp");
            })
            .catch((ex) => {
                processing.value = false;
                localStorage.removeItem("op_token");
                switch (ex.response.status) {
                    case 422:
                        errors.value = ex.response.data.errors;
                        errors_exist.value = true;
                        break;
                    case 401:
                        invalid_credentials.value = ex.response.data.message;
                        isLoginInvalid.value = true;
                        break;
                }
            });
    };

    const hpLogin = async (data) => {
        processing.value = true;
        await axios
            .post("hp/login", data, { headers: { Accept: "application/json" } })
            .then((response) => {
                localStorage.setItem("op_token", response.data.token);
                state.auth = response.data.user;
                processing.value = false;
                router.push("/");
            })
            .catch((ex) => {
                processing.value = false;
                localStorage.removeItem("op_token");
                switch (ex.response.status) {
                    case 422:
                        errors.value = ex.response.data.errors;
                        errors_exist.value = true;
                        break;
                    case 401:
                        invalid_credentials.value = ex.response.data.message;
                        isLoginInvalid.value = true;
                        break;
                }
            });
    };

    const logout = async () => {
        await axios
            .post(
                "logout",
                {},
                {
                    Authorization: "Bearer " + localStorage.getItem("op_token"),
                }
            )
            .then((response) => {
                localStorage.removeItem("op_token");
                state.auth = {};
                console.log(state.auth);
                processing.value = false;
                router.push("/");
            })
            .catch((ex) => {
                processing.value = false;
            });
    };

    const adminLogout = async () => {
        processing.value = true;
        await axios
            .post(
                "admin/logout",
                {},
                {
                    Authorization: "Bearer " + localStorage.getItem("op_token"),
                }
            )
            .then((response) => {
                localStorage.removeItem("op_token");
                state.auth = {};
                processing.value = false;
                router.push("/");
            })
            .catch((ex) => {
                processing.value = false;
            });
    };

    const hplogout = async () => {
        processing.value = true;
        await axios
            .post(
                "hp/logout",
                {},
                {
                    Authorization: "Bearer " + localStorage.getItem("op_token"),
                }
            )
            .then((response) => {
                localStorage.removeItem("op_token");
                state.auth = {};
                processing.value = false;
                router.push("/");
            })
            .catch((ex) => {
                processing.value = false;
            });
    };

    return {
        ...toRefs(state),
        getUser,
        login,
        adminLogin,
        hpLogin,
        logout,
        hplogout,
        errors,
        processing,
        validationErrors,
        errors_exist,
        invalid_credentials,
        isLoginInvalid,
    };
}
