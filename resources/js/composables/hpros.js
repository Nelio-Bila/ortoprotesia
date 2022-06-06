import { ref, watch } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useHPros() {
    const hpros = ref([]);
    const hpro = ref([]);
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);

    const getHPros = async () => {
        processing.value = true;
        await axios
            .get("/hpros")
            .then((response) => {
                hpros.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                hpros.value = [];
                processing.value = false;
            });
    };

    const getHPro = async (id) => {
        processing.value = true;

        await axios
            .get("/hpro/" + id)
            .then((response) => {
                hpro.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                hpro.value = [];
                processing.value = false;
            });
    };

    const storeHPro = async (data) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.post("/hpros/register", data);
            processing.value = false;
            await router.push("/hpros");
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const updateHPro = async (id) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.put("/hpros/" + id, hpro.value);
            await router.push("/hpros");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const destroyHPro = async (id) => {
        processing.value = true;

        await axios.delete("/hpros/" + id);
        processing.value = false;
    };

    return {
        hpros,
        hpro,
        errors,
        processing,
        getHPros,
        getHPro,
        storeHPro,
        updateHPro,
        destroyHPro,
    };
}
