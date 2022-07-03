<template>
  <div class="d-flex" id="wrapper">
    <HPSideBar currentLink="articles" />

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
          <h1 class="h2">Editar artigo</h1>
        </div>

        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <router-link to="/hp/articles">Artigos</router-link>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Editar artigo
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

        <form @submit.prevent="saveArticle" enctype="multipart/form-data">
          <div class="form-group mb-3 text-center">
            <label for="title">Foto do cabecalho</label>
            <img
              :src="src"
              :alt="article.title"
              class="h-52 w-52 my-3 d-block mx-auto"
            />
            <i
              v-if="article.featuredImage"
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
              placeholder="Foto de cabeçalho do artigo"
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
            <label for="title">Titulo do artigo</label>
            <input
              @blur="v$.title.$touch"
              type="text"
              class="form-control"
              :class="{
                'is-invalid': v$.title.$error,
                'is-valid': !v$.title.$invalid,
              }"
              placeholder="Titulo"
              v-model="article.title"
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
            <label for="title">Trecho introdutório do artigo</label>
            <input
              @blur="v$.postExcerpt.$touch"
              type="text"
              class="form-control"
              :class="{
                'is-invalid': v$.postExcerpt.$error,
                'is-valid': !v$.postExcerpt.$invalid,
              }"
              placeholder="Titulo"
              v-model="article.postExcerpt"
            />

            <span
              class="invalid-feedback"
              v-for="error of v$.postExcerpt.$errors"
              :key="error.$uid"
            >
              {{ error.$message }}
            </span>
          </div>

          <div class="form-group mb-3">
            <label for="title">Corpo do artigo</label>
            <ckeditor
              :editor="editor"
              v-model="article.body"
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
            <label for="category_id">Categoria do artigo</label>
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
              <option selected disabled>Selecione a categoria do artigo</option>
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

            <i v-if="!processing" class="fa-solid fa-plus mx-2"></i>
            <span v-if="!processing">Salvar</span>
          </button>
        </form>
      </div>
    </main>
  </div>
</template>

<script setup>
import { reactive, computed, ref, onMounted, watch } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, minLength, helpers, minValue } from "@vuelidate/validators";
import "@ckeditor/ckeditor5-build-classic/build/translations/pt";
import "../../../components/editor/ckeditor";

import useArticles from "../../../composables/articles";
import useCategories from "../../../composables/categories";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

const props = defineProps(["id"]);

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

const { processing, errors, article, getArticle, updateArticle } =
  useArticles();

onMounted(() => {
  getArticle(props.id);
  console.log(article.featuredImage);
  // src.value = article.featuredImage;
});

const changeFeaturedImage = (event) => {
  article.featuredImage = event.target.files[0];
  console.log(article.featuredImage);
  let reader = new FileReader();
  reader.readAsDataURL(event.target.files[0]);
  reader.onload = (e) => {
    src.value = e.target.result;
  };
};

const defaultSrc = ref("/images/logo.png");
const src = ref(defaultSrc.value);
const fileInput = ref(null);
const creating = ref(true);

watch(article.featuredImage, async (featuredImage, oldfeaturedImage) => {
  console.log("featuredImage", featuredImage);
  src.value = featuredImage;
});

const removeImage = () => {
  article.featuredImage = null;
  fileInput.value.value = "";
  src.value = defaultSrc.value;
};

const rules = computed(() => ({
  title: {
    required: helpers.withMessage(
      "Por favor preencha o titulo do artigo",
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
      "Por favor preencha o conteúdo do artigo",
      required
    ),
    minLength: helpers.withMessage(
      "Por favor preencha um contéudo válido",
      minLength(2)
    ),
    minValue: helpers.withMessage(
      "O titulo deve ter trinta caracteres no minímo",
      minLength(30)
    ),
  },
  category_id: {
    required: helpers.withMessage(
      "Por favor selecione a categoria do artigo",
      required
    ),
  },
  postExcerpt: {
    required: helpers.withMessage(
      "Por favor preencha o trecho introdutório do artigo",
      required
    ),
  },
  featuredImage: {},
}));

const v$ = useVuelidate(rules, article);

const saveArticle = async () => {
  v$._value.$validate();

  let data = new FormData();
  data.append("title", article.title);
  data.append("body", article.body);
  data.append("postExcerpt", article.postExcerpt);
  data.append("featuredImage", article.featuredImage);
  data.append("category_id", article.category_id);
  data.append("metaDescription", article.title);
  data.append("slug", article.title.replace(/\s/g, ""));
  creating.value = false;
  await updateArticle(props.id, data);
};
</script>

<style lang="scss" scoped>
.form-group {
  padding: 5px 0;
  margin-bottom: 10px;
}
</style>
