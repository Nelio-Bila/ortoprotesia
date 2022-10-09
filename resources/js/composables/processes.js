import { ref, watch } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useProcesses() {
    const processes = ref([]);
    const provinces = ref([]);
    const districts = ref([]);
    const process = ref([]);
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);

    const getProcesses = async () => {
        processing.value = true;
        await axios
            .get("/processes")
            .then((response) => {
                processes.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                processes.value = [];
                processing.value = false;
            });
    };

    const getProvinces = async () => {
        processing.value = true;
        await axios
            .get("/provinces")
            .then((response) => {
                provinces.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                provinces.value = [];
                processing.value = false;
            });
    };

    const getDistricts = async (province_id) => {
        console.log(province_id);
        processing.value = true;

        await axios
            .get("/districts/" + province_id)
            .then((response) => {
                districts.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                districts.value = [];
                processing.value = false;
            });
    };
    const getProcess = async (id) => {
        processing.value = true;

        await axios
            .get("/process/" + id)
            .then((response) => {
                process.value = response.data[0];
                processing.value = false;
            })
            .catch((ex) => {
                process.value = [];
                processing.value = false;
            });
    };

    const storeProcess = async (data) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.post("/process/register", data);
            await router.push("/processes");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const updateProcess = async (id) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.put("/process/" + id, process.value);
            await router.push("/processes");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const destroyProcess = async (id) => {
        processing.value = true;

        await axios.delete("/process/" + id);
        processing.value = false;
    };

    return {
        processes,
        process,
        errors,
        processing,
        provinces,
        districts,
        getDistricts,
        getProcesses,
        getProvinces,
        getProcess,
        storeProcess,
        updateProcess,
        destroyProcess,
    };
}
