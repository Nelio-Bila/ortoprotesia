import { ref, watch } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useUsers() {
    const users = ref([]);
    const user = ref([]);
    const userProcess = ref([]);
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);

    const getUsers = async () => {
        processing.value = true;
        await axios
            .get("/users")
            .then((response) => {
                users.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                users.value = [];
                processing.value = false;
            });
    };

    const getUser = async () => {
        processing.value = true;

        await axios
            .get("/user/details")
            .then((response) => {
                user.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                user.value = [];
                processing.value = false;
            });
    };

    const getUserProcess = async (user_id) => {
        processing.value = true;

        await axios
            .get("/user/process/" + user_id)
            .then((response) => {
                userProcess.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                userProcess.value = [];
                processing.value = false;
            });
    };

    const storeUser = async (data) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.post("/users/register", data);
            await router.push("/users");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const updateUser = async (id) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios
                .put("/user/update/" + id, user.value)
                .then((response) => {
                    user.value = response.data;
                    processing.value = false;
                });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const destroyUser = async (id) => {
        processing.value = true;

        await axios.delete("/users/" + id);
        processing.value = false;
    };

    const setUSer = (auth) => {
        user.value = auth;
    };

    return {
        users,
        user,
        errors,
        processing,
        getUsers,
        getUser,
        storeUser,
        updateUser,
        destroyUser,
        setUSer,
        getUserProcess,
        userProcess,
    };
}
