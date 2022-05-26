import { ref, watch } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useUsers() {
    const users = ref([]);
    const user = ref([]);
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
                console.log(ex.response.data.errors);
                users.value = [];
                processing.value = false;
            });
    };

    const getUser = async (id) => {
        processing.value = true;

        await axios
            .get("/user/" + id)
            .then((response) => {
                user.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                user.value = [];
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
            await axios.put("/users/" + id, user.value);
            await router.push("/users");
            processing.value = false;
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
    };
}
