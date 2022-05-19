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
          <h1 class="h2">Registro de nova categoria</h1>
        </div>

        <router-link to="/categories" class="btn btn-primary mb-4"
          >Lista de categorias</router-link
        >
        <!-- <div v-if="errors">
          <div v-for="(v, k) in errors" :key="k">
            <p v-for="error in v" :key="error">
              {{ error }}
            </p>
          </div>
        </div> -->
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

        <form @submit.prevent="saveCategory">
          <div class="form-group mb-3 text-center">
            <label for="name">Icone da categoria</label>
            <image-input
              @input="getImage"
              defaultSrc="/images/icons/category_default.png"
            ></image-input>
          </div>
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
              v-model="form.name"
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

            <i v-if="!processing" class="fa-solid fa-plus mx-2"></i>
            <span v-if="!processing">Salvar</span>
          </button>
        </form>
      </div>
    </main>
  </div>
</template>

<script>
import { reactive, computed } from "vue";
import useVuelidate from "@vuelidate/core";
import {
  required,
  minLength,
  helpers,
  minLengthValue,
} from "@vuelidate/validators";
import { UploadMedia } from "vue-media-upload";

import useCategories from "../../../composables/categories";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";
import ImageInput from "../../../components/ImageInput.vue";

export default {
  setup() {
    const form = reactive({
      name: "",
      image: null,
    });

    const { processing, errors, storeCategory } = useCategories();

    function getImage(value) {
      form.image = value;
    }

    const rules = computed(() => ({
      name: {
        required: helpers.withMessage("Por favor preencha o nome", required),
        minLength: helpers.withMessage(
          "Por favor preencha um nome válido",
          minLength(2)
        ),
        minLengthValue: helpers.withMessage(
          "O nome deve ter dois caracteres no minímo",
          minLength(2)
        ),
      },
      image: {},
    }));

    const v$ = useVuelidate(rules, form);

    const saveCategory = async () => {
      v$._value.$validate();
      if (!v$._value.$invalid) {
        await storeCategory({ ...form });
      } else {
        processing.value = false;
      }
    };

    return {
      form,
      processing,
      errors,
      saveCategory,
      getImage,
      v$,
    };
  },
  components: {
    HPNavBar,
    HPSideBar,
    UploadMedia,
    ImageInput,
  },
};
</script>
