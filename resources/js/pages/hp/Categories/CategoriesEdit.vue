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

        <router-link to="/categories" class="btn btn-primary mb-4"
          >Lista de categorias</router-link
        >
        <div v-if="errors">
          <div v-for="(v, k) in errors" :key="k">
            <p v-for="error in v" :key="error">
              {{ error }}
            </p>
          </div>
        </div>

        <form @submit.prevent="saveCategory">
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

          <div class="form-group mb-3">
            <div id="app">
              <upload-media server="/upload" error=""> </upload-media>
            </div>
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

<script>
import { onMounted, computed } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, helpers, minValue } from "@vuelidate/validators";
import { UploadMedia, UpdateMedia } from "vue-media-upload";

import useCategories from "../../../composables/categories";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

export default {
  props: {
    id: {
      required: true,
      type: String,
    },
  },
  setup(props) {
    const { processing, errors, category, getCategory, updateCategory } =
      useCategories();

    onMounted(getCategory(props.id));

    const saveCategory = async () => {
      await updateCategory(props.id);
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
    }));

    const v$ = useVuelidate(rules, category);

    return {
      processing,
      errors,
      category,
      saveCategory,
      v$,
    };
  },

  components: {
    HPNavBar,
    HPSideBar,
    UploadMedia,
    UpdateMedia,
  },
};
</script>
