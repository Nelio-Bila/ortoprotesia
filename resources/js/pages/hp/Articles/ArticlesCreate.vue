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
          <h1 class="h2">Novo artigo</h1>
        </div>

        <router-link to="/categories" class="btn btn-primary mb-4"
          >Lista de artigos</router-link
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

        <form @submit.prevent="saveArticle">
          <div class="form-group mb-3 text-center">
            <label for="title">Foto do cabecalho</label>
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
              v-model="form.postExcerpt"
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

          <button class="btn btn-primary btn-block btn-lg">
            <i
              v-if="processing"
              class="fa-solid fa-spinner fa-spin-pulse mx-2"
            ></i>
            <span v-if="processing">Processando...</span>

            <i v-if="!processing" class="fa-solid fa-plus mx-2"></i>
            <span v-if="!processing">Publicar</span>
          </button>
        </form>
      </div>
    </main>
  </div>
</template>

<script setup>
import { reactive, computed, ref, onMounted, nextTick } from "vue";
import useVuelidate from "@vuelidate/core";
import {
  required,
  minLength,
  helpers,
  minLengthValue,
} from "@vuelidate/validators";
import "@ckeditor/ckeditor5-build-classic/build/translations/pt";
import "../../../components/editor/ckeditor";

import useArticles from "../../../composables/categories";
import useCategories from "../../../composables/categories";
import HPNavBar from "../../../components/HPNavBar.vue";
import HPSideBar from "../../../components/HPSideBar.vue";

const form = reactive({
  title: "",
  body: "",
  postExcerpt: "",
  featuredImage: null,
  category_id: null,
});

const { categories, getCategories } = useCategories();

onMounted(() => {
  getCategories();
});

const editor = ref(ClassicEditor);
const editorData = ref("<p>Content of the editor.</p>");
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

const { processing, errors, storeArticle } = useArticles();

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
    minLengthValue: helpers.withMessage(
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
    minLengthValue: helpers.withMessage(
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
}));

const v$ = useVuelidate(rules, form);

const saveArticle = async () => {
  v$._value.$validate();
  if (!v$._value.$invalid) {
    await storeArticle({ ...form });
  } else {
    processing.value = false;
  }
};
</script>

<style>
.document-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  flex-grow: 1;
  max-width: 1280px;
  margin: 0 auto;
}

.toolbar-container {
  width: 100%;
}

.minimap-wrapper {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  max-height: calc(100vh - 400px);
  width: 100%;
  position: relative;
  top: -1px;
}

.editor-container {
  width: 100%;
  border: 1px solid hsl(0, 0%, 80%);
  border-right: 0;
  background: hsl(0, 0%, 95%);
  box-sizing: border-box;
  position: relative;
  overflow: auto;
}

.minimap-container {
  width: 120px;
  flex: 0 0 auto;
  border: 1px solid var(--ck-color-toolbar-border);
  position: relative;
  overflow: hidden;
  max-height: 100%;
}

#editor-content {
  width: calc(180mm + 2px);
  min-height: calc(210mm + 2px);
  height: auto;
  padding: 20mm 12mm;
  box-sizing: border-box;
  background: hsl(0, 0%, 100%);
  border: 1px solid hsl(0, 0%, 88%);
  box-shadow: 0 2px 8px hsla(0, 0%, 0%, 0.08);
  margin: 40px auto;
  overflow: hidden;
}
</style>
