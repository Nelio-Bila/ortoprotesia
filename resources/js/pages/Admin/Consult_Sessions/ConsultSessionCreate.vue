<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="consultsessions" />

    <!-- Page Content -->
    <main id="page-content-wrapper">
      <!-- Navbar -->
      <HPNavBar />
      <!-- Navbar End  -->

      <div class="container-fluid my-3">
        <div
          class="
            d-flex
            justify-content-between
            flex-wrap flex-md-nowrap
            align-items-center
            pt-3
            pb-2
            mb-3
            border-bottom
          "
        >
          <h1 class="h2">Registro de sessão de consultas</h1>
        </div>

        <router-link to="/consultsessions" class="btn btn-primary mb-4"
          >Lista de sessão de consultas</router-link
        >
        <div v-if="errors">
          <div
            v-for="(field, k) in errors"
            :key="k"
            class="
              alert alert-danger
              d-flex
              align-items-center
              alert-dismissible
              fade
              show
            "
            role="alert"
          >
            <svg
              class="bi flex-shrink-0 me-2"
              width="24"
              height="24"
              role="img"
              aria-label="Danger:"
            >
              <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div v-for="error in field" :key="error">{{ error }}</div>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            ></button>
          </div>
        </div>

        <form @submit.prevent="saveConsultSession">
          <div class="row">
            <div class="col">
              <div class="form-group mb-3">
                <!-- 'type', 'date', 'accomplished', 'admin_id' -->
                <label for="type">Tipo de consulta</label>
                <select
                  @blur="v$.type.$touch"
                  class="form-select"
                  :class="{
                    'is-invalid': v$.type.$error,
                    'is-valid': !v$.type.$invalid,
                  }"
                  v-model="form.type"
                >
                  <option disabled selected>Selecione o tipo</option>
                  <option value="Proteses">Próteses</option>
                  <option value="Proteses">Órtoteses</option>
                </select>

                <span
                  class="invalid-feedback"
                  v-for="error of v$.type.$errors"
                  :key="error.$uid"
                >
                  {{ error.$message }}
                </span>
              </div>
            </div>
            <div class="col">
              <div class="form-group mb-3">
                <label for="date">Data a realizar-se</label>
                <input
                  type="date"
                  @blur="v$.date.$touch"
                  class="form-control"
                  :class="{
                    'is-invalid': v$.date.$error,
                    'is-valid': !v$.date.$invalid,
                  }"
                  v-model="form.date"
                />

                <span
                  class="invalid-feedback"
                  v-for="error of v$.date.$errors"
                  :key="error.$uid"
                >
                  {{ error.$message }}
                </span>
              </div>
            </div>
          </div>

          <button class="btn btn-primary btn-block btn-lg">
            <span
              v-if="processing"
              class="spinner-border spinner-border-sm mx-2"
              role="status"
              aria-hidden="true"
            ></span>
            <span v-if="processing">Processando...</span>

            <i v-if="!processing" class="fa-solid fa-plus mx-2"></i>
            <span v-if="!processing">Salvar</span>
          </button>
        </form>
      </div>
    </main>
  </div>
</template>

<script>
import { reactive, computed, ref, onMounted, nextTick } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, helpers } from "@vuelidate/validators";
import { useUserStore } from "../../../stores/UserStore";

import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";
import useConsultSessions from "../../../composables/consultSessions";

export default {
  setup() {
    const form = reactive({
      type: "",
      date: "",
      admin_id: "",
    });

    const { processing, errors, storeConsultSession } = useConsultSessions();

    const rules = computed(() => ({
      type: {
        required: helpers.withMessage("Por favor selecione o tipo", required),
      },
      date: {
        required: helpers.withMessage("Por favor indique a data", required),
      },
      admin_id: {},
    }));

    const v$ = useVuelidate(rules, form);

    const saveConsultSession = async () => {
      const useUser = useUserStore();

      form.admin_id = useUser.user.id;

      v$._value.$validate();
      if (!v$._value.$invalid) {
        await storeConsultSession({ ...form });
      } else {
        processing.value = false;
      }
    };

    return {
      processing,
      errors,
      saveConsultSession,
      v$,
      form,
    };
  },
  components: {
    HPNavBar,
    HPSideBar,
  },
};
</script>
