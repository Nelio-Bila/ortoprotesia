import { ref, watch } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useConsults() {
    const consults = ref([]);
    const consult = ref([]);
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);

    const getConsults = async () => {
        processing.value = true;
        await axios
            .get("/consults")
            .then((response) => {
                consults.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                consults.value = [];
                processing.value = false;
            });
    };

    const getConsult = async (id) => {
        processing.value = true;

        await axios
            .get("/consult/" + id)
            .then((response) => {
                consult.value = response.data[0];
                processing.value = false;
            })
            .catch((ex) => {
                consult.value = [];
                processing.value = false;
            });
    };

    const storeConsult = async (data) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.post("/consults/register", data);
            await router.push("/consults");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const updateConsult = async (id) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.put("/consults/" + id, consult.value);
            await router.push("/consults");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const destroyConsult = async (id) => {
        processing.value = true;

        await axios.delete("/consults/" + id);
        processing.value = false;
    };

    return {
        consults,
        consult,
        errors,
        processing,
        getConsults,
        getConsult,
        storeConsult,
        updateConsult,
        destroyConsult,
    };
}
