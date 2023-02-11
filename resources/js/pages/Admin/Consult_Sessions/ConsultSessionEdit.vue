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
          <h1 class="h2">Editar Sessão de consultas</h1>
        </div>
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <router-link to="/consultsessions"
                >Sessões de consultas</router-link
              >
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Editar Sessão de consultas
            </li>
          </ol>
        </nav>

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
                <label for="date">Tipo de consulta</label>
                <select
                  @blur="v$.type.$touch"
                  class="form-select"
                  :class="{
                    'is-invalid': v$.type.$error,
                    'is-valid': !v$.type.$invalid,
                  }"
                  v-model="consultSession.type"
                >
                  <option value="Proteses">Próteses</option>
                  <option value="Proteses">Órtoteses</option>
                </select>
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
                  v-model="consultSession.date"
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

            <i v-if="!processing" class="fa-solid fa-floppy-disk mx-2"></i>
            Actualizar
          </button>
        </form>
      </div>
    </main>
  </div>
</template>

<script setup>
import { onMounted, computed, ref, reactive, nextTick } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, helpers, minValue } from "@vuelidate/validators";
import { useRoute } from "vue-router";

import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";
import useConsultSessions from "../../../composables/consultSessions";

const route = useRoute();

const {
  processing,
  errors,
  consultSession,
  getConsultSession,
  updateConsultSession,
} = useConsultSessions();

onMounted(() => {
  getConsultSession(route.params.id);
});

const saveConsultSession = async () => {
  v$._value.$validate();
  if (!v$._value.$invalid) {
    await updateConsultSession(route.params.id, { ...consultSession.value });
  } else {
    processing.value = false;
  }
};

const rules = computed(() => ({
  type: {
    required: helpers.withMessage("Por favor preencha o nome", required),
  },
  date: {
    required: helpers.withMessage("Por favor preencha a data", required),
  },
  accomplished: {},
  admin_id: {},
  created_at: {},
  updated_at: {},
}));

const v$ = useVuelidate(rules, consultSession);
</script>
