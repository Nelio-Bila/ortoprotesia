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

          <!-- <div class="form-group mb-3">
            <label for="name">Foto da categoria</label>
            <div id="app">
              <upload-media
                server="/upload"
                :error="imageError"
                @media="form.image"
                v-model="form.image"
              >
              </upload-media>
              <span
                class="invalid-feedback"
                v-for="error of v$.image.$errors"
                :key="error.$uid"
              >
                {{ error.$message }}
              </span>
            </div>
            <span class="invalid-feedback" v-if="v$.image.$error">
              {{ v$.image.$errors[0].$message }}
            </span>
          </div> -->

          <img
            v-show="imageUrl"
            :src="imageUrl"
            class="w-24 h-24 object-cover"
          />
          <div class="form-group mb-3">
            <label for="image">Foto da categoria</label>
            <input
              class="form-control"
              type="file"
              accept="image/*"
              @change="handleImageSelected"
            />
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

          <!-- <div class="flex flex-wrap mt-8">
            <img
              v-for="(image, key) in images"
              :key="key"
              :src="image.image"
              class="w-48 h-46 object-cover mr-4 mb-4 shadow rounded"
              name="image"
            />
          </div> -->
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

export default {
  setup() {
    const form = reactive({
      name: "",
      image: [],
    });

    const {
      processing,
      errors,
      storeCategory,
      imageFile,
      imageUrl,
      handleImageSelected,
    } = useCategories();

    const saveCategory = async () => {
      let data = new FormData();
      data.append("image", imageFile.value);
      await storeCategory({ ...form });
    };

    // function Media(value) {
    //   form.image = value;
    // }

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

    return {
      form,
      handleImageSelected,
      imageUrl,
      processing,
      errors,
      saveCategory,
      v$,
    };
  },
  components: {
    HPNavBar,
    HPSideBar,
    UploadMedia,
  },
};
</script>
