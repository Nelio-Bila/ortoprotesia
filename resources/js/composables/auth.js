import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { useUserStore } from "../stores/UserStore";

export default function useAuth() {
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);
    const validationErrors = ref([]);
    const errors_exist = ref(false);
    const invalid_credentials = ref([]);
    const isLoginInvalid = ref(false);
    const userStore = useUserStore();

    const login = async (data) => {
        processing.value = true;
        await axios
            .post("login", data, { headers: { Accept: "application/json" } })
            .then((response) => {
                localStorage.setItem("op_token", response.data.token);
                userStore.setUser(response.data.user);

                processing.value = false;
                router.push("/");
            })
            .catch((ex) => {
                processing.value = false;
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

    const logout = () => {
        localStorage.removeItem("op_token");
        userStore.removeUser();
        router.push("/");
    };

    return {
        login,
        logout,
        errors,
        processing,
        validationErrors,
        errors_exist,
        invalid_credentials,
        isLoginInvalid,
    };
}