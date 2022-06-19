import { reactive, ref, toRefs } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

import { useUserStore } from "../stores/UserStore";

export default function useAuth() {
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);
    const success = ref(false);
    const validationErrors = ref([]);
    const errors_exist = ref(false);
    const invalid_credentials = ref([]);
    const isLoginInvalid = ref(false);

    const getUser = async () => {
        processing.value = true;
        const useUser = useUserStore();
        await axios
            .get(
                "user",
                {},
                {
                    Authorization: "Bearer " + localStorage.getItem("op_token"),
                }
            )
            .then((response) => {
                useUser.setUser(response.data);
                processing.value = false;
            })
            .catch((ex) => {
                processing.value = false;
            });

        return useUser.getUser;
    };

    const updateUser = async (id) => {
        processing.value = true;
        const useUser = useUserStore();
        const auth = useUser.getUser;

        errors.value = "";
        try {
            await axios.put("/user/update/" + id, auth).then((response) => {
                useUser.setUser(response.data);
                success.value = true;
                processing.value = false;
            });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const login = async (data) => {
        processing.value = true;
        await axios
            .post("login", data, { headers: { Accept: "application/json" } })
            .then((response) => {
                localStorage.setItem("op_token", response.data.token);
                const useUser = useUserStore();
                useUser.setUser(response.data.user);
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
                const useUser = useUserStore();
                useUser.setUser(response.data.user);
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
                const useUser = useUserStore();
                useUser.setUser(response.data.user);
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
                const useUser = useUserStore();
                useUser.removeUser();
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
                const useUser = useUserStore();
                useUser.removeUser();
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
                const useUser = useUserStore();
                useUser.removeUser();
                processing.value = false;
                router.push("/");
            })
            .catch((ex) => {
                processing.value = false;
            });
    };

    return {
        getUser,
        updateUser,
        login,
        adminLogin,
        hpLogin,
        logout,
        hplogout,
        errors,
        processing,
        success,
        validationErrors,
        errors_exist,
        invalid_credentials,
        isLoginInvalid,
    };
}
