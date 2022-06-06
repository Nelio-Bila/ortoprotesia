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
            <div>
              <input
                type="file"
                accept="image/*"
                class="hidden"
                ref="input"
                @change="change"
              />
              <div class="relative inline-block rounded-3">
                <img
                  :src="src"
                  alt=""
                  class="h-52 w-52 object-cover rounded-3"
                />
                <div
                  class="
                    absolute
                    top-0
                    h-full
                    w-full
                    bg-black bg-opacity-25
                    flex
                    items-center
                    justify-center
                    rounded-3
                  "
                >
                  <i
                    @click.prevent="browse()"
                    class="
                      fa-solid fa-camera fa-2xl
                      primary-color
                      cursor-pointer
                      hover:white
                      mx-2
                    "
                  ></i>
                  <i
                    v-if="form.file"
                    @click.prevent="remove()"
                    class="
                      fa-solid fa-xmark fa-2xl
                      primary-color
                      cursor-pointer
                      hover:white
                      mx-2
                    "
                  ></i>
                </div>
              </div>
            </div>
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
import { reactive, computed, ref, onMounted, nextTick } from "vue";
import useVuelidate from "@vuelidate/core";
import {
  required,
  minLength,
  helpers,
  minLengthValue,
} from "@vuelidate/validators";

import useCategories from "../../../composables/categories";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";
import ImageInput from "../../../components/ImageInput.vue";

export default {
  setup() {
    const form = reactive({
      name: "",
      file: null,
    });

    const src = ref("/images/icons/category_default.png");
    const input = ref(null);

    function browse() {
      input.value.click();
    }

    function remove() {
      form.file = null;
      src.value = "/images/icons/category_default.png";
    }
    function change(e) {
      form.file = e.target.files[0];

      let reader = new FileReader();
      reader.readAsDataURL(e.target.files[0]);
      reader.onload = (e) => {
        src.value = e.target.result;
      };
      nextTick();
    }

    const { processing, errors, storeCategory } = useCategories();

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
      file: {},
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
      processing,
      errors,
      saveCategory,
      v$,
      src,
      form,
      input,
      browse,
      remove,
      change,
    };
  },
  components: {
    HPNavBar,
    HPSideBar,
    ImageInput,
  },
};
</script>
