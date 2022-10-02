<template>
  <div>
    <NavBar />
    <div class="wrapper">
      <!-- Sidebar -->
      <nav id="sidebar" class="bg-primary">
        <div class="sidebar-header">
          <h3>Consulta</h3>
        </div>

        <ul class="list-unstyled components">
          <!-- <li class="active">
            <router-link to="/process/create" class="nav-link text-white"
              >Marcação de consulta</router-link
            >
          </li> -->
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
            <form @submit.prevent="handleSubmit">
              <h3 class="text-center">Marcação de consulta</h3>
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
                <div class="col">
                  <label for="province">Tipo de consulta</label>
                  <select
                    id="type"
                    @blur="v$.consult.type.$touch"
                    class="form-select"
                    :class="{
                      'is-invalid': v$.consult.type.$error,
                      'is-valid': !v$.consult.type.$invalid,
                    }"
                    aria-label="Selecção de estado civil"
                    v-model="v$.consult.type.$model"
                  >
                    <option selected disabled>
                      Selecione o tipo de consulta
                    </option>
                    <option value="Próteses">Próteses</option>
                    <option value="Ortoteses">Ortoteses</option>
                  </select>
                  <span class="invalid-feedback" v-if="v$.consult.type.$error">
                    {{ v$.consult.type.$errors[0].$message }}
                  </span>
                </div>
                <div class="col">
                  <label for="province">Data a realizar-se</label>
                  <input
                    id="date"
                    @blur="v$.consult.date.$touch"
                    type="date"
                    class="form-control"
                    :class="{
                      'is-invalid': v$.consult.date.$error,
                      'is-valid': !v$.consult.date.$invalid,
                    }"
                    placeholder="Telefone"
                    v-model="v$.consult.date.$model"
                  />
                  <span class="invalid-feedback" v-if="v$.consult.date.$error">
                    {{ v$.consult.date.$errors[0].$message }}
                  </span>
                </div>
              </div>

              <button
                class="btn btn-primary btn-block mb-3"
                :disabled="processing"
              >
                <span
                  v-if="processing"
                  class="spinner-border spinner-border-sm mx-2"
                  role="status"
                  aria-hidden="true"
                ></span>
                <span v-if="processing">Processando...</span>

                <span v-if="!processing">Submeter</span>
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
  name: "ConsultCreate",
  data() {
    return {
      v$: useValidate(),
      consult: {
        type: "",
        date: "",
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
      consult: {
        type: {
          required: helpers.withMessage(
            "Por favor selecione o tipo de consulta",
            required
          ),
        },
        date: {
          required: helpers.withMessage("Por favor selecione a data", required),
        },
      },
      processing: {},
      errors_exist: {},
      validationErrors: {},
    };
  },
  components: { NavBar, Footer },
};
</script>
