<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="news" />

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
          <h1 class="h2">Nova noticia</h1>
        </div>

        <router-link to="/admin/news" class="btn btn-primary mb-4"
          >Lista de noticias</router-link
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

        <form @submit.prevent="saveNews" enctype="multipart/form-data">
          <div class="form-group mb-3 text-center">
            <label for="title">Foto do cabecalho</label>
            <img
              :src="src"
              :alt="form.title"
              class="h-52 w-52 my-3 d-block mx-auto"
            />
            <i
              v-if="form.featuredImage"
              @click.prevent="removeImage()"
              class="fa-solid fa-xmark fa-2xl cursor-pointer hover:primary mb-5"
            ></i>

            <input
              @blur="v$.featuredImage.$touch"
              type="file"
              class="form-control"
              :class="{
                'is-invalid': v$.featuredImage.$error,
                'is-valid': !v$.featuredImage.$invalid,
              }"
              placeholder="Foto de cabeçalho da noticia"
              v-on:change="changeFeaturedImage"
              ref="fileInput"
            />

            <span
              class="invalid-feedback"
              v-for="error of v$.featuredImage.$errors"
              :key="error.$uid"
            >
              {{ error.$message }}
            </span>
          </div>

          <div class="form-group mb-3">
            <label for="title">Titulo da noticia</label>
            <input
              @blur="v$.title.$touch"
              type="text"
              class="form-control"
              :class="{
                'is-invalid': v$.title.$error,
                'is-valid': !v$.title.$invalid,
              }"
              placeholder="Titulo"
              v-model="form.title"
            />

            <span
              class="invalid-feedback"
              v-for="error of v$.title.$errors"
              :key="error.$uid"
            >
              {{ error.$message }}
            </span>
          </div>

          <div class="form-group mb-3">
            <label for="title">Corpo da noticia</label>
            <ckeditor
              :editor="editor"
              v-model="form.body"
              :config="editorConfig"
              class="form-control"
            ></ckeditor>

            <span
              class="invalid-feedback"
              v-for="error of v$.body.$errors"
              :key="error.$uid"
            >
              {{ error.$message }}
            </span>
          </div>

          <div class="form-group mb-3">
            <label for="category_id">Categoria da noticia</label>
            <select
              id="category_id"
              @blur="v$.category_id.$touch"
              class="form-select"
              :class="{
                'is-invalid': v$.category_id.$error,
                'is-valid': !v$.category_id.$invalid,
              }"
              aria-label="Selecção de categoria"
              v-model="v$.category_id.$model"
            >
              <option selected disabled>
                Selecione a categoria da noticia
              </option>
              <option
                v-for="category in categories"
                :key="category.id"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>

            <span
              class="invalid-feedback"
              v-for="error of v$.category_id.$errors"
              :key="error.$uid"
            >
              {{ error.$message }}
            </span>
          </div>

          <button class="btn btn-primary btn-block mb-3" :disabled="processing">
            <span
              v-if="processing"
              class="spinner-border spinner-border-sm mx-2"
              role="status"
              aria-hidden="true"
            ></span>
            <span v-if="processing">Processando...</span>

            <i v-if="!processing" class="fa-solid fa-floppy-disk mx-2"></i>
            <span v-if="!processing">Salvar</span>
          </button>
          <!-- <button
              class="btn btn-primary btn-block mb-3 mx-10"
              :disabled="processing"
            >
              <span
                v-if="processing"
                class="spinner-border spinner-border-sm mx-2"
                role="status"
                aria-hidden="true"
              ></span>
              <span v-if="processing">Processando...</span>

              <i v-if="!processing" class="fa-solid fa-newspaper mx-2"></i>
              <span v-if="!processing">Publicar</span>
            </button> -->
        </form>
      </div>
    </main>
  </div>
</template>

  <script setup>
import { reactive, computed, ref, onMounted, nextTick } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, helpers, minValue } from "@vuelidate/validators";
import "@ckeditor/ckeditor5-build-classic/build/translations/pt";
import "../../../components/editor/ckeditor";
import VueAnkaCropper from "../../../components/VueAnkaCropper.vue";
import { onBeforeRouteLeave } from "vue-router";
import Swal from "sweetalert2";

import useNews from "../../../composables/news";
import useCategories from "../../../composables/categories";
import { useUserStore } from "../../../stores/UserStore";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

const form = reactive({
  title: "",
  body: "",
  featuredImage: null,
  category_id: null,
});

const defaultSrc = ref("/images/logo.png");
const src = ref(defaultSrc.value);

const creating = ref(true);
const useUser = useUserStore();

const { categories, getCategories } = useCategories();

onMounted(() => {
  getCategories();
});

const editor = ref(ClassicEditor);
const editorData = ref("");
const editorConfig = reactive({
  language: "pt",
  fontFamily: {
    options: [
      "default",
      "Ubuntu, Arial, sans-serif",
      "Ubuntu Mono, Courier New, Courier, monospace",
    ],
  },
  heading: {
    options: [
      {
        model: "paragraph",
        title: "Paragraph",
        class: "ck-heading_paragraph",
      },
      {
        model: "heading1",
        view: "h1",
        title: "Heading 1",
        class: "ck-heading_heading1",
      },
      {
        model: "heading2",
        view: "h2",
        title: "Heading 2",
        class: "ck-heading_heading2",
      },
      {
        model: "heading3",
        view: "h3",
        title: "Heading 3",
        class: "ck-heading_heading3",
      },
      {
        model: "heading4",
        view: "h4",
        title: "Heading 4",
        class: "ck-heading_heading4",
      },
      {
        model: "heading5",
        view: "h5",
        title: "Heading 5",
        class: "ck-heading_heading5",
      },
      {
        model: "heading6",
        view: "h6",
        title: "Heading 6",
        class: "ck-heading_heading6",
      },
    ],
  },
  supportAllValues: true,
  toolbar: {
    shouldNotGroupWhenFull: true,
    items: [
      "heading",
      "FontFamily",
      "FontSize",
      "FontColor",
      "FontBackgroundColor",
      "Highlight",
      "indent",
      "outdent",
      "|",
      "bold",
      "italic",
      "Underline",
      "strikethrough",
      "HorizontalLine",
      "|",
      "alignment:left",
      "alignment:right",
      "alignment:center",
      "alignment:justify",
      "bulletedList",
      "numberedList",

      "|",
      "blockQuote",
      "insertTable",
      "mediaEmbed",
      "ImageInsert",
      "link",
      // "imageTextAlternative",
      "Superscript",
      "Subscript",

      "|",
      "Code",
      "htmlEmbed",
      "CodeBlock",
      "|",
      "SpecialCharacters",
      "SelectAll",
      "removeFormat",
      "undo",
      "redo",
    ],
  },
  image: {
    styles: ["alignLeft", "alignCenter", "alignRight"],
    resizeOptions: [
      {
        name: "imageResize:original",
        label: "Original",
        value: null,
      },
      {
        name: "imageResize:75",
        label: "75%",
        value: "75",
      },
      {
        name: "imageResize:50",
        label: "50%",
        value: "50",
      },
      {
        name: "imageResize:50",
        label: "20%",
        value: "20",
      },
      {
        name: "imageResize:20",
        label: "10%",
        value: "10",
      },
    ],

    // You need to configure the image toolbar, too, so it shows the new style
    // buttons as well as the resize buttons.
    toolbar: [
      "imageStyle:alignLeft",
      "imageStyle:alignCenter",
      "imageStyle:alignRight",
      "|",
      "imageResize",
      "|",
      "imageTextAlternative",
    ],
  },
  table: {
    contentToolbar: [
      "tableColumn",
      "tableRow",
      "mergeTableCells",
      "tableProperties",
      "tableCellProperties",
    ],
  },
});
// The configuration of the editor.

const { processing, errors, storeNews } = useNews();

const rules = computed(() => ({
  title: {
    required: helpers.withMessage(
      "Por favor preencha o titulo da noticia",
      required
    ),
    minLength: helpers.withMessage(
      "Por favor preencha um titulo válido",
      minLength(2)
    ),
    minValue: helpers.withMessage(
      "O titulo deve ter dois caracteres no minímo",
      minLength(2)
    ),
  },
  body: {
    required: helpers.withMessage(
      "Por favor preencha o conteúdo da noticia",
      required
    ),
    minLength: helpers.withMessage(
      "Por favor preencha um contéudo válido",
      minLength(2)
    ),
    minValue: helpers.withMessage(
      "O conteúdo deve ter trinta caracteres no minímo",
      minLength(30)
    ),
  },
  category_id: {
    required: helpers.withMessage(
      "Por favor selecione a categoria da noticia",
      required
    ),
  },
  featuredImage: {},
}));

const changeFeaturedImage = (event) => {
  form.featuredImage = event.target.files[0];
  let reader = new FileReader();
  reader.readAsDataURL(event.target.files[0]);
  reader.onload = (e) => {
    src.value = e.target.result;
  };
};

const fileInput = ref(null);
const removeImage = () => {
  form.featuredImage = null;
  fileInput.value.value = "";
  src.value = defaultSrc.value;
};

const v$ = useVuelidate(rules, form);

const saveNews = async () => {
  v$._value.$validate();

  //   if (!v$._value.$invalid) {
  let data = new FormData();
  data.append("title", form.title);
  data.append("body", form.body);
  data.append("featuredImage", form.featuredImage);
  data.append("category_id", form.category_id);
  data.append("slug", form.title.replace(/\s/g, ""));
  creating.value = false;

  await storeNews(data);
  //   } else {
  //     processing.value = false;
  //   }
};

// onBeforeRouteLeave((to, from) => {
//   if (creating.value) {
//     const answer = window.confirm(
//       "Tens certeza que desejas sair desta pagina?"
//     );
//     // cancel the navigation and stay on the same page
//     if (!answer) return false;
//   }
// });
</script>

  <style lang="scss" scoped>
/* @import "../node_modules/vue-anka-cropper/dist/VueAnkaCropper.css"; */
@import "../../../../../node_modules/vue-anka-cropper/dist/VueAnkaCropper.css";

.options,
.cropper,
.events {
  padding: 2em 0;
}

@media (min-width: 600px) {
  .options,
  .cropper,
  .events {
    float: left;
    padding: 2em;
    box-sizing: border-box;
  }
  .options {
    width: 30%;
  }
  .cropper {
    width: 70%;
  }
  .events {
    width: 70%;
  }
}

@media (min-width: 1260px) {
  .options {
    width: 20%;
  }
  .cropper {
    width: 60%;
  }
  .events {
    width: 20%;
  }
}

.form-group {
  padding: 5px 0;
  margin-bottom: 10px;
}

.chip {
  display: inline-block;
  background: #234e72;
  padding: 5px 10px;
  margin: 0 10px 10px 0;
  border-radius: 4px;
  cursor: pointer;
  &:hover {
    background: #6f1414;
  }
}
</style>
