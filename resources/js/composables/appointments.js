import { ref, watch } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useAppointments() {
    const appointments = ref([]);
    const appointment = ref([]);
    const router = useRouter();
    const errors = ref("");
    const processing = ref(false);

    const getAppointments = async () => {
        processing.value = true;
        await axios
            .get("/appointments")
            .then((response) => {
                appointments.value = response.data;
                processing.value = false;
            })
            .catch((ex) => {
                console.log(ex.response.data.errors);
                appointments.value = [];
                processing.value = false;
            });
    };

    const getAppointment = async (id) => {
        processing.value = true;

        await axios
            .get("/appointment/" + id)
            .then((response) => {
                appointment.value = response.data[0];
                processing.value = false;
            })
            .catch((ex) => {
                console.log(ex.response.data.errors);
                appointment.value = [];
                processing.value = false;
            });
    };

    const storeAppointment = async (data) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.post("/appointments/register", data);
            await router.push("/appointments");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const updateAppointment = async (id) => {
        processing.value = true;

        errors.value = "";
        try {
            await axios.put("/appointments/" + id, appointment.value);
            await router.push("/appointments");
            processing.value = false;
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            processing.value = false;
        }
    };

    const destroyAppointment = async (id) => {
        processing.value = true;

        await axios.delete("/appointments/" + id);
        processing.value = false;
    };

    return {
        appointments,
        appointment,
        errors,
        processing,
        getAppointments,
        getAppointment,
        storeAppointment,
        updateAppointment,
        destroyAppointment,
    };
}
