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

        <form @submit.prevent="saveArticle" enctype="multipart/form-data">
          <div class="form-group mb-3 text-center">
            <label for="title">Foto do cabecalho</label>
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
            />

            <!-- <vue-anka-cropper
              :options="options"
              @cropper-mounted="debug($event, 'cropper-mounted')"
              @cropper-error="debug($event, 'cropper-error')"
              @cropper-file-selected="debug($event, 'cropper-file-selected')"
              @cropper-preview="debug($event, 'cropper-preview')"
              @cropper-saved="debug($event, 'cropperSaved')"
              @cropper-cancelled="debug($event, 'cropper-cancelled')"
              @cropper-uploaded="debug($event, 'cropper-uploaded')"
              @cropper-before-destroy="debug($event, 'cropper-before-destroy')"
            ></vue-anka-cropper> -->

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
import { required, minLength, helpers, minValue } from "@vuelidate/validators";
import "@ckeditor/ckeditor5-build-classic/build/translations/pt";
import "../../../components/editor/ckeditor";
import VueAnkaCropper from "../../../components/VueAnkaCropper.vue";

import useArticles from "../../../composables/articles";
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

const crop = reactive({
  closeOnSave: true,
  cropArea: "box",
  croppedHeight: 400,
  croppedWidth: 800,
  dropareaMessage: "Arraste e solte uma imagem aqui ou use o botão abaixo.",
  frameLineDash: [5, 3],
  frameStrokeColor: "#273a7e",
  handleFillColor: "rgba(255, 255, 255, 0.2)",
  handleHoverFillColor: "rgba(255, 255, 255, 0.4)",
  handleHoverStrokeColor: "rgba(255, 255, 255, 1)",
  handleSize: 10,
  handleStrokeColor: "rgba(255, 255, 255, 0.8)",
  layoutBreakpoint: 850,
  maxCropperHeight: 768,
  maxFileSize: 4000000, // 8MB
  overlayFill: "rgba(0, 0, 0, 0.5)",
  previewOnDrag: true,
  previewQuality: 0.65,
  resultQuality: 0.8,
  resultMimeType: "image/jpeg",
  selectButtonLabel: "Seleciona uma imagem",
  showPreview: true,
  skin: "light",
  uploadData: {},
  uploadTo: false,
  // demo, internal
  cropperH: 500,
  useCropperH: false,
  dash: "",
  upl: "/api/uploadarticleheaderimage",
  useAr: true,
  ar: 1,
  events: [],
});

const options = computed(() => {
  return {
    aspectRatio: crop.aspectRatio,
    closeOnSave: crop.closeOnSave,
    cropArea: crop.cropArea,
    croppedHeight: crop.croppedHeight,
    croppedWidth: crop.croppedWidth,
    cropperHeight: crop.cropperHeight,
    dropareaMessage: crop.dropareaMessage,
    frameLineDash: crop.frameLineDash,
    frameStrokeColor: crop.frameStrokeColor,
    handleFillColor: crop.handleFillColor,
    handleHoverFillColor: crop.handleHoverFillColor,
    handleHoverStrokeColor: crop.handleHoverStrokeColor,
    handleSize: crop.handleSize,
    handleStrokeColor: crop.handleStrokeColor,
    layoutBreakpoint: crop.layoutBreakpoint,
    maxCropperHeight: crop.maxCropperHeight,
    maxFileSize: crop.maxFileSize,
    overlayFill: crop.overlayFill,
    previewOnDrag: crop.previewOnDrag,
    previewQuality: crop.previewQuality,
    resultQuality: crop.resultQuality,
    resultMimeType: crop.resultMimeType,
    selectButtonLabel: crop.selectButtonLabel,
    showPreview: crop.showPreview,
    skin: crop.skin,
    uploadData: crop.uploadData,
    uploadTo: crop.uploadTo,
  };
});
const cropperHeight = computed(() => {
  return crop.useCropperH ? crop.cropperH : false;
});

const aspectRatio = computed(() => {
  return crop.useAr ? crop.ar : false;
});

const debug = (ev, name) => {
  crop.events.unshift({ name: name, payload: ev });
  if (crop.events.lenght > 10) {
    crop.events.pop();
  }
};
const printEv = (e) => {
  if (e.payload === undefined) return "No payload";
  if (e.name === "cropper-preview") {
    return (
      'Image data URI<br/><img src="' +
      e.payload +
      '" alt="" style="max-width: 100px;"/>'
    );
  }
  if (e.name === "cropper-error") {
    return e.payload;
  }
  if (e.name === "cropper-file-selected") {
    return "Payload: selected file";
  }
  if (e.name === "cropper-saved") {
    let d = e.payload;
    let output = "<div><strong>cropCoords</strong><br/>";
    for (let p in d.cropCoords) {
      output += p + ": " + d.cropCoords[p] + "<br/>";
    }
    output += "</div>";
    output += "<div><strong>croppedFile</strong><br/>Blob</div>";
    output +=
      '<div><strong>croppedImageURI</strong><br/><img src="' +
      d.croppedImageURI +
      '" alt="" style="max-width: 100px;"/></div>';
    output += "<div><strong>filename</strong><br/>" + d.filename + "</div>";
    output += "<div><strong>flippedH</strong><br/>" + d.flippedH + "</div>";
    output += "<div><strong>flippedV</strong><br/>" + d.flippedV + "</div>";
    output += "<div><strong>originalFile</strong><br/>File</div>";
    output += "<div><strong>rotation</strong><br/>" + d.rotation + "</div>";
    return output;
  }
};
const addDash = (ev) => {
  let num = parseInt(ev.target.value.trim());
  if (!isNaN(num)) {
    crop.frameLineDash.push(num);
  }
  crop.dash = "";
};
const removeDash = (i) => {
  crop.frameLineDash.splice(i, 1);
};

const cropperSaved = (ev) => {
  console.log(ev);
};

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

const changeFeaturedImage = (event) => {
  form.featuredImage = event.target.files[0];
};

const v$ = useVuelidate(rules, form);

const saveArticle = async () => {
  v$._value.$validate();

  if (!v$._value.$invalid) {
    let data = new FormData();
    data.append("title", form.title);
    data.append("body", form.body);
    data.append("postExcerpt", form.postExcerpt);
    data.append("featuredImage", form.featuredImage);
    data.append("category_id", form.category_id);
    data.append("metaDescription", "metaDescription");
    data.append("health_professional_id", 1);
    data.append("slug", form.title.replace(/\s/g, ""));
    await storeArticle(data);
  } else {
    processing.value = false;
  }
};
</script>

<style lang="scss" scoped>
/* @import "../node_modules/vue-anka-cropper/dist/VueAnkaCropper.css"; */
@import "../../../../../node_modules/vue-anka-cropper/dist/VueAnkaCropper.css";

// .document-container {
//   display: flex;
//   flex-direction: column;
//   align-items: center;
//   position: relative;
//   flex-grow: 1;
//   max-width: 1280px;
//   margin: 0 auto;
// }

// .toolbar-container {
//   width: 100%;
// }

// .minimap-wrapper {
//   display: flex;
//   flex-direction: row;
//   flex-wrap: nowrap;
//   max-height: calc(100vh - 400px);
//   width: 100%;
//   position: relative;
//   top: -1px;
// }

// .editor-container {
//   width: 100%;
//   border: 1px solid hsl(0, 0%, 80%);
//   border-right: 0;
//   background: hsl(0, 0%, 95%);
//   box-sizing: border-box;
//   position: relative;
//   overflow: auto;
// }

// .minimap-container {
//   width: 120px;
//   flex: 0 0 auto;
//   border: 1px solid var(--ck-color-toolbar-border);
//   position: relative;
//   overflow: hidden;
//   max-height: 100%;
// }

// #editor-content {
//   width: calc(180mm + 2px);
//   min-height: calc(210mm + 2px);
//   height: auto;
//   padding: 20mm 12mm;
//   box-sizing: border-box;
//   background: hsl(0, 0%, 100%);
//   border: 1px solid hsl(0, 0%, 88%);
//   box-shadow: 0 2px 8px hsla(0, 0%, 0%, 0.08);
//   margin: 40px auto;
//   overflow: hidden;
// }

/* .cropper {
  height: 600px;
  background: #ddd;
} */

// body {
//   background: #111;
//   color: #eee;
// }
// #app {
//   font-family: "Avenir", Helvetica, Arial, sans-serif;
//   -webkit-font-smoothing: antialiased;
//   -moz-osx-font-smoothing: grayscale;
//   margin-top: 60px;
// }
// a {
//   color: #0cf;
// }
// h1 {
//   text-align: center;
// }

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

// input,
// select,
// label {
//   width: 100%;
//   display: block;
//   margin-bottom: 5px;
// }

// input[type="checkbox"] {
//   width: auto;
//   margin-right: 10px;
//   float: left;
// }

// input,
// select {
//   box-sizing: border-box;
//   border: none;
//   padding: 6px 12px;
//   border-radius: 3px;
// }

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
