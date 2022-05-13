<template>
  <div>
    <HPNavBar />

    <div class="container-fluid">
      <div class="row">
        <HPSideBar currentLink="categories" />

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
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
            <h1 class="h2">Categorias</h1>
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
                @blur="v$.form.name.$touch"
                type="text"
                class="form-control"
                :class="{
                  'is-invalid': v$.form.name.$error,
                  'is-valid': !v$.form.name.$invalid,
                }"
                placeholder="Ex.: Próteses"
                v-model="v$.form.name.$model"
              />
              <span class="invalid-feedback" v-if="v$.form.name.$error">
                {{ v$.form.name.$errors[0].$message }}
              </span>
            </div>

            <div class="form-group mb-3">
              <label for="name">Foto da categoria</label>
              <div id="app">
                <upload-media
                  server="/upload"
                  :error="imageError"
                  @media="form.image"
                  v-model="v$.form.image.$model"
                >
                </upload-media>
              </div>
            </div>

            <button class="btn btn-primary btn-block btn-lg">
              <i
                v-if="processing"
                class="fa-solid fa-spinner fa-spin-pulse mx-2"
              ></i>
              <span v-if="processing">Processando...</span>

              <i v-if="!processing" class="fa-solid fa-plus mx-2"></i>
              Salvar
            </button>
          </form>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive } from "vue";
import useVuelidate from "@vuelidate/core";
import {
  required,
  minLength,
  helpers,
  minLengthValue,
} from "@vuelidate/validators";
import { UploadMedia, UpdateMedia } from "vue-media-upload";

import useCategories from "../../../composables/categories";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

export default {
  setup() {
    const { processing, errors, storeCategory } = useCategories();
    const saveCategory = async () => {
      await storeCategory({ ...this.form });
    };

    function Media(value) {
      this.form.image = value;
    }

    return {
      processing,
      errors,
      Media,
      saveCategory,
      v$: useVuelidate(),
    };
  },
  data() {
    return {
      form: { name: "", image: [] },
      errors_exist: false,
      validationErrors: null,
      imageError: "",
    };
  },
  validations() {
    return {
      form: {
        name: {
          required: helpers.withMessage(
            "Por favor preencha o nome da categoria",
            required
          ),
          minLength: helpers.withMessage(
            "Por favor preencha um nome válido",
            minLength(2)
          ),
          minLengthValue: minLength(2),
        },
        image: {},
      },
      errors_exist: {},
      validationErrors: {},
      imageError: {},
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
