import { ref, watch } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useConsultSessions() {
    const consultSessions = ref([]);
    const consultSession = ref([]);
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);

    const getConsultSessions = async () => {
        processing.value = true;
        await axios
            .get("/consultsessions")
            .then((response) => {
                consultSessions.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                consultSessions.value = [];
                processing.value = false;
            });
    };

    const getConsultSession = async (id) => {
        processing.value = true;

        await axios
            .get("/consultsession/" + id)
            .then((response) => {
                consultSession.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                consultSession.value = [];
                processing.value = false;
            });
    };

    const storeConsultSession = async (data) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.post("/consultsession/register", data);
            await router.push("/consultSessions");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const updateConsultSession = async (id, data) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.put("/consultsession/" + id, data);
            await router.push("/consultSessions");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const deleteConsultSession = async (id) => {
        processing.value = true;

        await axios.delete("/consultsession/destroy/" + id);
        processing.value = false;
    };

    return {
        consultSessions,
        consultSession,
        errors,
        processing,
        getConsultSessions,
        getConsultSession,
        storeConsultSession,
        updateConsultSession,
        deleteConsultSession,
    };
}
