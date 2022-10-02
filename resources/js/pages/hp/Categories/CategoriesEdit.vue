<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="categories" />

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
          <h1 class="h2">Editar Categoria</h1>
        </div>
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <router-link to="/categories">Categorias</router-link>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Editar categoria
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

        <form @submit.prevent="saveCategory" enctype="multipart/form-data">
          <div class="form-group mb-3">
            <label for="name">Nome da categoria</label>
            <input
              @blur="v$.name.$touch"
              type="text"
              class="form-control"
              :class="{
                'is-invalid': v$.name.$error,
                'is-valid': !v$.name.$invalid,
              }"
              placeholder="Ex.: Próteses"
              v-model="category.name"
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
            <span
              v-if="processing"
              class="spinner-border spinner-border-sm mx-2"
              role="status"
              aria-hidden="true"
            ></span>
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

import useCategories from "../../../composables/categories";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

const route = useRoute();
const { processing, errors, category, getCategory, updateCategory } =
  useCategories();

onMounted(() => {
  getCategory(route.params.id);
});

const saveCategory = async () => {
  await updateCategory(route.params.id, { ...category });
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
  deleted_at: {},
  created_at: {},
  updated_at: {},
}));

const v$ = useVuelidate(rules, category);
</script>
