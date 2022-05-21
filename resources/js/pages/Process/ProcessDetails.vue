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
            <a href="#" class="nav-link text-white">Consultas</a>
          </li>
          <li>
            <a href="#" class="nav-link text-white">Nova consulta</a>
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
            <form @submit.prevent="handleSubmit">
              <h3 class="text-center">Dados do processo</h3>
              <div v-if="errors_exist">
                <div
                  v-for="(field, k) in validationErrors"
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
                    v-model="v$.address.province.$model"
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
                    v-model="v$.address.district.$model"
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
                    v-model="v$.address.neighbourhood.$model"
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
                    v-model="v$.identification.number.$model"
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
                    v-model="v$.identification.archive.$model"
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
                    v-model="v$.identification.issueDate.$model"
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
                    @blur="v$.process.genre.$touch"
                    class="form-select"
                    :class="{
                      'is-invalid': v$.process.maritalState.$error,
                      'is-valid': !v$.process.maritalState.$invalid,
                    }"
                    aria-label="Selecção de estado civil"
                    v-model="v$.process.maritalState.$model"
                  >
                    <option selected disabled>Selecione o estado civil</option>
                    <option value="Solteiro(a)">Solteiro(a)</option>
                    <option value="Casado(a)">Casado(a)</option>
                    <option value="Divorciado(a)">Divorciado(a)</option>
                    <option value="Viuvo(a)">Viuvo(a)</option>
                  </select>
                  <span
                    class="invalid-feedback"
                    v-if="v$.process.maritalState.$error"
                  >
                    {{ v$.process.maritalState.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="archive">Genero</label>
                  <select
                    id="genre"
                    @blur="v$.process.genre.$touch"
                    class="form-select"
                    :class="{
                      'is-invalid': v$.process.genre.$error,
                      'is-valid': !v$.process.genre.$invalid,
                    }"
                    aria-label="Selecção de genero"
                    v-model="v$.process.genre.$model"
                  >
                    <option selected disabled>Selecione o seu genero</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                  </select>
                  <span
                    class="invalid-feedback"
                    v-if="v$.process.maritalState.$error"
                  >
                    {{ v$.process.maritalState.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="archive">Raça</label>
                  <select
                    id="race"
                    @blur="v$.process.race.$touch"
                    class="form-select"
                    :class="{
                      'is-invalid': v$.process.race.$error,
                      'is-valid': !v$.process.race.$invalid,
                    }"
                    aria-label="Selecção de raça"
                    v-model="v$.process.race.$model"
                  >
                    <option selected disabled>Selecione a sua raça</option>
                    <option value="Negro">Negro</option>
                    <option value="Caucasiano">Caucasiano(Branco)</option>
                    <option value="Mestiço">Mestiço</option>
                    <option value="Asiático">Asiático</option>
                    <option value="Outro">Outro</option>
                  </select>
                  <span class="invalid-feedback" v-if="v$.process.race.$error">
                    {{ v$.process.race.$errors[0].$message }}
                  </span>
                </div>
              </div>
              <div class="row mb-3 py-2">
                <div class="col">
                  <label for="phoneNumber">Telefone</label>
                  <input
                    id="phoneNumber"
                    @blur="v$.process.phoneNumber.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.process.phoneNumber.$error,
                      'is-valid': !v$.process.phoneNumber.$invalid,
                    }"
                    placeholder="Telefone"
                    v-model="v$.process.phoneNumber.$model"
                  />
                  <span
                    class="invalid-feedback"
                    v-if="v$.process.phoneNumber.$error"
                  >
                    {{ v$.process.phoneNumber.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="profession">Profissão</label>
                  <input
                    id="profession"
                    @blur="v$.process.profession.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.process.profession.$error,
                      'is-valid': !v$.process.profession.$invalid,
                    }"
                    placeholder="profissão"
                    v-model="v$.process.profession.$model"
                  />
                  <span
                    class="invalid-feedback"
                    v-if="v$.process.profession.$error"
                  >
                    {{ v$.process.profession.$errors[0].$message }}
                  </span>
                </div>

                <div class="col">
                  <label for="workPlace">Local de trabalho</label>
                  <input
                    id="workPlace"
                    @blur="v$.process.workPlace.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.process.workPlace.$error,
                      'is-valid': !v$.process.workPlace.$invalid,
                    }"
                    placeholder="Local de trabalho"
                    v-model="v$.process.workPlace.$model"
                  />
                  <span
                    class="invalid-feedback"
                    v-if="v$.process.workPlace.$error"
                  >
                    {{ v$.process.workPlace.$errors[0].$message }}
                  </span>
                </div>
              </div>
              <div class="row mb-3 py-2">
                <div class="col">
                  <label for="naturality">Naturalidade</label>
                  <input
                    id="naturality"
                    @blur="v$.process.naturality.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.process.naturality.$error,
                      'is-valid': !v$.process.naturality.$invalid,
                    }"
                    placeholder="Naturalidade"
                    v-model="v$.process.naturality.$model"
                  />
                  <span
                    class="invalid-feedback"
                    v-if="v$.process.naturality.$error"
                  >
                    {{ v$.process.naturality.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="fatherName">Nome do pai</label>
                  <input
                    id="fatherName"
                    @blur="v$.process.fatherName.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.process.fatherName.$error,
                      'is-valid': !v$.process.fatherName.$invalid,
                    }"
                    placeholder="Nome do pai"
                    v-model="v$.process.fatherName.$model"
                  />
                  <span
                    class="invalid-feedback"
                    v-if="v$.process.fatherName.$error"
                  >
                    {{ v$.process.fatherName.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="motherName">Nome do mãe</label>
                  <input
                    id="motherName"
                    @blur="v$.process.motherName.$touch"
                    type="text"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.process.motherName.$error,
                      'is-valid': !v$.process.motherName.$invalid,
                    }"
                    placeholder="Nome do mãe"
                    v-model="v$.process.motherName.$model"
                  />
                  <span
                    class="invalid-feedback"
                    v-if="v$.process.motherName.$error"
                  >
                    {{ v$.process.motherName.$errors[0].$message }}
                  </span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- </div> -->
    <Footer />
  </div>
</template>

<script>
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
  name: "ProcesseDetails",
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
</script>
