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

        <!-- <router-link to="/categories" class="btn btn-primary mb-4"
          >Lista de categorias</router-link
        > -->
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
                    v-if="category.image"
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

import useCategories from "../../../composables/categories";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

const route = useRoute();
const { processing, errors, category, getCategory, updateCategory } =
  useCategories();

onMounted(() => {
  getCategory(route.params.id);
});

const src = ref("/images/icons/category_default.png");
const input = ref(null);

const form = reactive({
  file: null,
});

function browse() {
  input.value.click();
}

function remove() {
  form.file = null;
  src.value = "/images/icons/category_default.png";
}
function change(e) {
  form.file = e.target.files[0];
  category.value.image = e.target.files[0];

  let reader = new FileReader();
  reader.readAsDataURL(e.target.files[0]);
  reader.onload = (e) => {
    src.value = e.target.result;
  };
  nextTick();
}

const saveCategory = async () => {
  //   let data = new FormData();
  //   data.append("name", "ghoust");
  //   data.append("image", form.file);
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
  image: {},
  created_at: {},
  updated_at: {},
}));

const v$ = useVuelidate(rules, category);
</script>
