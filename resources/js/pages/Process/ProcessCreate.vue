<template>
  <div>
    <NavBar />
    <div class="wrapper">
      <!-- Sidebar -->
      <nav id="sidebar" class="bg-primary">
        <div class="sidebar-header">
          <h3>Processo</h3>
        </div>

        <ul class="list-unstyled components">
          <li class="active">
            <router-link to="/process/create" class="nav-link text-white"
              >Abertura de processo</router-link
            >
          </li>
          <li class="active">
            <router-link to="/process" class="nav-link text-white"
              >Dados do processo</router-link
            >
          </li>
          <li>
            <router-link to="/consults" class="nav-link text-white"
              >Consultas</router-link
            >
          </li>
          <li>
            <router-link to="/consult/create" class="nav-link text-white"
              >Nova consulta</router-link
            >
          </li>
        </ul>
      </nav>

      <!-- Page Content -->
      <div
        id="content"
        class="container-fluid align-items-center justify-content-center"
      >
        <!-- We'll fill this with dummy content -->
        <div
          @click="toggleSideMenu"
          id="sidebarCollapse"
          class="my-2 text-primary cursor-pointer"
        >
          <i class="fas fa-align-left fa-2xl"></i>
        </div>
        <!-- <div class="container align-items-center justify-content-center"> -->
        <div class="row m-2">
          <div class="col mx-auto">
            <form @submit.prevent="saveProcess">
              <h3 class="text-center">Abertura de processo</h3>
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
              <div class="row mb-3 border py-2">
                <label class="my-2">Endereço</label>
                <div class="col">
                  <label for="province">Provincia</label>
                  <input
                    id="province"
                    @blur="v$.address.province.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.address.province.$error,
                      'is-valid': !v$.address.province.$invalid,
                    }"
                    placeholder="Provincia"
                    v-model="form.address.province"
                  />
                  <span
                    class="invalid-feedback"
                    v-if="v$.address.province.$error"
                  >
                    {{ v$.address.province.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="district">Distrito</label>
                  <input
                    id="district"
                    @blur="v$.address.district.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.address.district.$error,
                      'is-valid': !v$.address.district.$invalid,
                    }"
                    placeholder="Distrito"
                    v-model="form.address.district"
                  />
                  <span
                    class="invalid-feedback"
                    v-if="v$.address.district.$error"
                  >
                    {{ v$.address.district.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="neighbourhood">Bairro</label>
                  <input
                    id="neighbourhood"
                    @blur="v$.address.neighbourhood.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.address.neighbourhood.$error,
                      'is-valid': !v$.address.neighbourhood.$invalid,
                    }"
                    placeholder="Bairro"
                    v-model="form.address.neighbourhood"
                  />
                  <span
                    class="invalid-feedback"
                    v-if="v$.address.neighbourhood.$error"
                  >
                    {{ v$.address.neighbourhood.$errors[0].$message }}
                  </span>
                </div>
              </div>

              <div class="row mb-3 border py-2">
                <label class="my-2">Bilhete de identidade</label>
                <div class="col">
                  <label for="number">Numero</label>
                  <input
                    id="number"
                    @blur="v$.identification.number.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.identification.number.$error,
                      'is-valid': !v$.identification.number.$invalid,
                    }"
                    placeholder="Numero"
                    v-model="form.identification.number"
                  />
                  <span
                    class="invalid-feedback"
                    v-if="v$.identification.number.$error"
                  >
                    {{ v$.identification.number.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="archive">Arquivo de Identificação civil</label>
                  <input
                    id="archive"
                    @blur="v$.identification.archive.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.identification.archive.$error,
                      'is-valid': !v$.identification.archive.$invalid,
                    }"
                    placeholder="Arquivo de identificação civil"
                    v-model="form.identification.archive"
                  />
                  <span
                    class="invalid-feedback"
                    v-if="v$.identification.archive.$error"
                  >
                    {{ v$.identification.archive.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="issueDate">Data de registo</label>
                  <input
                    id="issueDate"
                    @blur="v$.identification.issueDate.$touch"
                    type="date"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.identification.issueDate.$error,
                      'is-valid': !v$.identification.issueDate.$invalid,
                    }"
                    placeholder="Data de registo"
                    v-model="form.identification.issueDate"
                  />
                  <span
                    class="invalid-feedback"
                    v-if="v$.identification.issueDate.$error"
                  >
                    {{ v$.identification.issueDate.$errors[0].$message }}
                  </span>
                </div>
              </div>

              <div class="row mb-3 py-2">
                <div class="col">
                  <label for="archive">Estado civil</label>
                  <select
                    id="maritalState"
                    @blur="v$.genre.$touch"
                    class="form-select"
                    :class="{
                      'is-invalid': v$.maritalState.$error,
                      'is-valid': !v$.maritalState.$invalid,
                    }"
                    aria-label="Selecção de estado civil"
                    v-model="form.maritalState"
                  >
                    <option selected disabled>Selecione o estado civil</option>
                    <option value="Solteiro(a)">Solteiro(a)</option>
                    <option value="Casado(a)">Casado(a)</option>
                    <option value="Divorciado(a)">Divorciado(a)</option>
                    <option value="Viuvo(a)">Viuvo(a)</option>
                  </select>
                  <span class="invalid-feedback" v-if="v$.maritalState.$error">
                    {{ v$.maritalState.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="archive">Genero</label>
                  <select
                    id="genre"
                    @blur="v$.genre.$touch"
                    class="form-select"
                    :class="{
                      'is-invalid': v$.genre.$error,
                      'is-valid': !v$.genre.$invalid,
                    }"
                    aria-label="Selecção de genero"
                    v-model="form.genre"
                  >
                    <option selected disabled>Selecione o seu genero</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                  </select>
                  <span class="invalid-feedback" v-if="v$.maritalState.$error">
                    {{ v$.maritalState.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="archive">Raça</label>
                  <select
                    id="race"
                    @blur="v$.race.$touch"
                    class="form-select"
                    :class="{
                      'is-invalid': v$.race.$error,
                      'is-valid': !v$.race.$invalid,
                    }"
                    aria-label="Selecção de raça"
                    v-model="v$.race.$model"
                  >
                    <option selected disabled>Selecione a sua raça</option>
                    <option value="Negro">Negro</option>
                    <option value="Caucasiano">Caucasiano(Branco)</option>
                    <option value="Mestiço">Mestiço</option>
                    <option value="Asiático">Asiático</option>
                    <option value="Outro">Outro</option>
                  </select>
                  <span class="invalid-feedback" v-if="v$.race.$error">
                    {{ v$.race.$errors[0].$message }}
                  </span>
                </div>
              </div>
              <div class="row mb-3 py-2">
                <div class="col">
                  <label for="phoneNumber">Telefone</label>
                  <input
                    id="phoneNumber"
                    @blur="v$.phoneNumber.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.phoneNumber.$error,
                      'is-valid': !v$.phoneNumber.$invalid,
                    }"
                    placeholder="Telefone"
                    v-model="form.phoneNumber"
                  />
                  <span class="invalid-feedback" v-if="v$.phoneNumber.$error">
                    {{ v$.phoneNumber.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="profession">Profissão</label>
                  <input
                    id="profession"
                    @blur="v$.profession.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.profession.$error,
                      'is-valid': !v$.profession.$invalid,
                    }"
                    placeholder="profissão"
                    v-model="form.profession"
                  />
                  <span class="invalid-feedback" v-if="v$.profession.$error">
                    {{ v$.profession.$errors[0].$message }}
                  </span>
                </div>

                <div class="col">
                  <label for="workPlace">Local de trabalho</label>
                  <input
                    id="workPlace"
                    @blur="v$.workPlace.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.workPlace.$error,
                      'is-valid': !v$.workPlace.$invalid,
                    }"
                    placeholder="Local de trabalho"
                    v-model="form.workPlace"
                  />
                  <span class="invalid-feedback" v-if="v$.workPlace.$error">
                    {{ v$.workPlace.$errors[0].$message }}
                  </span>
                </div>
              </div>
              <div class="row mb-3 py-2">
                <div class="col">
                  <label for="naturality">Naturalidade</label>
                  <input
                    id="naturality"
                    @blur="v$.naturality.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.naturality.$error,
                      'is-valid': !v$.naturality.$invalid,
                    }"
                    placeholder="Naturalidade"
                    v-model="form.naturality"
                  />
                  <span class="invalid-feedback" v-if="v$.naturality.$error">
                    {{ v$.naturality.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="fatherName">Nome do pai</label>
                  <input
                    id="fatherName"
                    @blur="v$.fatherName.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.fatherName.$error,
                      'is-valid': !v$.fatherName.$invalid,
                    }"
                    placeholder="Nome do pai"
                    v-model="form.fatherName"
                  />
                  <span class="invalid-feedback" v-if="v$.fatherName.$error">
                    {{ v$.fatherName.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="motherName">Nome do mãe</label>
                  <input
                    id="motherName"
                    @blur="v$.motherName.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.motherName.$error,
                      'is-valid': !v$.motherName.$invalid,
                    }"
                    placeholder="Nome do mãe"
                    v-model="form.motherName"
                  />
                  <span class="invalid-feedback" v-if="v$.motherName.$error">
                    {{ v$.motherName.$errors[0].$message }}
                  </span>
                </div>
              </div>

              <button class="btn btn-primary btn-block btn-lg">
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
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- </div> -->
    <Footer />
  </div>
</template>

<script setup>
import { reactive, computed, onMounted } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, helpers, minLength } from "@vuelidate/validators";

import useProcesses from "../../composables/processes";
import useAuth from "../../composables/auth";

import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";

const form = reactive({
  user_id: "",
  maritalState: "",
  genre: "",
  race: "",
  profession: "",
  workPlace: "",
  naturality: "",
  phoneNumber: "",
  fatherName: "",
  motherName: "",
  address: {
    province: "",
    district: "",
    neighbourhood: "",
  },
  identification: {
    number: "",
    archive: "",
    issueDate: "",
  },
});

onMounted(() => {});

const toggleSideMenu = () => {
  document.getElementById("sidebar").classList.toggle("active");
};

const { processing, errors, storeProcess } = useProcesses();

const rules = computed(() => ({
  user_id: { required },
  maritalState: {},
  genre: {
    required: helpers.withMessage("Por favor preencha o seu genero", required),
  },
  race: {
    required: helpers.withMessage("Por favor preencha a sua raça", required),
  },
  profession: {},
  workPlace: {},
  naturality: {
    required: helpers.withMessage(
      "Por favor preencha a sua nacionalidade",
      required
    ),
  },
  phoneNumber: {
    required: helpers.withMessage(
      "Por favor preencha o seu numero de telefone",
      required
    ),
  },
  fatherName: {},
  motherName: {},
  address: {
    province: {
      required: helpers.withMessage("Por favor preencha a provincia", required),
    },
    district: {
      required: helpers.withMessage("Por favor preencha o distrito", required),
    },
    neighbourhood: {
      required: helpers.withMessage("Por favor preencha o bairro", required),
    },
    process_id: { required },
  },
  identification: {
    number: {
      required: helpers.withMessage(
        "Por favor preencha o numero do BI",
        required
      ),
    },
    archive: {
      required: helpers.withMessage(
        "Por favor preencha o arquivo de identificação",
        required
      ),
    },
    issueDate: {
      required: helpers.withMessage(
        "Por favor preencha a data de registo do BI",
        required
      ),
    },
  },
}));

const v$ = useVuelidate(rules, form);

const saveProcess = async () => {
  const { auth } = useAuth();

  form.user_id = auth.id;
  v$._value.$validate();

  if (!v$._value.$invalid) {
    await storeProcess({ ...form });
  } else {
    processing.value = false;
  }
};
</script>
<!-- <script>
import axios from "axios";
import useValidate from "@vuelidate/core";
import {
  required,
  email,
  sameAs,
  helpers,
  minLength,
} from "@vuelidate/validators";

import NavBar from "../../components/NavBar.vue";
import Footer from "../../components/Footer.vue";

export default {
  name: "ProcesseCreate",
  data() {
    return {
      v$: useValidate(),
      address: {
        province: "",
        district: "",
        neighbourhood: "",
      },
      identification: {
        number: "",
        archive: "",
        issueDate: "",
      },
      process: {
        user_id: "",
        maritalState: "",
        genre: "",
        race: "",
        profession: "",
        workPlace: "",
        naturality: "",
        phoneNumber: "",
        fatherName: "",
        motherName: "",
      },
      processing: false,
      errors_exist: false,
      validationErrors: null,
    };
  },
  methods: {
    toggleSideMenu() {
      document.getElementById("sidebar").classList.toggle("active");
    },
    async handleSubmit() {
      this.processing = true;
      this.v$.$validate();
      if (!this.v$.$error) {
        await axios
          .post("process/register", {
            province: this.address.province,
            district: this.address.district,
            neighbourhood: this.address.neighbourhood,

            number: this.identification.number,
            archive: this.identification.archive,
            issueDate: this.identification.issueDate,

            user_id: this.process.user_id,
            maritalState: this.process.maritalState,
            genre: this.process.maritalState,
            race: this.process.race,
            profession: this.process.profession,
            workPlace: this.process.workPlace,
            naturality: this.process.naturality,
            phoneNumber: this.process.phoneNumber,
            fatherName: this.process.fatherName,
            motherName: this.process.motherName,
            identification_id: this.process.identification_id,
          })
          .then((response) => {
            this.processing = false;
            this.$router.push("/login");
          })
          .catch((ex) => {
            this.processing = false;
            switch (ex.response.status) {
              case 422:
                this.validationErrors = ex.response.data.errors;
                this.errors_exist = true;
                break;
            }
          });
      } else {
        this.processing = false;
      }
    },
  },
  validations() {
    return {
      address: {
        province: {
          required: helpers.withMessage(
            "Por favor preencha a provincia",
            required
          ),
        },
        district: {
          required: helpers.withMessage(
            "Por favor preencha o distrito",
            required
          ),
        },
        neighbourhood: {
          required: helpers.withMessage(
            "Por favor preencha o bairro",
            required
          ),
        },
        process_id: { required },
      },
      identification: {
        number: {
          required: helpers.withMessage(
            "Por favor preencha o numero do BI",
            required
          ),
        },
        archive: {
          required: helpers.withMessage(
            "Por favor preencha o arquivo de identificação",
            required
          ),
        },
        issueDate: {
          required: helpers.withMessage(
            "Por favor preencha a data de registo do BI",
            required
          ),
        },
      },
      process: {
        user_id: { required },
        maritalState: {},
        genre: {
          required: helpers.withMessage(
            "Por favor preencha o seu genero",
            required
          ),
        },
        race: {
          required: helpers.withMessage(
            "Por favor preencha a sua raça",
            required
          ),
        },
        profession: {},
        workPlace: {},
        naturality: {
          required: helpers.withMessage(
            "Por favor preencha a sua nacionalidade",
            required
          ),
        },
        phoneNumber: {
          required: helpers.withMessage(
            "Por favor preencha o seu numero de telefone",
            required
          ),
        },
        fatherName: {},
        motherName: {},
      },
      processing: {},
      errors_exist: {},
      validationErrors: {},
    };
  },
  components: { NavBar, Footer },
};
</script> -->
