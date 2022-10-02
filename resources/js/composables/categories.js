import { ref, watch } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useCategories() {
    const categories = ref([]);
    const category = ref([]);
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);

    const getCategories = async () => {
        processing.value = true;
        await axios
            .get("/categories")
            .then((response) => {
                categories.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                categories.value = [];
                processing.value = false;
            });
    };

    const getCategory = async (id) => {
        processing.value = true;

        await axios
            .get("/category/" + id)
            .then((response) => {
                category.value = response.data[0];
                processing.value = false;
            })
            .catch((ex) => {
                category.value = [];
                processing.value = false;
            });
    };

    const storeCategory = async (data) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.post("/category/register", data);
            await router.push("/categories");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const updateCategory = async (id, data) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.put("/category/" + id, data);
            await router.push("/categories");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const destroyCategory = async (id) => {
        processing.value = true;

        await axios.delete("/category/destroy/" + id);
        processing.value = false;
    };

    return {
        categories,
        category,
        errors,
        processing,
        getCategories,
        getCategory,
        storeCategory,
        updateCategory,
        destroyCategory,
    };
}
