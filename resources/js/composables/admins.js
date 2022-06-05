import { ref, watch } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useAdmins() {
    const admins = ref([]);
    const admin = ref([]);
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);

    const getAdmins = async () => {
        processing.value = true;
        await axios
            .get("/admins")
            .then((response) => {
                admins.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                admins.value = [];
                processing.value = false;
            });
    };

    const getAdmin = async (id) => {
        processing.value = true;

        await axios
            .get("/admin/" + id)
            .then((response) => {
                admin.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                admin.value = [];
                processing.value = false;
            });
    };

    const storeAdmin = async (data) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.post("/admin/register", data);
            await router.push("/admins");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const updateAdmin = async (id) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios
                .put("/admin/update/" + id, admin.value)
                .then((response) => {
                    admin = response.data;
                    processing.value = false;
                });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const destroyAdmin = async (id) => {
        processing.value = true;

        await axios.delete("/admin/" + id);
        processing.value = false;
    };

    return {
        admins,
        admin,
        errors,
        processing,
        getAdmins,
        getAdmin,
        storeAdmin,
        updateAdmin,
        destroyAdmin,
    };
}
