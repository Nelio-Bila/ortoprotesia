import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useCategories() {
    const categories = ref([]);
    const category = ref([]);
    const router = useRouter();
    const errors = ref("");

    const getCategories = async () => {
        await axios
            .get("/categories")
            .then((response) => {
                categories.value = response.data;
            })
            .catch((ex) => {
                console.log(ex.response.data.errors);
                categories.value = [];
            });
    };

    const getCategory = async (id) => {
        let response = await axios.get("/categories/" + id);
        category.value = response.data.data;
    };

    const storeCategory = async (data) => {
        errors.value = "";
        try {
            await axios.post("/categories", data);
            await router.push("/categories");
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const updateCategory = async (id) => {
        errors.value = "";
        try {
            await axios.put("/categories/" + id, category.value);
            await router.push("/categories");
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const destroyCategory = async (id) => {
        await axios.delete("/categories/" + id);
    };

    return {
        categories,
        category,
        errors,
        getCategories,
        getCategory,
        storeCategory,
        updateCategory,
        destroyCategory,
    };
}
