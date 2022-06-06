<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="processes" />

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
          <h1 class="h2">Editar Processo</h1>
        </div>

        <!-- <router-link to="/processes" class="btn btn-primary mb-4"
          >Lista de processos</router-link
        > -->
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <router-link to="/processes">Processos</router-link>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Editar processo
            </li>
          </ol>
        </nav>
        <div v-if="errors">
          <div v-for="(v, k) in errors" :key="k">
            <p v-for="error in v" :key="error">
              {{ error }}
            </p>
          </div>
        </div>

        <form @submit.prevent="saveProcess" enctype="multipart/form-data">
          <div class="form-group mb-3">
            <label for="name">Nome da processo</label>
            <input
              @blur="v$.name.$touch"
              type="text"
              class="form-control"
              :class="{
                'is-invalid': v$.name.$error,
                'is-valid': !v$.name.$invalid,
              }"
              placeholder="Ex.: Próteses"
              v-model="process.name"
            />
            <span
              class="invalid-feedback"
              v-for="error of v$.name.$errors"
              :key="error.$uid"
            >
              {{ error.$message }}
            </span>
          </div>

          <button class="btn btn-primary btn-block btn-lg">
            <i
              v-if="processing"
              class="fa-solid fa-spinner fa-spin-pulse mx-2"
            ></i>
            <span v-if="processing">Processando...</span>

            <i v-if="!processing" class="fa-solid fa-user-plus mx-2"></i>
            Salvar
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

import useProcesses from "../../../composables/processes";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

const route = useRoute();
const { processing, errors, process, getProcess, updateProcess } =
  useProcesses();

onMounted(() => {
  getProcess(route.params.id);
});

const saveProcess = async () => {
  await updateProcess(route.params.id, { ...process });
};

const rules = computed(() => ({
  name: {
    required: helpers.withMessage("Por favor preencha o nome", required),
    minLength: helpers.withMessage(
      "Por favor preencha um nome válido",
      minLength(2)
    ),
    minValue: minLength(2),
  },

  created_at: {},
  updated_at: {},
}));

const v$ = useVuelidate(rules, process);
</script>
